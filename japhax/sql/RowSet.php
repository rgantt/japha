<?
package("japhax.sql");

import("japhax.sql.ResultSet");

/**
 * $Id$
 *
 * The interface that adds support to the JDBC API for the JavaBeansTM component model. A rowset, 
 * which can be used as a JavaBeans component in a visual Bean development environment, can be 
 * created and configured at design time and executed at run time. 
 *
 * The RowSet interface provides a set of JavaBeans properties that allow a RowSet instance to be 
 * configured to connect to a JDBC data source and read some data from the data source. A group 
 * of setter methods (setInt, setBytes, setString, and so on) provide a way to pass input parameters 
 * to a rowset's command property. This command is the SQL query the rowset uses when it gets 
 * its data from a relational database, which is generally the case. 
 *
 * The RowSet interface supports JavaBeans events, allowing other components in an application to 
 * be notified when an event occurs on a rowset, such as a change in its value. 
 *
 * The RowSet interface is unique in that it is intended to be implemented using the rest of the 
 * JDBC API. In other words, a RowSet implementation is a layer of software that executes "on top" 
 * of a JDBC driver. Implementations of the RowSet interface can be provided by anyone, including 
 * JDBC driver vendors who want to provide a RowSet implementation as part of their JDBC products. 
 *
 * A RowSet object may make a connection with a data source and maintain that connection 
 * throughout its life cycle, in which case it is called a connected rowset. 
 * A rowset may also make a connection with a data source, get data from it, and then close 
 * the connection. Such a rowset is called a disconnected rowset. A disconnected rowset may 
 * make changes to its data while it is disconnected and then send the changes back to the 
 * original source of the data, but it must reestablish a connection to do so. 
 *
 * A disconnected rowset may have a reader (a RowSetReader object) and a writer (a RowSetWriter object) 
 * associated with it. The reader may be implemented in many different ways to populate a rowset 
 * with data, including getting data from a non-relational data source. The writer can also be 
 * implemented in many different ways to propagate changes made to the rowset's data back to the 
 * underlying data source. 
 *
 * Rowsets are easy to use. The RowSet interface extends the standard java.sql.ResultSet interface. 
 * The RowSetMetaData interface extends the java.sql.ResultSetMetaData interface. Thus, developers 
 * familiar with the JDBC API will have to learn a minimal number of new APIs to use rowsets. 
 * In addition, third-party software tools that work with JDBC ResultSet objects will also easily 
 * be made to work with rowsets. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface RowSet extends ResultSet
{
}
?>