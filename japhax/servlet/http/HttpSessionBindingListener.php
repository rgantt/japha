<?php
namespace japhax\servlet\http;

use japha\util\EventListener;

/**
 * Causes an object to be notified when it is bound to or unbound from a session.
 *
 * The object is notified by an HttpSessionBindingEvent object.
 * This may be the result of a servlet programmer explicitly unbinding an attribute
 * from a session, due to a session being invalidated, or due to a session timing out.
 */
interface HttpSessionBindingListener {
	public function valueBound( HttpSessionBindingEvent $event );
	public function valueUnbound( HttpSessionBindingEvent $event );
}