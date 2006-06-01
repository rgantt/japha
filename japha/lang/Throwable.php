<?
package("japha.lang");

import("japha.io.Serializable");

/**
 * $Id: Throwable.php,v 1.10 2004/08/25 21:50:21 japha Exp $
 *
 * The Throwable class is the superclass of all errors and exceptions in the Java language. 
 * Only objects that are instances of this class (or one of its subclasses) are thrown by 
 * the Java Virtual Machine or can be thrown by the Java throw statement. Similarly, only 
 * this class or one of its subclasses can be the argument type in a catch clause. 
 *
 * Instances of two subclasses, Error and Exception, are conventionally used to indicate that 
 * exceptional situations have occurred. Typically, these instances are freshly created in 
 * the context of the exceptional situation so as to include relevant information (such as 
 * stack trace data). 
 *
 * A throwable contains a snapshot of the execution stack of its thread at the time it was 
 * created. It can also contain a message string that gives more information about the error. 
 * Finally, it can contain a cause: another throwable that caused this throwable to get thrown. 
 * The cause facility is new in release 1.4. It is also known as the chained exception 
 * facility, as the cause can, itself, have a cause, and so on, leading to a "chain" of 
 * exceptions, each caused by another. 
 *
 * One reason that a throwable may have a cause is that the class that throws it is built 
 * atop a lower layered abstraction, and an operation on the upper layer fails due to a 
 * failure in the lower layer. It would be bad design to let the throwable thrown by the 
 * lower layer propagate outward, as it is generally unrelated to the abstraction provided 
 * by the upper layer. Further, doing so would tie the API of the upper layer to the details 
 * of its implementation, assuming the lower layer's exception was a checked exception. 
 * Throwing a "wrapped exception" (i.e., an exception containing a cause) allows the upper 
 * layer to communicate the details of the failure to its caller without incurring either of 
 * these shortcomings. It preserves the flexibility to change the implementation of the upper 
 * layer without changing its API (in particular, the set of exceptions thrown by its methods). 
 *
 * A second reason that a throwable may have a cause is that the method that throws it must 
 * conform to a general-purpose interface that does not permit the method to throw the cause 
 * directly. For example, suppose a persistent collection conforms to the Collection interface, 
 * and that its persistence is implemented atop java.io. Suppose the internals of the put 
 * method can throw an IOException. The implementation can communicate the details of the 
 * IOException to its caller while conforming to the Collection interface by wrapping the 
 * IOException in an appropriate unchecked exception. (The specification for the persistent 
 * collection should indicate that it is capable of throwing such exceptions.) 
 * 
 * A cause can be associated with a throwable in two ways: via a constructor that takes the 
 * cause as an argument, or via the initCause(Throwable) method. New throwable classes that 
 * wish to allow causes to be associated with them should provide constructors that take a 
 * cause and delegate (perhaps indirectly) to one of the Throwable constructors that takes a 
 *cause. For example: 
 *
 *    try {
 *        lowLevelOp();
 *    } catch (LowLevelException le) {
 *        throw new HighLevelException(le);  // Chaining-aware constructor
 *    }
 *
 * Because the initCause method is public, it allows a cause to be associated with any 
 * throwable, even a "legacy throwable" whose implementation predates the addition of the 
 * exception chaining mechanism to Throwable. For example: 
 *
 *    try {
 *        lowLevelOp();
 *    } catch (LowLevelException le) {
 *        throw (HighLevelException)
 *                new HighLevelException().initCause(le);  // Legacy constructor
 *    }
 *
 * Prior to release 1.4, there were many throwables that had their own non-standard exception 
 * chaining mechanisms ( ExceptionInInitializerError, ClassNotFoundException, 
 * UndeclaredThrowableException, InvocationTargetException, WriteAbortedException, 
 * PrivilegedActionException, PrinterIOException and RemoteException). As of release 1.4, 
 * all of these throwables have been retrofitted to use the standard exception chaining
 * mechanism, while continuing to implement their "legacy" chaining mechanisms for compatibility. 
 *
 * Further, as of release 1.4, many general purpose Throwable classes (for example Exception, 
 * RuntimeException, Error) have been retrofitted with constructors that take a cause. This 
 * was not strictly necessary, due to the existence of the initCause method, but it is more 
 * convenient and expressive to delegate to a constructor that takes a cause. 
 *
 * By convention, class Throwable and its subclasses have two constructors, one that takes no 
 * arguments and one that takes a String argument that can be used to produce a detail message. 
 * Further, those subclasses that might likely have a cause associated with them should have 
 * two more constructors, one that takes a Throwable (the cause), and one that takes a 
 * String (the detail message) and a Throwable (the cause). 
 *
 * Also introduced in release 1.4 is the getStackTrace() method, which allows programmatic 
 * access to the stack trace information that was previously available only in text form, via 
 * the various forms of the printStackTrace() method. This information has been added to 
 * the serialized representation of this class so getStackTrace and printStackTrace will 
 * operate properly on a throwable that was obtained by deserialization. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.10 $
 */
