<?
namespace japha\util;

use japha\lang\Object;
use japha\lang\Cloneable;
use japha\io\_Serializable;

/**
 * Linked list implementation of the List interface. Implements all optional list operations, and permits all elements
 * (including null). In addition to implementing the List interface, the LinkedList class provides uniformly named
 * methods to get, remove and insert an element at the beginning and end of the list. These operations allow linked lists
 * to be used as a stack, queue, or double-ended queue (deque).
 *
 * All of the stack/queue/deque operations could be easily recast in terms of the standard list operations. They're
 * included here primarily for convenience, though they may run slightly faster than the equivalent List operations.
 *
 * All of the operations perform as could be expected for a doubly-linked list. Operations that index into the list will
 * traverse the list from the begining or the end, whichever is closer to the specified index.
 *
 * The iterators returned by the this class's iterator and listIterator methods are fail-fast: if the list is
 * structurally modified at any time after the iterator is created, in any way except through the Iterator's own remove
 * or add methods, the iterator will throw a ConcurrentModificationException. Thus, in the face of concurrent
 * modification, the iterator fails quickly and cleanly, rather than risking arbitrary, non-deterministic behavior at
 * an undetermined time in the future.
 *
 * Note that the fail-fast behavior of an iterator cannot be guaranteed as it is, generally speaking, impossible to make
 * any hard guarantees in the presence of unsynchronized concurrent modification. Fail-fast iterators throw
 * ConcurrentModificationException on a best-effort basis. Therefore, it would be wrong to write a program that depended
 * on this exception for its correctness: the fail-fast behavior of iterators should be used only to detect bugs.
 */
abstract class LinkedList extends AbstractSequentialList implements PList, Cloneable, Serializable
{
    /**
     * The size of the Linked List
     */
    public $size;
    private $first = null;

    public $header;

