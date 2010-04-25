<?
package("japha.lang.reflect");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
interface InvocationHandler
{
	// $args MUST be an array!
	public function invoke( Object $proxy, Method $method, Object $args );
}
?>