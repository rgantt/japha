<?
package("japha.security");

import("japha.lang.Object");
import("japha.io.Serializable");

/**
 * $Id: PermissionCollection.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $ $Date: 2004/07/14 22:27:03 $
 */
abstract class PermissionCollection extends Object implements Serializable
{
	private $collection;
	private $readOnly = false;
	
	public function __construct(){}
	
	abstract public function elements();
	abstract public function implies();
	
	public function add( Permission $p )
	{
		if(!$this->readOnly)
		{
			array_push($this->collection, $p);
		}
		else
		{
			throw new SecurityException("This PermissionCollection has been marked read-only");
		}
	}
	
	public function isReadOnly()
	{
		return $this->readOnly;
	}
	
	public function setReadOnly()
	{
		$this->readOnly = true;
	}
	
	public function toString()
	{
	}
}
?>