<?
package("japha.beans");

import("japha.lang.Exception");

/**
 * $Id: IntrospectionException.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class IntrospectionException extends Exception
{
	public function __construct( String $mess )
	{
		$this->message = $mess;
	}
}
?>
