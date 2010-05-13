<?
package("japha.util");

import("japha.util.Collection");
import("japha.util.PList");
import("com.japha.iterator.ListIterator");

/**
 * $Id$
 *
 * This class provides a skeletal implementation of the List interface to minimize the effort
 * required to implement this interface backed by a "random access" data store (such as an array).
 * For sequential access data (such as a linked list), AbstractSequentialList should be used in
 * preference to this class.
 *
 * To implement an unmodifiable list, the programmer needs only to extend this class and provide
 * implementations for the get(int index) and size() methods.
 *
 * To implement a modifiable list, the programmer must additionally override the
 * set(int index, Object element) method (which otherwise throws an UnsupportedOperationException.
 * If the list is variable-size the programmer must additionally override the
 * add(int index, Object element) and remove(int index) methods.
 *
 * The programmer should generally provide a void (no argument) and collection constructor,
 * as per the recommendation in the Collection interface specification.
 *
 * Unlike the other abstract collection implementations, the programmer does not have to provide
 * an iterator implementation; the iterator and list iterator are implemented by this class,
 * on top the "random access" methods: get(int index), set(int index, Object element),
 * set(int index, Object element), add(int index, Object element) and remove(int index).
 *
 * The documentation for each non-abstract methods in this class describes its implementation in detail.
 * Each of these methods may be overridden if the collection being implemented admits a
 * more efficient implementation.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class AbstractList extends Object implements Collection, PList
{
    /**
     * The number of times this list has been <i>structurally modified</i>.
     * Structural modifications are those that change the size of the
     * list, or otherwise perturb it in such a fashion that iterations in
     * progress may yield incorrect results.<p>
     *
     * This field is used by the iterator and list iterator implementation
     * returned by the <tt>iterator</tt> and <tt>listIterator</tt> methods.
     * If the value of this field changes unexpectedly, the iterator (or list
     * iterator) will throw a <tt>ConcurrentModificationException</tt> in
     * response to the <tt>next</tt>, <tt>remove</tt>, <tt>previous</tt>,
     * <tt>set</tt> or <tt>add</tt> operations.  This provides
     * <i>fail-fast</i> behavior, rather than non-deterministic behavior in
     * the face of concurrent modification during iteration.<p>
     *
     * <b>Use of this field by subclasses is optional.</b> If a subclass
     * wishes to provide fail-fast iterators (and list iterators), then it
     * merely has to increment this field in its <tt>add(int, Object)</tt> and
     * <tt>remove(int)</tt> methods (and any other methods that it overrides
     * that result in structural modifications to the list).  A single call to
     * <tt>add(int, Object)</tt> or <tt>remove(int)</tt> must add no more than
     * one to this field, or the iterators (and list iterators) will throw
     * bogus <tt>ConcurrentModificationExceptions</tt>.  If an implementation
     * does not wish to provide fail-fast iterators, this field may be
     * ignored.
     *
     * @desc The number of times this list has been structurally modified.
     * @access protected
     * @var
     */
    public $modCount = 0;

    /**
     * The list.
     *
     * @since 0.1
     * @access protected
     * @var
     */
    public $list = array();

    public function add()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 2:
                return $this->add0( $argv[0], $argv[1] );
                break;   
			case 1:
	    		return $this->addElement( $argv[0] );
				break;
        }   
    }
    
    /**
     * Appends the specified element to the end of this List (optional
     * operation). <p>
     *
     * This implementation calls <tt>add(object, size())</tt>, if index is not specified.<p>
     *
     * Note that this implementation throws an <tt>UnsupportedOperationException</tt>
     * unless <tt>add(int, Object)</tt> is overridden.
     *
     * @desc Inserts the specified element at the specified position in this list (optional operation).
     * @param object Element to be added to the list.
     * @param index Index at which the specified element is to be inserted
     *
     * @throws UnsupportedOperationException If the add method is not supported by this list.
     * @throws ClassCastException If the class of the specified element prevents it from being added to this list.
     * @throws IllegalArgumentException If some aspect of the specified element prevents it from being added to this list.
     * @throws IndexOutOfBoundsException Index is out of range (index < 0 || index > size()).
     *
     * @access public
     */
    public function add0( Object $object, $index )
    {
		if( is_null( $index ) )
		{
			$this->list[] = $object;
			++$this->modCount;
		}
		else if( $index >= 0 )
		{
			for( $i = $index; $i < count( $this->list ); $i++ )
			{
				$tempList[ $i + 1 ] = $this->list[ $i ];
				++$this->modCount;
			}
			$this->list[ $index ] = $object;
			for( $i = $index++; $i < count( $this->list ); $i++ )
			{
				$this->list[ $i + 1 ] = $tempList[ $i ];
				++$this->modCount;
			}
		}
		else
		{
			throw new Exception("IllegalArgumentException in AbstractList::add()");
		}
    }

    public function addElement( Object $object, $index = null )
    {
    	$this->add( $object, $index );
    }
    
    /**
     * Inserts all of the elements in the specified collection into this list
     * at the specified position (optional operation).  Shifts the element
     * currently at that position (if any) and any subsequent elements to the
     * right (increases their indices).  The new elements will appear in the
     * list in the order that they are returned by the specified collection's
     * iterator.  The behavior of this operation is unspecified if the
     * specified collection is modified while the operation is in progress.
     * (Note that this will occur if the specified collection is this list,
     * and it's nonempty.)<p>
     *
     * This implementation gets an iterator over the specified collection and
     * iterates over it, inserting the elements obtained from the iterator
     * into this list at the appropriate position, one at a time, using
     * <tt>   add(int, Object)</tt>.  Many implementations will override this
     * method for efficiency.<p>

     * Note that this implementation throws an
     * <tt>UnsupportedOperationException</tt> unless <tt>add(int, Object)</tt>
     * is overridden.
     *
     * @param index Index at which to insert the first element from the specified collection.
     * @param collection Elements to be inserted into this List.
     * @return boolean <tt>true</tt> if this list changed as a result of the call.
     *
     * @throws UnsupportedOperationException If the addAll method is not supported by this list.
     * @throws ClassCastException If the class of an element of the specified collection prevents it from being added to this List.
     * @throws IllegalArgumentException Some aspect an element of the specified collection prevents it from being added to this List.
     * @throws IndexOutOfBoundsException Index out of range (index < 0 || index > size()).
     * @throws NullPointerException If the specified collection is null.
     *
     * @access public
     * @abstract
     */
