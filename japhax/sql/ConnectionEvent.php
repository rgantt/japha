<?
package("japhax.sql");

import("japha.util.EventObject");

/**
 * $Id$
 *
 * An Event object that provides information about the source of a connection-related event. 
 * ConnectionEvent objects are generated when an application closes a pooled connection 
 * and when an error occurs. The ConnectionEvent object contains two kinds of information: 
 *
 * <ul><li/>The pooled connection closed by the application 
 * <li/>In the case of an error event, the SQLException about to be thrown to the application </ul>
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class ConnectionEvent extends EventObject
{
	private $SQLException;
	
	/**
	 * Polymorphic method: __construct( PooledConnection ), __construct( PooledConnection, SQLException )
	 *
	 * Constructs a ConnectionEvent object initialized with the given PooledConnection object and SQLException object. 
	 *
	 * @param con the pooled connection that is the source of the event
	 * @param ex the SQLException about to be thrown to the application
	 */
	public function __construct()
	{
		$argv = func_get_args();
		if( $argv[0] instanceof PooledConnection )
		{
			$this->source = $argv[0];
		}
		if( $argv[1] instanceof SQLException )
		{
			$this->SQLException = $argv[1];	
		}
	}	
	
	/**
	 * Retrieves the SQLException for this ConnectionEvent object. May be null. 
	 *
	 * @returns the SQLException about to be thrown or null
	 */
	public function getSQLException()
	{
		return $this->SQLException;
	}
}