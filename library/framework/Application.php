<?php

namespace framework;

abstract class Application{

	protected $httpRequest;
	protected $httpResponse;
	protected $name;
	protected $config;

	public function __construct(){
		$this->httpRequest = new HTPPRequest;
		$this->httpResponse = new HTTPResponse;
		$this->config = new Config;
		$this->name = '';
	}

	//Récupère le bon controlleur
	public function getController(){

		$routeur  = new Routeur;

		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../../Frontend/Routeur/routes.xml');

		$routes = $xml->getElementsByTagName('route');

		foreach ($routes as $route){

			$arrayVars = [];

			//Si une variable est présente dans l'URL
			if($route->hasAttribute('vars')){

				//Sépare le nom des variables par des ',' et récupère la valeur des variables
				$vars = explode(',', $route->getAttribute('vars'));
			}

			$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
		}

		try{
			$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
			
		}catch(\RuntimeException $e){

			if($e->getCode == Routeur::ERR_ROUTE){

				$this->httpResponse->page404();
			}
		}

		$_GET = array_merge($_GET, $matchedRoute->varName());

		$controllerClass = $this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module.'Controller';

		return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());


	}
	//Méthode qui doit être réécrite chez l'enfant
	abstract public function run();

	public function httpRequest(){
		return $this->httpRequest;
	}

	public function httpResponse(){
		return $this->httpResponse;
	}

	public function name(){
		return $this->name;
	}

	public function config(){
		return $this->config;
	}
}
