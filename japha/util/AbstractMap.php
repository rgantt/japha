<? 
namespace japha\util;

use japha\lang\Object;

/** 
 * This class provides a skeletal implementation of the Map interface, to minimize the effort required to 
 * implement this interface.
 *
 * To implement an unmodifiable map, the programmer needs only to extend this class and provide an 
 * implementation for the entrySet method, which returns a set-view of the map's mappings. Typically, 
 * the returned set will, in turn, be implemented atop AbstractSet. This set should not support the 
 * add or remove methods, and its iterator should not support the remove method.
 *
 * To implement a modifiable map, the programmer must additionally override this class's put method 
 * (which otherwise throws an UnsupportedOperationException), and the iterator returned by 
 * entrySet().iterator() must additionally implement its remove method.
 *
 * The programmer should generally provide a void (no argument) and map constructor, as per the recommendation 
 * in the Map interface specification.
 *
 * The documentation for each non-abstract methods in this class describes its implementation in detail. Each 
 * of these methods may be overridden if the map being implemented admits a more efficient implementation.
 *
 * This class is a member of the Japha Collections Framework.
 */
abstract class AbstractMap extends Object implements Map {
    protected $map;
	
	public function __construct() {
		$this->clear();
	}
    
    /**
     * Removes all mappings from this map (optional operation).
     */
    public function clear() {
        $this->map = array();
    }
    
    /**
     * Returns true if this map contains a mapping for the specified key.
     */
    public function containsKey( $key ) {
		return isset( $this->map[ $this->hashKey( $key ) ] );
    }
    
    /**
     * Returns true if this map maps one or more keys to this value.
     */
    public function containsValue( $value ) {
		foreach( $this->map as $key => $mappedValue ) {
			if( $value === $mappedValue ) {
				return true;
			}
		}
		return false;
    }
    
    /**
     * Compares the specified object with this map for equality.
     */
    public function equals( Object $o ) {
        if( $o instanceof AbstractCollection ) {
            foreach( $this->map as $key => $value ) {
                if( !$o->containsKey( $key ) || !$o->containsValue( $value ) ) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
          
    /**
     * Returns the value to which this map maps the specified key.
     */
    public function get( $key ) {
        if( $this->containsKey( $key ) ) {
            return $this->map[ $key ];
        }
        return null;
    }
          
    /**
     * Returns the hash code value for this map.
     */
    public function hashCode() {
        $h = 0;
        foreach( $this->map as $key => $value ) {
            $h = 2 * org( var_dump( $key ) ) + ord( var_dump( $value ) );   
        }
        return $h;
    }
          
    /**
     * Returns true if this map contains no key-value mappings.
     */
    public function isEmpty() {
        return count( $this->map ) == 0 ? true : false;
    }
       
    /**
     * Associates the specified value with the specified key in this map (optional operation).
     */
    public function put( $key, $value )
    {
        $this->map[ $this->hashKey( $key ) ] = $value;
    }
	
	private function hashKey( $key ) {
		if( $key instanceof Object ) {
			$key = $key->hashCode();
		} elseif( is_object( $key ) || is_array( $key ) ) {
			$h = 0;
			foreach( $key as $attr => $val ) {
				$h += ord( $attr ) + ord( $val );
			}
			$key = $h;
		}
		return $key;
	}
    
    /**
     * Copies all of the mappings from the specified map to this map (optional operation).
     */
    public function putAll( Map $t ) {
        $keys = $t->keySet();
        for( $i = $keys->iterator(); $i->hasNext(); $i->next() ) {
            $this->put( $i->current(), $t->get( $i->current() ) );   
        }
    }
          
    /**
     * Removes the mapping for this key from this map if present (optional operation).
     */
    public function remove( $key ) {
        if( $this->containsKey( $key ) ) {
            unset( $this->map[ $key ] );
        }
    }
       
    /**
     * Returns the number of key-value mappings in this map.
     */
    public function size() {
        return count( $this->map );
    }
       
    /**
     *  Returns a string representation of this map.
     */
    public function toString() {
        return "AbstractMap( ".$this->size()." ): ".$this->hashCode();
    }
       
    /**
     * Returns a collection view of the values contained in this map.
     */
    public function	values(){}
    
    /**
     * Returns a Set view of the keys contained in this map.
     */
    public function keySet()
    {
        echo "AbstractMap::keyset()<br/>";
        return new ArrayList();
    }
    
    /**
     * Returns a set view of the mappings contained in this map.
     */
    abstract public function entrySet();
}