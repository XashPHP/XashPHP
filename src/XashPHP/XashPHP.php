<?php

declare(strict_types=1);

namespace XashPHP;

use XashPHP\UtilsLoader;

class XashPHP
{
	
	public function spawn(){
		$this->UtilsLoader = new UtilsLoader($this);
	}
	
}

require(__DIR__ . "/../../vendor/autoload.php");
$xashphp = new XashPHP;
$xashphp->spawn();