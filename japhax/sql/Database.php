<?
package("japhax.sql");

/**
 * $Id$
 *
 * Base class for all database layers. Contains all of the methods necessary for overloading 
 * the class. Provides methods for getting and setting the linkId to different connections, 
 * but you should never have to use them exception in a bind.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class Database extends Object
{
	/** 
	 * The linkId. Can be got and set to different connections 
	 *
	 * @access public
	 * @var
	 */
	protected $linkId;
	
	/** 
	 * Array for overloaded member variables 
	 *
	 * @access public
	 * @var
	 */	 
	public $members;
	
	/** 
	 * reset the linkId to a different connection 
	 *
	 * @access public
	 */
	public function setLinkId( $linkId )
	{
		$this->linkId = $linkId;
	}
	
	/** 
	 * returns the current linkId for the current connection 
	 *
	 * @access public
	 */
	public function getLinkId()
	{
		return $this->linkId;
	}
	
	/** 
	 * Prepares linkId and overloaded members array for garbage collection 
	 *
	 * @deprecated use PHP 5's <code>__destruct()</code> instead
	 * @access public
	 */
	public function release()
	{
		$this->members = NULL;
		$this->linkId = NULL;
	}
	
	/**
	 * Garbace collects linkId and overloaded members array
	 *
	 * @since Revision 0.2
	 * @access public
	 */
	public function __destruct()
	{
		$this->members = NULL;
		$this->linkId = NULL;
	}
}

interface SQL
{
	public function connect( $host="", $user="", $pass="" );
	public function select_db( $dbName );
	public function query( $queryString );
	public function close();
	public function fetch_array( $query );
	public function fetch_object( $query );
	public function num_rows( $query );
	public function num_fields();
}
?>
