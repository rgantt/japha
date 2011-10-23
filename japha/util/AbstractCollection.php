<?
namespace japha\util;

use japha\lang\Object;

abstract class AbstractCollection extends Object implements Collection
{
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
     * Add an object to the collection
     *
     * @access public
     * @param object The object to add to the Collection
     */
    public function add0( Object $object, $index ){}
    
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
     * Append a collection to this collection
     *
     * @param collection The collection to append
     * @access public
     */
    public function addAll0( Collection $collection ){}
    
    /**
     * Clear the current collection. Deletes all elements.
     *
     * @access public
     */
    public function clear(){}
    
    /**
     * 'Cruise' through the collection, searching for a particular object
     *
     * @param object the item to search for
     * @access public
     */
    public function contains( Object $obejct ){}
    
    /**
     * Check if this collection contains all of the elements of the passed collection
     *
     * @access public
     * @param collection The collection to search
     */
    public function containsAll( Collection $collection ){}
    
    /** 
     * Checks if the current collection has no elements
     *
     * @access public
     * @return boolean true iff the collection has no elements
     */
    public function isEmpty(){}

    /**
     * Removes an element from the collection
     *
     * @access public
     * @param object the object to remove
     */
    public function remove( $index ){}

    /**
     * Remove an entire collection from the current collection
     *
     * @access public
     * @param collection the collection to remove
     */
    public function removeAll( Collection $collection ){}

    /** */
    public function retainAll( Collection $collection ){}

    /**
     * Create a normal array out of the current collection
     *
     * @access public
     * @return Object[] an array of objects contained in the current collection
     */
    public function toArray(){}

    /**
     * Convert the current array to a string
     *
     * @access public
     * @return String the string representation of the collection
     */
    public function toString(){}

    /**
     * Returns the number of elements in the current collection
     *
     * @access public
     * @abstract
     * @return int The number of elements in the collection
     */
    //abstract public function size();

    /**
     * Returns an instance of ListIterator to iterate over the current collection
     *
     * @return ListIterator To iterate over the current collection
     * @access public
     * @abstract
     */
    //abstract public function iterator();
}
