<?
package("japha.lang");

/**
 * $Id$
 * $Author$
 *
 * A php representation of the java.lang.Object class that all Java classes inherit from.
 * Includes some of the basic functionality that the builtin stdClass does not.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class Object extends Exception
{    
    static $class;
    
    /**
     * Create a copy of the current object.
     *
     * @return Object copy of the current instance
     */
    public function _clone()
    {
        $copy = $this;
        return $copy;
    }

   /**
     * A real, case-sensitive comparison between two objects, not necessarily of the same type.
     *
     * This should be overwritten to provide a more implementation-based comparison.
     *
     * @return boolean true iff the current instance is the SAME as another instance of the same type
     * @param object object of any type to compare
     */
    public function equals( Object $object )
    {
        return ( $this == $object );
    }

    /**
     * Conducts a case-insensitive comparison of two objects
     *
     * This should be overwritten to provide a more implementation-based comparison.
     *
     * @return boolean true iff the current isntance is the SAME as another instance of the same type
     * @param object object of any type to compar
     */
    public function equalsIgnoreCase( $object )
    {
        return ( strtolower( $this ) === strtolower( $object ) );
    }

    /**
     * Returns a reflection pointer to the current instance of the class
     *
     * @return ReflectionClass An instance of the PHP internal class reflection class
     */
    public final function getClass()
    {
	    return new _Class( $this );
	    //return new ReflectionClass( get_class( $this ) );
    }

    /**
     * Returns a string representation of the current object
     *
     * @return String the String representation of this classes methods and members
     */
    public function toString()
    {
        return var_export( $this, TRUE );
    }

    /**
     * When called, will stop (pause, actually) execution of the script for a given number of seconds or microseconds.
     *
     * @param seconds Number of seconds or microseconds to wait
     * @param micro Pass 'true' to use microseconds (a millionth of a second) instead of seconds
     */
    public function wait( $seconds, $micro = FALSE)
    {
        switch( $micro )
        {
            case TRUE:
                usleep( $seconds );
                break;

            case FALSE:
            default:
                sleep( $seconds );
                break;
        }
    }

	/**
	 * Overloads the language-level "__toString()" method that is called each time an object is used in a string context
	 */
	public function __toString()
	{
	   return $this->toString();   
	}
	
	/**
	 * Used to wrap to the Virtual Machine function that would kill the VM with the given error code
	 *
	 * Now does nothing.
	 */
	public function _exit( $int ){}

	/**
	 * Prepares all of the member variables in the instance for serialization
	 */
	public function __sleep(){}

	/**
	 * Reload the member variables after serialiatztion
	 */
	public function __wakeup(){}
	
    /**
     * Forces deletion of all references to this object. They become NullPointers.
     *
     * This has been modified to call the wrapper to the Virtual Machine instead of a flat out delete
     *
     */
    public function finalize(){}
    
    static function initStaticClass( $name = '' )
    {
        self::$class = new $name;
    }
}
?>