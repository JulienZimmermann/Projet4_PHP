<?php

namespace FrontendModel;

class Manager{
	protected function dbConnect(){
		$db = new \PDO('mysql:host=localhost;dbname=blog_p4', 'root', '');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