class Throwable extends Object implements Serializable
{
    /**
     * A short description of the exception and what caused it
     */
	protected $message;
	
	/**
	 * The Throwable instance that cause this exception to be thrown
	 */
	protected $cause;
	
	/**
	 * The name that should be displayed as the top level class in the
	 * stack trace.
	 */
	private $classname = "japha.lang.Throwable";
	
	/**
	 * Constructs a new Throwable with the specified detail message and cause
	 */
	function __construct( $message, Throwable $cause )
	{
		$this->message = $message;
		$this->cause = $cause;
	}
		
	/**
	 * Returns the Throwable instance that caused this exception to be thrown (may be heavily
	 * nested throughout the entire hierarchy). See class javadoc for more information about
	 * causes.
	 */
	public function getCause()
	{
		return $this->cause;
	}
	
	/**
	 * Returns a buffered version of the printStackTrace method
	 */
	public function getStackTrace()
	{
	    $sb = new StringBuffer("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=\"2\">");
	    $sb->append( "<b>".$this->classname.": ".$this->getMessage()."</b><br/>" );
	    foreach( $this->getTrace() as $value )
	    {
	        $sb->append("</td></tr><tr><td width=\"25\">&nbsp;</td><td>");
	        $sb->append( "\tat ".$value['class'].$value['type'].$value['function']." ( ".Japha::getQualified( $value['file'] ).":".$value['line'].")<br/>");
	    }
	    $sb->append("</tr></table>");
	    return $sb;
	}

	/**
	 * Since printStackTrace is a final method, called this method with the name of the class that calls
	 * the stack trace will cause the top level class name to reflect that of the subclass instead of
	 * "japha.lang.Throwable"
	 */
	protected function setClassName( $name )
	{
	   $this->classname = $name;   
	}
	
	/**
	 * Prints a Java-like stack trace based on the private member of Exception called 'trace'.
	 * Trace information is called from Object's superclass (namely, Exception)
	 */
	public final function printStackTrace()
	{
	    echo $this->getStackTrace()->toString();
	}
	
	/**
	 * Set's an element on top of the stack trace
	 */
	public function setStackTrace( StackTraceElement $stackTrace )
	{
		$this->stackTrace = $stackTrace;
	}
	
	/**
	 * Returns the string representation of the exception detail message
	 *
	 * Use Throwable::getLocalizedMessage() for locale-specific errors
	 */
	public function toString()
	{
		return $this->getMessage();
	}
	
	/**
	 * Returns a locale-specific exception detail message
	 */
	public function getLocalizedMessage()
	{
	   return $this->getMessage();
	}
	
	public function initCause( Throwable $t ){}
	public function fillInStackTrace(){}
}
?>