//    abstract public function addAll( Collection $collection );

    /**
     * Removes all of the elements from this collection (optional operation).
     * The collection will be empty after this call returns (unless it throws
     * an exception).<p>
     *
     * This implementation calls <tt>removeRange(0, size())</tt>.<p>
     *
     * Note that this implementation throws an
     * <tt>UnsupportedOperationException</tt> unless <tt>remove(int
     * index)</tt> or <tt>removeRange(int fromIndex, int toIndex)</tt> is
     * overridden.
     *
     * @access public
     * @throws UnsupportedOperationException If the clear method is not supported by this Collection.
     */
    public function clear()
    {
        $this->removeRange( 0, count($this->list) - 1 );
    }

    /**
     * Compares the specified object with this list for equality.  Returns
     * <tt>true</tt> if and only if the specified object is also a list, both
     * lists have the same size, and all corresponding pairs of elements in
     * the two lists are <i>equal</i>.  (Two elements <tt>e1</tt> and
     * <tt>e2</tt> are <i>equal</i> if <tt>(e1==null ? e2==null :
     * e1.equals(e2))</tt>.)  In other words, two lists are defined to be
     * equal if they contain the same elements in the same order.<p>
     *
     * This implementation first checks if the specified object is this
     * list. If so, it returns <tt>true</tt>; if not, it checks if the
     * specified object is a list. If not, it returns <tt>false</tt>; if so,
     * it iterates over both lists, comparing corresponding pairs of elements.
     * If any comparison returns <tt>false</tt>, this method returns
     * <tt>false</tt>.  If either iterator runs out of elements before the
     * other it returns <tt>false</tt> (as the lists are of unequal length);
     * otherwise it returns <tt>true</tt> when the iterations complete.
     *
     * @param object The object to be compared for equality with this list.
     * @return boolean <tt>true</tt> if the specified object is equal to this list.
     * @access public
     */
    public function equals( Object $object )
    {
        if( !( $object instanceof AbstractList ) )
        	return false;
        if( $object->size() != $this->size() )
        	return false;
        for( $i = 0; $i < $this->size(); $i++ )
        {
            if( $object->list[$i] != $this->list[$i] )
                return false;
        }
        return true;
    }

    /**
     * Returns the element at the specified position in this list.
     *
     * @param index Index of element to return.
     * @return Object The element at the specified position in this list.
     * @throws IndexOutOfBoundsException if the given index is out of range (index < 0 || index >= size()).
     * @access public
     * @abstract
     */
