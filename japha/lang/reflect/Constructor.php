<?php
package("japha.lang.reflect");

import("japha.lang.reflect.AccessibleObject");

/**
 * $Id$
 *
 * Constructor provides information about, and access to, a single constructor for a class. 
 *
 * Constructor permits widening conversions to occur when matching the actual parameters to 
 * newInstance() with the underlying constructor's formal parameters, but throws an 
 * IllegalArgumentException if a narrowing conversion would occur. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class Constructor extends AccessibleObject
{
	private $Reflection;
	private $className = "";

	public function __construct( $class, $name )
	{
		// this is really dirty, since in Java this is all handled by the ClassLoader and the VM itself
		$this->className = $class;
	}
	/**
	 * Compares this Constructor against the specified object. Returns true if the objects are 
	 * the same. Two Constructor objects are the same if they were declared by the same class 
	 * and have the same formal parameter types. 
	 *
	 * @overrides equals in class Object
	 * @param obj the reference object with which to compare. 
	 * @returns true if this object is the same as the obj argument; false otherwise.
	 */
	public function equals( Object $obj )
	{
		if( $this->equals( $obj ) )
		{
			return true;
		}
		return false;	
	}
	
	/**
	 * Returns the Class object representing the class that declares the constructor represented 
	 * by this Constructor object. 
	 *
	 * @specified getDeclaringClass in interface Member
	 * @returns an object representing the declaring class of the underlying member
	 */
	public function getDeclaringClass()
	{
		return $this->Reflection->getDeclaringClass();	
	}
	
	/**
	 * Returns the name of this constructor, as a string. This is always the same as the 
	 * simple name of the constructor's declaring class. 
	 *
	 * @specified getName in interface Member
	 * @returns the simple name of the underlying member
	 */
	public function getName()
	{
		return "__construct";	
	}
	
	/**
	 * Uses the constructor represented by this Constructor object to create and initialize a 
	 * new instance of the constructor's declaring class, with the specified initialization 
	 * parameters. Individual parameters are automatically unwrapped to match primitive 
	 * formal parameters, and both primitive and reference parameters are subject to method 
	 * invocation conversions as necessary. 
	 *
	 * If the number of formal parameters required by the underlying constructor is 0, the 
	 * supplied initargs array may be of length 0 or null. 
	 *
	 * If the required access and argument checks succeed and the instantiation will proceed, 
	 * the constructor's declaring class is initialized if it has not already been initialized. 
	 *
	 * If the constructor completes normally, returns the newly created and initialized instance. 
	 *
	 * @param initargs array of objects to be passed as arguments to the constructor call; values of primitive types are wrapped in a wrapper object of the appropriate type (e.g. a float in a Float) 
	 * @returns a new object created by calling the constructor this object represents 
	 * @throws IllegalAccessException if this Constructor object enforces Java language access control and the underlying constructor is inaccessible. 
	 * @throws IllegalArgumentException if the number of actual and formal parameters differ; if an unwrapping conversion for primitive arguments fails; or if, after possible unwrapping, a parameter value cannot be converted to the corresponding formal parameter type by a method invocation conversion. 
	 * @throws InstantiationException if the class that declares the underlying constructor represents an abstract class. 
	 * @throws InvocationTargetException if the underlying constructor throws an exception. 	
	 * @throws ExceptionInInitializerError if the initialization provoked by this method fails.
	 */
	public function newInstance()
	{
		return new $this->className;	
	}
	
	/**
	 * Returns a string describing this Constructor. The string is formatted as the constructor 
	 * access modifiers, if any, followed by the fully-qualified name of the declaring class, 
	 * followed by a parenthesized, comma-separated list of the constructor's formal parameter 
	 * types. For example: 
	 *
     * public java.util.Hashtable(int,float)
     *
 	 * The only possible modifiers for constructors are the access modifiers public, protected 
 	 * or private. Only one of these may appear, or none if the constructor has default 
 	 * (package) access. 
	 *
	 * @overrides toString in class Object
	 * @returns a string representation of the object.
	 */
	public function toString()
	{
		return "__construct";	
	}
	
	/**
	 * Returns an array of Class objects that represent the formal parameter types, in 
	 * declaration order, of the constructor represented by this Constructor object. Returns 
	 * an array of length 0 if the underlying constructor takes no parameters. 
	 *
	 * @returns the parameter types for the constructor this object represents
	 */
	public function getParameterTypes(){}
	
	/**
	 * Returns a hashcode for this Constructor. The hashcode is the same as the hashcode for 
	 * the underlying constructor's declaring class name. 
	 *
	 * @overrides hashCode in class Object
	 * @returns a hash code value for this object.
	 */
	public function hashCode(){}
	
	/**
	 * Returns an array of Class objects that represent the types of of exceptions declared 
	 * to be thrown by the underlying constructor represented by this Constructor object. 
	 * Returns an array of length 0 if the constructor declares no exceptions in its throws 
	 * clause. 
	 *
	 * @returns the exception types declared as being thrown by the constructor this object represents
	 */
	public function getExceptionTypes(){}
	
	/**
	 * Returns the Java language modifiers for the constructor represented by this Constructor 
	 * object, as an integer. The Modifier class should be used to decode the modifiers. 
	 *
	 * @specified getModifiers in interface Member
	 * @returns the Java language modifiers for the underlying member
	 */
	public function getModifiers(){}
}
?>