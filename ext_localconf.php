<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Less',
	array(
		'Less' => 'base,lessphp,lessjs',
		
	),
	// non-cacheable actions
	array(
		'Less' => '',
		
	)
);

?>