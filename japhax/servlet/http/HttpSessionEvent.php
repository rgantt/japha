<?
package("japhax.servlet.http");

import("japha.util.EventObject");

/** 
 * $Id: HttpSessionEvent.php,v 1.4 2004/07/14 22:27:04 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $
 */
class HttpSessionEvent extends EventObject
{
	public function __construct( HttpSession $source )
	{
		$this->source = $source;
	}

	public function getSession()
	{
		return $this->source;
	}
}
?>
