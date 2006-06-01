<?
package("japha.io");

import("japha.io.DataInput");

/**
 * $Id: ObjectInput.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
interface ObjectInput extends DataInput
{
    public function available();
    public function close();
    public function read();
    //public function read( $b );
    //public function read( $b, $off, $len );
    public function readObject();
    public function skip( $n );
}
?>