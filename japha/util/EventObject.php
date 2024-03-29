<?php
namespace japha\util;

use japha\lang\Object;
use japha\io\_Serializable;

/**
 * The root class from which all event state objects shall be derived.
 *
 * All Events are constructed with a reference to the object, the "source", that is logically deemed to be the object 
 * upon which the Event in question initially occurred upon.
 */
class EventObject extends Object implements _Serializable
{
    /**
     * The object on which the Event initially occurred.
     */
    protected $source;
 
    /**
     * Sole constructor -- constructs a prototypical event
     */    
    public function __construct( Object $source )
    {
        $this->source = $source;
    }
 
    /**
     * The object on which the Event initially occurred.
     */
    public function getSource()
    {
        return $this->source;
    }
          
    /**
     * Returns a String representation of this EventObject.
     */
    public function toString()
    {
        return $this->source->toString();
    }
}