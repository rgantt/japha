<?
namespace japha\util;

use japha\lang\Object;
use japha\lang\Cloneable;
use japha\io\_Serializable;

/**
 * The Vector class implements a growable array of objects. Like an array, it contains 
 * components that can be accessed using an integer index. However, the size of a Vector can 
 * grow or shrink as needed to accommodate adding and removing items after the Vector has 
 * been created.
 *
 * Each vector tries to optimize storage management by maintaining a capacity and a 
 * capacityIncrement. The capacity is always at least as large as the vector size; it is 
 * usually larger because as components are added to the vector, the vector's storage 
 * increases in chunks the size of capacityIncrement. An application can increase the 
 * capacity of a vector before inserting a large number of components; this reduces the amount 
 * of incremental reallocation. 
 *
 * As of the Java 2 platform v1.2, this class has been retrofitted to implement List, so that 
 * it becomes a part of Java's collection framework. Unlike the new collection implementations, 
 * Vector is synchronized.
 *
 * The Iterators returned by Vector's iterator and listIterator methods are fail-fast: if the 
 * Vector is structurally modified at any time after the Iterator is created, in any way except 
 * through the Iterator's own remove or add methods, the Iterator will throw a 
 * ConcurrentModificationException. Thus, in the face of concurrent modification, the Iterator 
 * fails quickly and cleanly, rather than risking arbitrary, non-deterministic behavior at 
 * an undetermined time in the future. The Enumerations returned by Vector's elements method 
 * are not fail-fast. 
 *
 * Note that the fail-fast behavior of an iterator cannot be guaranteed as it is, generally 
 * speaking, impossible to make any hard guarantees in the presence of unsynchronized 
 * concurrent modification. Fail-fast iterators throw ConcurrentModificationException on a 
 * best-effort basis. Therefore, it would be wrong to write a program that depended on this 
 * exception for its correctness: the fail-fast behavior of iterators should be used only to 
 * detect bugs. 
 */
class Vector extends AbstractList implements PList, RandomAccess, Cloneable, _Serializable
{	
    protected $capacityIncrement;
    protected $elementCount;
    protected $elementData;

    /**
     * Unified constructor. Takes no parameters. Makes a new list, and sets the mod count to zero.
     *
     * @access protected
     * @desc Creates a new list and populates it with... nothing.
     */
    public function __construct()
    {
    	$this->modCount = 0;
    	$this->list = array();
    }
    
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
     */
    public function addAll0( $collection )
    {
    	if( is_array( $collection ) )
    	{
    		foreach( $collection as $key )
    		{
    			$this->add( $key );
    		}
    		return;
    	} 
    	if( $collection instanceof Collection )
    	{
    		$it = $collection->iterator();
    		while( $it->hasNext() )
    		{
	    		$this->add( $it->current() );
    			$it->next();	
    		}
    		return;
    	}
    	throw new Exception("Argument neither array nor collection");
    	//throw new IllegalArgumentException("Argument neither array nor collection");
    }
    
