<?
package("japhax.sql");

import("japha.util.EventObject");

/**
 * $Id: RowSetEvent.php,v 1.4 2004/07/14 22:27:04 japha Exp $
 *
 * An Event object generated when an event occurs to a RowSet object. A RowSetEvent object is 
 * generated when a single row in a rowset is changed, the whole rowset is changed, or the rowset 
 * cursor moves. 
 *
 * When an event occurs on a RowSet object, one of the RowSetListener methods will be sent to 
 * all registered listeners to notify them of the event. An Event object is supplied to 
 * the RowSetListener method so that the listener can use it to find out which RowSet object is 
 * the source of the event. 
 *
 * @author Ryan Gantt
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:04 $
 */
class RowSetEvent extends EventObject
{
	/**
	 * Constructs a RowSetEvent object initialized with the given RowSet object. 
	 *
	 * @param source the RowSet object whose data has changed or whose cursor has moved
	 */
	public function __construct( RowSet $source )
	{
		$this->source = $source;
	}	
}
?>