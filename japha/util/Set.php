<?php
namespace japha\util;

use japha\lang\Object;

/** 
 * A collection that contains no duplicate elements. More formally, sets contain no pair of elements e1 and e2 such that 
 * e1.equals(e2), and at most one null element. As implied by its name, this interface models the mathematical set 
 * abstraction.
 *
 * The Set interface places additional stipulations, beyond those inherited from the Collection interface, on the 
 * contracts of all constructors and on the contracts of the add, equals and hashCode methods. Declarations for other 
 * inherited methods are also included here for convenience. (The specifications accompanying these declarations have 
 * been tailored to the Set interface, but they do not contain any additional stipulations.)
 *
 * The additional stipulation on constructors is, not surprisingly, that all constructors must create a set that contains 
 * no duplicate elements (as defined above).
 *
 * Note: Great care must be exercised if mutable objects are used as set elements. The behavior of a set is not specified 
 * if the value of an object is changed in a manner that affects equals comparisons while the object is an element in the 
 * set. A special case of this prohibition is that it is not permissible for a set to contain itself as an element.
 *
 * Some set implementations have restrictions on the elements that they may contain. For example, some implementations 
 * prohibit null elements, and some have restrictions on the types of their elements. Attempting to add an ineligible 
 * element throws an unchecked exception, typically NullPointerException or ClassCastException. Attempting to query the 
 * presence of an ineligible element may throw an exception, or it may simply return false; some implementations will 
 * exhibit the former behavior and some will exhibit the latter. More generally, attempting an operation on an ineligible 
 * element whose completion would not result in the insertion of an ineligible element into the set may throw an exception 
 * or it may succeed, at the option of the implementation. Such exceptions are marked as "optional" in the specification 
 * for this interface.
 *
 * This interface is a member of the Japha Collections Framework.
 */
interface Set extends Collection
{
    // Great.
    //public function add( Object $o );
    //public function addAll( Collection $c );
    //public function clear();
    //public function contains( Object $o );
    //public function containsAll( Collection $c );
    //public function equals( Object $o );
    //public function hashCode();
    //public function isEmpty();
    //public function iterator();
    //public function remove( Object $o );
    //public function removeAll( Collection $c );
    //public function retainAll( Collection $c );
    //public function size();
    //public function toArray( $a );
}