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

namespace XashPHP\config;

class Config {

    const YAML = 1;

    public $file;

    public function __construct(string $path, int $type, array $default = []){
        if(!file_exists($path)){
            $this->file = fopen($path, "w");
            fwrite($this->file, yaml_emit($default));
        }
        $this->file = fopen($path, "a+");
    }
    
    public function close(){
        fclose($this->file);
    }

}