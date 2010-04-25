<?
package("japha.lang");

import("japha.lang.CharSequence");

/**
 * $Id$
 *
 * This needs to be reimplemented to accept a numeric constructor parameter (overload the constructor)
 * Also needs to:
 *    - Not suck
 *    - Have more array-like support for the buffer
 *
 * This is an attempt at an exact clone of the StringBuffer class for Java
 * It contains all of the same methods, and emulates the same methods and steps that are taken in Java.
 *
 * You have more control than simply using PHP's .= append feature, because you can work with only
 * one string at a time, making adjustments to that buffer as you work, and call common requests on
 * that buffer.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class StringBuffer extends Object implements CharSequence
{
    /**
     * This is the final output string. Can only be accessed after toString has been called.
     * @access private
     * @var
     */
    private $string = "";
    
    /**
     * The current state of the buffer. Can be of type string or array\
     * @access private
     * @var
     */
    private $curChar;
    private $charLen;
    
    /**
     * Constructor. Takes initial char buffer as a parameter.
     *
     * @param initChar The initial value of the buffer
     */
    public function __construct( $initChar = "" )
    {
        $this->curChar = $initChar;
        if( is_array($this->curChar) )
        {
            $this->charLen = count($this->curChar);
        }
        else if( is_string($this->curChar) )
        {
            $this->charLen = strlen($this->curChar);
        }
    }
    
    /**
     * Returns the character at a specific offset in a buffer.
     *
     * @param index The offset to return.
     * @return char The character at the specific offset
     * @access public
     */
    public function charAt( $index )
    {
        return $this->curChar{ $index };
    }
    
    /**
     * Removes a character from the buffer at a specific offset
     *
     * @param index The offset to remove.
     * @access public
     */
    public function deleteCharAt( $index )
    {
        unset( $this->curChar{ $index } ); 
        $this->charLen--;  
    }
    
    /**
     * Return a portion of the buffer, between the starting and ending offsets
     *
     * @param start The starting offset.
     * @param end The ending offset
     * @return String A portion of the current buffer in String format
     * @access public
     */
    public function substring( $start, $end = -1 )
    {
        if( $end > 0 )
        {
            return substr( $this->toString(), $start, $end );   
        }
        else
        {
            return substr( $this->toString(), $start, $this->length() );   
        }
    }
    
    /**
     * Return a portion of the current buffer as an array.
     *
     * @access public
     * @param start index to start at
     * @param end index to end at
     * @return char[] A portion of the current buffer in char[] array format
     */
    public function subSequence( $start, $end )
    {
        $this->subString( $start, $end );   
    }
    
    /**
     * Changes the value of the character at the passed offset
     *
     * @param offset The location to replace.
     * @param char The character to insert at the offset.
     * @throws Exception
     * @access public
     */
    public function setCharAt( $offset, $char )
    {
        if( strlen($char) > 1 )
        {
            throw new Exception("Argument to StringBuffer::setCharAt() must be a char, as in, a single character.");   
        }
        else
        {
            $this->curChar{ $offset } = $char;   
        }   
    }
    
    /**
     * Returns the first occurence of a value in the buffer.
     *
     * @param char The character to search for.
     * @return int the index of the element, if found
     * @access public
     */
    public function indexOf( $char )
    {
        return array_search( $char, $this->curChar );
    }
    
    /**
     * Fill up a passed array with values from the buffer, beginning and ending at specific offsets
     *
     * @access public
     * @param start The starting offset.
     * @param end The ending offset.
     * @param array The array to populate (passed by reference).
     * @param arrayIndex The offset to start at in the passed array.
     * @return char[] the modified array of chars
     */
    public function getChars( $start, $end, $array, $arrayIndex = 0 )
    {
        for( $i = 0; $start + $i > $end; $i++ )
        {
            $array[$arrayIndex + $i] = $this->curChar{ $start + $i };
        }
    }
    
    /** 
     * Add a value to the end of the buffer.
     *
     * @access public
     * @param char The char (or String) to append.
     * @throws Exception
     */
    public function append( $char )
    {
        if( strlen( $char ) == 1 )
        {
            $this->curChar{ $this->charLen++ } = $char;  
        }
        else if( is_array($char) )
        {
            foreach( $char as $key => $value )
            {
                $this->curChar{ $this->charLen++ } = $value;   
            }   
        }
        else if( is_string( $char ) )
        {
            for( $i = 0; $i < strlen( $char ); $i++ )
            {
                $this->curChar{ $this->charLen++ } = $char{ $i };   
            }
        }
	else if( !$char )
	{
		return;
	}
        else
        {
            throw new Exception("Argument for StringBuffer::append(), (".$char.") must be an array, char, or string.");   
        }
    }   
    
    /**
     * Insert data into an already populated StringBuffer. Insert at a specific offset, and pushes
     * existing text backwards.
     *
     * @access public
     * @param offset The offset to start at in the buffer.
     * @param data The char (or String) to insert into the buffer.
     * @throws Exception
     */
    public function insert( $offset, $data )
    {
        $nLen = strlen( $data );
        if( $offset > strlen($this->curChar) )
        {
            throw new Exception("Offset cannot be longer than string in StringBuffer::insert()");
        }
        $aOffset = substr( $this->curChar, $offset );
        for( $i = $offset; $i < strlen($this->curChar); $i++ )
        {
            $this->curChar{ $i } = "";   
        }
        for( $i = 0; $i < $nLen; $i++ )
        {
            $this->curChar{ $offset + $i } = $data{ $i };   
        }
        $this->append( $aOffset );
    }
    
    /**
     * Returns a string representation of the completed buffer
     *
     * @access public
     * @return String
     * @throws Exception
     * @return String a String representation of the current buffer
     */
    public function toString()
    {
    	// unset($this->string) <- This cause JpUnit to fail completely. WTF.
        if( is_string($this->curChar) )
        {
            return $this->curChar;   
        }
        else if( is_array($this->curChar) )
        {
            foreach($this->curChar as $key => $value)
            {
                $this->string .= $value;   
            }
            return $this->string;
        }
        else
        {
            throw new Exception("Argument to StringBuffer::toString() must be an array or string.");   
        }
    }
    
    /**
     * Changes the length of the buffer, to accomodate more characters
     *
     * @param len The new length of the buffer.
     * @access public
     * @param len Clip or Grow the current amound of indices in the buffer
     */
    public function setLength( $len )
    {
        for( $i = 0; $i < $len; $i++ )
        {
            if( $i < strlen($this->curChar) )
            {
                $newCurChar{ $i } = $this->curChar{ $i };   
            }
            else
            {
                $newCurChar{ $i } = "";   
            }
        }
        $this->curChar = $newCurChar;
        $this->charLen = count($this->curChar);
    }
    
    /**
     * Returns the length of the current buffer.
     *
     * @access public
     * @return int number of indices in the buffer
     */
    public function length()
    {
        return count( $this->curChar );   
    }
    
    /**
     * Flips the current buffer programmatically.
     *
     * @access public
     */
    public function reverse()
    {
        $ar = array();
        if( is_array($this->curChar) )
        {
            for( $i = 0; $i < count($this->curChar); $i++ )
            {
                array_unshift( $ar, $this->curChar{ $i } );
            }   
        }
        else if( is_string($this->curChar) )
        {
            for( $i = 0; $i < strlen($this->curChar); $i++ )
            {
                array_unshift( $ar, $this->curChar{ $i } );
            }
        }   
        $this->curChar = $ar;
    }
}
?>