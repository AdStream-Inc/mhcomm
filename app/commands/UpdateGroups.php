<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateGroups extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'groups:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the group permissions found in the groups.php config file.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$adminGroup = Sentry::findGroupByName('Admin');
		$adminGroup->permissions = Config::get('groups.admin.permissions');
		$adminGroup->save();

    $superUserGroup = Sentry::findGroupByName('Super User');
    $superUserGroup->permissions = Config::get('groups.superuser.permissions');
    $superUserGroup->save();

    $superManagerGroup = Sentry::findGroupByName('Super Manager');
    $superManagerGroup->permissions = Config::get('groups.supermanager.permissions');
    $superManagerGroup->save();

    $managerGroup = Sentry::findGroupByName('Manager');
    $managerGroup->permissions = Config::get('groups.manager.permissions');
    $managerGroup->save();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(

		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(

		);
	}

}
