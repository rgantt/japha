<?
package("japha.util");

import("japha.util.AbstractMap");
import("japha.util.AbstractSet");
import("japha.lang.Cloneable");
import("japha.util.Map");
import("japha.io.Serializable");

/** 
 * $Id: HashMap.php,v 1.7 2004/07/23 17:51:15 japha Exp $
 *
 * Hash table based implementation of the Map interface. This implementation provides all of the optional map operations, 
 * and permits null values and the null key. (The HashMap class is roughly equivalent to Hashtable, except that it is 
 * unsynchronized and permits nulls.) This class makes no guarantees as to the order of the map; in particular, it does 
 * not guarantee that the order will remain constant over time.
 *
 * This implementation provides constant-time performance for the basic operations (get and put), assuming the hash 
 * function disperses the elements properly among the buckets. Iteration over collection views requires time proportional 
 * to the "capacity" of the HashMap instance (the number of buckets) plus its size (the number of key-value mappings). 
 * Thus, it's very important not to set the initial capacity too high (or the load factor too low) if iteration performance
 * is important.
 *
 * An instance of HashMap has two parameters that affect its performance: initial capacity and load factor. The capacity 
 * is the number of buckets in the hash table, and the initial capacity is simply the capacity at the time the hash table 
 * is created. The load factor is a measure of how full the hash table is allowed to get before its capacity is 
 * automatically increased. When the number of entries in the hash table exceeds the product of the load factor and the 
 * current capacity, the capacity is roughly doubled by calling the rehash method.
 *
 * As a general rule, the default load factor (.75) offers a good tradeoff between time and space costs. Higher values
 * decrease the space overhead but increase the lookup cost (reflected in most of the operations of the HashMap class, 
 * including get and put). The expected number of entries in the map and its load factor should be taken into account 
 * when setting its initial capacity, so as to minimize the number of rehash operations. If the initial capacity is 
 * greater than the maximum number of entries divided by the load factor, no rehash operations will ever occur.
 *
 * If many mappings are to be stored in a HashMap instance, creating it with a sufficiently large capacity will allow the 
 * mappings to be stored more efficiently than letting it perform automatic rehashing as needed to grow the table.
 *
 * Note that this implementation is not synchronized. If multiple threads access this map concurrently, and at least one 
 * of the threads modifies the map structurally, it must be synchronized externally. (A structural modification is any 
 * operation that adds or deletes one or more mappings; merely changing the value associated with a key that an instance 
 * already contains is not a structural modification.) This is typically accomplished by synchronizing on some object 
 * that naturally encapsulates the map. If no such object exists, the map should be "wrapped" using the 
 * Collections.synchronizedMap method. This is best done at creation time, to prevent accidental unsynchronized access 
 * to the map:
 *
 * $m = Collections::synchronizedMap( new HashMap(...) );
 * 
 * The iterators returned by all of this class's "collection view methods" are fail-fast: if the map is structurally 
 * modified at any time after the iterator is created, in any way except through the iterator's own remove or add methods, 
 * the iterator will throw a ConcurrentModificationException. Thus, in the face of concurrent modification, the iterator 
 * fails quickly and cleanly, rather than risking arbitrary, non-deterministic behavior at an undetermined time in the 
 * future.
 *
 * Note that the fail-fast behavior of an iterator cannot be guaranteed as it is, generally speaking, impossible to make 
 * any hard guarantees in the presence of unsynchronized concurrent modification. Fail-fast iterators throw 
 * ConcurrentModificationException on a best-effort basis. Therefore, it would be wrong to write a program that depended 
 * on this exception for its correctness: the fail-fast behavior of iterators should be used only to detect bugs.
 *
 * This class is a member of the Japha Collections Framework. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.7 $
 */
