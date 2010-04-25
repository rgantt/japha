<?
package("japha.lang");

/**
 * $Id$
 *
 * Wrapper for the integer primitive
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class Integer extends Object
{
    private $int;
    
    public function __construct( $int )
    {
        $this->int = $int;    
    }  
}
?>