<?
spl_autoload_register( function ( $class ) {
	set_error_handler( function() use ( $class ) {
		print_r( debug_backtrace() );
	});
	$file = str_replace( "_", "", $class );
	require_once dirname(__FILE__)."/{$file}.php";
});