<?
package("japha.lang");

/**
 * $Id$
 *
 * The class Exception and its subclasses are a form of Throwable that indicates conditions that 
 * a reasonable application might want to catch. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class _Exception extends Throwable
{
    /**
	 * Constructs a new exception with the specified detail message and cause. 
	 * Note that the detail message associated with cause is not automatically incorporated in 
	 * this exception's detail message. 
	 *
	 * @param message the detail message (which is saved for later retrieval by the Throwable.getMessage() method).
	 * @param cause the cause (which is saved for later retrieval by the Throwable.getCause() method). (A null value is permitted, and indicates that the cause is nonexistent or unknown.)
	 */
	public function __construct( $message, $cause=null )
	{
		$this->message = $message;
		$this->cause = $cause;
	}
}
?>