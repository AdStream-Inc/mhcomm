<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Request;
use Response;
use Sentry;
use Adstream\Models\Communities;
use Adstream\Models\User;
use Adstream\Controllers\BaseController;

class CommunitiesController extends BaseController {

    private $model;

    private $users;

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
    public function __construct(Communities $communities, User $users)
	{
        parent::__construct();
        $this->users = $users;
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

        $group = Sentry::findGroupByName('Manager');
        $usersCollection = Sentry::findAllUsersInGroup($group);
        $managers = array();

        foreach ($usersCollection as $user) {
            $managers[$user->id] = $user->present()->fullName;
        }

        return View::make('admin.communities.edit', compact('community', 'managers'));
    }

    public function store()
    {
        $community = new $this->model(Input::all());

        if ($community->save()) {
            Alert::success('Community successfully added!')->flash();
            return Redirect::route($this->adminUrl . '.communities.index');
        }

        return Redirect::back()->withInput();
        // return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

    public function update($id)
    {
        $community = $this->model->find($id);

        if ($community->update(Input::all())) {
            if ($this->isManager) {
                Alert::success('Your changes are pending approval from an administrator.')->flash();
            } else {
                Alert::success('Community successfully updated!')->flash();
            }
            return Redirect::route($this->adminUrl . '.communities.index');
        }

        return Redirect::back()->withInput();
        // return Redirect::back()->withInput()->withErrors($community->getErrors());
    }

}