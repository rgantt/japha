<?php
package("japha.lang");

/**
 * $Id$
 *
 * An IllegalAccessException is thrown when an application tries to reflectively create an instance (other than an array), 
 * set or get a field, or invoke a method, but the currently executing method does not have access to the definition of 
 * the specified class, field, method or constructor.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class IllegalAccessException extends Exception implements _Serializable
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