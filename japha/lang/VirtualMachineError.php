<?
package("japha.lang");

/**
 * $Id: VirtualMachineError.php,v 1.5 2004/07/19 17:28:43 japha Exp $
 *
 * Thrown to indicate that the Java Virtual Machine is broken or has run out of resources 
 * necessary for it to continue operating.
 *
 * @deprecated For now, because we aren't using a virtual machine
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.5 $
 */
class VirtualMachineError extends Error
{
}
?>
