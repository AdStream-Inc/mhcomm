<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Sentry;
use Request;
use Response;
use Adstream\Controllers\BaseController;

class UsersController extends BaseController {

    /**
     * The table fields for our data table
     * @var array
     */
    private $tableFields = array(
        array(
            'id' => 'email',
            'header' => array(
                array('text' => 'Email'),
                array('content' => 'textFilter')
            ),
            'adjust' => true,
            'fillspace' => true,
            'sort' => 'string'
        ),
        array(
            'id' => 'name',
            'header' => array(
                array('text' => 'Name'),
                array('content' => 'textFilter'),
            ),
            'adjust' => true,
            'fillspace' => true,
            'sort' => 'string'
        ),
        array(
            'id' => 'login_last',
            'header' => 'Last Login',
            'adjust' => true,
            'sort' => 'string'
        ),
        array(
            'id' => 'created_on',
            'header' => 'Created On',
            'adjust' => true,
            'sort' => 'string'
        )
    );

    public function index()
    {
        $users = Sentry::where('first_name', '!=', 'Adstream')->count();
        return View::make('admin.users.index', compact('users'));
    }

    public function listData()
    {
        $users = Sentry::where('first_name', '!=', 'Adstream')->get();
        $columns = $this->tableFields;

        foreach ($users as &$user) {
            $user->email = '<a href="' . route($this->adminUrl . '.users.edit', $user->id) . '">' . $user->email . '</a>';
            $user->name = $user->present()->fullName;
            $user->created_on = $user->present()->createdOn;
            $user->login_last = $user->present()->lastLogin;
        }

        return Response::json(array('data' => $users->toArray(), 'columns' => $columns));
    }

    public function create()
    {
        $groupsCollection = Sentry::findAllGroups();
        $groups = array();
        foreach ($groupsCollection as $group) {
            $groups[$group->id] = $group->name;
        }
        $adstreamGroup = Sentry::findGroupByName('Adstream')->id;
        $groups = array_except($groups, array($adstreamGroup));

        return View::make('admin.users.create', compact('groups'));
    }

    public function edit($id)
    {
        $user = Sentry::findUserById($id);
        $userGroups = $user->getGroups()[0]->id;

        $groupsCollection = Sentry::findAllGroups();
        $groups = array();
        foreach ($groupsCollection as $group) {
            $groups[$group->id] = $group->name;
        }
        $adstreamGroup = Sentry::findGroupByName('Adstream')->id;
        $groups = array_except($groups, array($adstreamGroup));

        return View::make('admin.users.edit', compact('user', 'groups', 'userGroups'));
    }

    public function store()
    {
        /**
         * TODO:: find a better way to handle additional validation
         */
        try {
            $user = Sentry::createUser(array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password'),
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'activated' => true,
            ));

            if ($user) {
                $this->assignGroup($user, Input::get('user_group'));
                Alert::success('User successfully added!')->flash();
                return Redirect::route($this->adminUrl . '.users.index');
            }

            return Redirect::back()->withInput()->withErrors($user->getErrors());

        } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
            Alert::error('Email field is required.')->flash();
            return Redirect::to($this->adminUrl . '/users/create')->withInput();
        } catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            Alert::error('Password field is required.')->flash();
            return Redirect::to($this->adminUrl . '/users/create')->withInput();
        } catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
            Alert::error('A user with this email already exists.')->flash();
            return Redirect::to($this->adminUrl . '/users/create')->withInput();
        }
    }

    public function update($id)
    {
        $user = Sentry::findUserById($id);
        $user->email = Input::get('email');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');

        $this->assignGroup($user, Input::get('user_group'));

        if ($user->save()) {
            Alert::success('User successfully updated!')->flash();
            return Redirect::route($this->adminUrl . '.users.index');
        } else {
            return Redirect::back()->withInput()->withErrors($user->getErrors());
        }
    }

    public function destroy($id)
    {
        $user = Sentry::findUserById($id);
        $user->delete();

        Alert::success('User successfully deleted!')->flash();
        return Redirect::route($this->adminUrl . '.users.index');
    }

    private function assignGroup($user, $group)
    {
        foreach (Sentry::findAllGroups() as $gr) {
            $user->removeGroup($gr);
        }

        $group = Sentry::findGroupById($group);
        $user->addGroup($group);

        return $user;
    }
}