<?php

########################################################################
# Extension Manager/Repository config file for ext "t3_less".
#
# Auto generated 25-08-2012 09:46
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'LESS for TYPO3',
	'description' => 'An easy to use extbase extension for using LESScss in TYPO3. You can choose between leafo.net LESS-PHP-compiler or Javascript-based less.js-compiler. It is also possible to include compiled files and delete unused/old compiled files automaticaly.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.5.2',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => 'fileadmin/t3_less/lessfiles',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'David Greiner',
	'author_email' => 'hallo@davidgreiner.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:10:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"50e4";s:14:"ext_tables.php";s:4:"1ea5";s:37:"Classes/Controller/LessController.php";s:4:"a23b";s:38:"Configuration/TypoScript/constants.txt";s:4:"aa5e";s:34:"Configuration/TypoScript/setup.txt";s:4:"065b";s:40:"Resources/Private/Language/locallang.xml";s:4:"4ef5";s:35:"Resources/Private/Lib/lessc.inc.php";s:4:"db5a";s:37:"Resources/Public/Js/less-1.3.0.min.js";s:4:"ca73";s:14:"doc/manual.sxw";s:4:"cff5";}',
);

?>