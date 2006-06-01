<?
package("japha.lang");

/**
 * $Id: Error.php,v 1.3 2004/07/19 17:28:43 japha Exp $
 *
 * An Error is a subclass of Throwable that indicates serious problems that a reasonable 
 * application should not try to catch. Most such errors are abnormal conditions. The 
 * ThreadDeath error, though a "normal" condition, is also a subclass of Error because 
 * most applications should not try to catch it. 
 *
 * A method is not required to declare in its throws clause any subclasses of Error that 
 * might be thrown during the execution of the method but not caught, since these errors 
 * are abnormal conditions that should never occur. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class Error extends Throwable
{
	/**
	 * The message associated with this Error
	 */
	protected $message;
	
	/**
	 * The child of Throwable that was the cause of this Error
	 */
	protected $cause;

	/**
	 * Constructs a new error with the specified detail message and cause. 
	 * Note that the detail message associated with cause is not automatically 
	 * incorporated in this error's detail message. 
	 *
	 * @param message the detail message (which is saved for later retrieval by the Throwable.getMessage() method).
	 * @param cause the cause (which is saved for later retrieval by the Throwable.getCause() method). (A null value is permitted, and indicates that the cause is nonexistent or unknown.)
	 */
	function __construct( $message, Throwable $cause )
	{
		$this->message = $message;
		$this->cause = $cause;		
	}
}
