<?
package("japha.util");

/**
 * $Id$
 *
 * The root interface in the collection hierarchy. A collection represents a group of 
 * objects, known as its elements. Some collections allow duplicate elements and 
 * others do not. Some are ordered and others unordered. The SDK does not provide 
 * any direct implementations of this interface: it provides implementations of 
 * more specific subinterfaces like Set and List. This interface is typically used 
 * to pass collections around and manipulate them where maximum generality is desired. 
 *
 * Bags or multisets (unordered collections that may contain duplicate elements) 
 * should implement this interface directly. 
 *
 * All general-purpose Collection implementation classes (which typically implement 
 * Collection indirectly through one of its subinterfaces) should provide two 
 * "standard" constructors: a void (no arguments) constructor, which creates an 
 * empty collection, and a constructor with a single argument of type Collection, 
 * which creates a new collection with the same elements as its argument. In effect, 
 * the latter constructor allows the user to copy any collection, producing an 
 * equivalent collection of the desired implementation type. There is no way to 
 * enforce this convention (as interfaces cannot contain constructors) but all of 
 * the general-purpose Collection implementations in the Java platform libraries 
 * comply. 
 *
 * The "destructive" methods contained in this interface, that is, the methods that 
 * modify the collection on which they operate, are specified to throw 
 * UnsupportedOperationException if this collection does not support the operation. 
 * If this is the case, these methods may, but are not required to, throw an 
 * UnsupportedOperationException if the invocation would have no effect on the 
 * collection. For example, invoking the addAll(Collection) method on an unmodifiable 
 * collection may, but is not required to, throw the exception if the collection to be 
 * added is empty. 
 *
 * Some collection implementations have restrictions on the elements that they may 
 * contain. For example, some implementations prohibit null elements, and some have 
 * restrictions on the types of their elements. Attempting to add an ineligible element 
 * throws an unchecked exception, typically NullPointerException or ClassCastException. 
 * Attempting to query the presence of an ineligible element may throw an exception, or 
 * it may simply return false; some implementations will exhibit the former behavior 
 * and some will exhibit the latter. More generally, attempting an operation on an
 * ineligible element whose completion would not result in the insertion of an ineligible
 * element into the collection may throw an exception or it may succeed, at the option
 * of the implementation. Such exceptions are marked as "optional" in the specification
 * for this interface.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface Collection
{
    public function add( /*...*/ );
    public function addAll( /*...*/ );
    public function clear();
    public function contains( Object $object );
    public function containsAll( Collection $collection );
    public function equals( Object $object );
    public function hashCode();
    public function isEmpty();
    public function iterator();
    //public function remove( $index );
    public function removeAll( Collection $collection );
    public function retainAll( Collection $collection );
    public function size();
    public function toArray();
}
?>
