<?php

/*
 * Author & Copyright: David Greiner
 * Contact: hallo@davidgreiner.de
 * Created on: 21.02.2013, 21:18:31
 */

class Tx_T3Less_Controller_LessJsController extends Tx_T3Less_Controller_BaseController {

    /**
     * lessJs
     * includes all less-files from defined lessfolder to head and less.js to the footer
     */
    public function lessJs($files) {
        //respect given sort order defined in TS 
        usort($files, array($this, 'getSortOrderJs'));
        //files in defined lessfolder?
        if ($files) {
            foreach ($files as $lessFile) {
                $filename = array_pop(explode('/', $lessFile));

                $excludeFromPageRender = $this->configuration['jscompiler']['filesettings'][substr($filename, 0, -5)]['excludeFromPageRenderer'];

                if (!$excludeFromPageRender || $excludeFromPageRender == 0) {
                    // array with filesettings from TS
                    $tsOptions = $this->configuration['jscompiler']['filesettings'][substr($filename, 0, -5)];

                    $GLOBALS['TSFE']->getPageRenderer()->addCssFile(
                            $lessFile, $rel = 'stylesheet/less', $media = $tsOptions['media'] ? $tsOptions['media'] : 'all', $title = $tsOptions['title'] ? $tsOptions['title'] : '', $compress = FALSE, $forceOnTop = FALSE, $allWrap = $tsOptions['allWrap'] ? $tsOptions['allWrap'] : '', $excludeFromConcatenation = TRUE
                    );
                }
            }
            //include less.js to footer            
            $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($file = Tx_T3Less_Utility_ResolvePath::getPath('EXT:t3_less/Resources/Public/Js/' . $this->configuration['other']['lessJsScriptPath'], true), $type = 'text/javascript', $compress = TRUE, $forceOnTop = FALSE);
        } else {
            echo Tx_T3Less_Utility_ErrorMessage::wrapErrorMessage(Tx_Extbase_Utility_Localization::translate('noLessFilesInFolder', $this->extensionName, $arguments = array('s' => $this->lessfolder)));
        }
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

        if ($sortOrder1 == $sortOrder2) {
            return 0;
        }
        return ($sortOrder1 < $sortOrder2) ? -1 : 1;
    }

}

?>
