<?
package("japha.lang.reflect");

/**
 * $Id: InvocationHandler.php,v 1.3 2004/07/19 17:28:43 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
interface InvocationHandler
{
	// $args MUST be an array!
	public function invoke( Object $proxy, Method $method, Object $args );
}
?>