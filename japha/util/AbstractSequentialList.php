<?
namespace japha\util;

use japha\lang\Object;

/**
 * This class provides a skeletal implementation of the List interface to minimize the effort 
 * required to implement this interface backed by a "sequential access" data store (such as a 
 * linked list). For random access data (such as an array), AbstractList should be used in 
 * preference to this class.
 *
 * This class is the opposite of the AbstractList class in the sense that it implements the 
 * "random access" methods (get(int index), set(int index, Object element), 
 * set(int index, Object element), add(int index, Object element) and remove(int index)) 
 * on top of the list's list iterator, instead of the other way around.
 *
 * To implement a list the programmer needs only to extend this class and provide implementations 
 * for the listIterator and size methods. For an unmodifiable list, the programmer need only 
 * implement the list iterator's hasNext, next, hasPrevious, previous and index methods.
 *
 * For a modifiable list the programmer should additionally implement the list iterator's set 
 * method. For a variable-size list the programmer should additionally implement the list 
 * iterator's remove and add methods.
 *
 * The programmer should generally provide a void (no argument) and collection constructor, as 
 * per the recommendation in the Collection interface specification. 
 */
abstract class AbstractSequentialList extends AbstractList
{
    public function get( $index ){}
	
    public function iterator()
	{
	   return $this->listIterator();
	}
	
	public function listIterator(){}
	public function remove( $index ){}
	
	/**
	 * Inserts the specified element at the specified position in this list. Shifts the element 
	 * currently at that position (if any) and any subsequent elements to the right (adds one to 
	 * their indices).
	 *
	 * This implementation first gets a list iterator pointing to the indexed element (with 
	 * listIterator(index)). Then, it inserts the specified element with ListIterator.add.
	 *
	 * Note that this implementation will throw an UnsupportedOperationException if list iterator does not implement the add operation. 
	 *
	 * @specified add in interface List
	 * @overrides add in class AbstractList
	 * @param index index at which the specified element is to be inserted.
	 * @param element element to be inserted. 
	 * @throws UnsupportedOperationException if the add operation is not supported by this list. 
	 * @throws NullPointerException this list does not permit null elements and one of the elements of c is null. 
	 * @throws ClassCastException if the class of the specified element prevents it from being added to this list. 
	 * @throws IllegalArgumentException if some aspect of the specified element prevents it from being added to this list. 
	 * @throws IndexOutOfBoundsException if the specified index is out of range (index < 0 || index > size()).
	 */
	//public function add( $index, Object $element )
	//{
		
	//}
	
	//public function set( $index, Object $element ){}
	//public function addAll( $index, Collection $c ){}
}