<?php
package("japha.security");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface Guard
{
	public function checkGuard( Object $object ); //throw SecurityException
}
?>