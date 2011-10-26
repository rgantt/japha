<?php
package("japha.lang");

/**
 * $Id$
 *
 * Thrown to indicate that the Java Virtual Machine is broken or has run out of resources 
 * necessary for it to continue operating.
 *
 * @deprecated For now, because we aren't using a virtual machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class VirtualMachineError extends Error
{
}
?>
