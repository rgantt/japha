<?php
namespace japha\util;

use japha\lang\Object;

/** 
 * An object that maps keys to values. A map cannot contain duplicate keys; each key can map to at most one value.
 *
 * This interface takes the place of the Dictionary class, which was a totally abstract class rather than an interface.
 *
 * The Map interface provides three collection views, which allow a map's contents to be viewed as a set of keys, 
 * collection of values, or set of key-value mappings. The order of a map is defined as the order in which the 
 * iterators on the map's collection views return their elements. Some map implementations, like the TreeMap class, 
 * make specific guarantees as to their order; others, like the HashMap class, do not.
 *
 * Note: great care must be exercised if mutable objects are used as map keys. The behavior of a map is not specified 
 * if the value of an object is changed in a manner that affects equals comparisons while the object is a key in the 
 * map. A special case of this prohibition is that it is not permissible for a map to contain itself as a key. While 
 * it is permissible for a map to contain itself as a value, extreme caution is advised: the equals and hashCode 
 * methods are no longer well defined on a such a map.
 *
 * All general-purpose map implementation classes should provide two "standard" constructors: a void (no arguments) 
 * constructor which creates an empty map, and a constructor with a single argument of type Map, which creates a new 
 * map with the same key-value mappings as its argument. In effect, the latter constructor allows the user to copy any 
 * map, producing an equivalent map of the desired class. There is no way to enforce this recommendation (as interfaces 
 * cannot contain constructors) but all of the general-purpose map implementations in the SDK comply.
 *
 * The "destructive" methods contained in this interface, that is, the methods that modify the map on which they 
 * operate, are specified to throw UnsupportedOperationException if this map does not support the operation. If this 
 * is the case, these methods may, but are not required to, throw an UnsupportedOperationException if the invocation 
 * would have no effect on the map. For example, invoking the putAll(Map) method on an unmodifiable map may, but is 
 * not required to, throw the exception if the map whose mappings are to be "superimposed" is empty.
 *
 * Some map implementations have restrictions on the keys and values they may contain. For example, some implementations 
 * prohibit null keys and values, and some have restrictions on the types of their keys. Attempting to insert an 
 * ineligible key or value throws an unchecked exception, typically NullPointerException or ClassCastException. 
 * Attempting to query the presence of an ineligible key or value may throw an exception, or it may simply return 
 * false; some implementations will exhibit the former behavior and some will exhibit the latter. More generally, 
 * attempting an operation on an ineligible key or value whose completion would not result in the insertion of an 
 * ineligible element into the map may throw an exception or it may succeed, at the option of the implementation. Such 
 * exceptions are marked as "optional" in the specification for this interface.
 *
 * This interface is a member of the Japha Collections Framework.
 */
interface Map
{ 
    /**
     * Removes all mappings from this map (optional operation).
     */
    public function clear();
          
    /**
     * Returns true if this map contains a mapping for the specified key.
     */
    public function containsKey( $key );
    /**
     * Returns true if this map maps one or more keys to the specified value.
     */
    public function containsValue( $value );
          
    /**
     * Returns a set view of the mappings contained in this map.
     */
    //public function entrySet();
         
    /**
     * Compares the specified object with this map for equality.
     */
    public function equals( Object $o );
 
    /**
     * Returns the value to which this map maps the specified key.
     */
    public function get( $key );
         
    /**
     * Returns the hash code value for this map.
     */
    public function hashCode();
          
    /**
     * Returns true if this map contains no key-value mappings.
     */
    public function isEmpty();
          
    /**
     * Returns a set view of the keys contained in this map.
     */
    public function keySet();
          
    /**
     * Associates the specified value with the specified key in this map (optional operation).
     */
    public function put( $key, $value );
          
    /**
     * Copies all of the mappings from the specified map to this map (optional operation).
     */
    public function putAll( Map $t );
          
    /**
     * Removes the mapping for this key from this map if it is present (optional operation).
     */
    public function remove( $key );
          
    /**
     * Returns the number of key-value mappings in this map.
     */
    public function size();
              
    /**
     * Returns a collection view of the values contained in this map.
     */
    public function values();
}
?>