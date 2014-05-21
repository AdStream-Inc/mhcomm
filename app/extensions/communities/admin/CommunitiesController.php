<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Request;
use Response;
use Sentry;
use Str;
use Adstream\Models\Communities;
use Adstream\Models\User;
use Adstream\Controllers\BaseController;
use Adstream\Models\CommunityImages;

class CommunitiesController extends BaseController {

    private $model;

    private $users;

    private $images;

    /**
     * The table fields for our data table
     * @var array
     */
    private $tableFields = array(
        array(
            'id' => 'name',
            'header' => array(
                array('text' => 'Name'),
                array('content' => 'textFilter')
            ),
            'adjust' => true,
            'fillspace' => true,
            'sort' => 'string'
        ),
        array(
            'id' => 'email',
            'header' => array(
                array('text' => 'Email'),
                array('content' => 'textFilter'),
            ),
            'adjust' => true,
            'fillspace' => true,
            'sort' => 'string'
        ),
		array(
            'id' => 'created_on',
            'header' => 'Created On',
            'adjust' => true,
            'sort' => 'string'
        ),
        array(
            'id' => 'last_updated',
            'header' => 'Last Updated',
            'adjust' => true,
            'sort' => 'string'
        )
    );

    /**
     * Setup Communities repository and construct BaseController
     * for additional properties
     * @param Communities $communities Communities repository
     */
    public function __construct(Communities $communities, User $users, CommunityImages $images)
	{
        parent::__construct();
        $this->users = $users;
        $this->images = $images;
        $this->model = $communities;
    }

    public function index()
    {
        $communities = $this->model->count();

        return View::make('admin.communities.index', compact('communities'));
    }

    public function listData()
    {
        $columns = $this->tableFields;
        $user = Sentry::getUser();
        $manager = Sentry::findGroupByName('Manager');

        if ($user->inGroup($manager)) {
            $communities = $user->community;

            foreach ($communities as &$community) {
                $community->name = '<a href="' . route($this->adminUrl . '.communities.edit', $community->id) . '">' . $community->name . '</a>';
                $community->created_on = $community->present()->createdOn;
                $community->last_updated = $community->present()->lastUpdated;
            }
        } else {
            $communities = $this->model->all();

            foreach ($communities as &$community) {
                $community->name = '<a href="' . route($this->adminUrl . '.communities.edit', $community->id) . '">' . $community->name . '</a>';
                $community->created_on = $community->present()->createdOn;
                $community->last_updated = $community->present()->lastUpdated;
            }
        }

        return Response::json(array('data' => $communities->toArray(), 'columns' => $columns));
    }

    public function create()
    {
        $group = Sentry::findGroupByName('Manager');
        $usersCollection = Sentry::findAllUsersInGroup($group);
        $managers = array();

        foreach ($usersCollection as $user) {
            $managers[$user->id] = $user->present()->fullName;
        }

        return View::make('admin.communities.create', compact('managers'));
    }

    public function edit($id)
    {
        $community = $this->model->find($id);
        $images = $community->images;

        $group = Sentry::findGroupByName('Manager');
        $usersCollection = Sentry::findAllUsersInGroup($group);
        $managers = array();

        foreach ($usersCollection as $user) {
            $managers[$user->id] = $user->present()->fullName;
        }

        return View::make('admin.communities.edit', compact('community', 'managers', 'images'));
    }

    public function store()
    {
        $community = new $this->model(Input::all());
        $community->slug = Str::slug(Input::get('name'));

        if (Input::file('main_image_file')) {
            $community->main_image = $this->saveMainImage($community);
        }

        if ($community->save()) {
            if (Input::get('image_titles')) {
                $this->saveCommunityImages($community);
            }

            Alert::success('Community successfully added!')->flash();
            return Redirect::route($this->adminUrl . '.communities.index');
        }

        return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

    public function update($id)
    {
        $community = $this->model->find($id);
        $community->slug = Str::slug(Input::get('name'));

        if (Input::file('main_image_file')) {
            $community->main_image = $this->saveMainImage($community);
        }

        if ($community->update(Input::all())) {
            if (Input::get('image_titles')) {
                $this->saveCommunityImages($community);
            }

            if (Input::get('delete_images')) {
                $this->deleteCommunityImages();
            }

            if (Input::get('old_titles')) {
                $this->updateCommunityImages();
            }

            if ($this->isManager) {
                Alert::success('Your changes are pending approval from an administrator.')->flash();
            } else {
                Alert::success('Community successfully updated!')->flash();
            }
            return Redirect::route($this->adminUrl . '.communities.index');
        }

        return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

    private function saveImage($file, $name, $community)
    {
        $path = public_path() . '/uploads/' . $community->id . '/';
        $extension = $file->getClientOriginalExtension();
        $name = empty($name) ? Str::random() . '-' . date('Y-m-d') : $name;
        $name = $name . '.' . $extension;
        $file->move($path, $name);
        return url('uploads') . '/' . $community->id . '/' . $name;
    }

    private function saveMainImage($community)
    {
        $mainImage = Input::file('main_image_file');
        $mainImageSlug = 'main-image';
        return $this->saveImage($mainImage, $mainImageSlug, $community);
    }

    private function saveCommunityImages($community)
    {
        $images = Input::file('images');
        $titles = Input::get('image_titles');
        foreach ($images as $key => $file) {
            $title = $titles[$key];
            $slug = Str::slug($title);

            $image = new CommunityImages();
            $image->community_id = $community->id;
            $image->name = $title;
            $image->slug = $slug;
            $image->path = $this->saveImage($file, $slug, $community);
            $image->save();
        }
    }

    private function updateCommunityImages()
    {
        $images = Input::get('old_titles');
        foreach ($images as $id => $title) {
            $slug = Str::slug($title);

            $image = $this->images->find($id);
            $image->name = $title;
            $image->slug = $slug;
            $image->save();
        }
    }

    private function deleteCommunityImages()
    {
        $images = Input::get('delete_images');
        foreach ($images as $id) {
            $image = $this->images->find($id);
            $image->delete();
        }
    }

}