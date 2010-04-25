<?
package("japha.io");

/**
 * $Id$
 *
 * Abstract class for writing to character streams. The only methods that a subclass must 
 * implement are <code>write(char[], int, int)</code>, <code>flush()</code>, and <code>close()</code>. 
 * Most subclasses, however, will override some of the methods defined here in order to provide 
 * higher efficiency, additional functionality, or both. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class Writer extends Object
{   
	/**
	 * The object used to synchronize operations on this stream. For efficiency, a character-stream 
	 * object may use an object other than itself to protect critical sections. 
	 * A subclass should therefore use the object in this field rather than this or a 
	 * synchronized method. 
	 */
	protected $lock;
	
    /**
     * Create a new character-stream writer whose critical sections will synchronize on the writer itself.
     *
     * @access protected
     */
    public function __construct(){}   
    
    /**
     * Close the stream, flushing it first. Once a stream has been closed, further write() or flush() 
     * invocations will cause an IOException to be thrown. Closing a previously-closed stream, however, 
     * has no effect. 
     * 
     * @access public
     * @abstract
     */
    abstract public function close();
    
    /**
     * Flush the stream. If the stream has saved any characters from the various write() methods in 
     * a buffer, write them immediately to their intended destination. Then, if that destination 
     * is another character or byte stream, flush it. Thus one flush() invocation will flush all the 
     * buffers in a chain of Writers and OutputStreams. 
     *
     * @access public
     * @abstract
     */
    abstract public function flush();
    
    /**
     * Write a single character. The character to be written is contained in the 16 low-order bits of 
     * the given integer value; the 16 high-order bits are ignored. 
     *
     * Subclasses that intend to support efficient single-character output should override this method. 
     *
     * @access public
     * @abstract
     * @param c int specifying a character to be written. 
     */
    abstract public function write( $c );
}
?>
