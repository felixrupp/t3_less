<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 David Greiner <hallo@davidgreiner.de>
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
class Tx_T3Less_Controller_BaseController extends Tx_Extbase_MVC_Controller_ActionController {

    /**
     * configuration array from constants
     * @var array $configuration
     */
    protected $configuration;

    /**
     * folder for lessfiles
     * @var string $lessfolder 
     */
    protected $lessfolder;

    /**
     * folder for compiled files 
     * @var string $outputfolder
     */
    protected $outputfolder;

    public function __construct() {
        //makeInstance should not be used, but injection does not work without FE-plugin?
        $objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
        $configurationManager = $objectManager->get('Tx_Extbase_Configuration_ConfigurationManagerInterface');

        $configuration = $configurationManager->getConfiguration(
                Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'T3Less', ''
        );
        $this->configuration = $configuration;

        parent::__construct();
    }

    /**
     * action base
     * 
     */
    public function baseAction() {
        if (TYPO3_MODE != 'FE') {
            return;
        }

        $this->lessfolder = Tx_T3Less_Utility_ResolvePath::getPath($this->configuration['files']['pathToLessFiles']);
        $this->outputfolder = Tx_T3Less_Utility_ResolvePath::getPath($this->configuration['files']['outputFolder']);

        $files = array();
        // compiler activated?
        if ($this->configuration['other']['activateCompiler']) {
            // folders defined?
            if ($this->lessfolder && $this->outputfolder) {
                // are there files in the defined less folder?
                if (t3lib_div::getFilesInDir($this->lessfolder, "less", TRUE)) {
                    $files = t3lib_div::getFilesInDir($this->lessfolder, "less", TRUE);
                } else {
                    echo Tx_T3Less_Utility_ErrorMessage::wrapErrorMessage(Tx_Extbase_Utility_Localization::translate('noLessFilesInFolder', $this->extensionName, $arguments = array('s' => $this->lessfolder)));
                }
            } else {
                echo Tx_T3Less_Utility_ErrorMessage::wrapErrorMessage(Tx_Extbase_Utility_Localization::translate('emptyPathes', $this->extensionName));
            }
        }


        /* Hook to pass less-files from other extension, see manual */
        if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['t3less']['addForeignLessFiles']) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['t3less']['addForeignLessFiles'] as $hookedFilePath) {
                $hookPath = Tx_T3Less_Utility_ResolvePath::getPath($hookedFilePath);
                $files[] = t3lib_div::getFilesInDir($hookPath, "less", TRUE);
            }
            $files = Tx_T3Less_Utility_FlatArray::flatArray(null, $files);
        }

        switch ($this->configuration['enable']['mode']) {
            case 'PHP-Compiler':
                Tx_T3Less_Controller_LessPhpController::lessPhp($files);
                break;

            case 'JS-Compiler':
                Tx_T3Less_Controller_LessJsController::lessJs($files);
                break;
        }
    }

    /** Helper functions * */

    /**
     * getSortOrderPhp
     * little helper function to respect given sort order defined in TS by using phpcompiler
     * @param type $file1
     * @param type $file2
     * @return int 
     */
    function getSortOrderPhp($file1, $file2) {
        $fileSettings = $this->configuration['phpcompiler']['filesettings'];
        $tsOptions1 = $fileSettings[substr($file1, 0, -37)];
        $tsOptions2 = $fileSettings[substr($file2, 0, -37)];
        $sortOrder1 = $tsOptions1['sortOrder'] ? $tsOptions1['sortOrder'] : 0;
        $sortOrder2 = $tsOptions2['sortOrder'] ? $tsOptions2['sortOrder'] : 0;
        $forceOnTop1 = $tsOptions1['forceOnTop'] ? $tsOptions1['forceOnTop'] : FALSE;
        $forceOnTop2 = $tsOptions2['forceOnTop'] ? $tsOptions2['forceOnTop'] : FALSE;
        $sortDirection = 1;
        if($forceOnTop1 || $forceOnTop2) {
            $sortDirection = -1;
        }

        if ($sortOrder1 == $sortOrder2) {
            return 0;
        }
        return $sortDirection * (($sortOrder1 < $sortOrder2) ? -1 : 1);
    }

    /**
     * getSortOrderJs
     * little helper function to respect given sort order defined in TS by using jscompiler
     * @param type $file1
     * @param type $file2
     * @return int 
     */
    function getSortOrderJs($file1, $file2) {
        $fileSettings = $this->configuration['jscompiler']['filesettings'];
        $tsOptions1 = $fileSettings[substr(array_pop(explode('/', $file1)), 0, -5)];
        $tsOptions2 = $fileSettings[substr(array_pop(explode('/', $file2)), 0, -5)];
        $sortOrder1 = $tsOptions1['sortOrder'] ? $tsOptions1['sortOrder'] : 0;
        $sortOrder2 = $tsOptions2['sortOrder'] ? $tsOptions2['sortOrder'] : 0;
        $forceOnTop1 = $tsOptions1['forceOnTop'] ? $tsOptions1['forceOnTop'] : FALSE;
        $forceOnTop2 = $tsOptions2['forceOnTop'] ? $tsOptions2['forceOnTop'] : FALSE;
        $sortDirection = 1;
        if($forceOnTop1 || $forceOnTop2) {
            $sortDirection = -1;
        }

        if ($sortOrder1 == $sortOrder2) {
            return 0;
        }
        return $sortDirection * (($sortOrder1 < $sortOrder2) ? -1 : 1);
    }

}

?>
