<?
package("japhax.sql");

import("japhax.sql.EventListener");

/**
 * $Id: RowSetListener.php,v 1.4 2004/07/14 22:27:04 japha Exp $
 *
 * An interface that must be implemented by a component that wants to be notified when a significant 
 * event happens in the life of a RowSet object. A component becomes a listener by being registered 
 * with a RowSet object via the method RowSet.addRowSetListener. How a registered component 
 * implements this interface determines what it does when it is notified of an event. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:04 $
 */
interface RowSetListener extends EventListener
{
	/**
	 * Notifies registered listeners that a RowSet object's cursor has moved. 
	 * The source of the event can be retrieved with the method event.getSource. 
	 *
	 * @param event a RowSetEvent object that contains the RowSet object that is the source of the event
	 */
	public function cursorMoved( RowSetEvent $event );
	
	/**
	 * Notifies registered listeners that a RowSet object has had a change in one of its rows. 
	 * The source of the event can be retrieved with the method event.getSource. 
	 *
	 * @param event a RowSetEvent object that contains the RowSet object that is the source of the event
	 */
	public function rowChanged( RowSetEvent $event );
	
	/**
	 * Notifies registered listeners that a RowSet object in the given RowSetEvent object has changed its entire 
	 * contents. The source of the event can be retrieved with the method event.getSource. 
	 *
	 * @param event a RowSetEvent object that contains the RowSet object that is the source of the event
	 */
	public function rowSetChanged( RowSetEvent $event );	
}