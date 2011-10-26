<?php
package("japha.io");

import("japha.lang.Object");

/**
 * $Id$
 *
 * This abstract class is the superclass of all classes representing an output stream of bytes. 
 * An output stream accepts output bytes and sends them to some sink. 
 *
 * Applications that need to define a subclass of OutputStream must always provide at least 
 * a method that writes one byte of output. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class OutputStream extends Object
{
	public function __construct()
	{
		;	
	}
	
	/**
	 * Closes this output stream and releases any system resources associated with this stream. 
	 * The general contract of close is that it closes the output stream. 
	 * A closed stream cannot perform output operations and cannot be reopened. 
	 *
	 * The close method of OutputStream does nothing. 
	 *
	 * @throws IOException if an I/O error occurs.
	 */
	public function close()
	{
		;
	}
	
	/**
	 * Flushes this output stream and forces any buffered output bytes to be written out. 
	 * The general contract of flush is that calling it is an indication that, if any bytes 
	 * previously written have been buffered by the implementation of the output stream, 
	 * such bytes should immediately be written to their intended destination. 
	 *
	 * The flush method of OutputStream does nothing. 
	 *
	 * @throws IOException if an I/O error occurs.
	 */
	public function flush()
	{
		;
	}
	
	/**
	 * Polymorphic method: write( int ), write( byte[] ), write( int, int, byte[] )
	 *
	 * Writes len bytes from the specified byte array starting at offset off to this output 
	 * stream. The general contract for write(b, off, len) is that some of the bytes in 
	 * the array b are written to the output stream in order; element b[off] is the 
	 * first byte written and b[off+len-1] is the last byte written by this operation. 
	 *
	 * The write method of OutputStream calls the write method of one argument on each of 
	 * the bytes to be written out. Subclasses are encouraged to override this method and provide 
	 * a more efficient implementation. 
	 * 
	 * If b is null, a NullPointerException is thrown. 
	 *
	 * If off is negative, or len is negative, or off+len is greater than the length of the 
	 * array b, then an IndexOutOfBoundsException is thrown. 
	 *
	 * @param b the data.
	 * @param off the start offset in the data.
	 * @param len the number of bytes to write. 
	 * @throws IOException if an I/O error occurs. In particular, an IOException is thrown if the output stream is closed.
	 */
	public function write( $str )
	{
	    echo $str;
		/*$argv = func_get_args();
		switch( is_array( $argv[0] ) )
		{
			case 1:
				if( !isset( $argv[1], $argv[2] ) )
				{
					$this->write( $argv[0], 0, count( $argv[0] ) );
				}
				else
				{
					// Do the writing here...	
				}	
				break;
			default:
			case 0:
				throw new Exception("OutputStream::write( int b ) must be overwritten!");
				break;	
		}*/
	}
}
?>