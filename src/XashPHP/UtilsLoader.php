<?php

declare(strict_types=1);

namespace XashPHP;

use XashPHP\XashPHP;
use XashPHP\utils\OptionResolver;

class UtilsLoader {
	
	protected $XashPHP;
	
	public function __construct(XashPHP $XashPHP) {
		$this->XashPHP = $XashPHP;
		$this->load();
	}
	
	protected function load(){
		$this->XashPHP->OptionResolver = new OptionResolver();
	}
	
}