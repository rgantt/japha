<?
package("japhax.servlet.jsp");

import("japha.lang.Exception");

/**
 * $Id: JspException.php,v 1.2 2004/07/14 22:27:04 japha Exp $
 *
 * A generic exception known to the JSP engine; uncaught JspExceptions will result in an 
 * invocation of the errorpage machinery. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.2 $ $Date: 2004/07/14 22:27:04 $
 */
class JspTagException extends Exception
{
	/**
	 * Constructs a new JSP exception when the JSP needs to throw an exception and include a 
	 * message about the "root cause" exception that interfered with its normal operation, 
	 * including a description message.
	 * 
	 * @param message a String containing the text of the exception message
	 * @param rootCause the Throwable exception that interfered with the servlet's normal operation, making this servlet exception necessary
	 */
	public function __construct( $message, Throwable $cause )
	{
		$this->message = $message;
		$this->cause = $cause;	
	}
	
	/**
	 * Returns the exception that caused this JSP exception.
	 *
	 * @returns the Throwable that caused this JSP exception
	 */
	public function getRootCause()
	{
		return $this->cause;	
	}
}
?>