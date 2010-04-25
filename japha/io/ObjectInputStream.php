<?
package("japha.io");

import("japha.io.InputStream");
import("japha.io.ObjectInput");
import("japha.io.ObjectStreamConstants");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
abstract class ObjectInputStream extends InputStream implements ObjectInput, ObjectStreamConstants
{
}
?>