<?
spl_autoload_register( function ( $class ) {
	$file = str_replace( "_", "", $class );
	require_once dirname(__FILE__)."/{$file}.php";
});