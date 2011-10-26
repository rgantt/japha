<?php
package("japha.io");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
abstract class InputStream extends Object
{
    protected $isOpen;
    
    public function __construct(){}

    public function available()
    {
        return 4096;   
    }   
    
    public function close()
    {
        $this->isOpen = false;   
    }
    
    public function mark( $readLimit )
    {
        if( $this->markSupported() )
        {
            $this->mark = $this->position;
        }
    }
    
    public function markSupported()
    {
        return true;   
    }
    
    public function reset()
    {
        $this->position = $this->mark;   
    }
    
    public function skip( $n )
    {
        $this->position += $n;
    }
    
    // abstract public function read();
    public function read(){}
}
?>