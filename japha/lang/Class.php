<?php
import("japha.lang.Object");

import('japha.lang.reflect.Constructor');

/**
 * $Id$
 *
 * Instances of the class Class represent classes and interfaces in a running Java 
 * application. Every array also belongs to a class that is reflected as a Class object 
 * that is shared by all arrays with the same element type and number of dimensions. 
 * The primitive Java types (boolean, byte, char, short, int, long, float, and double), and 
 * the keyword void are also represented as Class objects. 
 *
 * Class has no public constructor. Instead Class objects are constructed automatically by 
 * the Java Virtual Machine as classes are loaded and by calls to the defineClass method in 
 * the class loader. 
 *
 * The following example uses a Class object to print the class name of an object: 
 *
 *    void printClassName( Object obj ) 
 *    {
 *        System.out.println("The class of " + obj + " is " + obj.getClass().getName() );
 *    }
 *
 * It is also possible to get the Class object for a named type (or for void) using a class 
 * literal (JLS Section 15.8.2). For example: 
 *
 *    System.out.println("The name of class Foo is: " + Foo.class.getName() );
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class _Class extends Object
{
	private $_class;
	
	public function __construct( $obj )
	{
		$this->_class = $obj;	
	}
	
	public function getDeclared_Classes()
	{
		return get_declared_classes();
	}
	
	public function getConstructor( $parameterTypes = false )
	{
		return $this->getConstructors( $parameterTypes );
	}	
	
	public function getConstructors()
	{
	    $argv = func_get_args();
		$cons = ( ( $this->getDeclaredConstructor( $argv[0] ) ) ? '__construct' : false );
		return new Constructor( $this->_class, $cons );
	}
	
	public function getDeclaredConstructor( $parameterTypes = false )
	{
		$methods = get_class_methods( $this->_class );
		foreach( $methods as $value )
		{
			if( '__construct' == $value )
			{
				return true;
			}
		}
		return false;
	}
	
	public function getDeclaredConstructors()
	{
		return $this->getDeclaredConstructor( null );
	}
	
	public function getDeclaredField( String $name )
	{
		$fields = $this->getDeclaredFields();
		if(key_exists($name, $fields))
			return $fields[$name];	
		return false;
	}
	
	public function getDeclaredFields()
	{
		$fields = $this->getFields();
		foreach($fields as $field => $value)
		{
			if($value != null)
				$vFields[$field] = $value;	
		}
		return $vFields;
	}
	
	// I hate temporary variables -- We need array return dereferencing!
	public function getField( String $name )
	{
		$clazz = $this->getFields();
		return isset( $clazz[ $name ] ) ? $clazz[ $name ] : 0;
	}
	
	public function getFields()
	{
		return get_object_vars( $this->_class );
	}
	
	// I assume that PHP counts interfaces as a parent class
	public function getInterfaces()
	{
		return $this->getSuperClass();
	}

	public function getMethod( $name, _Class $parameterTypes ) // $name is String
	{
		$methodShizz = $this->getMethods();
		$parent = $this->getSuperClass();
		if(method_exists( $parent, $name ))
		{
			$this->getMethod( $name );
		}
		else
		{
			return isset( $methodShizz[ $name ] ) ? $methodShizz[ $name ] : 0;
		}
	}
	
	public function getMethods()
	{
		return get_class_methods( $this->_class );
	}
	
	public function getName()
	{
		if( is_string( $this->_class ) )
		{
			return $this->_class;
		}
		return get_class( $this->_class );
	}
	
	public function getSuperClass()
	{
		return _Class::forName( get_parent_class( $this->_class ) );
	}
	
	public function isArray()
	{
		return is_array( $this->_class );
	}
	
	public function isAssignableFrom( _Class $cls )
	{
		try
		{
			$clzz = $cls->newInstance();
		}
		catch( Exception $e ){ return false; }
		if( $this->isInstance( $clzz ) )
		{
			return true;
		}
		return false;
	}
	
	public function isInstance( Object $obj )
	{
		$className = $obj->getClass()->getName();
		if( is_string( $this->_class ) )
		{
			return is_subclass_of( $obj, get_parent_class( $this->_class ) );
		}
		if( $inst instanceof $className )
		{
			return true;
		}
		return false;
	}
	
	public function isInterface()
	{
		if( get_class( $this->_class ) )
		{
			return false;	
		}
		return true;
	}
	
	public function isPrimitive()
	{
		if( is_object( $this->_class ) )
		{
			return false;
		}
		return true;
	}
	
	public function newInstance()
	{
		if( is_string( $this->_class ) )
		{
			$rflc = new ReflectionClass( $this->_class );
			if( $rflc->isAbstract() )
				throw new Exception('Cannot instantiate abstract class '.$this->_class.'!');
			return new $this->_class;
		}
		return new $this->_class->getName();
	}
	
	public function toString()
	{
		if(get_class( $this ))
		{
			return "class ".get_class( $this->_class );	
		}
		// How the heck can we access the name of the interface?
		return "interface ".get_class( $this->_class );
	}
	
	public function desiredAssertionStatus(){}
	
	public static function forName( $name )
	{
		return new _Class( $name );
	}
	
	/*
	public function forName( String $name, boolean $initialize, _ClassLoader $loader )
	{
	
	}
	*/
	
	public function get_Classes(){}
	public function get_ClassLoader(){}
	public function getComponentType(){}
	public function getDeclaredMethod( String $name, _Class $parameterTypes ){}
	
	public function getDeclaredMethods()
	{
		return $this->getMethods();
	}
	
	public function getDeclaring_Class(){}	
	public function getPackage(){}
	public function getProtectionDomain(){}
	public function getResource( String $name ){}
	public function getResourseAsStream( String $name ){}
	public function getSigners(){}
	public function getModifiers(){}
}
?>