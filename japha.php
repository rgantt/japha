<?
spl_autoload_register( function ( $class ) {
	set_error_handler( function() use ( $class ) {
		echo "ERROR LOADING {$class}!\n";
		print_r( debug_backtrace() );
	});
	$file = str_replace( "_", "", $class );
	require_once dirname(__FILE__)."/{$file}.php";
	echo "loaded {$class}\n";
});