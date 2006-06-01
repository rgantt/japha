<?
package("japha.security");

import("japha.lang.Object");
import("japha.io.Serializable");
import("japha.security.Guard");

/**
 * $Id: Permission.php,v 1.4 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:03 $
 */
abstract class Permission extends Object implements Guard, Serializable
{
	protected $name;
	protected $actions;
	
	abstract function getActions();
	abstract function hashCode();
	abstract function implies( Permission $permission );
	
	public function __construct( $name )
	{
		$this->name = $name;
	}
		
	public function checkGuard( Object $object )
	{
		if(!SecurityManager::checkPermission( $this ))
			throw new SecurityException("Access denied by System Security Manager");
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function newPermissionCollection()
	{
		return new PermissionCollection( $this );
	}
	
	public function toString()
	{
		return "(Permission ".$this->getName()." ".$this->getActions().")";
	}
}
?>