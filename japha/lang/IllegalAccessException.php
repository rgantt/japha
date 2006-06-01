<?
package("japha.lang");

/**
 * $Id: IllegalAccessException.php,v 1.1 2004/07/27 20:27:45 japha Exp $
 *
 * An IllegalAccessException is thrown when an application tries to reflectively create an instance (other than an array), 
 * set or get a field, or invoke a method, but the currently executing method does not have access to the definition of 
 * the specified class, field, method or constructor.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.1 $
 */
class IllegalAccessException extends Exception implements Serializable
{
    public function __construct( $message=null )
    {
        if( !( $message == null ) )
        {
            $this->message = $message;   
        }
    }
}
?>