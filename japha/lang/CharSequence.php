<?php
namespace japha\lang;

/**
 * A CharSequence is a readable sequence of characters. 
 * This interface provides uniform, read-only access to many different kinds of character sequences. 
 * This interface does not refine the general contracts of the equals and hashCode methods. 
 * The result of comparing two objects that implement CharSequence is therefore, in general, undefined. 
 * Each object may be implemented by a different class, and there is no guarantee that each class will 
 * be capable of testing its instances for equality with those of the other. 
 * It is therefore inappropriate to use arbitrary CharSequence instances as elements in a set or as keys 
 * in a map. 
 */
interface CharSequence {
    /**
     * Returns the character at the specified index. An index ranges from zero to length() - 1. 
     * The first character of the sequence is at index zero, the next at index one, and so on, as for array indexing. 
     *
     * @desc Returns the character at the specified index.
     * @returns The specified character.
     * @param index The index of the charater to be returned
     * @access public
     * @throws IndexOutOfBoundsException if the <tt>index</tt> argument is negative or not less than <tt>length()</tt>.
     */
    public function charAt( $index );
    
    /**
     * Returns the length of this character sequence. The length is the number of 16-bit Unicode characters in the sequence. 
     * 
     * @desc Returns the length of this character sequence.
     * @access public
     * @returns The number of characters in this sequence.
     */
    public function length();
    
    /**
     * Returns a new character sequence that is a subsequence of this sequence. 
     * The subsequence starts with the character at the specified index and ends 
     * with the character at index end - 1. 
     * The length of the returned sequence is end - start, so if start == end then an 
     * empty sequence is returned. 
     *
     * @param start The start index, inclusive.
     * @param end The end index, exclusive.
     * @returns The specified subsequence. 
     * @access public
     * @throws IndexOutOfBoundsException - if start or end are negative, if end is greater than length(), or if start is greater than end
     */
    public function subSequence( $start, $end );
    
    /**
     * Returns a string containing the characters in this sequence in the same order as this sequence. 
     * The length of the string will be the length of this sequence. 
     *
     * @returns A string consisting of exactly this sequence of characters.
     * @access public
     * @overrides toString in class Object
     */
    public function toString();
}