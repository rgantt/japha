<?
package("japhax.sql");

import("japha.sql.ResultSetMetaData");

/**
 * $Id$
 *
 * An object that contains information about the columns in a RowSet object. This interface is 
 * an extension of the ResultSetMetaData interface with methods for setting the values in a 
 * RowSetMetaData object. When a RowSetReader object reads data into a RowSet object, it creates 
 * a RowSetMetaData object and initializes it using the methods in the RowSetMetaData interface. 
 * Then the reader passes the RowSetMetaData object to the rowset. 
 *
 * The methods in this interface are invoked internally when an application calls the method 
 * RowSet.execute; an application programmer would not use them directly. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface RowSetMetaData extends ResultSetMetaData
{
	/**
	 * Sets whether the designated column is automatically numbered, and thus read-only. 
	 * The default is for a RowSet object's columns not to be automatically numbered. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param property true if the column is automatically numbered; false if it is not 
	 * @throws SQLException if a database access error occurs
	 */
	public function setAutoIncrement( $columnIndex, $property );
	
	/**
	 * Sets whether the designated column is case sensitive. The default is false. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param property true if the column is case sensitive; false if it is not 
	 * @throws SQLException if a database access error occurs
	 */
	public function setCaseSensitive( $columnIndex, $property );
	
	/**
	 * Sets the designated column's table's catalog name, if any, to the given String. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param catalogName the column's catalog name 
	 * @throws SQLException if a database access error occurs
	 */
	public function setCatalogName( $columnIndex, $catalogName );
	
	/**
	 * Sets the number of columns in the RowSet object to the given number. 
	 *
	 * @param columnCount the number of columns in the RowSet object 
	 * @throws SQLException if a database access error occurs
	 */
	public function setColumnCount( $columnCount );
	
	/**
	 * Sets the designated column's normal maximum width in chars to the given int. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param size the normal maximum number of characters for the designated column 
	 * @throws SQLException if a database access error occurs
	 */
	public function setColumnDisplaySize( $columnIndex, $size );
	
	/**
	 * Sets the suggested column title for use in printouts and displays, if any, to the given String. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param label the column title 
	 * @throws SQLException if a database access error occurs
	 */
	public function setColumnLabel( $columnIndex, $label );
	
	/**
	 * Sets the name of the designated column to the given String. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param columnName the designated column's name 
	 * @throws SQLException if a database access error occurs
	 */
	public function setColumnName( $columnIndex, $columnName );
	
	/**
	 * Sets the designated column's SQL type to the one given. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param SQLType the column's SQL type 
	 * @throws SQLException if a database access error occurs
	 * @see Types
	 */
	public function setColumnType( $columnIndex, $SQLType );
	
	/**
	 * Sets the designated column's type name that is specific to the data source, if any, to the given String. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param typeName data source specific type name. 
	 * @throws SQLException if a database access error occurs
	 */
	public function setColumnTypeName( $columnIndex, $typeName );
	
	/**
	 * Sets whether the designated column is a cash value. The default is false. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param property true if the column is a cash value; false if it is not 
	 * @throws SQLException if a database access error occurs
	 */
	public function setCurrency( $columnIndex, $typeName );
	
	/**
	 * Sets whether the designated column's value can be set to NULL. The default is ResultSetMetaData.columnNullableUnknown 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param property one of the following constants: ResultSetMetaData.columnNoNulls, ResultSetMetaData.columnNullable, or ResultSetMetaData.columnNullableUnknown 
	 * @throws SQLException if a database access error occurs
	 */
	public function setNullable( $columnIndex, $property );
	
	/**
	 * Sets the designated column's number of decimal digits to the given int. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param precision the total number of decimal digits 
	 * @throws SQLException if a database access error occurs
	 */
	public function setPrecision( $columnIndex, $property );
	
	/**
	 * Sets the designated column's number of digits to the right of the decimal point to the given int. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param scale the number of digits to right of decimal point 
	 * @throws SQLException if a database access error occurs
	 */
	public function setScale( $columnIndex, $scale );
	
	/**
	 * Sets the name of the designated column's table's schema, if any, to the given String. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param schemaName the schema name 
	 * @throws SQLException if a database access error occurs
	 */
	public function setSchemaName( $columnIndex, $schemaName );
	
	/**
	 * Sets whether the designated column can be used in a where clause. The default is false. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param property true if the column can be used in a WHERE clause; false if it cannot 
	 * @throws SQLException if a database access error occurs
	 */
	public function setSearchable( $columnIndex, $property );
	
	/**
	 * Sets whether the designated column is a signed number. The default is false. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param property true if the column is a signed number; false if it is not 
	 * @throws SQLException if a database access error occurs
	 */
	public function setSigned( $columnIndex, $property );
	
	/**
	 * Sets the designated column's table name, if any, to the given String. 
	 *
	 * @param columnIndex the first column is 1, the second is 2, ...
	 * @param tableName the column's table name 
	 * @throws SQLException if a database access error occurs
	 */
	public function setTableName( $columnIndex, $tableName );
}