<?
package("japha.io");

import("japha.io.Writer");

/**
 * $Id$
 *
 * Print formatted representations of objects to a text-output stream. This class implements all of the print methods 
 * found in PrintStream. It does not contain methods for writing raw bytes, for which a program should use unencoded 
 * byte streams.
 *
 * Unlike the PrintStream class, if automatic flushing is enabled it will be done only when one of the println() methods 
 * is invoked, rather than whenever a newline character happens to be output. The println() methods use the platform's 
 * own notion of line separator rather than the newline character.
 *
 * Methods in this class never throw I/O exceptions. The client may inquire as to whether any errors have occurred by 
 * invoking checkError(). 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class PrintWriter extends Writer
{
    protected $out;
    
	public function __construct( Writer $w )
	{
	    $this->out = $w;
	}
	
	public function close(){}
	public function flush(){}
	public function write( $c ){}
}
?>