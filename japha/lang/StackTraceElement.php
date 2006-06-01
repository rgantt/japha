<?
package("japha.lang");

import("japha.lang.Object");

/**
 * $Id: StackTraceElement.php,v 1.3 2004/07/19 17:28:43 japha Exp $
 *
 * An element in a stack trace, as returned by Throwable.getStackTrace(). Each element represents a single stack frame. 
 * All stack frames except for the one at the top of the stack represent a method invocation. 
 * The frame at the top of the stack represents the the execution point at which the stack trace was generated. 
 * Typically, this is the point at which the throwable corresponding to the stack trace was created.
 * 
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class StackTraceElement extends Object implements Serializable
{
	public function equals( Object $obj ){}
	public function getClassName(){}
	public function getFileName(){}
	public function getLineNumber(){}
	public function getMethodName(){}
	public function hashCode(){}
	public function isNativeMethod(){}
	public function toString(){}
}
?>