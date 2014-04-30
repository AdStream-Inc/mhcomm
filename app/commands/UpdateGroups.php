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
		foreach (Config::get('groups') as $groupData) {
			try {
				$group = Sentry::findGroupByName($groupData['name']);
				$group->permissions = $groupData['permissions'];
				$group->save();
			} catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
				Sentry::createGroup(array(
		        'name' => $groupData['name'],
		        'permissions' => $groupData['permissions'],
		    ));

		    $this->info('Adding new group [' . $groupData['name'] . ']');
			}
		}
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
