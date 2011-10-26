<?php
namespace japha\util;

use japha\lang\Object;

/** 
 * This class provides a skeletal implementation of the Set interface to minimize the effort required to implement 
 * this interface.
 *
 * The process of implementing a set by extending this class is identical to that of implementing a Collection by 
 * extending AbstractCollection, except that all of the methods and constructors in subclasses of this class must obey 
 * the additional constraints imposed by the Set interface (for instance, the add method must not permit addition of 
 * multiple intances of an object to a set).
 *
 * Note that this class does not override any of the implementations from the AbstractCollection class. It merely adds 
 * implementations for equals and hashCode.
 *
 * This class is a member of the Java Collections Framework. 
 */
abstract class AbstractSet extends AbstractCollection implements Set
{
    /**
     * Sole constructor
     */
    public function __construct(){}
 
    /**
     * Compares the specified object with this set for equality.
     *
     * For the time being, this just checks the hashcodes to make sure they are equivalent
     */
    public function equals( Object $o )
    {
        if( $o instanceof AbstractSet )
        {
            if( $o->hashCode() == $this->hashCode() )
            {
                return true;   
            }
        }
        return false;
    }
          
    /**
     * Returns the hash code value for this set.
     */
    public function	hashCode()
    {
        $h = 0;
        foreach( $this->set as $value )
        {
            $h = 2 * ord( var_dump( $value ) );   
        }
        return $h;
    }
       
    /**
     * Removes from this set all of its elements that are contained in the specified collection (optional operation).
     */
    public function removeAll( Collection $c )
    {
        for( $i = $c->iterator(); $i->hasNext(); $i->next() )
        {
            if( in_array( $i->current(), $this->set ) )
            {
                unset( $this->set[ $i->current() ] );   
            }   
        }
    }
}
?>
