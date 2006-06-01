<?
package("japhax.sql");

/**
 * $Id: ConnectionPoolDataSource.php,v 1.7 2004/07/20 21:12:42 japha Exp $
 *
 * A factory for PooledConnection objects. An object that implements this interface will typically 
 * be registered with a naming service that is based on the JavaTM Naming and Directory Interface (JNDI). 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.7 $ $Date: 2004/07/20 21:12:42 $
 */
interface ConnectionPoolDataSource
{
	/**
	 * Retrieves the maximum time in seconds that this ConnectionPoolDataSource object will wait 
	 * while attempting to connect to a database. A value of zero means that the timeout is the 
	 * default system timeout if there is one; otherwise, it means that there is no timeout. 
	 * When a DataSource object is created, its login timeout is initially zero. 
	 *
	 * @returns the data source login time limit 
	 * @throws SQLException if a database access error occurs.
	 * @see setLoginTimeout(int)
	 */
	public function getLoginTimeout();

	/**
	 * Retrieves the log writer for this ConnectionPoolDataSource object. 
	 *
	 * The log writer is a character output stream to which all logging and tracing messages for 
	 * this ConnectionPoolDataSource object are printed. This includes messages printed by 
	 * the methods of this object, messages printed by methods of other objects manufactured by 
	 * this object, and so on. Messages printed to a data source- specific log writer are not 
	 * printed to the log writer associated with the java.sql.DriverManager class. 
	 * When a data source object is created, the log writer is initially null; in other words, 
	 * the default is for logging to be disabled. 
	 *
	 * @returns the log writer for this ConnectionPoolDataSource object or null if logging is disabled 
	 * @throws SQLException if a database access error occurs
	 * @see setLogWriter(java.io.PrintWriter)
	 */ 
	public function getLogWriter();
	
	/**
	 * Attempts to establish a physical database connection that can be used as a pooled connection. 
	 *
	 * @param user the database user on whose behalf the connection is being made
	 * @param password the user's password 
	 * @returns	a PooledConnection object that is a physical connection to the database that this ConnectionPoolDataSource object represents 
	 * @throws SQLException if a database access error occurs
	 */
	public function getPooledConnection( $user, $password );
	
	/**
	 * Attempts to establish a physical database connection that can be used as a pooled connection. 
	 *
	 * @param user the database user on whose behalf the connection is being made
	 * @param password the user's password 
	 * @returns a PooledConnection object that is a physical connection to the database that this ConnectionPoolDataSource object represents 
	 * @throws SQLException if a database access error occurs
	 */
	public function setLoginTimeout( $seconds );
	
	/**
	 * Sets the log writer for this ConnectionPoolDataSource object to the given java.io.PrintWriter 
	 * object. The log writer is a character output stream to which all logging and tracing 
	 * messages for this ConnectionPoolDataSource object are printed. This includes messages printed 
	 * by the methods of this object, messages printed by methods of other objects manufactured by 
	 * this object, and so on. Messages printed to a data source- specific log writer are not printed 
	 * to the log writer associated with the java.sql.Drivermanager class. When a data source 
	 * object is created, the log writer is initially null; in other words, the default is for 
	 * logging to be disabled. 
	 *
	 * @param out the new log writer; null to disable logging 
	 * @throws SQLException if a database access error occurs
	 * @see getLogWriter()
	 */
	public function setLogWriter( PrintWriter $out );	
}