<?
package("japhax.sql");

/**
 * $Id: RowSetInternal.php,v 1.4 2004/07/14 22:27:04 japha Exp $
 *
 * The interface that a RowSet object implements in order to present itself to a RowSetReader 
 * or RowSetWriter object. The RowSetInternal interface contains methods that let the reader or 
 * writer access and modify the internal state of the rowset. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:04 $
 */
interface RowSetInternal
{
	/**
	 * Retrieves the Connection object that was passed to this RowSet object. 
	 *
	 * @returns the Connection object passed to the rowset or null if none was passed 
	 * @throws SQLException if a database access error occurs
	 */
	public function getConnection();
	
	/**
	 * Retrieves a ResultSet object containing the original value of this RowSet object. 
	 * The cursor is positioned before the first row in the result set. Only rows contained in 
	 * the result set returned by the method getOriginal are said to have an original value. 
	 *
	 * @returns the original value of the rowset 
	 * @throws SQLException if a database access error occurs
	 */
	public function getOriginal();
	
	/**
	 * Retrieves a ResultSet object containing the original value of the current row only. If the current row has no original value, an empty result set is returned. If there is no current row, an exception is thrown. 
	 *
	 * @returns the original value of the current row as a ResultSet object 
	 * @throws SQLException if a database access error occurs or this method is called while the cursor is on the insert row, before the first row, or after the last row
	 */
	public function getOriginalRow();
	
	/**
	 * Retrieves the parameters that have been set for this RowSet object's command. 
	 *
	 * @returns an array of the current parameter values for this RowSet object's command 
	 * @throws SQLException if a database access error occurs
	 */
	public function getParams();
	
	/**
	 * Sets the given RowSetMetaData object as the RowSetMetaData object for this RowSet object. The RowSetReader object associated with the rowset will use RowSetMetaData methods to set the values giving information about the rowset's columns. 
	 *
	 * @param md the RowSetMetaData object that will be set with information about the rowset's columns 
	 * @throws SQLException if a database access error occurs
	 */
	public function setMetaData( RowSetMetaData $md );
}
?>