//    abstract public function get( $index );

    /**
     * Returns the hash code value for this list. <p>
     *
     * This implementation uses exactly the code that is used to define the
     * list hash function in the documentation for the <tt>List.hashCode</tt>
     * method.
     *
     * @return HashCode The hash code value for this list.
     * @access public
     */
    public function hashCode()
    {
        $hashCode = 1;
        $i = $this->iterator();
        while( $i->hasNext() )
        {
            $obj = $i->current();
            $hashCode = 31 * $hashCode + ( $obj == NULL ? 0 : $obj->hashCode());
			$i->next();
        }
        return $hashCode;
    }


    /**
     * Returns the index in this list of the first occurence of the specified
     * element, or -1 if the list does not contain this element.  More
     * formally, returns the lowest index <tt>i</tt> such that <tt>(o==null ?
     * get(i)==null : o.equals(get(i)))</tt>, or -1 if there is no such
     * index.<p>
     *
     * This implementation first gets a list iterator (with
     * <tt>listIterator()</tt>).  Then, it iterates over the list until the
     * specified element is found or the end of the list is reached.
     *
     * @param object Element to search for.
     * @return int The index in this List of the first occurence of the specified element, or -1 if the List does not contain this element.
     * @access public
     * @abstract
     */
//    abstract public function indexOf( Object $object );

    /**
     * Returns the index in this list of the last occurence of the specified
     * element, or -1 if the list does not contain this element.  More
     * formally, returns the highest index <tt>i</tt> such that <tt>(o==null ?
     * get(i)==null : o.equals(get(i)))</tt>, or -1 if there is no such
     * index.<p>
     *
     * This implementation first gets a list iterator that points to the end
     * of the list (with listIterator(size())).  Then, it iterates backwards
     * over the list until the specified element is found, or the beginning of
     * the list is reached.
     *
     * @param object Element to search for.
     * @return int The index in this list of the last occurence of the specified element, or -1 if the list does not contain this element.
     * @access public
     * @abstract
     */
