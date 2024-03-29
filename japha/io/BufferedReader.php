<?php
package("japha.io");

import('japha.io.Reader');

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class BufferedReader extends Reader
{
    private $reader;
    
    public function __construct( Reader $in )
    {
        $this->reader = $in;    
    }
    
    public function readLine()
    {
        return $this->reader->read();
    }
    
    public function close()
    {
        return $this->reader->close();
    }
    
    public function ready()
    {
        return $this->reader->ready();
    }
    
    public function mark( $readAheadLimit )
    {
        return $this->reader->mark( $readAheadLimit );
    }
    
    public function markSupported()
    {
        return $this->reader->markSupported();
    }
    
    public function reset()
    {
        return $this->reader->reset();
    }
    
    public function skip( $n )
    {
        return $this->reader->skip( $n );
    }
    
    public function read()
    {
        return $this->reader->read();
    }
}
?>