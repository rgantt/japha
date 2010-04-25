<?
package("japha.io");

import("japha.io.OutputStream");

/**
 * $Id$
 *
 * This class is the superclass of all classes that filter output streams. 
 * These streams sit on top of an already existing output stream (the underlying output stream) 
 * which it uses as its basic sink of data, but possibly transforming the data along the way 
 * or providing additional functionality. 
 *
 * The class FilterOutputStream itself simply overrides all methods of OutputStream with 
 * versions that pass all requests to the underlying output stream. Subclasses of 
 * FilterOutputStream may further override some of these methods as well as provide 
 * additional methods and fields. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class FilterOutputStream extends OutputStream
{
	/**
	 * The underlying output stream to be filtered.
	 */
	public $out = "";
	
	/**
	 * Creates an output stream filter built on top of the specified underlying output stream.
	 *
	 * @param out The underlying output stream to be assigned to the field this.out for later use, or null if this instance is to be created without an underlying stream.
	 */
	public function __construct( $out=null )
	{
		$this->out = $out;
	}
	
	/**
	 * Flushes this output stream and forces any buffered output bytes to be written out to the stream. 
	 * The flush method of FilterOutputStream calls the flush method of its underlying output stream. 
	 *
	 * @overrides flush in class OutputStream
	 * @throws IOException If an I/O error occurs.
	 * @see out
	 */
	public function flush()
	{
		parent::flush();	
	}
	
	/**
	 * Closes this output stream and releases any system resources associated with the stream. 
	 * The close method of FilterOutputStream calls its flush method, and then calls the 
	 * close method of its underlying output stream. 
	 *
	 * @overrides close in class OutputStream
	 * @throws IOException If an I/O error occurs.
	 * @see flush(), out
	 */
	public function close()
	{
		$this->flush();
		parent::close();	
	}
	
	/**
	 * Polymorphic method: write( int ), write( byte[] ), write( byte[], int, int )
	 *
	 * Writes len bytes from the specified byte array starting at offset off to this output stream. 
	 * The write method of FilterOutputStream calls the write method of one argument on each byte 
	 * to output. 
	 *
	 * Note that this method does not call the write method of its underlying input stream with 
	 * the same arguments. Subclasses of FilterOutputStream should provide a more efficient 
	 * implementation of this method. 
	 * 
	 * @overrides write in class OutputStream
	 * @param b the data.
	 * @param off the start offset in the data.
	 * @param len the number of bytes to write. 
	 * @throws IOException if an I/O error occurs.
	 */
	public function write()
	{
		$argv = func_get_args();
		switch( count( $argv ) )
		{
			// write( int ) or write( byte[] )
			case 1:
			    echo $argv[0];
				break;
			// write( byte[], int, int )
			case 3:
				break;
			default:
				throw new Exception("FilterOutputStream::write() requires either one or three parameters!");
		}	
	}
}
?>