//    abstract public function lastIndexOf( Object $object );

    /**
     * Returns an iterator over the elements in this list in proper
     * sequence. <p>
     *
     * This implementation returns a straightforward implementation of the
     * iterator interface, relying on the backing list's <tt>size()</tt>,
     * <tt>get(int)</tt>, and <tt>remove(int)</tt> methods.<p>
     *
     * Note that the iterator returned by this method will throw an
     * <tt>UnsupportedOperationException</tt> in response to its
     * <tt>remove</tt> method unless the list's <tt>remove(int)</tt> method is
     * overridden.<p>
     *
     * This implementation can be made to throw runtime exceptions in the face
     * of concurrent modification, as described in the specification for the
     * (protected) <tt>modCount</tt> field.
     *
     * @return ListIterator An iterator over the elements in this list in proper sequence.
     * @access public
     */
    public function iterator()
    {
        return $this->listIterator();
    }

    /**
     * Returns a list iterator of the elements in this list (in proper
     * sequence), starting at the specified position in the list.  The
     * specified index indicates the first element that would be returned by
     * an initial call to the <tt>next</tt> method.  An initial call to
     * the <tt>previous</tt> method would return the element with the
     * specified index minus one.<p>
     *
     * This implementation returns a straightforward implementation of the
     * <tt>ListIterator</tt> interface that extends the implementation of the
     * <tt>Iterator</tt> interface returned by the <tt>iterator()</tt> method.
     * The <tt>ListIterator</tt> implementation relies on the backing list's
     * <tt>get(int)</tt>, <tt>set(int, Object)</tt>, <tt>add(int, Object)</tt>
     * and <tt>remove(int)</tt> methods.<p>
     *
     * Note that the list iterator returned by this implementation will throw
     * an <tt>UnsupportedOperationException</tt> in response to its
     * <tt>remove</tt>, <tt>set</tt> and <tt>add</tt> methods unless the
     * list's <tt>remove(int)</tt>, <tt>set(int, Object)</tt>, and
     * <tt>add(int, Object)</tt> methods are overridden.<p>
     *
     * This implementation can be made to throw runtime exceptions in the
     * face of concurrent modification, as described in the specification for
     * the (protected) <tt>modCount</tt> field.
     *
     * @param index Index of the first element to be returned from the list iterator (by a call to the next method).
     * @return ListIterator an iterator of the elements in this list (in proper sequence).
     * @throws IndexOutOfBoundsException If the specified index is out of range (index < 0 || index > size()).
     * @access public
     */
    public function listIterator()
    {
        return new ListIterator( $this );
    }

    /**
     * Removes the element at the specified position in this list (optional
     * operation).  Shifts any subsequent elements to the left (subtracts one
     * from their indices).  Returns the element that was removed from the
     * list.<p>
     *
     * This implementation always throws an
     * <tt>UnsupportedOperationException</tt>.
     *
     * @param index The index of the element to remove.
     * @return Object The element previously at the specified position.
     *
     * @throws UnsupportedOperationException If the remove method is not supported by this list.
     * @throws IndexOutOfBoundsException If the specified index is out of range (index < 0 || index >= size()).
     *
     * @access public
     */
	 // Notes -- This is not decrementing the subsequent array indices like it should be. It still works, though.
	 // It's also returning a '1' on success, instead of some good data
    public function remove( $index )
    {
		$temp = $this->list[$index];
        for(; $index < count($this->list) - 1; $index++)
		{
        	$this->list[$index] = $this->list[$index + 1];
			++$this->modCount;
		}
		//$this->bubbleSortInternalList();
        return $temp;
    }

    /**
     * Removes from this list all of the elements whose index is between
     * <tt>fromIndex</tt>, inclusive, and <tt>toIndex</tt>, exclusive.
     * Shifts any succeeding elements to the left (reduces their index).  This
     * call shortens the ArrayList by <tt>(toIndex - fromIndex)</tt>
     * elements.  (If <tt>toIndex==fromIndex</tt>, this operation has no
     * effect.)<p>
     *
     * This method is called by the <tt>clear</tt> operation on this list
     * and its subLists.  Overriding this method to take advantage of
     * the internals of the list implementation can <i>substantially</i>
     * improve the performance of the <tt>clear</tt> operation on this list
     * and its subLists.<p>
     *
     * This implementation gets a list iterator positioned before
     * <tt>fromIndex</tt>, and repeatedly calls <tt>ListIterator.next</tt>
     * followed by <tt>ListIterator.remove</tt> until the entire range has
     * been removed.  <b>Note: if <tt>ListIterator.remove</tt> requires linear
     * time, this implementation requires quadratic time.</b>
     *
     * @param fromIndex Index of first element to be removed.
     * @param toIndex Index after last element to be removed.
     *
     * @access public
     *
     * @throws IndexOutOfBoundsException If the to or from parameters are larger than the array
     */
    public function removeRange( $to, $from )
    {
        if( $to > count($this->list) || $from > count($this->list) )
        {
            throw new Exception("IndexOutOfBoundsException in AbstractList::removeRange(), Your parameters cannot be bigger than the list!");
        }
        else
        {
            for(; $to < $from; $to++ )
            {
                $this->remove( $to );
            }
        }
    }

    /**
     * Replaces the element at the specified position in this list with the
     * specified element (optional operation). <p>
     *
     * This implementation always throws an
     * <tt>UnsupportedOperationException</tt>.
     *
     * @param index Index of element to replace.
     * @param object Element to be stored at the specified position.
     * @return Object The element previously at the specified position.
     *
     * @access public
     *
     * @throws UnsupportedOperationException If the set method is not supported by this List.
     * @throws ClassCastException If the class of the specified element prevents it from being added to this list.
     * @throws IllegalArgumentException If some aspect of the specified element prevents it from being added to this list.
     * @throws IndexOutOfBoundsException If the specified index is out of range (index < 0 || index >= size()).
     */
    public function set( Object $object, $index )
    {
        if( $index > count($this->list) )
        {
            throw new Exception("IndexOutOfBoundsException in AbstractList::set(), index cannot be greater than length of List!");
        }
        else if( is_array($object) || $object instanceof AbstractList )
        {
            throw new Exception("IllegalArgumentException in AbstractList::set(), object cannot be array, list, or arrayList");
        }
        else if( $index < count($this->list) && !is_array($object) )
        {
            $temp = $this->get( $index );
			unset($this->list[ $index ]);
			$this->add( $object, $index );
            return $temp;
        }
    }

    /**
     *  Returns a view of the portion of this list between <tt>fromIndex</tt>,
     *  inclusive, and <tt>toIndex</tt>, exclusive.  (If <tt>fromIndex</tt> and
     *  <tt>toIndex</tt> are equal, the returned list is empty.)  The returned
     *  list is backed by this list, so changes in the returned list are
     *  reflected in this list, and vice-versa.  The returned list supports all
     *  of the optional list operations supported by this list.<p>
     *
     *  This method eliminates the need for explicit range operations (of the
     *  sort that commonly exist for arrays).  Any operation that expects a
     *  list can be used as a range operation by operating on a subList view
     *  instead of a whole list.  For example, the following idiom removes a
     *  range of elements from a list:
     *  <pre>
     *      list.subList(from, to).clear();
     *  </pre>
     *  Similar idioms may be constructed for <tt>indexOf</tt> and
     *  <tt>lastIndexOf</tt>, and all of the algorithms in the
     *  <tt>Collections</tt> class can be applied to a subList.<p>
     *
     *  The semantics of the list returned by this method become undefined if
     *  the backing list (i.e., this list) is <i>structurally modified</i> in
     *  any way other than via the returned list.  (Structural modifications are
     *  those that change the size of the list, or otherwise perturb it in such
     *  a fashion that iterations in progress may yield incorrect results.)<p>
     *
     *  This implementation returns a list that subclasses
     *  <tt>AbstractList</tt>.  The subclass stores, in private fields, the
     *  offset of the subList within the backing list, the size of the subList
     *  (which can change over its lifetime), and the expected
     *  <tt>modCount</tt> value of the backing list.  There are two variants
     *  of the subclass, one of which implements <tt>RandomAccess</tt>.
     *  If this list implements <tt>RandomAccess</tt> the returned list will
     *  be an instance of the subclass that implements <tt>RandomAccess</tt>.<p>
     *
     *  The subclass's <tt>set(int, Object)</tt>, <tt>get(int)</tt>,
     *  <tt>add(int, Object)</tt>, <tt>remove(int)</tt>, <tt>addAll(int,
     *  Collection)</tt> and <tt>removeRange(int, int)</tt> methods all
     *  delegate to the corresponding methods on the backing abstract list,
     *  after bounds-checking the index and adjusting for the offset.  The
     *  <tt>addAll(Collection c)</tt> method merely returns <tt>addAll(size,
     *  c)</tt>.<p>
     *
     *  The <tt>listIterator(int)</tt> method returns a "wrapper object" over a
     *  list iterator on the backing list, which is created with the
     *  corresponding method on the backing list.  The <tt>iterator</tt> method
     *  merely returns <tt>listIterator()</tt>, and the <tt>size</tt> method
     *  merely returns the subclass's <tt>size</tt> field.<p>
     *
     *  All methods first check to see if the actual <tt>modCount</tt> of the
     *  backing list is equal to its expected value, and throw a
     * <tt>ConcurrentModificationException</tt> if it is not.
     *
     * @param to Low endpoint (inclusive) of the subList.
     * @param from High endpoint (exclusive) of the subList.
     * @return AbstractList a view of the specified range within this list.
     *
     * @access public
     * @abstract
     *
     * @throws IndexOutOfBoundsException Endpoint index value out of range (fromIndex < 0 || toIndex > size)
     * @throws IllegalArgumentException Endpoint indices out of order (fromIndex > toIndex)
     */
//    abstract public function subList( $to, $from );

	// Something to make creating the ListIterator a little bit easier
	public function getList()
	{
     	return $this->list;
	}
}
?>