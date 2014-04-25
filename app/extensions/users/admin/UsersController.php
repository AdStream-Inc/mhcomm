<?php namespace Adstream\Controllers\Admin;

use View;
use Input;
use Redirect;
use Alert;
use Sentry;
use Adstream\Controllers\BaseController;

class UsersController extends BaseController {

    private $tableFields = array(
        'Email',
        'Name',
        'Last Login',
        'Created On'
    );

    public function index()
    {
        $users = Sentry::findAllUsers();
        $fields = $this->tableFields;
        return View::make('admin.users.index', compact('users', 'fields'));
    }

    public function create()
    {
        $groupsCollection = Sentry::findAllGroups();
        $groups = array();
        foreach ($groupsCollection as $group) {
            $groups[$group->id] = $group->name;
        }

        return View::make('admin.users.create', compact('groups'));
    }

    public function edit($id)
    {
        $user = Sentry::findUserById($id);
        $userGroups = $user->getGroups();

        $groupsCollection = Sentry::findAllGroups();
        $groups = array();
        foreach ($groupsCollection as $group) {
            $groups[$group->id] = $group->name;
        }

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