<?php

namespace Model;

use \framework\Manager;

abstract class NewsManager extends Manager{

	abstract public function getList($debut = -1, $limite = -1);
}