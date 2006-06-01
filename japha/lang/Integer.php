<?
package("japha.lang");

/**
 * $Id: Integer.php,v 1.1 2004/07/30 23:34:02 japha Exp $
 *
 * Wrapper for the integer primitive
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.1 $
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