<?
package("japha.util");

import('japha.lang.Object');
import('japha.util.Enumeration');
import('japha.lang.StringBuffer');

/**
 * $Id$
 *
 * The string tokenizer class allows an application to break a string into 
 * tokens. The tokenization method is much simpler than the one used by the 
 * StreamTokenizer class. The StringTokenizer methods do not distinguish among 
 * identifiers, numbers, and quoted strings, nor do they recognize and skip 
 * comments.
 * 
 * The set of delimiters (the characters that separate tokens) may be specified 
 * either at creation time or on a per-token basis.
 *
 * An instance of StringTokenizer behaves in one of two ways, depending on 
 * whether it was created with the returnDelims flag having the value true or 
 * false:
 *
 * If the flag is false, delimiter characters serve to separate tokens. A token 
 * is a maximal sequence of consecutive characters that are not delimiters. If 
 * the flag is true, delimiter characters are themselves considered to be tokens. 
 * A token is thus either one delimiter character, or a maximal sequence of 
 * consecutive characters that are not delimiters. 
 *
 * A StringTokenizer object internally maintains a current position within the 
 * string to be tokenized. Some operations advance this current position past 
 * the characters processed.
 *
 * A token is returned by taking a substring of the string that was used to 
 * create the StringTokenizer object. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class StringTokenizer extends Object implements Enumeration
{
		private $pos = 0;

		private $tokens = array();

		function __construct( $string, $separator ) 
		{
			if ( !is_string( $string ) )
			{
				throw new Exception('StringTokenizer::__construct() requires a String');
			}
			$this->tokens = explode( $separator, $string );
		}

		function countTokens() 
		{
			return sizeof( $this->tokens );
		}

		function hasMoreElements()
		{
			return $this->hasMoreTokens();
		}

		function hasMoreTokens() 
		{
			return ( $this->pos < sizeof( $this->tokens ) );
		}

		function nextElement() 
		{
			return $this->nextToken();
		}
		
		function nextToken() 
		{
			if ( $this->pos > sizeof( $this->tokens ) )
			{
				throw new Exception("Array index out of bounds in StringTokenizer::nextToken()");
			}
			return $this->tokens[ $this->pos++ ];
		}
	 }
?>