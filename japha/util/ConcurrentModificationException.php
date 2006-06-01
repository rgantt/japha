<?
package("japha.util");

/**
 * $Id: ConcurrentModificationException.php,v 1.1 2004/07/23 17:51:47 japha Exp $
 *
 * This exception may be thrown by methods that have detected concurrent modification of an object when such modification 
 * is not permissible.
 *
 * For example, it is not generally permssible for one thread to modify a Collection while another thread is iterating over 
 * it. In general, the results of the iteration are undefined under these circumstances. Some Iterator implementations 
 * (including those of all the collection implementations provided by the JRE) may choose to throw this exception if this 
 * behavior is detected. Iterators that do this are known as fail-fast iterators, as they fail quickly and cleanly, rather 
 * that risking arbitrary, non-deterministic behavior at an undetermined time in the future.
 *
 * Note that this exception does not always indicate that an object has been concurrently modified by a different thread. If 
 * a single thread issues a sequence of method invocations that violates the contract of an object, the object may throw 
 * this exception. For example, if a thread modifies a collection directly while it is iterating over the collection with a 
 * fail-fast iterator, the iterator will thow this exception.
 *
 * Note that fail-fast behavior cannot be guaranteed as it is, generally speaking, impossible to make any hard guarantees 
 * in the presence of unsynchronized concurrent modification. Fail-fast operations throw ConcurrentModificationException 
 * on a best-effort basis. Therefore, it would be wrong to write a program that depended on this exception for its 
 *correctness: ConcurrentModificationException should be used only to detect bugs.
 *
 * @author <a href="gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.1 $
 */
class ConcurrentModificationException extends RuntimeException
{
    public function __construct()
    {
        $argv = func_get_args();
        if( $argv[0] )
        {
            $this->ConcurrentModificationException1( $argv[0] );   
        }
        else
        {
            $this->ConcurrentModificationException0();   
        }
    }
    
    /**
     * Constructs a ConcurrentModificationException with no detail message.
     */
    public function ConcurrentModificationException0(){}
          
    /**
     * Constructs a ConcurrentModificationException with the specified detail message.
     */
    public function ConcurrentModificationException1( $message )
    {
        $this->message = $message;   
    }
}
?>