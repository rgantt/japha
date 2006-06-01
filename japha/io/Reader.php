<?
package("japha.io");

/**
 * $Id: Reader.php,v 1.6 2004/08/25 21:49:13 japha Exp $
 *
 * Abstract class for reading character streams. The only methods that a subclass must implement 
 * are <code>read(char[], int, int)</code> and <code>close()</code>. Most subclasses, however, 
 * will override some of the methods defined here in order to provide higher efficiency, 
 * additional functionality, or both. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.6 $ $Date: 2004/08/25 21:49:13 $
 */
abstract class Reader extends Object
{
	/**
	 * The object used to synchronize operations on this stream. For efficiency, a 
	 * character-stream object may use an object other than itself to protect critical 
	 * sections. A subclass should therefore use the object in this field rather than 
	 * this or a synchronized method.
	 */
	protected $lock;
	
    /**
     * @access protected
     */
    public function __construct(){}
    
    /**
     * Close the stream. Once a stream has been closed, further read(), ready(), mark(), or 
     * reset() invocations will throw an IOException. Closing a previously-closed stream, 
     * however, has no effect. 
     * 
     * @abstract
     * @access public
     */
    abstract public function close();
    
    /**
     * Read a single character. This method will block until a character is available, an I/O error 
     * occurs, or the end of the stream is reached. 
     *
     * Subclasses that intend to support efficient single-character input should override this method. 
     *
     * @abstract
     * @access public
     * @return int The character read, as an integer in the range 0 to 65535 (0x00-0xffff), or -1 if the end of the stream has been reached 
     */
    abstract public function read();
    
    /**
     * Mark the present position in the stream. Subsequent calls to reset() will attempt to reposition 
     * the stream to this point. Not all character-input streams support the mark() operation. 
     *
     * @access public
     * @param readAheadLimit Limit on the number of characters that may be read while still preserving the mark. After reading this many characters, attempting to reset the stream may fail. 
     */
    abstract public function mark( $readAheadLimit );
    
    /**
     * Tell whether this stream supports the mark() operation. The default implementation always 
     * returns false. Subclasses should override this method. 
     *
     * @access public
     * @return boolean true if and only if this stream supports the mark operation.
     */
    abstract public function markSupported();

    /**
     * Tell whether this stream is ready to be read.
     *
     * @access public
     * @return boolean True if the next read() is guaranteed not to block for input, false otherwise. Note that returning false does not guarantee that the next read will block.
     */
    abstract public function ready();

    /**
     * Reset the stream. If the stream has been marked, then attempt to reposition it at the mark.
     * If the stream has not been marked, then attempt to reset it in some way appropriate to the
     * particular stream, for example by repositioning it to its starting point. Not all
     * character-input streams support the reset() operation, and some support reset() without
     * supporting mark().
     *
     * @access public
     */
    abstract public function reset();

    /**
     * Skip characters. This method will block until some characters are available, an I/O error occurs,
     * or the end of the stream is reached.
     *
     * @access public
     * @return long The number of characters actually skipped
     * @param n The number of characters to skip
     */
    abstract public function skip( $n );
}
?>
