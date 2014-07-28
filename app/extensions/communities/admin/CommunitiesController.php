<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Request;
use Response;
use Sentry;
use Str;
use File;
use Adstream\Models\Communities;
use Adstream\Models\User;
use Adstream\Controllers\BaseController;
use Adstream\Models\CommunityImages;
use Adstream\Models\CommunityEvents;

class CommunitiesController extends BaseController {

    private $model;

    private $users;

    private $images;

    private $managers;

    private $communityEvents;

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
    public function __construct(Communities $communities, User $users, CommunityImages $images, CommunityEvents $events)
	{
        parent::__construct();
        $this->users = $users;
        $this->images = $images;
        $this->model = $communities;
        $this->communityEvents = $events;

        $managersGroup = Sentry::findGroupByName('Manager');
        $superManagerGroup = Sentry::findGroupByName('Super Manager');

        $managerUsers = Sentry::findAllUsersInGroup($managersGroup);
        $superManagerUsers = Sentry::findAllUsersInGroup($superManagerGroup);

        $managers = array();

        foreach ($managerUsers as $user) {
          $managers[$user->id] = $user->present()->fullName;
        }

        foreach ($superManagerUsers as $user) {
          $managers[$user->id] = $user->present()->fullName;
        }

        $this->managers = $managers;
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
        $superManager = Sentry::findGroupByName('Super Manager');

        if ($user->inGroup($manager) || $user->inGroup($superManager)) {
            $communities = $user->communities;

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
        $managers = $this->managers;

        return View::make('admin.communities.create', compact('managers'));
    }

    public function edit($id)
    {
        $community = $this->model->find($id);
        $images = $community->images;
        $managers = $this->managers;
        $activeManagers = $community->users()->lists('id');
        $events = $community->communityEvents;

        $newslettersDir = public_path() . '/uploads/' . $community->id . '/newsletters';
        $allFiles = File::files($newslettersDir);
        $newsletters = array();

        foreach ($allFiles as $file) {
            $fullPathName = public_path() . '/uploads/' . $community->id . '/newsletters/';
            $fileName = substr($file, strlen($fullPathName));
            $path = url('/') . '/uploads/' . $community->id . '/newsletters/' . $fileName;

            if ($path != $community->newsletter) {
                $newsletters[] = array(
                    'original' => $file,
                    'name' => $fileName,
                    'path' => $path
                );
            }
        }

        return View::make('admin.communities.edit', compact('community', 'managers', 'images', 'activeManagers', 'events', 'newsletters'));
    }

    public function store()
    {
        $community = new $this->model(Input::all());
        $community->slug = Str::slug(Input::get('name'));

        $mainImage = Input::file('main_image_file');
        if ($mainImage && in_array(strtolower($mainImage->getClientOriginalExtension()), array('jpg', 'png', 'gif', 'jpeg', 'bmp'))) {
            $community->main_image = $this->saveMainImage($community);
        }

        $newsletter = Input::file('newsletter_file');
        if ($newsletter) {
            $community->newsletter = $this->saveCommunityNewsletter($community);
        }

        if ($community->save()) {
            if (Input::has('managers')) {
                $community->users()->sync(Input::get('managers'));
            }

            if (Input::has('image_titles')) {
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

        $mainImage = Input::file('main_image_file');
        if ($mainImage && in_array(strtolower($mainImage->getClientOriginalExtension()), array('jpg', 'png', 'gif', 'jpeg', 'bmp'))) {
            $community->main_image = $this->saveMainImage($community);
        }

        $newsletter = Input::file('newsletter_file');
        if ($newsletter) {
            $community->newsletter = $this->saveCommunityNewsletter($community);
        }

		$result = $community->update(Input::all());

        if ($result || $community->revisionPending) {
            if (Input::has('managers')) $community->users()->sync(Input::get('managers'));

            if (Input::get('image_titles')) {
                $this->saveCommunityImages($community);
            }

            if (Input::get('delete_images')) {
                $this->deleteCommunityImages();
            }

            if (Input::get('old_titles')) {
                $this->updateCommunityImages();
            }

            if (Input::get('events')) {
                $this->saveEvents($community);
            }

            if (Input::get('old_events')) {
                $this->updateEvents($community);
            }

            if (Input::get('delete_events')) {
                $this->deleteEvents();
            }

            if (Input::get('delete_newsletters')) {
                $this->deleteNewsletters();
            }

			$message = $result ? 'Community successfully updated!' : 'Your changes are pending approval from an administrator.';
            Alert::success($message)->flash();

            return Redirect::route($this->adminUrl . '.communities.index');

        }

        return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

    public function destroy($id) {
        $community = $this->model->find($id);
        $community->delete();

        Alert::success('Community successfully deleted!')->flash();
        return Redirect::route($this->adminUrl . '.communities.index');
    }

    private function saveImage($file, $name, $community)
    {
        $path = public_path() . '/uploads/' . $community->id . '/';
        $extension = $file->getClientOriginalExtension();
        $name = isset($name) ? $name . '-' . date('Y-m-d-H-m-s') : Str::random() . '-' . date('Y-m-d-H-m-s');
        $name = $name . '.' . $extension;
        $file->move($path, $name);
        return url('uploads') . '/' . $community->id . '/' . $name;
    }

    private function saveNewsletter($file, $name, $community)
    {
        $path = public_path() . '/uploads/' . $community->id . '/newsletters/';
        $extension = $file->getClientOriginalExtension();
        $extensionLength = strlen($extension) + 1;
        $name = isset($name) ? substr($name, 0, -($extensionLength)) : Str::random() . '-' . date('Y-m-d');
        $name = $name . '.' . $extension;
        $file->move($path, $name);
        return url('uploads') . '/' . $community->id . '/newsletters/' . $name;
    }

    private function saveMainImage($community)
    {
        $mainImage = Input::file('main_image_file');
        $mainImageSlug = 'main-image-' . date('Y-m-d');
        return $this->saveImage($mainImage, $mainImageSlug, $community);
    }

    private function saveCommunityImages($community)
    {
        $images = Input::file('images');
        $titles = Input::get('image_titles');
        foreach ($images as $key => $file) {
            if (isset($file)) {
                $title = $titles[$key];
                if (empty($title)) {
                    $title = Str::random();
                }
                $slug = Str::slug($title);
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, array('jpg', 'png', 'gif', 'jpeg', 'bmp'))) {
                    continue;
                }

                $image = new CommunityImages();
                $image->community_id = $community->id;
                $image->name = $title;
                $image->slug = $slug;
                $image->path = $this->saveImage($file, $slug, $community);
                $image->save();
            }
        }
    }

    private function saveCommunityNewsletter($community)
    {
        $newsletter = Input::file('newsletter_file');
        $extension = strtolower($newsletter->getClientOriginalExtension());
        $name = $newsletter->getClientOriginalName();

        if ($extension != 'pdf') {
           return false;
        }

        return $this->saveNewsletter($newsletter, $name, $community);
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
            if ($image) $image->delete();
        }
    }

    private function saveEvents($community)
    {
        $events = Input::get('events');
        $newImages = Input::file('js_new_event_image');

        // this needs to be before events array loop
        if ($newImages) {
            foreach ($newImages as $id => $image) {
                if ($image) {
                    $events[$id]['image_url'] = $this->saveImage($image, 'event-image-' . $id, $community);
                }
            }
        }

        foreach ($events as $event) {
            $event['community_id'] = $community->id;
            if (isset($event['start_date'])) {
                $event['start_date'] = $this->sqlDate($event['start_date']);
            }

            if (isset($event['end_date'])) {
                $event['end_date'] = $this->sqlDate($event['end_date']);
            }

            if (isset($event['recurring'])) {
                $event['recurring'] = $event['recurring'] == 'on' ? true : false;
            } else {
                $event['recurring'] =  false;
            }

            $this->communityEvents->create($event);
        }
    }

    private function updateEvents($community)
    {
        $events = Input::get('old_events');
        $newImages = Input::file('new_event_image');

        // this needs to be before events array loop
        if ($newImages) {
            foreach ($newImages as $id => $image) {
                if ($image) {
                    $events[$id]['image_url'] = $this->saveImage($image, 'event-image-' . $id, $community);
                }
            }
        }

        foreach ($events as $id => $data) {
            $event =  $this->communityEvents->find($id);

            if (isset($data['start_date'])) {
                $data['start_date'] = $this->sqlDate($data['start_date']);
            }

            if (isset($data['end_date'])) {
                $data['end_date'] = $this->sqlDate($data['end_date']);
            }

            if (isset($data['recurring'])) {
                $data['recurring'] = $data['recurring'] == 'on' ? true : false;
            } else {
                $data['recurring'] = false;
            }

            $event->update($data);
        }
    }

    private function deleteEvents()
    {
        $events = Input::get('delete_events');

        $this->communityEvents->destroy($events);
    }

    private function deleteNewsletters()
    {
        $newsletters = Input::get('delete_newsletters');

        foreach ($newsletters as $newsletter) {
            File::delete($newsletter);
        }
    }

    private function sqlDate($date) {
        return date('Y-m-d H:m:s', strtotime($date));
    }
}