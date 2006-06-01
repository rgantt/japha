<?
package("japha.io");

import("japha.io.InputStreamWriter");

/**
 * $Id: FileWriter.php,v 1.4 2004/07/14 22:27:03 japha Exp $
 *
 * Convenience class for writing character files. The constructors of this class assume that the 
 * default character encoding and the default byte-buffer size are acceptable. To specify these 
 * values yourself, construct an OutputStreamWriter on a FileOutputStream. 
 *
 * Whether or not a file is available or may be created depends upon the underlying platform. 
 * Some platforms, in particular, allow a file to be opened for writing by only one FileWriter 
 * (or other file-writing object) at a time. In such situations the constructors in this class 
 * will fail if the file involved is already open. 
 *
 * FileWriter is meant for writing streams of characters. For writing streams of raw bytes, 
 * consider using a FileOutputStream.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:03 $
 */
class FileWriter extends InputStreamWriter
{
	private $pointer;
	
	public function __construct( $filename )
	{
		$this->pointer = fopen( $filename, "w" );
	}

	public function close()
	{
		$this->flush();
		fclose( $this->pointer );
		if(!$this->pointer)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function flush()
	{
		fflush( $this->pointer );
	}

	public function write( $c )
	{
		fputs( $this->pointer, $c, 1 );
	}
}
?>