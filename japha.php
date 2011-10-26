<?php
spl_autoload_register( function ( $class ) {
	$file = str_replace( "_", "", $class );
	if( file_exists( dirname(__FILE__)."/{$file}.php" ) ) {
		include_once dirname(__FILE__)."/{$file}.php";
	} else {
		echo "could not load {$file}";
	}
});