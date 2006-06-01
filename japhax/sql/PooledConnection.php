<?
package("japhax.sql");

/**
 * $Id: PooledConnection.php,v 1.4 2004/07/14 22:27:04 japha Exp $
 *
 * An object that provides hooks for connection pool management. A PooledConnection object 
 * represents a physical connection to a data source. The connection can be recycled 
 * rather than being closed when an application is finished with it, thus reducing the 
 * number of connections that need to be made. 
 *
 * An application programmer does not use the PooledConnection interface directly; rather, it 
 * is used by a middle tier infrastructure that manages the pooling of connections.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:04 $
 */
interface PooledConnection
{
	/**
	 * Registers the given event listener so that it will be notified when an event occurs on this PooledConnection object. 
	 *
	 * @param listener a component that has implemented the ConnectionEventListener interface and wants to be notified when the connection is closed or has an error; generally, a connection pool manager
	 * @see removeConnectionEventListener( ConnectionEventListener )
	 */
	public function addConnectionEventListener( ConnectionEventListener $listener );
	
	/**
	 * Closes the physical connection that this PooledConnection object represents. 
	 *
	 * @throws SQLException if a database access error occurs
	 */
	public function close();
	
	/**
	 * Creates an object handle for the physical connection that this PooledConnection object represents. The object returned is a temporary handle used by application code to refer to a physical connection (this PooldedConnection object) that is being pooled. 
	 *
	 * @returns a Connection object that is a handle to this PooledConnection object 
	 * @throws SQLException if a database access error occurs
	 */
	public function getConnection();
	
	/**
	 * Removes the given event listener from the list of components that will be notified when an event occurs on this PooledConnection object. 
	 *
	 * @param listener - a component that has implemented the ConnectionEventListener interface and been been registered as a listener; generally, a connection pool manager
	 * @see addConnectionEventListener( ConnectionEventListener )
	 */
	public function removeConnectionEventListener( ConnectionEventListener $listener );
}