<?php
namespace japha\util;

use japha\lang\Object;
use japha\lang\Cloneable;
use japha\io\_Serializable;

/** 
 * Resizable-array implementation of the List interface. Implements all optional list operations, and permits all 
 * elements, including null. In addition to implementing the List interface, this class provides methods to manipulate 
 * the size of the array that is used internally to store the list. (This class is roughly equivalent to Vector, except 
 * that it is unsynchronized.)
 *
 * The size, isEmpty, get, set, iterator, and listIterator operations run in constant time. The add operation runs in 
 * amortized constant time, that is, adding n elements requires O(n) time. All of the other operations run in linear time 
 * (roughly speaking). The constant factor is low compared to that for the LinkedList implementation.
 *
 * Each ArrayList instance has a capacity. The capacity is the size of the array used to store the elements in the list. 
 * It is always at least as large as the list size. As elements are added to an ArrayList, its capacity grows automatically. 
 * The details of the growth policy are not specified beyond the fact that adding an element has constant amortized time 
 * cost.
 *
 * An application can increase the capacity of an ArrayList instance before adding a large number of elements using the 
 * ensureCapacity operation. This may reduce the amount of incremental reallocation.
 *
 * Note that this implementation is not synchronized. If multiple threads access an ArrayList instance concurrently, and at 
 * least one of the threads modifies the list structurally, it must be synchronized externally. (A structural modification 
 * is any operation that adds or deletes one or more elements, or explicitly resizes the backing array; merely setting 
 * the value of an element is not a structural modification.) This is typically accomplished by synchronizing on some 
 * object that naturally encapsulates the list. If no such object exists, the list should be "wrapped" using the 
 * Collections.synchronizedList method. This is best done at creation time, to prevent accidental unsynchronized access 
 * to the list:
 *
 * $list = Collections::synchronizedList( new ArrayList(...) );
 *
 * The iterators returned by this class's iterator and listIterator methods are fail-fast: if list is structurally 
 * modified at any time after the iterator is created, in any way except through the iterator's own remove or add 
 * methods, the iterator will throw a ConcurrentModificationException. Thus, in the face of concurrent modification, 
 * the iterator fails quickly and cleanly, rather than risking arbitrary, non-deterministic behavior at an undetermined 
 * time in the future.
 *
 * Note that the fail-fast behavior of an iterator cannot be guaranteed as it is, generally speaking, impossible to make 
 * any hard guarantees in the presence of unsynchronized concurrent modification. Fail-fast iterators throw 
 * ConcurrentModificationException on a best-effort basis. Therefore, it would be wrong to write a program that depended 
 * on this exception for its correctness: the fail-fast behavior of iterators should be used only to detect bugs.
 */
class ArrayList extends AbstractList implements PList, RandomAccess, Cloneable, _Serializable
{
    public function __construct()
    {
        $argv = func_get_args();
        switch( func_num_args () )
        {
            case 0:
                $this->ArrayList0();
                break;
            case 1:
                if( $argv[0] instanceof Collection )
                {
                    $this->ArrayList1( $argv[0] );
                    break;   
                }
                $this->ArrayList( $argv[0] );
                break;
        }
    }    
       
    /**
     * Constructs an empty list with an initial capacity of ten.
     */
    private function ArrayList0(){ echo "ArrayList::ArrayList0<br/>"; }
    
    /**
     * Constructs a list containing the elements of the specified collection, in the order they are returned by the 
     * collection's iterator.
     */
    private function ArrayList1( Collection $c ){}
    
    /**
     * Constructs an empty list with the specified initial capacity.
     */
    private function ArrayList2( $initialCapacity ){}
 
    public function add()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 2:
                return $this->add0( $argv[0], $argv[1] );
                break;   
        }   
    }
    
    /**
     * Inserts the specified element at the specified position in this list.
     */
    public function add0( Object $element, $index ){}

    public function addAll()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 1:
                return $this->addAll0( $argv[0] );
                break;   
        }   
    }
    
    /**
     * Appends all of the elements in the specified Collection to the end of this list, in the order that they are returned by the specified Collection's Iterator.
     */
    public function addAll0( Collection $c ){}

    /**
     * Removes all of the elements from this list.
     */
    public function clear(){}

    /**
     * Returns a shallow copy of this ArrayList instance.
     */
    public function _clone(){}

    /**
     * Returns true if this list contains the specified element.
     */
    public function contains( Object $elem ){}

    /**
     * Increases the capacity of this ArrayList instance, if necessary, to ensure that it can hold at least the number 
     * of elements specified by the minimum capacity argument.
     */
    public function ensureCapacity( $minCapacity ){}

    /**
     * Returns the element at the specified position in this list.
     */
    public function get( $index ){}

    /**
     * Searches for the first occurence of the given argument, testing for equality using the equals method.
     */
    public function indexOf( Object $elem ){}

    /**
     * Tests if this list has no elements.
     */
    public function isEmpty(){}

    /**
     * Returns the index of the last occurrence of the specified object in this list.
     */
    public function lastIndexOf( Object $elem ){}

    /**
     * Removes the element at the specified position in this list.
     */
    public function remove( $index ){}

    /**
     * Removes from this List all of the elements whose index is between fromIndex, inclusive and toIndex, exclusive.
     */
    public function removeRange( $fromIndex, $toIndex ){}

    /**
     * Replaces the element at the specified position in this list with the specified element.
     */
    public function set( Object $element, $index ){}

    /**
     * Returns the number of elements in this list.
     */
    public function	size(){}

    /**
     * Returns an array containing all of the elements in this list in the correct order; the runtime type of the returned array is that of the specified array.
     */
    public function toArray( $a=array() ){}

    /**
     * Trims the capacity of this ArrayList instance to be the list's current size.
     */
    public function trimToSize(){}
    
    public function containsAll( Collection $c ){}
    public function removeAll( Collection $c ){}
    public function retainAll( Collection $c ){}
    public function subList( $start, $end ){}
}