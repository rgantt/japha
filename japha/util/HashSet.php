<?php
namespace japha\util;

use japha\lang\Object;
use japha\lang\Cloneable;
use japha\io\_Serializable;
use com\japha\iterator\SetIterator;

/** 
 * This class implements the Set interface, backed by a hash table (actually a HashMap instance). It makes no guarantees 
 * as to the iteration order of the set; in particular, it does not guarantee that the order will remain constant over 
 * time. This class permits the null  element.
 *
 * This class offers constant time performance for the basic operations (add, remove, contains and size), assuming the 
 * hash function disperses the elements properly among the buckets. Iterating over this set requires time proportional 
 * to the sum of the HashSet instance's size (the number of elements) plus the "capacity" of the backing HashMap instance 
 * (the number of buckets). Thus, it's very important not to set the initial capacity too high (or the load factor too low) 
 * if iteration performance is important.
 *
 * The iterators returned by this class's iterator method are fail-fast: if the set is modified at any time after the 
 * iterator is created, in any way except through the iterator's own remove method, the Iterator throws a 
 * ConcurrentModificationException. Thus, in the face of concurrent modification, the iterator fails quickly and cleanly, 
 * rather than risking arbitrary, non-deterministic behavior at an undetermined time in the future.
 *
 * Note that the fail-fast behavior of an iterator cannot be guaranteed as it is, generally speaking, impossible to make 
 * any hard guarantees in the presence of unsynchronized concurrent modification. Fail-fast iterators throw 
 * ConcurrentModificationException on a best-effort basis. Therefore, it would be wrong to write a program that depended 
 * on this exception for its correctness: the fail-fast behavior of iterators should be used only to detect bugs.
 */
abstract class HashSet extends AbstractSet implements Cloneable, Serializable, Set
{
    public function __construct()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 0:
                $this->HashSet0();
                break;
            case 1:
                if( $argv[0] instanceof Collection )
                {
                    $this->HashSet1( $argv[0] );
                    break;   
                }
                $this->HashSet2( $argv[0] );
                break;
            case 2:   
                $this->HashSet3( $argv[0], $argv[1] );
                break;
        }   
    }

    /**
     * Constructs a new, empty set; the backing HashMap instance has default initial capacity (16) and load factor (0.75).
     */
    public function HashSet0()
    {
        $this->__construct( 10 );
    }
       
    /**
     * Constructs a new set containing the elements in the specified collection.
     */
    public function HashSet1( Collection $c )
    {
        $this->__construct();
        for( $i = $c->iterator(); $i->hasNext(); $i->next() )
        {
            $this->add( $i->current() );   
        }
    }

    /**
     * Constructs a new, empty set; the backing HashMap instance has the specified initial capacity and default load factor, which is 0.75.<BR>
     */
    public function HashSet2( $initialCapacity )
    {
        $this->__construct( $initialCapacity, 1 );
    }

    /**
     * Constructs a new, empty set; the backing HashMap instance has the specified initial capacity and the specified load factor.
     */
    public function HashSet3( $initialCapacity, $loadFactor )
    {
        $this->set = new HashMap();
    }
          
    public function add()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 1:
                return $this->add0( $argv[0] );
                break;   
        }   
    }
 
    /**
     * Adds the specified element to this set if it is not already present.
     */
    public function add0( Object $o, $index=NULL )
    {
        if( $index == NULL )
        {
            $index = $this->set->size();
        }
        $this->set->put( $index, $o );
    }
       
    /**
     * Removes all of the elements from this set.
     */
    public function clear()
    {
        $this->set = new HashMap();
    }
     
    /**
     * Returns true if this set contains the specified element.
     */
    public function contains( Object $o )
    {
        return $this->set->containsValue( $o );
    }
          
    /**
     * Returns true if this set contains no elements.
     */
    public function isEmpty()
    {
        return ( $this->set-size() == 0 ? true : false );
    }
          
    /**
     * Removes the specified element from this set if it is present.
     */
    public function remove( Object $o )
    {
        return $this->set->remove( $o );
    }
                 
    /**
     * Returns the number of elements in this set (its cardinality).
     */
    public function size()
    {
        return $this->set->size();
    }
    
    /**
     * Returns an iterator over the elements in this set.
     */
    public function iterator()
    {
        return $this->set->keySet()->iterator();
    }
    
    /**
     * Returns a shallow copy of this HashSet instance: the elements themselves are not cloned.
     */
    //public function _clone(){}
}