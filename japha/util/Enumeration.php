<?
package("japha.util");

/**
 * $Id: Enumeration.php,v 1.4 2004/07/22 16:40:05 japha Exp $
 *
 * An object that implements the Enumeration interface generates a series of elements, one at a time. Successive calls to 
 * the nextElement method return successive elements of the series.
 *
 * For example, to print all elements of a vector v:
 *
 *   for( $e = $v->elements() ; $e->hasMoreElements() ; ) 
 *   {
 *       System::out->println( $e->nextElement() );
 *   }
 *
 * Methods are provided to enumerate through the elements of a vector, the keys of a hashtable, and the values in a 
 * hashtable. Enumerations are also used to specify the input streams to a SequenceInputStream.
 *
 * NOTE: The functionality of this interface is duplicated by the Iterator interface. In addition, Iterator adds an 
 * optional remove operation, and has shorter method names. New implementations should consider using Iterator in 
 * preference to Enumeration. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/22 16:40:05 $
 */
interface Enumeration
{
	public function hasMoreElements();
	public function nextElement();
}
?>