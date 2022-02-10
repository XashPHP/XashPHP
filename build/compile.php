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

try
{
    $pharFile = 'XashPHP.phar';

    // clean up
    if (file_exists($pharFile)) 
    {
        unlink($pharFile);
    }

    if (file_exists($pharFile . '.gz')) 
    {
        unlink($pharFile . '.gz');
    }

    // create phar
    $phar = new Phar($pharFile);

    // start buffering. Mandatory to modify stub to add shebang
    $phar->startBuffering();

    // Create the default stub from main.php entrypoint
    $defaultStub = $phar->createDefaultStub('XashPHP.php');

    // Add the rest of the apps files
    $phar->buildFromDirectory(__DIR__ . '/../');

    // Customize the stub to add the shebang
    $stub = <<<'STUB'
<?php

require("phar://" . __FILE__ . "/src/XashPHP/XashPHP.php");

__HALT_COMPILER();
STUB;

    // Add the stub
    $phar->setStub($stub);

    $phar->stopBuffering();

    // plus - compressing it into gzip  
    $phar->compressFiles(Phar::GZ);

    # Make the file executable
    chmod(__DIR__ . '/XashPHP.phar', 0770);

    echo "$pharFile succesfully compiled!" . PHP_EOL;
}
catch (Exception $e)
{
    echo $e->getMessage();
}