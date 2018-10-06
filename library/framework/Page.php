<?php

namespace framework;

class Page extends Component{

	protected $contentFile;
	protected $vars = [];

	public function addVarPage($var, $value){

		if(!is_strin($var) || is_numeric($var) || empty($var)){
			throw new \InvalidAugumentException('Le nom de la variable doit être une chaîne de caractère et présente');
		}

		$this->vars[$var] = $value;
	}

	public function getGeneratedPage(){

		if(!file_exists($this->contentFile)){

			throw new \RuntimeException('La vue demandée n\'existe pas');
		}

		extract($this->vars);

		ob_start();
		require $this->contentFile;
		$content = ob_get_clean();

		ob_start();
		require(__DIR__.'/../../FrontendViews/layout.php');
		return ob_get_clean();
	}

	public function setContentFile($contentFile){

		if(!is_string($contentFile) || empty($contentFile)){
			throw new \InvalidAugumentException('La vue demandés est invalide');
		}

		$this->contentFile = $contentFile;
	}


}