    public function __construct()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 0:
            $this->LinkedList0();
            break;
            case 1:
            $this->LinkedList1( $argv[0] );
            break;
        }
    }

    /**
     * Constructs an empty list.
     */
    public function LinkedList0()
    {
        parent::__construct();
        $this->header = new Entry( null, null, null );
        $this->header->next = $this->header->previous = $this->header;
        $this->size = 0;
    }

    /**
     * Constructs a list containing the elements of the specified collection, in the order they are returned by the
     * collection's iterator.
     */
    public function LinkedList1( Collection $c )
    {
        $this->addAll( $c );
    }

    public function add()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 1:
            $this->add0( $argv[0] );
            break;
            case 2:
            $this->add1( $argv[0], $argv[1] );
            break;
        }
    }

    /**
     * Inserts the specified element at the specified position in this list.
     */
    public function	add0( Object $o )
    {
        $this->addBefore( $o, $this->header );
        return true;
    }

    public function add1( $index, Object $element )
    {
        $this->addBefore( $element, ( $index == $this->size ? $this->header : $this->entry( $index ) ) );
    }

    public function addAll()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 1:
            return $this->addAll0( $argv[0] );
            break;
            case 2:
            return $this->addAll1( $argv[0], $argv[1] );
            break;
        }
    }

    /**
     * Appends all of the elements in the specified collection to the end of this list, in the order that they are
     * returned by the specified collection's iterator.
     */
    public function	addAll0( Collection $c )
    {
        $this->addAll( $this->size, $c );
    }

    public function addAll1( $index, Collection $c )
    {
        $a = $c->toArray();
        $numNew = count( $a );
        if ( $numNew == 0 )
        {
            return false;
        }
        $this->modCount++;

        $successor = ( $index == $this->size ? $this->header : $this->entry( $index ) );
        $predecessor = $successor->previous;
        for ( $i = 0; $i < $numNew; $i++ )
        {
            $e = new Entry( $a[ $i ], $successor, $predecessor );
            $predecessor->next = $e;
            $predecessor = $e;
        }
        $successor->previous = $predecessor;

        $this->size += $numNew;
        return true;
    }

    /**
     * Inserts the given element at the beginning of this list.
     */
    public function	addFirst( Object $o )
    {
        $this->addBefore( $o, $this->header->next );
    }

    /**
     * Appends the given element to the end of this list.
     */
    public function addLast( Object $o )
    {
        $this->addBefore( $o, $this->header );
    }

    /**
     * Removes all of the elements from this list.
     */
    public function	clear()
    {
        $this->modCount++;
        $this->header->next = $this->header->previous = $this->header;
        $this->size = 0;
    }

    /**
     * Returns true if this list contains the specified element.
     */
    public function contains( Object $o )
    {
        return ( $this->indexOf( $o ) != - 1 );
    }

    private function entry( $index )
    {
        if( $index < 0 || $index > $this->size )
        {
            throw new IndexOutOfBoundsException("Index: ".$index.", Size:".$this->size );
        }
        $e = $this->header;
        if( $index < ( $this->size >> 1 ) )
        {
            for( $i = 0; $i <= $index; $i++ )
            {
                $e = $e->next;
            }
        }
        else
        {
            for( $i = $this->size; $i > $index; $i-- )
            {
                $e = $e->previous;
            }
        }
        return $e;
    }

    /**
     * Returns the element at the specified position in this list.
     */
    public function	get( $index )
    {
        return $this->entry( $index )->element;
    }

    /**
     * Returns the first element in this list.
     */
    public function getFirst()
    {
        if( $this->size == 0 )
        {
            throw new NoSuchElementException("Could not access first element of LinkedList, does not exist!");
        }
        return $this->header->next->element;
    }

    /**
     * Returns the last element in this list.
     */
    public function	getLast()
    {
        if( $this->size == 0 )
        {
            throw new NoSuchElementException("Could not access last element of Linked List, does not exist!");
        }
        return $this->header->previous->element;
    }

    /**
     * Returns the index in this list of the first occurrence of the specified element, or -1 if the List does not
     * contain this element.
     */
    public function	indexOf( Object $o )
    {
        $index = 0;
        if( $o == null )
        {
            for( $e = $this->header->next; $e != $this->header; $e = $e->next )
            {
                if( $e->element == null )
                {
                    return $index;
                }
                $index++;
            }
        }
        else
        {
            for( $e = $this->header->next; $e != $this->header; $e = $e->next )
            {
                if( $o->equals( $e->element ) )
                {
                    return $index;
                }
                $index++;
            }
        }
        return -1;
    }

    /**
     * Returns the index in this list of the last occurrence of the specified element, or -1 if the list does not
     * contain this element.
     */
    public function	lastIndexOf( Object $o )
    {
        $index = $this->size;
        if( $o == null )
        {
            for( $e = $this->header->previous; $e != $this->header; $e = $e->previous )
            {
                if( $e-element == null )
                {
                    return $index;
                }
                $index--;
            }
        }
        else
        {
            for( $e = $this->header->previous; $e != $this->header; $e = $e->previous )
            {
                if( $o->equals( $e->element ) )
                {
                    return $index;
                }
                $index--;
            }
        }
        return -1;
    }

    public function remove()
    {
        $argv = func_get_args();
        if( $argv[0] instanceof Object )
        {
            return $this->remove2( $argv[0] );
        }
        else if( $argv[0] instanceof Object )
        {
            return $this->remove1( $argv[0] );
        }
        return $this->remove0( $argv[0] );
    }

    /**
     * Removes the element at the specified position in this list.
     */
    public function	remove0( $index )
    {
        $e = $this->entry( $index );
        $this->remove( $e );
        return $e->element;
    }

    /**
     * Removes the first occurrence of the specified element in this list.
     */
    public function remove1( Object $o )
    {
        if ( $o == null )
        {
            for ( $e = $this->header->next; $e != $this->header; $e = $e->next )
            {
                if ( $e->element == null )
                {
                    $this->remove( $e );
                    return true;
                }
            }
        }
        else
        {
            for ( $e = $this->header->next; $e != $this->header; $e = $e->next )
            {
                if ( $o->equals( $e->element ) )
                {
                    $this->remove( $e );
                    return true;
                }
            }
        }
        return false;
    }

    public function remove2( Entry $e )
    {
        $e->previous->next = $e->next;
        $e->next->previous = $e->previous;
        $this->size--;
        $this->modCount++;
    }

    /**
     * Removes and returns the first element from this list.
     */
    public function removeFirst()
    {
        $first = $this->header->next->element;
        $this->remove( $this->header->next );
        return $first;
    }

    /**
     * Removes and returns the last element from this list.
     */
    public function removeLast()
    {
        $last =  $this->header->previous->element;
        $this->remove( $this->header->previous );
        return $last;
    }

    /**
     * Replaces the element at the specified position in this list with the specified element.
     */
    public function set( Object $element, $index )
    {
        $e = $this->entry( $index );
        $oldVal = $e->element;
        $e->element = $element;
        return $oldVal;
    }

    /**
    * Returns the number of elements in this list.
    */
    public function size()
    {
        return $this->size();
    }

    public function addBefore( Object $o, Entry $e )
    {
        $newEntry = new Entry( $o, $e, $e->previous );
        $newEntry->previous->next = $newEntry;
        $newEntry->next->previous = $newEntry;
        $this->size++;
        $this->modCount++;
        return $newEntry;
    }

    /**
    * Returns an array containing all of the elements in this list in the correct order.
    */
    public function toArray()
    {
        $i = 0;
        for ( $e = $this->header->next; $e != $this->header; $e = $e->next )
        {
            $result[ $i++ ] = $e->element;
        }
        return $result;
    }

    /**
    * Returns a shallow copy of this LinkedList.
    */
    public function _clone()
    {
        $clone = null;
        try
        {
            $clone = parent::_clone();
        }
        catch ( CloneNotSupportedException $e )
        {
            throw new InternalError();
        }
        $clone->header = new Entry( null, null, null );
        $clone->header->next = $clone->header->previous = $clone->header;
        $clone->size = 0;
        $clone->modCount = 0;

        // Initialize clone with our elements
        for ( $e = $this->header->next; $e != $this->header; $e = $e->next )
        {
            $clone->add( $e->element);
        }
        return $clone;
    }

    /**
    * Returns a list-iterator of the elements in this list (in proper
    * sequence), starting at the specified position in the list.
    * Obeys the general contract of <tt>List.listIterator(int)</tt>.<p>
    *
    * The list-iterator is <i>fail-fast</i>: if the list is structurally
    * modified at any time after the Iterator is created, in any way except
    * through the list-iterator's own <tt>remove</tt> or <tt>add</tt>
    * methods, the list-iterator will throw a
    * <tt>ConcurrentModificationException</tt>.  Thus, in the face of
    * concurrent modification, the iterator fails quickly and cleanly, rather
    * than risking arbitrary, non-deterministic behavior at an undetermined
    * time in the future.
    *
    * @param index index of first element to be returned from the
    *		    list-iterator (by a call to <tt>next</tt>).
    * @return a ListIterator of the elements in this list (in proper
    * 	       sequence), starting at the specified position in the list.
    * @throws    IndexOutOfBoundsException if index is out of range
    *		  (<tt>index &lt; 0 || index &gt; size()</tt>).
    * @see List#listIterator(int)
    */
    public function listIterator()
    {
        echo "Returning listiterator...<br/>";
        return new ListItr( $this, 0 );
    }

    public function containsAll( Collection $c ){}
    public function removeAll( Collection $c ){}
    public function isEmpty(){}
    public function retainAll( Collection $c ){}
    public function subList( $index, $index ){}
}

