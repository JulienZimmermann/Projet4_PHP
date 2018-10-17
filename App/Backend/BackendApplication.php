<?php
namespace App\Backend;

use \framework\Application;

class BackendApplication extends Application{

	public function __construct(){

		parent::__construct();

		$this->name = 'Backend';
	}

	public function run(){

		$controller = new Module\Connexion\ConnexionController($this, 'Connexion', 'index');
		$controler = execute();

		$this->httpResponse->setPage($controller->page());
		$this->httpResponse->send();
	}
}
