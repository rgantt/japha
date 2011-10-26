<?php
package("japha.lang");

import("japha.lang.Error");

/**
 * $Id$
 *
 * An instance of ThreadDeath is thrown in the victim thread when the stop method with zero arguments in class Thread is 
 * called.
 *
 * An application should catch instances of this class only if it must clean up after being terminated asynchronously. If 
 * ThreadDeath is caught by a method, it is important that it be rethrown so that the thread actually dies.
 *
 * The top-level error handler does not print out a message if ThreadDeath is never caught.
 *
 * The class ThreadDeath is specifically a subclass of Error rather than Exception, even though it is a "normal occurrence", 
 * because many applications catch all occurrences of Exception and then discard the exception.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class ThreadDeath extends Error
{
}
?>