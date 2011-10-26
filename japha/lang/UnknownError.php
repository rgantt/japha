<?php
package("japha.lang");

import("japha.lang.VirtualMachineError");

/**
 * $Id$
 *
 * Thrown when an unknown but serious exception has occurred in the Java Virtual Machine. 
 *
 * @deprecated For now, because we aren't using a Virtual Machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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