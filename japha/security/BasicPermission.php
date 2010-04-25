<?
package("japha.security");

import("japha.security.Permission");
import("japha.security.PermissionCollection");

/**
 * $Id$
 *
 * The BasicPermission class extends the Permission class, and can be used as the base class for permissions 
 * that want to follow the same naming convention as BasicPermission.
 *
 * The name for a BasicPermission is the name of the given permission (for example, "exit", "setFactory", 
 * "print.queueJob", etc). The naming convention follows the hierarchical property naming convention. An asterisk 
 * may appear by itself, or if immediately preceded by a "." may appear at the end of the name, to signify a 
 * wildcard match. For example, "*" and "java.*" are valid, while "*java", "a*b", and "java*" are not valid.
 *
 * The action string (inherited from Permission) is unused. Thus, BasicPermission is commonly used as the base 
 * class for "named" permissions (ones that contain a name but no actions list; you either have the named 
 * permission or you don't.) Subclasses may implement actions on top of BasicPermission, if desired. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
abstract class BasicPermission extends Permission implements _Serializable
{
    /**
     * Constructor
     *
     * Creates a new BasicPermission object with the specified name. The name is the symbolic name of the 
     * BasicPermission, and the actions String is currently unused.
     *
     * @param name The name of the BasicPermission.
     * @param actions ignored. 
     * @throws NullPointerException If name is null. 
     * @throws IllegalArgumentException If name is empty.
     */
	public function __construct( $name, $actions = false )
	{
		$this->name = $name;
		if($actions)
			$this->actions = $actions;
	}
	
	public function equals( Object $object )
	{
		if($object instanceof BasicPermission)
		{
			if($object->getName() == $this->getName())
			{
				return true;
			}
			return false;
		}
		return false;
	}
	
	public function getActions()
	{
		return $this->actions;
	}
	
	public function hashCode(){}
	
	public function implies( Permission $p )
	{
		if($p instanceof BasicPermission)
		{
			// This has to be changed to do a wildcard match
			if($p->getName() == $this->getName())
			{
				return true;
			}
			return false;
		}
		return false;
	}
	
	public function newPermissionCollection()
	{
		return new PermissionColletion( $this );
	}
}
?>