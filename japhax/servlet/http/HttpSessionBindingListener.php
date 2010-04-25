<?
package('japhax.servlet.http');

import('japha.util.EventListener');
import('japhax.servlet.http.HttpSessionBindingEvent');

/**
 * $Id$
 *
 * Causes an object to be notified when it is bound to or unbound from a session.
 *
 * The object is notified by an HttpSessionBindingEvent object.
 * This may be the result of a servlet programmer explicitly unbinding an attribute
 * from a session, due to a session being invalidated, or due to a session timing out.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
interface HttpSessionBindingListener
{
	public function valueBound( HttpSessionBindingEvent $event );
	public function valueUnbound( HttpSessionBindingEvent $event );
}
?>
