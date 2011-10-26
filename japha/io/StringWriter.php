<?php
package("japha.io");

import("japha.io.Writer");
import("japha.lang.StringBuffer");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class StringWriter extends Writer
{
    public function __construct(){}
    public function close(){}
    public function flush(){}
    public function write( $c ){}
    
    public function getBuffer()
    {
        return new StringBuffer();   
    }
}
?>