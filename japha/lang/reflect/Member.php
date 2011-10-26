<?php
package("japha.lang.reflect");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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