class HashMap extends AbstractMap implements Cloneable, Map, Serializable
{
    public function __construct()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 0:
                $this->HashMap0();
                break;
            case 1:   
                if( $argv[0] instanceof Map )
                {  
                    $this->HashMap1( $argv[0] );
                    break;
                }
                $this->HashMap3( $argv[0] );
                break;
            case 2:
                $this->HashMap2( $argv[0], $argv[1] );
                break;
        }   
    }
    
    /**
     * Constructs an empty HashMap with the default initial capacity (16) and the default load factor (0.75).
     */
    private function HashMap0()
    {
        parent::__construct();
    }
       
    /**
     * Constructs an empty HashMap with the specified initial capacity and the default load factor (0.75).
     */
    private function HashMap1( $initialCapacity )
    {
        parent::__construct();
    }
       
    /**
     * Constructs an empty HashMap with the specified initial capacity and load factor.
     */
    private function HashMap2( $initialCapacity, $loadFactor )
    {
        parent::__construct();
    }
       
    /**
     * Constructs a new HashMap with the same mappings as the specified Map.
     */
    private function HashMap3( Map $m )
    {
        parent::__construct();
        for( $i = $m->iterator(); $i->hasNext(); $i->next() )
        {
            $this->put( $i->current, $m->get( $i->current() ) );   
        }
    }
     
    /**
     * Returns a collection view of the mappings contained in this map.
     *
     * This implementation isn't quite right
     */
    public function entrySet()
    {
        return $this;
    }
      
    /**
     * Removes all mappings from this map.
     */
    public function clear()
    {
        return parent::clear();
    }
      
    /**
     * Returns a shallow copy of this HashMap instance: the keys and values themselves are not cloned.
     */
    //public function _clone(){}
          
    /**
     * Returns true if this map contains a mapping for the specified key.
     */
    public function containsKey( Object $key )
    {
        return parent::containsKey( $key );
    }
       
    /**
     * Returns true if this map maps one or more keys to the specified value.
     */
    public function containsValue( Object $value )
    {
        return parent::containsValue( $value );
    }
          
    /**
     * Returns the value to which the specified key is mapped in this identity hash map, or null if the map contains no mapping for this key.
     */
    public function get( Object $key )
    {
        return parent::get( $key );
    }
       
    /**
     * Returns true if this map contains no key-value mappings.
     */
    public function isEmpty()
    {
        return parent::isEmpty();
    }
           
    /**
     * Returns a set view of the keys contained in this map.
     */
    public function keySet()
    {
        $ks = $this->keySet;
        if( $ks == null )
        {
            $this->keySet = new KeySet( $this );   
        }
        $ks = $this->keySet;
        return $ks;
    }
         
    /**
     * Associates the specified value with the specified key in this map.
     *
     * Should be Object, Object, but sometimes we don't want only Object keys
     */
    public function put( $key, Object $value )
    {
        parent::put( $key, $value );
    }
         
    /**
     * Copies all of the mappings from the specified map to this map These mappings will replace any mappings that this map had for any of the keys currently in the specified map.
     */
    public function putAll( Map $m )
    {
        return parent::putAll( $m );
    }
          
    /**
     * Removes the mapping for this key from this map if present.
     */
    public function remove( Object $key ){}
         
    /**
     * Returns the number of key-value mappings in this map. 
     */
    public function size()
    {
        return parent::size();
    }
       
    /**
     * Returns a collection view of the values contained in this map.
     */
    public function values()
    {
        return parent::values();
    }
}

class KeySet extends AbstractSet 
{
    private $map;
    
    public function __construct( $map )
    {
        $this->map = $map;    
    }
    
    public function iterator() 
    {
        return new KeyIterator( $this->map );
    }
    
    public function size() 
    {
        return $this->map->size();
    }

    public function contains( Object $o ) 
    {
        return $this->map->containsKey( $o );
    }
    
    public function remove( Object $o ) 
    {
            return $this->map->removeEntryForKey( $o ) != null;
    }
    
    public function clear() 
    {
            $this->map->clear();
    }
}    

abstract class HashIterator //extends _Iterator 
{
    protected $index;             // current slot
    protected $list;
    protected $map;

    public function __construct() 
    {
        $this->list = $this->map->map;
        $this->END = count( $this->list );
        echo $this->END;
        $this->index = 0;
    }

    public function hasNext() 
    {
        return $this->list[ $this->index ];
    }

    public function next() 
    {
        return $this->index++;
    }

    public function current()
    {
        return $this->list[ $this->index ];
    }
}
    
class ValueIterator extends HashIterator 
{
    public function next() 
    {
        return nextEntry().value;
    }
}

class EntryIterator extends HashIterator 
{
    public function next() 
    {
        return nextEntry();
    }
}
    
class KeyIterator extends HashIterator 
{
    public function __construct( Map $map )
    {
        $this->map = $map;
        parent::__construct();       
    }
}
?>