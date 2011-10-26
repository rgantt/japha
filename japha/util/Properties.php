<?php
namespace japha\util;

use japha\lang\Object;

class Properties extends Object
{
    private $props = array();
    static $instance = false;
    
    public function put( $name, $value )
    {
        $this->props[ $name ] = $value;   
    }
    
    public function get( $name )
    {
        return $this->props[ $name ];   
    }
    
    public function getProperty( $name )
    {
        return $this->get( $name );   
    }
    
    public static function getInstance()
    {
        if( !self::$instance )
        {
            self::$instance = new Properties();
        }
        return self::$instance;
    }
}