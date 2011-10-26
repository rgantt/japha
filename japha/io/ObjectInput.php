<?php
package("japha.io");

import("japha.io.DataInput");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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