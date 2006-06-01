<?
package("japha.io");

import("japha.io.Writer");
import("japha.lang.StringBuffer");

/**
 * $Id: StringWriter.php,v 1.4 2004/07/27 20:26:55 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $
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