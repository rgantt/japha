<?
package("japhax.sql");

/**
 * $Id: RowSetWriter.php,v 1.4 2004/07/20 21:12:42 japha Exp $
 *
 * An object that implements the RowSetWriter interface, called a writer. A writer may be 
 * registered with a RowSet object that supports the reader/writer paradigm. 
 *
 * If a disconnected RowSet object modifies some of its data, and it has a writer associated 
 * with it, it may be implemented so that it calls on the writer's writeData method internally to 
 * write the updates back to the data source. In order to do this, the writer must first 
 * establish a connection with the rowset's data source. 
 *
 * If the data to be updated has already been changed in the data source, there is a conflict, 
 * in which case the writer will not write the changes to the data source. 
 * The algorithm the writer uses for preventing or limiting conflicts depends 
 * entirely on its implementation.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/20 21:12:42 $
 */
interface RowSetWriter
{
	/**
	 * Writes the changes in this RowSetWriter object's rowset back to the data source from 
	 * which it got its data. 
	 *
	 * @param caller the RowSet object (1) that has implemented the RowSetInternal interface, (2) with which this writer is registered, and (3) that called this method internally 
	 * @returns true if the modified data was written; false if not, which will be the case if there is a conflict 
	 * @throws SQLException if a database access error occurs
	 */
	public function writeData( RowSetInternal $caller );	
}