class Entry
{
    public $next;
    public $previous;
    public $value;

    public function __construct( $value, $next, $previous )
    {
        $this->value = $value;
        $this->next = $next;
        $this->previous = $previous;
    }
}

class ListItr extends ListIterator
{
    private $lastReturned;
    private $next;
    private $nextIndex;
    private $expectedModCount;

    private $ll;

    public function __construct( $ll, $index )
    {
        $this->ll = $ll;

        $this->lastReturned = $ll->header;
        $this->expectedModCount = $ll->modCount;

        if ( $index < 0 || $index > $size )
        {
            throw new IndexOutOfBoundsException("Index: ".$index." Size: ".$this->ll->size );
        }
        if ( $index < ( $size >> 1 ) )
        {
            $this->next = $this->ll->header->next;
            for ( $this->nextIndex = 0; $this->nextIndex < $index; $this->nextIndex++ )
            {
                $this->next = $this->next->next;
            }
        }
        else
        {
            $this->next = $this->ll->header;
            for ( $this->nextIndex = $this->ll->size; $this->nextIndex > $index; $this->nextIndex-- )
            {
                $this->next = $this->next->previous;
            }
        }
    }

    public function hasNext()
    {
        return $this->nextIndex != $this->ll->size;
    }

    public function next()
    {
        $this->checkForComodification();
        if ( $this->nextIndex == $this->ll->size )
        {
            throw new NoSuchElementException();
        }
        $this->lastReturned = $this->next;
        $this->next = $this->next->next;
        $this->nextIndex++;
        return $this->lastReturned->element;
    }

    public function current()
    {
        return $this->lastReturned->element;   
    }
    
    public function hasPrevious()
    {
        return $this->nextIndex != 0;
    }

    public function previous()
    {
        if ( $this->nextIndex == 0 )
        {
            throw new NoSuchElementException();
        }
        $this->lastReturned = $this->next = $this->next->previous;
        $this->nextIndex--;
        $this->checkForComodification();
        return $this->lastReturned->element;
    }

    public function nextIndex()
    {
        return $this->nextIndex;
    }

    public function previousIndex()
    {
        return $this->nextIndex - 1;
    }

    public function remove()
    {
        $this->checkForComodification();
        try
        {
            $this->ll->remove( $this->lastReturned );
        }
        catch ( NoSuchElementException $e )
        {
            throw new IllegalStateException();
        }
        if ( $this->next == $this->lastReturned )
        {
            $this->next = $this->lastReturned->next;
        }
        else
        {
            $this->nextIndex--;
        }
        $this->lastReturned = $this->ll->header;
        $this->expectedModCount++;
    }

    public function set( Object $o )
    {
        if ( $this->lastReturned == $this->ll->header)
        {
            throw new IllegalStateException();
        }
        $this->checkForComodification();
        $this->lastReturned->element = o;
    }

    public function add( Object $o )
    {
        $this->checkForComodification();
        $this->lastReturned = $this->header;
        $this->ll->addBefore( $o, $this->next);
        $this->nextIndex++;
        $this->expectedModCount++;
    }

    final function checkForComodification()
    {
        if ( $this->ll->modCount != $this->expectedModCount )
        {
            throw new ConcurrentModificationException("The expected modification count (".$this->expectedModCount.") differed from the actual (".$this->ll->modCount.").");
        }
    }
}