    /**
     * Returns the element at the specified position in this list. 
     *
     * @param index Index of element to return.
     * @return Object The element at the specified position in this list.
     * @throws IndexOutOfBoundsException if the given index is out of range (index < 0 || index >= size()).
     * @access public
     */
    public function get( $index )
    {
        return $this->list[$index];
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
     */
    public function indexOf( Object $object )
    {
        foreach( $this->list as $key => $value )
		{
			foreach( $value as $hash => $instance )
			{
				if( $this->list[ $key ][ $hash ] === $object )
					return $key;
			}
		}
    }

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
     */
    public function lastIndexOf( Object $object )
    {
        // TODO::: MAKE SURE THIS RETURNS THE !LAST! INDEX OF THE OBJECT
        return array_search( $object, $this->list );
    }

    /**
     * Delete the value of a single list index
     *
     * r9: indices updated after value is removed, otherwise equals( Object ) doesn't work
     *
     * @access public
     * @param index the index to remove
     * @return int 1 if execution was not halted
     */
    public function removeElementAt( $index )
    {
    	return $this->remove( $index );
    }

    /**
     * Removes a range of indices from the list
     *
     * Delegates to this.remove( int )
     *
     * @param to the starting index to remove
     * @param from the ending index
     * @access public
     * @return int 1 if execution was not halted
     */
    public function removeRange( $to, $from )
    {
        for($i = $to; $i < $from; $i-- )
        {
            $this->remove( $i );
        }
    }

    /**
     * Sets the specified index to the specified value
     *
     * This method is affected by the fact that the index count change is not properly cascaded
     * by this.remove( int ).
     *
     * @access public
     * @param index the index to change
     * @param objec the objec to change the index to
     * @return int i if execution was not halted
     */
    public function set( Object $object, $index )
    {
    	$this->remove( $index );
    	$this->add( $object, $index );
        $this->modCount++;
    }

    /**
     * Returns a view of the portion of this list between <tt>fromIndex</tt>,
     * inclusive, and <tt>toIndex</tt>, exclusive.  (If <tt>fromIndex</tt> and
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
     *
     * @throws IndexOutOfBoundsException Endpoint index value out of range (fromIndex < 0 || toIndex > size)
     * @throws IllegalArgumentException Endpoint indices out of order (fromIndex > toIndex)
     */
    public function subList( $to, $from ){}
    
    /**
     * Returns an enumeration of the components of this vector. The returned Enumeration 
     * object will generate all items in this vector. The first item generated is the item at 
     * index 0, then the item at index 1, and so on. 
	 *
	 * @returns an enumeration of the components of this vector.
	 * @see Enumeration, Iterator
	 */
    public function elements()
    {
    	$enum = new Vector();
    	for( $i = 0; $i < count( $this->list ); $i++ )
    	{
    		$enum->addElement( $this->list[ $i ] );
    	}	
    	return $enum;
    }
    
    /**
     * Tests if the specified object is a component in this vector. 
	 *
	 * @overrides contains in class AbstractCollection
	 * @param elem an object. 
	 * @returns true iff the specified object is the same as a component in this vector, as determined by the equals method; false otherwise
	 */
	public function contains( Object $object )
	{
		$it = $this->iterator();
		while( $it->hasNext() )
		{
			if( $it->current()->equals( $object ) )
			{
				return true;
			}	
			$it->next();
		}
		return false;
	}
	
	/**
	 * Tests if this vector has no components. 
	 *
	 * @specified isEmpty in interface List
	 * @overrides isEmpty in class AbstractCollection
	 * @returns true iff this vector has no components, that is, its size is zero; false otherwise.
	 */
	public function isEmpty()
	{
		return ( $this->size() == 0 ) ? true : false;
	}
	
	/**
	 * Returns the number of components in this vector. 
	 *
	 * @specified size in interface List
	 * @specified size in class AbstractCollection
	 * @returns the number of components in this vector.
	 */
	public function size()
	{
		return count( $this->list );
	}
	
	/**
	 * Returns an array containing all of the elements in this Vector in the correct order. 
	 *
	 * @specified toArray in interface List
	 * @overrides toArray in class AbstractCollection
	 * @returns an array containing all of the elements in this list in proper sequence.
	 */
	public function toArray()
	{
		return $this->list;
	}

	/**
	 * Removes from this Vector all of its elements that are contained in the specified Collection. 
	 *
	 * @specified removeAll in interface List
	 * @overrides removeAll in class AbstractCollection
	 * @param c a collection of elements to be removed from the Vector 
	 * @returns true if this Vector changed as a result of the call. 
	 * @throws NullPointerException if the specified collection is null.
	 */
	public function removeAll( Collection $collection )
	{
		if( $this->containsAll() )
		{
			$it = $this->iterator();
			$ct = $collection->iterator();
			while( $it->hasNext() )
			{
				if( $it->current()->equals( $ct->current() ) )
				{
					$this->remove( $it->current() );	
				}	
			}
		}
		else
		{
			throw new Exception("Cannot remove a collection that is not contained in the vector!");	
		}
	}
	
	/**
	 * Retains only the elements in this Vector that are contained in the specified Collection. In other words, removes from this Vector all of its elements that are not contained in the specified Collection. 
	 *
	 * @specified retainAll in interface List
	 * @overrides retainAll in class AbstractCollection
	 * @param c a collection of elements to be retained in this Vector (all other elements are removed) 
	 * @returns true if this Vector changed as a result of the call. 
	 * @throws NullPointerException if the specified collection is null.
	 */
	public function retainAll( Collection $collection )
	{
		if( $this->containsAll() )
		{
			$it = $this->iterator();
			$ct = $collection->iterator();
			while( $it->hasNext() );
			{
				if( !$it->current()->equals( $ct->current() ) )
				{
					$this->remove( $it->current() );	
				}
			}
		}
		else
		{
			throw new Exception("Cannot retain a collection that is not contained in the vector!");	
		}
	}
	
	/**
	 * Returns true if this Vector contains all of the elements in the specified Collection. 
	 *
	 * @specified containsAll in interface List
	 * @overrides containsAll in class AbstractCollection
	 * @parm c a collection whose elements will be tested for containment in this Vector 
	 * @returns true if this Vector contains all of the elements in the specified collection. 
	 * @throws NullPointerException if the specified collection is null.
	 */
	public function containsAll( Collection $collection )
	{
		$ct = $collection->iterator();
		while( $ct->hasNext() )
		{
			if( !$this->contains( $ct->current() ) )
				return false;
			$ct->next();
		}
		return true;
	}
}
