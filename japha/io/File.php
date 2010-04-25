<?
package("japha.io");

import("japha.io.Serializable");
import("japha.lang.Comparable");
import("japha.net.URI");
import("japha.net.URL");
import("japha.io.FileFilter");
import("japha.io.FileNameFilter");

/**
 * $Id: File.php,v 1.4 2004/07/27 20:26:55 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $
 */
abstract class File extends Object implements Comparable, Serializable
{
    static $pathSeparator = "/";
    static $pathSeparatorChar = '/';
    static $separator = ",";
    static $separatorChar = ',';

    private $doDelete = false;
    private $pathname = '';
    
    public function __destruct()
    {
	    if( $this->doDelete )
	    {
		    return $this->delete();
	    }
    }
    
    public function __construct()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 1:
                if( $argv[0] instanceof URI )
                {
                    $this->_File_URI( $argv[0] );
                    break;
                }
                $this->_File_String( $argv[0] );
                break;
            case 2:
                if( $argv[0] instanceof File )
                {
                    $this->_File_File_String( $argv[0], $argv[1] );   
                    break;
                }
                $this->_File_String_String( $argv[0], $argv[1] );
                break;
        }
    }
    
    public function _File_File_String( File $parent, $child ){}
    
    public function _File_String( $pathname )
    {
	    $this->pathname = $pathname;
    }
    
    public function _File_String_String( $parent, $child ){}
    
    public function _File_URI( URI $uri ){}
    
    public function compareTo( Object $o )
    {
        if ( $o instanceof File )
        {
            return $this->_compareTo_File( $o );   
        }
        return $this->_compareTo_Object( $o );
    }
    public function _compareTo_File( File $pathname ){}
    public function _compareTo_Object( Object $o ){}
    
    public function createNewFile()
    {
	    return touch( $this->pathname );
    }
    
    public function delete()
    {
	    if( $this->canWrite() )
	    {
		    return unlink( $this->pathname );
	    }
	    throw new Exception("Cannot delete a non-writeable file!");
    }
    
    public function deleteOnExit()
    {
	    $this->doDelete = true;
    }
    
    public function canRead()
    {
	    return is_readable( $this->pathname );
    }
    
    public function canWrite()
    {
	    return is_writeable( $this->pathname );
    }
    
    public function exists()
    {
	    return file_exists( $this->pathname );
    }
    
    public function getAbsolutePath()
    {
	    return realpath( $this->pathname );
    }
    
    public function getAbsoluteFile()
    {
	    if( eregi( '/', $this->getName() ) )
	    {
		    return $this->getAbsolutePath().'/'.$this->getName();
	    }
	    return $this->getName();
    }
    
    public function getCanonicalFile()
    {
	    return $this->getAbsoluteFile();
    }
    
    public function getCanonicalPath()
    {
	    return $this->getAbsolutePath();
    }
    
    public function getName()
    {
	    return basename( $this->pathname, '.php' );
    }
    
    public function getParent()
    {
	    return $this->getAbsolutePath();
    }
    public function getParentFile()
    {
	    return false;
    }
    
    public function getPath()
    {
	    return $this->getAbsolutePath();
    }
    
    public function isAbsolute()
    {
	    return true;
    }
    
    public function isDirectory()
    {
	    return is_dir( $this->pathname );
    }
    
    public function isFile()
    {
	    return is_file( $this->pathname );
    }
    
    public function isHidden()
    {
	    $name = $this->getName();
	    return ( $name{0} == '.' ) ? true : false;
    }
    
    public function lastModified()
    {
	    return filectime( $this->pathname );
    }
    
    public function length()
    {
	    return filesize( $this->pathname );
    }
    
    public function _list()
    {
        $argv = func_get_args();
        if( $argv[0] instanceof FilenameFilter )
        {
            return $this->list1( $argv[0] );
        }
        return $this->list0();
    }
    public function list0(){}
    public function list1( FilenameFilter $filter ){}
    
    public function listFiles()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 0:
                return $this->_listFiles();
                break;
            case 1:
                if( $argv[0] instanceof FileFilter )
                {
                    return $this->_listFiles_FileFilter( $argv[0] );
                }
                return $this->_listFiles_FilenameFilter( $argv[0] );
        }
    }
    public function _listFiles(){}
    public function _listFiles_FileFilter( FileFilter $filter ){}
    public function _listFiles_FilenameFilter( FilenameFilter $filter ){}
    
    public function mkdir( $dir )
    {
	    return mkdir( $dir );
    }
    
    public function mkdirs( $dirs = array() )
    {
	    foreach( $dirs as $value )
	    {
		    mkdir( $value );
	    }
	    return;
    }
    
    public function renameTo( File $dest )
    {
	    return rename( $this->pathname, $dest->getName() );
    }
    
    public function setLastModified( $time )
    {
	    return false;
    }
    
    public function setReadOnly()
    {
	    return chmod( $this->pathname, 0555 );
    }
    
    public function toString()
    {
	    return $this->getAbsoluteFile();
    }
    
    public function toURI(){}
    public function toURL(){}
    public static function listRoots(){}
    
    public static function createTempFile()
    {
        $argv = func_get_args();
        switch( fun_num_args() )
        {
            case 2:
                $this->_createTempFile_String_String( $argv[0], $argv[1] );
                break;
            case 3:
                $this->_createTempFile_String_String_File( $argv[0], $argv[1], $argv[2] );
                break;    
        }
    }
    public static function _createTempFile_String_String( String $prefix, String $suffix ){}
    public static function _createTempFile_String_String_File( String $prefix, String $suffix, File $directory ){}
}
?>