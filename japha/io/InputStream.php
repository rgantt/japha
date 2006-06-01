<?
package("japha.io");

/**
 * $Id: InputStream.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
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