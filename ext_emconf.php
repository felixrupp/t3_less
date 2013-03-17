<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "t3_less".
 *
 * Auto generated 12-03-2013 14:57
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'LESS for TYPO3',
	'description' => 'An easy to use extbase extension for using LESScss in TYPO3. You can choose between leafo.net LESS-PHP-compiler or Javascript-based less.js-compiler. It is also possible to include compiled files and delete unused/old compiled files automaticaly.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.0.7',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'David Greiner',
	'author_email' => 'hallo@davidgreiner.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-7.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:21:{s:16:"ext_autoload.php";s:4:"d103";s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"2068";s:14:"ext_tables.php";s:4:"1ea5";s:37:"Classes/Controller/BaseController.php";s:4:"99de";s:39:"Classes/Controller/LessJsController.php";s:4:"8176";s:40:"Classes/Controller/LessPhpController.php";s:4:"ab93";s:48:"Classes/UserFunction/class.user_exampleClass.php";s:4:"6f74";s:32:"Classes/Utility/ErrorMessage.php";s:4:"460b";s:29:"Classes/Utility/FlatArray.php";s:4:"18f0";s:31:"Classes/Utility/ResolvePath.php";s:4:"146c";s:38:"Configuration/TypoScript/constants.txt";s:4:"37bb";s:34:"Configuration/TypoScript/setup.txt";s:4:"ac0e";s:40:"Resources/Private/Language/locallang.xml";s:4:"4ef5";s:35:"Resources/Private/Lib/lessc.inc.php";s:4:"a795";s:37:"Resources/Public/Js/less-1.3.0.min.js";s:4:"ca73";s:37:"Resources/Public/Js/less-1.3.1.min.js";s:4:"cef1";s:37:"Resources/Public/Js/less-1.3.2.min.js";s:4:"ae7d";s:37:"Resources/Public/Js/less-1.3.3.min.js";s:4:"3aa7";s:43:"Resources/Public/Js/less-1.4.0-alpha.min.js";s:4:"1750";s:14:"doc/manual.sxw";s:4:"3cad";}',
	'suggests' => array(
	),
);

?>