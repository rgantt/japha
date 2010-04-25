<?
package("japha.lang");

import("japha.lang.Object");

/**
 * $Id$
 *
 * Thrown when the Java Virtual Machine cannot allocate an object because it is out of memory, and 
 * no more memory could be made available by the garbage collector. 
 *
 * @deprecated For now, because we aren't using a virtual machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class OutOfMemoryError extends VirtualMachineError
{
	/**
	 * Constructs an OutOfMemoryError with the specified detail message. 
	 *
	 * @param s the detail message.
	 */
	public function __construct( $s )
	{
		$this->message = $s;
	}
}
?>