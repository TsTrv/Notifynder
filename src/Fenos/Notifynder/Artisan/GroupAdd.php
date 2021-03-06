<?php namespace Fenos\Notifynder\Artisan;

use Fenos\Notifynder\Groups\NotifynderGroup;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GroupAdd extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'notifynder:group-add';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Store a new notifynder group in the DB.';

    /**
     * @var NotifynderGroup
     */
    private $notifynderGroup;

    /**
     * Create a new command instance.
     *
     * @param \Fenos\Notifynder\Groups\NotifynderGroup $notifynderGroup
     * @return \Fenos\Notifynder\Artisan\GroupAdd
     */
	public function __construct(NotifynderGroup $notifynderGroup)
	{
		parent::__construct();
        $this->notifynderGroup = $notifynderGroup;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $nameGroup = $this->argument('name');

        if ($this->notifynderGroup->addGroup($nameGroup))
        {
            $this->info("Group {$nameGroup} has Been created");
        }
        else
        {
            $this->error('The name must be a string with dots as namespaces');
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
			array('name', InputArgument::REQUIRED, 'user.post.add'),
		);
	}
}
