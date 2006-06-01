<?
package("japha.util");

import("japha.io.Serializable");

/**
 * $Id: EventObject.php,v 1.2 2004/07/22 16:40:05 japha Exp $
 *
 * The root class from which all event state objects shall be derived.
 *
 * All Events are constructed with a reference to the object, the "source", that is logically deemed to be the object 
 * upon which the Event in question initially occurred upon.
 *
 * @author <a href="gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.2 $
 */
class EventObject extends Object implements Serializable
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
?>