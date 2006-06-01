<?
package("japha.io");

import("japha.io.InputStream");
import("japha.io.ObjectInput");
import("japha.io.ObjectStreamConstants");

/**
 * $Id: ObjectInputStream.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
abstract class ObjectInputStream extends InputStream implements ObjectInput, ObjectStreamConstants
{
}
?>