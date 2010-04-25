<?
package("japha.lang");

/**
* $Id$
*
* The System class contains several useful class fields and methods. It cannot be instantiated.
*
* Among the facilities provided by the System class are standard input, standard output,
* and error output streams; access to externally defined "properties"; a means of loading
* files and libraries; and a utility method for quickly copying a portion of an array.
*
* @deprecated For now, because this class is mostly useless without a virtual machine/garbage collector
*
* @author Ryan Gantt
* @version $Revision$
*/
class System //extends Object
{
    /**
    * Standard error stream
    * Type: PrintStream
    */
    static $err;
    public static function err()
    {
        if( !( self::$err instanceof ErrorStream ) )
        {
            self::$err = new ErrorStream();
        }
        return self::$err;
    }

    /**
    * Standard input stream
    * Type: InputStream
    */
    static $in;
    public static function in()
    {
        if( !( self::$in instanceof InputStream ) )
        {
            self::$in = new InputStream();
        }
        return self::$in;
    }

    /**
    * Standard output stream
    * Type: PrintStream
    */
    static $out;
    public static function out()
    {
        if( !( self::$out instanceof PrintStream ) )
        {
            self::$out = new PrintStream( new FilterOutputStream() );
        }
        return self::$out;
    }

    /**
    * Copy the entire contents of an array, or only a portion of one.
    *
    * Note: This needs to be re-implemented. I read the Java API wrong.
    *
    * @param src The array to clone
    * @param srcPos Where to start in the source array
    * @param dest The array to clone into
    * @param destPos Where to start in the destination array
    * @param len How many elements to copy
    */
    static function arrayCopy( $src, $srcPos=0, &$dest=0, $destPos=0, $len=false )
    {
        if(!$len)
        {
            $copy = $src;
            return $copy;
        }
        else
        {
            if(!$srcPos && $dest && $desPos)
            {
                if(isset($src[$srcPos], $src[$destPos]))
                {
                    for($i = $srcPos; $i < $destPos; $i++)
                    {
                        $copy[] = $src[$i];
                    }
                }
                else if(!$desPos)
                {
                    for($i = $srcPos; $i < count($src); $i++)
                    {
                        $copy[] = $src[$i];
                    }
                }
            }
        }
    }

    /**
    * Returns the current time in milliseconds
    *
    * @return The current time in milliseconds
    */
    static function currentTimeMillis()
    {
        return microtime();
    }

    /**
    * Close the virtual machine and kill all processes related to it
    */
    static function _exit( $status )
    {
        if( is_numeric( $status ) )
        {
            exit( $status );
        }
        else
        {
            exit();
        }
    }

    /**
    * Wake up the garbage collector? Run the garbage collector?
    */
    static function gc()
    {
        ;
    }

    /**
    * Returns a vector of all the system properties that have been set by both the user
    * and the Virtual Machine
    */
    static function getProperties()
    {

    }

    /**
    * Get a single property
    *
    * @param key The name of the property
    */
    static function getProperty( $key )
    {
        return Properties::getInstance()->get( $key );
    }

    /**
    * Returns the name of the current security manager
    */
    static function getSecurityManager()
    {

    }

    /**
    * Get a hashcode for an object
    */
    static function identityHashCode( Object $x )
    {
        return $this->hashCode( $x );
    }

    static function load( String $filename )
    {

    }

    static function loadLibrary( String $libname )
    {

    }

    static function mapLibraryName( String $libname )
    {

    }

    /**
    * Causes the garbage collector to finalize all of the object that are currently in limbo
    */
    static function runFinalization()
    {
        ;
    }

    /**
    * Sets the stdErr stream to an alternate object of type PrintStream
    *
    * @param err The new error stream to delegate to
    */
    static function setErr( PrintStream $err )
    {
        self::$err = $err;
    }

    /**
    * Sets the stdIn stream to an alternate object of type InputStream
    *
    * @param in The new input stream to read from
    */
    static function setIn( InputStream $in )
    {
        self::$in = $in;
    }

    /**
    * Sets the stdOut stream to an alternate object of type PrintStream
    *
    * @param out The new output stream to delegate to
    */
    static function setOut( PrintStream $out )
    {
        self::$out = $out;
    }

    /**
    * Maps the entire contents of a properties object into the current system properties
    *
    * @param props The properties object to map into the system
    */
    static function setProperties( Properties $props )
    {

    }

    /**
    * Set a single property of the system
    *
    * @param key The name of the property to set
    * @param value The value of the property that is being set
    */
    static function setProperty( String $key, String $value )
    {

    }

    /**
    * Change the system's security manager
    *
    * @param s The new SecurityManager
    */
    static function setSecurityManager( SecurityManager $s )
    {

    }
}
