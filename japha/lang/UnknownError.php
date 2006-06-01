<?
package("japha.lang");

import("japha.lang.VirtualMachineError");

/**
 * $Id: UnknownError.php,v 1.3 2004/07/19 17:28:43 japha Exp $
 *
 * Thrown when an unknown but serious exception has occurred in the Java Virtual Machine. 
 *
 * @deprecated For now, because we aren't using a Virtual Machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class UnknownError extends VirtualMachineError
{
	/**
	 * Constructs a new UnknownError with the specified detail message
	 *
	 * @param s the detail message
	 */
	public function __construct( $s )
	{
		$this->message = $s;
	}
}
?>