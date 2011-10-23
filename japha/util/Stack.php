<?
namespace japha\util;

/**
 * The Stack class represents a last-in-first-out (LIFO) stack of objects. 
 * It extends class Vector with five operations that allow a vector to be treated as a stack. 
 * The usual push and pop operations are provided, as well as a method to peek at the top 
 * item on the stack, a method to test for whether the stack is empty, and a method to search 
 * the stack for an item and discover how far it is from the top. 
 * <p/>When a stack is first created, it contains no items. 
 */
class Stack extends Vector
{
    /**
     * Creates an empty Stack
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->elementCount = count( $this->list );
    }
    
    /**
     * Tests if this stack is empty. 
     *
     * @desc Tests if this stack is empty.
     * @return boolean <tt>true</tt> if and only if this stack contains no items; <tt>false</tt> otherwise.
     */
    public function isEmpty()
    {
        return $this->size() == 0 ? true : false;
    }
    
    /**
     * Looks at the object at the top of this stack without removing it from the stack.
     *
     * @desc Looks at the object at the top of this stack without removing it from the stack.
     * @return Object the object at the top of this stack (the last item of the <tt>Vector</tt> object).
     * @throws EmptyStackException if this stack is empty.
     * @access public
     */
    public function peek()
    {
        return $this->list[ $this->elementCount - 1 ];
    }
    
    /**
     * Removes the object at the top of this stack and returns that object as the value of this function.
     *
     * @desc Removes the object at the top of this stack and returns that object as the value of this function.
     * @return Object The object at the top of this stack (the last item of the <tt>Vector</tt> object).
     * @throws EmptyStackException if this stack is empty.
     * @access public
     */
    public function pop()
    {
        $pop = $this->list[ $this->elementCount - 1 ];
        unset($this->list[ $this->elementCount - 1 ]);
        $this->elementCount--;
        return $pop;
    }
    
    /**
     * Pushes an item onto the top of this stack.
     *
     * @desc Pushes an item onto the top of this stack. This has exactly the same effect as: <p/><tt>addElement(item)</tt>
     * @return Object The <tt>object</tt> argument.
     * @param object the object to be added to the top of the stack
     * @see Vector.addElement(java.lang.Object)
     * @access public
     */
    public function push( $object )
    {
        $this->list[] = $object;
        $this->elementCount++;
        return $object;
    }
    
    /**
     * Returns the 1-based position where an object is on this stack. 
     * If the <tt>object</tt> occurs as an item in this stack, this method returns the distance from 
     * the top of the stack of the occurrence nearest the top of the stack; 
     * the topmost item on the stack is considered to be at distance 1. 
     * The equals method is used to compare <tt>object</tt> to the items in this stack.
     *
     * @desc  Returns the 1-based position where an object is on this stack.
     * @param object The desired object.
     * @return int The 1-based position from the top of the stack where the object is located; the return value -1 indicates that the object is not on the stack.
     * @access public
     */
    public function search( $object )
    {
        return array_search( $object, $this->list );
    }   
}