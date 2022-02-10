<?php

/**
 *  __  __                _       ____    _   _   ____  
 *  \ \/ /   __ _   ___  | |__   |  _ \  | | | | |  _ \ 
 *   \  /   / _` | / __| | '_ \  | |_) | | |_| | | |_) |
 *   /  \  | (_| | \__ \ | | | | |  __/  |  _  | |  __/ 
 *  /_/\_\  \__,_| |___/ |_| |_| |_|     |_| |_| |_|    
 *                                                      
 * Copyright (C) 2022  XashPHP Team
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace XashPHP;

use XashPHP\config\Config;
use XashPHP\UtilsLoader;
use XashPHP\utils\Logger;
use function socket_create;

class Server
{

	private \Socket $sock;

	private string $address;
	private int $port;

	private $logger;

	public function __construct()
	{
		set_time_limit(0);
		$this->address = 'localhost';
		$this->port = 27015;
		$this->logger = new Logger();
		$server = new Config("server.yml", Config::YAML, [
			"ip" => "test",
			"port" => 27015
		]);
		$server->close();
	}
	
	public function spawn(){
		$this->UtilsLoader = new UtilsLoader($this);
		$sock = socket_create(AF_INET, SOCK_STREAM, 0);
		socket_bind($sock, $this->address, $this->port) or die('Could not bind to address');
		socket_listen($sock);
		/*while(true) // main server loop
		{
			sleep(1);
		}*/
	}

	public function getLogger(){
		return $this->logger;
	}
	
}