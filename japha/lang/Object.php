<?
namespace japha\lang;

use stdClass;
use japha\io\_Serializable;

/**
 * A php representation of the java.lang.Object class that all Java classes inherit from.
 * Includes some of the basic functionality that the builtin stdClass does not.
 */
class Object extends stdClass {    
    private static $class;
    
    /**
     * Create a copy of the current object.
     *
     * @return Object copy of the current instance
     */
    public function _clone() {
        return clone $this;
    }

   /**
     * A real, case-sensitive comparison between two objects, not necessarily of the same type.
     *
     * This should be overwritten to provide a more implementation-based comparison.
     *
     * @return boolean true iff the current instance is the SAME as another instance of the same type
     * @param object object of any type to compare
     */
    public function equals( Object $object ) {
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
    public function equalsIgnoreCase( $object ) {
        return ( strtolower( $this ) === strtolower( $object ) );
    }

    /**
     * Returns a reflection pointer to the current instance of the class
     *
     * @return ReflectionClass An instance of the PHP internal class reflection class
     */
    public final function getClass() {
	    return new _Class( $this );
	    //return new ReflectionClass( get_class( $this ) );
    }

    /**
     * Returns a string representation of the current object
     *
     * @return String the String representation of this classes methods and members
     */
    public function toString() {
        return var_export( $this, TRUE );
    }

	/**
	 * Overloads the language-level "__toString()" method that is called each time an object is used in a string context
	 */
	public function __toString() {
	   return $this->toString();   
	}

	/**
	 * Prepares all of the member variables in the instance for serialization
	 */
	public function __sleep() {
		if( !( $this instanceof _Serializable ) ) {
			throw new Exception("Cannot serialize instances of this class");
		}
	}

	/**
	 * Reload the member variables after serialiatztion
	 */
	public function __wakeup() {
		if( !( $this instanceof _Serializable ) ) {
			throw new Exception("Cannot unserialize instances of this class");
		}
	}
	
    /**
     * Returns the hash code value for this map.
     */
    public function hashCode() {
		$h = 0;
		foreach( $this as $key => $value ) {
			$h += ord( $key ) + ord( $value );
		}
		return $h;
    }
	
	/**
	 * A sneaky way to overload stdClass to accept runtime, callable lambda attributes
	 */
	public function __call($key,$params){
		if( !isset( $this->{$key} ) ) throw new Exception("Call to undefined method ".get_class($this)."::".$key."()");
		$subject = $this->{$key};
		call_user_func_array( $subject, $params );
	}
}