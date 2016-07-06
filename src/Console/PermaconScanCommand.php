<?php namespace furkankadioglu\Permacon\Console;

/************************
*
*	Rys - Furkan Kadıoğlu
*	May - 2016	
*	http://github.com/furkankadioglu
*
*************************/

use Illuminate\Console\Command;

class PermaconScanCommand extends Command {

	protected $name = 'permacon:scan';
	protected $description = 'Return all configration files and generating stubs for each.';
	protected $type = 'Module';


	public function fire()
	{
		$this->info('+ Scanning configration files');

		$files = scandir(config_path());

		foreach($files as $file)
		{
			$this->info($file);
		}
		
	}


}
