<?
package("japha.io");

import("japha.io.Reader");

/**
 * $Id: StringReader.php,v 1.1 2004/07/27 20:27:45 japha Exp $
 *
 * A character stream whose source is a string.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.1 $
 */
class StringReader extends Reader
{
    private $string;
    protected $lock;
    
    private $index = 0;
    private $mark = 0;
    
    public function __construct( $string )
    {
        $this->string = $string;   
    }
    
    public function ready()
    {
        return true;   
    }
    
    public function markSupported()
    {
        return true;   
    }
    
    public function mark( $readAheadLimit )
    {
        $this->mark = $this->index;   
    }
    
    public function skip( $char )
    {
        if( ( $this->index + $char ) > strlen( $this->string ) )
        {
            throw new IndexOutOfBoundsException("Suggested read-ahead was beyond length of stream");   
        }
        $this->index += $char;
    }
    
    public function read()
    {
        return $this->string{ $this->index++ };
    }
    
    public function close()
    {
        return;   
    }
    
    public function reset()
    {
        $this->index = $this->mark;   
    }
}