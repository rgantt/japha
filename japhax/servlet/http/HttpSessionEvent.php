<?
package("japhax.servlet.http");

import("japha.util.EventObject");

/** 
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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
