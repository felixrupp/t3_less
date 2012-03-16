<?php

########################################################################
# Extension Manager/Repository config file for ext "t3_less".
#
# Auto generated 16-03-2012 18:52
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'LESS for TYPO3',
	'description' => 'An easy to use extbase extension to compile .less-files with the leafo.net less-php-compiler. It is also possible to include compiled files and delete unused/old compiled files automaticaly.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.0.2',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => 'fileadmin/t3_less/cssfiles, fileadmin/t3_less/lessfiles',
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
	'_md5_values_when_last_written' => 'a:14:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"08ef";s:14:"ext_tables.php";s:4:"355d";s:37:"Classes/Controller/LessController.php";s:4:"ea03";s:38:"Configuration/TypoScript/constants.txt";s:4:"38c7";s:34:"Configuration/TypoScript/setup.txt";s:4:"f7e4";s:14:"doc/manual.sxw";s:4:"c93c";s:40:"Resources/Private/Language/locallang.xml";s:4:"2349";s:38:"Resources/Private/Layouts/Default.html";s:4:"7cb6";s:35:"Resources/Private/Lib/lessc.inc.php";s:4:"e18e";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"d41d";s:47:"Resources/Private/Partials/Less/FormFields.html";s:4:"d41d";s:47:"Resources/Private/Partials/Less/Properties.html";s:4:"d41d";s:42:"Resources/Private/Templates/Less/Less.html";s:4:"25ff";}',
);

?>