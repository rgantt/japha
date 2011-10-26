<?php
package("japha.security");

import("japha.lang.Object");
import("japha.io.Serializable");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class PermissionCollection extends Object implements _Serializable
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