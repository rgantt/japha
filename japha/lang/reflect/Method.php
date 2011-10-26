<?php
package("japha.lang.reflect");

import("japha.lang.reflect.Member");
import("japha.lang.reflect.AccessibleObject");

/**
 * $Id$
 *
 * This class is essentially just a wrapper to the PHP 5 built in ReflectionMethod class. It does, however, work.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
final class Method extends AccessibleObject implements Member
{
	private $Reflection;
	private $name = false;
	
	function __construct( $class, $name )
	{
		$this->_class = $class;
		if( is_object( $name ) )
		{
			$this->name = $name->toString();
		}
		else
		{
			$this->name = $name;
		}
		$this->Reflection = new ReflectionMethod( $this->_class, $this->name );
	}
	
	function __destruct()
	{
		unset( $this->Reflection );	
	}
	
	function equals( Object $obj ){}

	function getDeclaringClass()
	{
		return $this->Reflection->getDeclaringClass();
	}
	
	function getExceptionTypes(){}
	
	function getModifiers()
	{
		return $this->Reflection->getModifiers();
	}
	
	function getName()
	{
		return $this->name;
	}
	
	// This was easy enough
	// Too bad this isn't even going to work, because func_get_args only counts arguments in the
	// Current function, which would be Method::getParameterTypes in the eyes of Zend
	function getParameterTypes()
	{
		return array();
		//return func_get_args();
	}
	
	// This is pretty hairy, since PHP is loosely typed
	function getReturnType()
	{
		return $this->Reflection->returnsReference();
	}
	
	function invoke( Object $obj, $args )
	{
		try
		{
			return $this->Reflection->invoke( $obj, $args );
		}
		catch( Exception $e )
		{
			throw $e;	
		}
	}
	
	function toString()
	{
		return $this->Reflection->toString();
	}
}
?>