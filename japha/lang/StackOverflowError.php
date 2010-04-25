<?
package("japha.lang");

import("japha.lang.VirtualMachineError");

/**
 * $Id$
 *
 * Thrown when a stack overflow occurs because an application recurses too deeply. 
 *
 * @deprecated For now, because we aren't using a virtual machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class StackOverflowError extends VirtualMachineError
{
	/**
	 * Construct a StackOverflowError with the sepecified detail message
	 *
	 * @param s the detail message
	 */
	public function __construct( $s )
	{
		$this->message = $s;
	}
}
?>