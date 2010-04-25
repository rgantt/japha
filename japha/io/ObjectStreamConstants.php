<?
package("japha.io");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
interface ObjectStreamConstants
{
    const baseWireHandle        = 0;
    const PROTOCOL_VERSION_1    = 1;
    const PROTOCOL_VERSION_2    = 2;
    const SC_BLOCK_DATA         = 3;
    const SC_EXTERNALIZABLE     = 4;
    const SC_SERIALIZABLE       = 5;
    const SC_WRITE_METHOD       = 6;
    const STREAM_MAGIC          = 7;
    const STREAM_VERSION        = 8;
    const TC_ARRAY              = 9;
    const TC_BASE               = 10;
    const TC_BLOCKDATA          = 11;
    const TC_BLOCKDATALONG      = 12;
    const TC_CLASS              = 13;
    const TC_CLASSDESC          = 14;
    const TC_ENDBLOCKDATA       = 15;
    const TC_EXCEPTION          = 16;
    const TC_LONGSTRING         = 17;
    const TC_MAX                = 18;
    const TC_NULL               = 19;
    const TC_OBJECT             = 20;
    const TC_PROXYCLASSDESC     = 21;
    const TC_REFERENCE          = 22;
    const TC_RESET              = 23;
    const TC_STRING             = 24;
    
    // SerializablePermission
    //public $SUBCLASS_IMPLEMENTATION_PERMISSION;
    //public $SUBSTITUTION_PERMISSION;
}
?>