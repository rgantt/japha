<?php
package("japha.io");

import("japha.io.Reader");

/**
 * $Id$
 *
 * A character stream whose source is a string.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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
	    return ( isset( $this->string{ $this->index++ } ) ) ? $this->string{ $this->index } : false;
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