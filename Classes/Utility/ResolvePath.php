<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 *
 *
 * @package TYPO3
 * @subpackage t3_less
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author  David Greiner <hallo@davidgreiner.de>
 */
class Tx_T3Less_Utility_ResolvePath {
    /*
     * Returns correct path to Less/Css-Folders
     * @todo: is there no t3lib_xx-function to resolve folder pathes starting with 'EXT:' ?
     * 
     * @param $path string Given path
     */
    public function getPath($path, $file = false) {
        
        // resolving 'EXT:' from path, if path begins with 'EXT:' 
        if (!strcmp(substr($path, 0, 4), 'EXT:')) {
            list($extKey, $endOfPath) = explode('/', substr($path, 4), 2);
            if ($extKey && t3lib_extMgm::isLoaded($extKey)) {
                $extPath = t3lib_extMgm::extPath($extKey);
		$path = substr($extPath, strlen(PATH_site)) . $endOfPath;
            }
        }
        
        // check for trailing slash and add it if it is not given
        if(substr($path, -1, 1) !== '/' && $file === false) {
            $path = $path . '/' ;
        }
        
        return $path;
    }

}

?>
