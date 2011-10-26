<?php
package("japha.lang");

/**
 * $Id$
 *
 * Class ClassLoader
 *
 * Provides a mechanism for loading class files into the global namespace, and keeping track of those files
 * in an effort to make sure that the same file is not loaded twice, and to make sure that any errors that
 * can be caught in the linking process ARE caught, and not let alone until run time.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class ClassLoader extends Object
{
	// The VM (parent) instance of the ClassLoader class. If no VM instance exists, then it is a reflective reference
	private $classLoader;
	
	function __construct( $parent = null )
	{
		if($parent == null)
		{
			$this->classLoader = $this->getSystemClassLoader();
		}
	}

	/**
	 * Loads a class into the virtual machine memory space - If the class has not been resolved, then it starts
	 * the resolution progress, along with verification and preparation. Not necessarily in that order.
	 *
	 * @param name The fully qualified name of the class to load
	 * @param resolve A boolean value that states whether or not the current class has been resolved
	 * @throws ClassNotFoundException If the fully qualified class name could not be found and/or loaded
	 * @return An reference to the control 'thing' of the loaded class (an instance of _Class)
	 */
	function loadClass( $name, $resolve = false )
	{
		if( ( $class = $this->findLoadedClass() ) && $class instanceof Object )
		{
			if( $resolve )
			{
				$this->resolveClass( $class );
			}
		}
		else if( ( $class = $this->classLoader->loadClass($name)) && $class instanceof Object )
		{
			if( $resolve )
			{
				$this->resolveClass( $class );
			}
		}
		else if( ( $class = $this->findClass( $name ) ) && $class instanceof Object )
		{
			if( $resolve )
			{
				$this->resolveClass( $class );
			}
		}
		else
		{
			throw new ClassNotFoundException("Could not find class ".$name."!");
		}
		return $class;
	}
	
	/**
 	 * Opens a file stream to a class file, and loads it character by character into an array
	 *
	 * @param path The path to the class file
	 * @return char[] The array of characters
	 */
	private function readClassFile( $path )
	{
		$fp = fopen( $path, "r" );
		while( !feof( $fp ) )
		{
			$chars[] = fgetc( $fp );
		}
		return $chars;
	}
	
	/**
	 * Assembles a set of bytes or an octet stream into a string
	 *
	 * @param bytes An array of characters, or any octet stream
	 * @return String The assembled string
	 */
	private function assembleBytes( $bytes )
	{
		foreach( $bytes as $char )
		{
			$str .= $char;
		}
		return $str;
	}
	
	/**
 	 * Attempts to load the bytecodes of a class file and then define the class. 
	 * Also defines or adds to a package with the given name.
	 *
	 * @param name The absolute path value of the class file (not the qualified *.*.* name)
	 * @return _Class A reference to a _Class instance of the loaded class
	 * @throws IOException If the specified class file could not be found and/or loaded
	 */
	function findClass( $name )
	{
		try
		{
			$path = str_replace( ".", "/", $name );
			$classBytes = $this->readClassFile( $path.".php" );
			$this->definePackage( $name );
			return $this->defineClass( $name, $classBytes, 0, count( $classBytes ) );
		}
		catch( IOException $e )
		{
			throw $e;
		}
	}
	
	/**
	 * Defines a new instance of _Class based on the parameters
	 *
	 * @param name The fully qualified name of the new class
	 * @param bytes An array of characters that represents the bytecodes of the class file
	 * @param offset The position in the file to start reading from, usually 0
	 * @param len The length of the file array - should be ~: $bytes.length()
	 * @return String The assembled bytes -- However, this is wrong, and will be fixed
	 * @throws ClassFormatError If the class was not well formed PHP5 source code
	 * @throws IndexOutOfBoundsException If the offset or len parameters are longer than the bytes
	 */
	function defineClass( $name, $bytes, $offset, $len )
	{
		if( !eregi( "error|warning", eval( $this->assembleBytes( $bytes ) ) ) )
		{
			if( ( $offset < 0 ) || ( $len < 0 ) || ( ( $offset + $len ) > count( $bytes ) ) )
			{
				throw new IndexOutOfBoundsException("Offset and Index can not be negative.");
			}
			else
			{
				$className = explode( $name, "." );
				//eval($this->assembleBytes($bytes));
				// WHICH ONE?!
				//return new $className[count($className)];
				return $this->assembleBytes( $bytes );
				//return new _Class($className[count($className)]);
			}
		}
		else
		{
			throw new ClassFormatError("There was an error in your class syntax and it could not be loaded.");
		}
	}

	/**
	 * Defines a package based on the fully qualified class name that is passed in
	 *
	 * @param name The fully qualified name of the class that the package will be defined as
	 */
	function definePackage( $name )
	{
		;	
	}

	/**
	 * Finds a class created especially for system use, and returns it if the permission rules are not violated.
	 *
	 * @param name The name of the system class to find
	 * @throws ClassNotFoundException Iff the class is not being used by the system currently
	 */
	function findSystemClass( $name )
	{
		throw new ClassNotFoundException("Could not find system class ".$name."!");
	}

	/**
 	 * Resolves an instance of class _Class, which represents one loaded/linked class file.
	 *
	 * @param c The class instance to resolve
	 */	
	function resolveClass( _Class $c )
	{
		// LINK SHIZZY HERE
	}
	
	/**
	 * Returns the parent ClassLoader instance (usually the one that is controlled directly by the virtual machine)
	 *
	 * @return ClassLoader The parent ClassLoader instance
	 */	
	function getParent()
	{
		return $this->classLoader;
	}
	
	/**
	 * Find a loaded class by-name. Returns true iff the class has already been successfully loaded and linked.
	 *
	 * @param name The name of the class to search for.
	 */
	function findLoadedClass( $name )
	{
		if( $this->isLoaded( $name ) )
		{
			return true;
		}
		return false;
	}
	
}
?>
