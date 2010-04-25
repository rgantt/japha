<?
package("japha.lang");

import("japha.security.BasicPermission");

/**
 * $Id$
 *
 * Note: The japha implementation does not support Permission wildcards as of yet. Ex// new RuntimePermission("*Thread") <- WILL NOT WORK
 * This class is for runtime permissions. A RuntimePermission contains a name (also referred to as a "target name") but no 
 * actions list; you either have the named permission or you don't.
 *
 * The target name is the name of the runtime permission (see below). The naming convention follows the hierarchical property 
 * naming convention. Also, an asterisk may appear at the end of the name, following a ".", or by itself, to signify a 
 * wildcard match. For example: "loadLibrary.*" or "*" is valid, "*loadLibrary" or "a*b" is not valid. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class RuntimePermission extends BasicPermission
{
    private $perms = array(
        "createClassLoader",
        "getClassLoader",
        "setContextClassLoader",
        "setSecurityManager",
        "createSecurityManager",
        "exitVM",
        "shutdownHooks",
        "setFactory",
        "setIO",
        "modifyThread",
        "stopThread",
        "modifyThreadGroup",
        "getProtectionDomain",
        "readFileDescriptor",
        "writeFileDescriptor",
        "loadLibrary",
        "accessClassInPackage",
        "definedClassInPackage",
        "accessDeclaredMembers",
        "queuePrintJob"
    );
	
	static $setPerms = array();
	
	// The default behavior:
	// 	if a value is sent in once, then that permission is granted while the VM is alive.
	//	if the same value is sent in again, that permission is taken away.
	public function __construct( $name )
	{
		if(in_array($this->perms, $name))
		{
			if(in_array($this->setPerms, $name))
			{
				unset($this->setPerms[$name]);
			}
			else
			{
				array_push($this->setPerms, $name);
			}
		}
	}
}
?>