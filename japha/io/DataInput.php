<?
package("japha.io");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
interface DataInput
{
    public function readBoolean();
    public function readByte();
    public function readChar();
    public function readDouble();
    public function readFloat();
    public function readFully();
    //public function readFully( $b );
    //public function readFully( $b, $off, $len );
    public function readInt();
    public function readLine();
    public function readLong();
    public function readShort();
    public function readUnsignedByte();
    public function readUnsignedShort();
    public function readUTF();
    public function skipBytes( $n );
}
?>