<?php namespace furkankadioglu\Permacon;

/************************
*
*	Rys - Furkan Kadıoğlu
*	May - 2016	
*	http://github.com/furkankadioglu
*
*************************/

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class PermaconServiceProvider extends ServiceProvider {

	protected $files;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */

	// Publish - Folders
	public $publishFolders = [
		'permacon',
	];


	public function boot() {


		/*
		*	php artisan vendor:publish
		*/




		//	Publish Folders Generate
		foreach((array)$this->publishFolders as $pf)
		{
			if (!file_exists(storage_path($pf))) 
			{
		    	mkdir(storage_path($pf), 0777, true);
			}
		}
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->files = new Filesystem;
		$this->registerScanCommand();
	}

	/**
	 * Register the "permacon:scan" console command.
	 *
	 * @return Console\PermaconScanCommand
	 */
	protected function registerScanCommand() {
		
		$this->commands('permacon.scan');
		$bind_method = method_exists($this->app, 'bindShared') ? 'bindShared' : 'singleton';
		$this->app->{$bind_method}('permacon.scan', function($app) {
			return new Console\PermaconScanCommand($this->files);
		});
	}


}
