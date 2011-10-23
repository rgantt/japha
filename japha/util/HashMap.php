<?
namespace japha\util;

use japha\lang\Object;
use japha\lang\Cloneable;
use japha\io\_Serializable;

/** 
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
 */
class HashMap extends AbstractMap implements Cloneable, Map, _Serializable {
	private $allocated = 0;
	private $capacity = 16;
	
	private $loadFactor = 0.75;
	
	/**
	 * More like... sillymorphism
	 */
    public function __construct() {
		parent::__construct();
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 1:   
                if( $argv[0] instanceof Map ) {  
                    $this->HashMap0( $argv[0] );
                } else {
					$this->capacity = $argv[0];
				}
                break;
            case 2:
				$this->capacity = $argv[0];
				$this->loadFactor = $argv[1];
                break;
        }
    }
       
    /**
     * Constructs a new HashMap with the same mappings as the specified Map.
     */
    private function HashMap0( Map $m ) {
        parent::__construct();
        for( $i = $m->iterator(); $i->hasNext(); $i->next() ) {
            $this->put( $i->current, $m->get( $i->current() ) );   
        }
    }
     
    /**
     * Returns a collection view of the mappings contained in this map.
     *
     * This implementation isn't quite right
     */
    public function entrySet() {
        return $this;
    }
           
    /**
     * Returns a set view of the keys contained in this map.
     */
    public function keySet() {
        $ks = $this->keySet;
        if( $ks == null ) {
            $this->keySet = new KeySet( $this );   
        }
        $ks = $this->keySet;
        return $ks;
    }
}

class KeySet extends AbstractSet {
    private $map;
    
    public function __construct( $map ) {
        $this->map = $map;    
    }
    
    public function iterator() {
        return new KeyIterator( $this->map );
    }
    
    public function size() {
        return $this->map->size();
    }

    public function contains( Object $o ) {
        return $this->map->containsKey( $o );
    }
    
    public function remove( $o ) {
            return $this->map->removeEntryForKey( $o ) != null;
    }
    
    public function clear() {
            $this->map->clear();
    }
}    

abstract class HashIterator /*extends _Iterator*/ {
    protected $index;
    protected $list;
    protected $map;

    public function __construct() {
        $this->list = $this->map->map;
        $this->END = count( $this->list );
        echo $this->END;
        $this->index = 0;
    }

    public function hasNext() {
        return $this->list[ $this->index ];
    }

    public function next() {
        return $this->index++;
    }

    public function current() {
        return $this->list[ $this->index ];
    }
}
    
class ValueIterator extends HashIterator {
    public function next() {
        return $this->nextEntry()->value;
    }
}

class EntryIterator extends HashIterator {
    public function next() {
        return $this->nextEntry();
    }
}
    
class KeyIterator extends HashIterator {
    public function __construct( Map $map ) {
        $this->map = $map;
        parent::__construct();       
    }
}