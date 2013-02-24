<?php

/*
 * Author & Copyright: David Greiner
 * Contact: hallo@davidgreiner.de
 * Created on: 21.02.2013, 21:02:48
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

}

?>
