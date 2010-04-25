<?
package("java.lang");

//import("java.io.ObjectStreamClass");
//import('java.io.ObjectStreamField");
import("japha.io.Serializable");
import("japha.lang.Comparable");
import("japha.lang.CharSequence");
import("japha.io.UnsupportedEncodingException");
import("japha.util.ArrayList");
import("japha.util.Comparator");
import("japha.util.Locale");
//import("java.util.regex.Matcher");
//import("java.util.regex.Pattern");
//import("java.util.regex.PatternSyntaxException");

/**
 * $Id$
 *
 * The <code>String</code> class represents character strings. All
 * string literals in Java programs, such as <code>"abc"</code>, are
 * implemented as instances of this class.
 * <p>
 * Strings are constant; their values cannot be changed after they
 * are created. String buffers support mutable strings.
 * Because String objects are immutable they can be shared. For example:
 * <p><blockquote><pre>
 *     String str = "abc";
 * </pre></blockquote><p>
 * is equivalent to:
 * <p><blockquote><pre>
 *     char data[] = {'a', 'b', 'c'};
 *     String str = new String(data);
 * </pre></blockquote><p>
 * Here are some more examples of how strings can be used:
 * <p><blockquote><pre>
 *     System.out.println("abc");
 *     String cde = "cde";
 *     System.out.println("abc" + cde);
 *     String c = "abc".substring(2,3);
 *     String d = cde.substring(1, 2);
 * </pre></blockquote>
 * <p>
 * The class <code>String</code> includes methods for examining
 * individual characters of the sequence, for comparing strings, for
 * searching strings, for extracting substrings, and for creating a
 * copy of a string with all characters translated to uppercase or to
 * lowercase. Case mapping relies heavily on the information provided
 * by the Unicode Consortium's Unicode 3.0 specification. The
 * specification's UnicodeData.txt and SpecialCasing.txt files are
 * used extensively to provide case mapping.
 * <p>
 * The Java language provides special support for the string
 * concatenation operator (&nbsp;+&nbsp;), and for conversion of
 * other objects to strings. String concatenation is implemented
 * through the <code>StringBuffer</code> class and its
 * <code>append</code> method.
 * String conversions are implemented through the method
 * <code>toString</code>, defined by <code>Object</code> and
 * inherited by all classes in Java. For additional information on
 * string concatenation and conversion, see Gosling, Joy, and Steele,
 * <i>The Java Language Specification</i>.
 *
 * <p> Unless otherwise noted, passing a <tt>null</tt> argument to a constructor
 * or method in this class will cause a {@link NullPointerException} to be
 * thrown.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class String extends Object implements _Serializable//, Comparable, CharSequence
{
    /** The value is used for character storage. */
    private $value =array();

    /** The offset is the first index of the storage that is used. */
    private $offset;

    /** The count is the number of characters in the String. */
    private $count;

    /** Cache the hash code for the string */
    private $hash = 0;

    /** use serialVersionUID from JDK 1.0.2 for interoperability */
    private static $serialVersionUID = -6849794470754667710;

   
    /**
     * Class String is special cased within the Serialization Stream Protocol.
     *
     * A String instance is written intially into an ObjectOutputStream in the
     * following format:
     * <pre>
     *      <code>TC_STRING</code> (utf String)
     * </pre>
     * The String is written by method <code>DataOutput.writeUTF</code>.
     * A new handle is generated to  refer to all future references to the
     * string instance within the stream.
     */
    //private static final ObjectStreamField[] serialPersistentFields =
    //    new ObjectStreamField[0];

    // This is the default constructor for now, so that it matches with the consistent php string -> japha String mapping
    public function __construct( $string )
    {
	    $this->value = $string;
    }
    
    /**
     * Initializes a newly created <code>String</code> object so that it
     * represents an empty character sequence.  Note that use of this 
     * constructor is unnecessary since Strings are immutable. 
     */
    public function String0() 
    {
        $this->value = array();
    }

    /**
     * Initializes a newly created <code>String</code> object so that it
     * represents the same sequence of characters as the argument; in other
     * words, the newly created string is a copy of the argument string. Unless 
     * an explicit copy of <code>original</code> is needed, use of this 
     * constructor is unnecessary since Strings are immutable. 
     *
     * @param   original   a <code>String</code>.
     */
     public function String1( $original )
     {
         $this->count = strlen( $original ) ;
         // The array representing the String is the same
         // size as the String, so no point in making a copy.
         $this->value = $original;
     }
     
    /**
     * Allocates a new <code>String</code> so that it represents the
     * sequence of characters currently contained in the character array
     * argument. The contents of the character array are copied; subsequent
     * modification of the character array does not affect the newly created
     * string.
     *
     * @param  value   the initial value of the string.
     */
    public function String2( $value=array() ) 
    {
        $this->count = count( $value );
        System::arraycopy( $value, 0, $this->value, 0, $count );
    }

    /**
     * Allocates a new <code>String</code> that contains characters from
     * a subarray of the character array argument. The <code>offset</code>
     * argument is the index of the first character of the subarray and
     * the <code>count</code> argument specifies the length of the
     * subarray. The contents of the subarray are copied; subsequent
     * modification of the character array does not affect the newly
     * created string.
     *
     * @param      value    array that is the source of characters.
     * @param      offset   the initial offset.
     * @param      count    the length.
     * @exception  IndexOutOfBoundsException  if the <code>offset</code>
     *               and <code>count</code> arguments index characters outside
     *               the bounds of the <code>value</code> array.
     */
    public function String3( $value, $offset, $count ) 
    {
        if ( $offset < 0 ) 
        {
            throw new StringIndexOutOfBoundsException( $offset );
        }
        if ( $count < 0 ) 
        {
            throw new StringIndexOutOfBoundsException( $count );
        }
        // Note: offset or count might be near -1>>>1.
        if ( $offset > count( $value ) - $count ) 
        {
            throw new StringIndexOutOfBoundsException( $offset + $count );
        }
        $this->value = array();
        $this->count = $count;
        System::arraycopy( $value, $offset, $this->value, 0, $count );
    }

    /**
     * Allocates a new string that contains the sequence of characters
     * currently contained in the string buffer argument. The contents of
     * the string buffer are copied; subsequent modification of the string
     * buffer does not affect the newly created string.
     *
     * @param   buffer   a <code>StringBuffer</code>.
     */
    /*
    public function String ( StringBuffer $buffer ) 
    {
            $buffer->setShared();
            $this->value = $buffer->getValue();
            $this->offset = 0;
            $this->count = $buffer->length();
    }
    */

    /**
     * Returns the length of this string.
     * The length is equal to the number of 16-bit
     * Unicode characters in the string.
     *
     * @return  the length of the sequence of characters represented by this
     *          object.
     */
    public function length() 
    {
        return $count;
    }

    /**
     * Returns the character at the specified index. An index ranges
     * from <code>0</code> to <code>length() - 1</code>. The first character
     * of the sequence is at index <code>0</code>, the next at index
     * <code>1</code>, and so on, as for array indexing.
     *
     * @param      index   the index of the character.
     * @return     the character at the specified index of this string.
     *             The first character is at index <code>0</code>.
     * @exception  IndexOutOfBoundsException  if the <code>index</code>
     *             argument is negative or not less than the length of this
     *             string.
     */
    public function charAt( $index ) 
    {
        if ( ( $index < 0 ) || ( $index >= $count ) ) 
        {
            throw new StringIndexOutOfBoundsException( $index );
        }
        return $this->value[ $index + $offset ];
    }

    /**
     * Copies characters from this string into the destination character
     * array.
     * <p>
     * The first character to be copied is at index <code>srcBegin</code>;
     * the last character to be copied is at index <code>srcEnd-1</code>
     * (thus the total number of characters to be copied is
     * <code>srcEnd-srcBegin</code>). The characters are copied into the
     * subarray of <code>dst</code> starting at index <code>dstBegin</code>
     * and ending at index:
     * <p><blockquote><pre>
     *     dstbegin + (srcEnd-srcBegin) - 1
     * </pre></blockquote>
     *
     * @param      srcBegin   index of the first character in the string
     *                        to copy.
     * @param      srcEnd     index after the last character in the string
     *                        to copy.
     * @param      dst        the destination array.
     * @param      dstBegin   the start offset in the destination array.
     * @exception IndexOutOfBoundsException If any of the following
     *            is true:
     *            <ul><li><code>srcBegin</code> is negative.
     *            <li><code>srcBegin</code> is greater than <code>srcEnd</code>
     *            <li><code>srcEnd</code> is greater than the length of this
     *                string
     *            <li><code>dstBegin</code> is negative
     *            <li><code>dstBegin+(srcEnd-srcBegin)</code> is larger than
     *                <code>dst.length</code></ul>
     */
    public function getChars( $srcBegin, $srcEnd, $dst, $dstBegin ) 
    {
        if ( $srcBegin < 0 ) 
        {
            throw new StringIndexOutOfBoundsException( $srcBegin );
        }
        if ( $srcEnd > $count ) 
        {
            throw new StringIndexOutOfBoundsException( $srcEnd );
        }
        if ( $srcBegin > $srcEnd ) 
        {
            throw new StringIndexOutOfBoundsException( $srcEnd - $srcBegin );
        }
        System::arraycopy( $value, $offset + $srcBegin, $dst, $dstBegin, $srcEnd - $srcBegin );
    }

    /**
     * Copies characters from this string into the destination byte
     * array. Each byte receives the 8 low-order bits of the
     * corresponding character. The eight high-order bits of each character
     * are not copied and do not participate in the transfer in any way.
     * <p>
     * The first character to be copied is at index <code>srcBegin</code>;
     * the last character to be copied is at index <code>srcEnd-1</code>.
     * The total number of characters to be copied is
     * <code>srcEnd-srcBegin</code>. The characters, converted to bytes,
     * are copied into the subarray of <code>dst</code> starting at index
     * <code>dstBegin</code> and ending at index:
     * <p><blockquote><pre>
     *     dstbegin + (srcEnd-srcBegin) - 1
     * </pre></blockquote>
     *
     * @deprecated This method does not properly convert characters into bytes.
     * As of JDK&nbsp;1.1, the preferred way to do this is via the
     * the <code>getBytes()</code> method, which uses the platform's default
     * charset.
     *
     * @param      srcBegin   index of the first character in the string
     *                        to copy.
     * @param      srcEnd     index after the last character in the string
     *                        to copy.
     * @param      dst        the destination array.
     * @param      dstBegin   the start offset in the destination array.
     * @exception IndexOutOfBoundsException if any of the following
     *            is true:
     *           <ul><li><code>srcBegin</code> is negative
     *           <li><code>srcBegin</code> is greater than <code>srcEnd</code>
     *           <li><code>srcEnd</code> is greater than the length of this
     *            String
     *           <li><code>dstBegin</code> is negative
     *           <li><code>dstBegin+(srcEnd-srcBegin)</code> is larger than
     *            <code>dst.length</code></ul>
     */
    public function getBytes( $srcBegin, $srcEnd, $dst, $dstBegin ) 
    {
        if ( $srcBegin < 0 ) 
        {
            throw new StringIndexOutOfBoundsException( $srcBegin );
        }
        if ( $srcEnd > $count ) 
        {
            throw new StringIndexOutOfBoundsException( $srcEnd );
        }
        if ( $srcBegin > $srcEnd ) 
        {
            throw new StringIndexOutOfBoundsException( $srcEnd - $srcBegin );
        }
        $j = $dstBegin;
        $n = $offset + $srcEnd;
        $i = $offset + $srcBegin;
        $val = $this->value;   /* avoid getfield opcode */

        while ( $i < $n ) 
        {
            $dst[ $j++ ] = $val[ $i++ ];
        }
    }

    /**
     * Compares this string to the specified object.
     * The result is <code>true</code> if and only if the argument is not
     * <code>null</code> and is a <code>String</code> object that represents
     * the same sequence of characters as this object.
     *
     * @param   anObject   the object to compare this <code>String</code>
     *                     against.
     * @return  <code>true</code> if the <code>String </code>are equal;
     *          <code>false</code> otherwise.
     * @see     java.lang.String#compareTo(java.lang.String)
     * @see     java.lang.String#equalsIgnoreCase(java.lang.String)
     */
     public function equals( $anObject ) 
     {
         if ( $this == $anObject ) 
         {
             return true;
         }
         if ( $anObject instanceof String ) 
         {
		 	return $anObject->toString() == $this->toString();
            $anotherString = $anObject;
            $n = $this->count;
            if ( $n == $anotherString->count ) 
            {
                $v1 = $value;
                $v2 = $anotherString->value;
                $i = $offset;
                $j = $anotherString->offset;
                while ( $n-- != 0 ) 
                {
                    if ( $v1[ $i++ ] != $v2[ $j++ ] )
                    return false;
                }
                return true;
            }
         }
         return $this === $anObject;
     }

    /**
     * Returns <tt>true</tt> if and only if this <tt>String</tt> represents
     * the same sequence of characters as the specified <tt>StringBuffer</tt>.
     *
     * @param   sb         the <tt>StringBuffer</tt> to compare to.
     * @return  <tt>true</tt> if and only if this <tt>String</tt> represents
     *          the same sequence of characters as the specified
     *          <tt>StringBuffer</tt>, otherwise <tt>false</tt>.
     * @since 1.4
     */
     public function contentEquals( StringBuffer $sb )
     {
         if ( $this->count != $sb->length() )
         {
             return false;
         }
         $v1 = $this->value;
         $v2 = $sb->getValue();
         $i = $offset;
         $j = 0;
         $n = $count;
         while ( $n-- != 0 )
         {
             if ( $v1[ $i++ ] != $v2[ $j++ ] )
             {
                 return false;
             }
         }
         return true;
     }

    /**
     * Returns a hash code for this string. The hash code for a
     * <code>String</code> object is computed as
     * <blockquote><pre>
     * s[0]*31^(n-1) + s[1]*31^(n-2) + ... + s[n-1]
     * </pre></blockquote>
     * using <code>int</code> arithmetic, where <code>s[i]</code> is the
     * <i>i</i>th character of the string, <code>n</code> is the length of
     * the string, and <code>^</code> indicates exponentiation.
     * (The hash value of the empty string is zero.)
     *
     * @return  a hash code value for this object.
     */
    public function hashCode() 
    {
	$h = $this->hash;
	if ( $h == 0 ) 
	{
	    $off = $this->offset;
	    $val = $this->value;
	    $len = $this->count;
            for ( $i = 0; $i < $len; $i++ ) 
            {
                $h = 31 * $h + $val[ $off++ ];
            }
            $this->hash = $h;
        }
        return $h;
    }
    
    public function toString()
    {
	    return $this->value;
    }
}
?>