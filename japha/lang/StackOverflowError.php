<?
package("japha.lang");

import("japha.lang.VirtualMachineError");

/**
 * $Id: StackOverflowError.php,v 1.3 2004/07/19 17:28:43 japha Exp $
 *
 * Thrown when a stack overflow occurs because an application recurses too deeply. 
 *
 * @deprecated For now, because we aren't using a virtual machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
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