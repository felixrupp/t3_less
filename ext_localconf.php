<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Less',
	array(
		'Less' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Less' => 'create, update, delete',
		
	)
);

?>