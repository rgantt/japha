<?
namespace japha\util;

/**
 * Signals that a resource is missing.
 */

class MissingResourceException extends _RuntimeException
{
    private $s;
    private $className;
    private $key;
    
    /**
     * Constructs a MissingResourceException with the specified information.
     */
    public function __construct( $s, $className, $key )
    {
        $this->s = $s;
        $this->className = $className;
        $this->key = $key;    
    }
 
    /**
     * Gets parameter passed by constructor.
     */
    public function getClassName()
    {
        return $this->className;
    }
    
    /**
     * Gets parameter passed by constructor.
     */
    public function getKey()
    {
        return $this->key;
    }
}