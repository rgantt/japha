<?
package("japha.security");

/**
 * $Id: Guard.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $ $Date: 2004/07/14 22:27:03 $
 */
interface Guard
{
	public function checkGuard( Object $object ); //throw SecurityException
}
?>