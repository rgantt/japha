<?php
package("japha.lang");

/**
 * $Id$
 *
 * The Compiler class is provided to support Java-to-native-code compilers and related services. 
 * By design, the Compiler class does nothing; it serves as a placeholder for a JIT compiler implementation.
 *
 * When the Java Virtual Machine first starts, it determines if the system property java.compiler exists. 
 * (System properties are accessible through getProperty and , a method defined by the System class.) 
 * If so, it is assumed to be the name of a library (with a platform-dependent exact location and type); the loadLibrary 
 * method in class System is called to load that library. If this loading succeeds, the function 
 * named java_lang_Compiler_start() in that library is called.
 *
 * If no compiler is available, these methods do nothing. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
final class Compiler
{
	/**
	 * Examines the argument type and its fields and perform some documented operation. No specific operations are required. 
	 *
	 * @param any an argument. 
	 * @returns a compiler-specific value, or null if no compiler is available. 
	 * @throws NullPointerException if any is null.
	 */
	static function command( Object $any ){}
	
	/**
	 * Compiles the specified class. 
	 * @param clazz a class. 
	 * @returns true if the compilation succeeded; false if the compilation failed or no compiler is available. 
	 * @throws NullPointerException if clazz is null.
	 */
	static function compileClass( _Class $clazz ){}
	
	/**
	 * public static boolean compileClasses(String string)Compiles all classes whose name matches the specified string. 
	 *
	 * @param string the name of the classes to compile. 
	 * @returns true if the compilation succeeded; false if the compilation failed or no compiler is available. 
	 * @throws NullPointerException if string is null.
	 */
	static function compileClasses( String $name ){}
	
	/**
	 * Cause the Compiler to cease operation. 
	 */
	static function disable(){}
	
	/**
	 * Cause the Compiler to resume operation.
	 */
	static function enable(){}
}
?>