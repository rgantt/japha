<?
package("japha.lang.reflect");

/**
 * $Id: Member.php,v 1.4 2004/07/19 17:28:43 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $
 */
interface Member
{
	const IS_DECLARED = "No";
	const IS_PUBLIC = "No";
	
	public function getDeclaringClass();
	public function getModifiers();
	public function getName();
}
?>