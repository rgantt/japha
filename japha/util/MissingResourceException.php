<?
package("japha.util");

/**
 * $Id: MissingResourceException.php,v 1.2 2004/07/22 17:46:58 japha Exp $
 *
 * Signals that a resource is missing.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.2 $
 */
class MissingResourceException extends _RuntimeException
{
    private $s;
    private $className;
    private $key;
    
    /**
     * Constructs a MissingResourceException with the specified information.
     */
    public function __construct( $s, $className, $key )
    {
        $this->s = $s;
        $this->className = $className;
        $this->key = $key;    
    }
 
    /**
     * Gets parameter passed by constructor.
     */
    public function getClassName()
    {
        return $this->className;
    }
    
    /**
     * Gets parameter passed by constructor.
     */
    public function getKey()
    {
        return $this->key;
    }
}
?>