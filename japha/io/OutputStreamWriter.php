<?
package("japha.io");

import("japha.io.Writer");

/**
 * $Id$
 *
 * An OutputStreamWriter is a bridge from character streams to byte streams: Characters written to it 
 * are encoded into bytes using a specified charset. The charset that it uses may be specified by 
 * name or may be given explicitly, or the platform's default charset may be accepted. 
 *
 * Each invocation of a write() method causes the encoding converter to be invoked on the given 
 * character(s). The resulting bytes are accumulated in a buffer before being written to the underlying 
 * output stream. The size of this buffer may be specified, but by default it is large enough for most 
 * purposes. Note that the characters passed to the write() methods are not buffered. 
 *
 * For top efficiency, consider wrapping an OutputStreamWriter within a BufferedWriter so as to avoid 
 * frequent converter invocations. For example: 
 *
 * Writer out = new BufferedWriter( new OutputStreamWriter( System.out ) );
 *
 * A surrogate pair is a character represented by a sequence of two char values: A high surrogate in 
 * the range '\uD800' to '\uDBFF' followed by a low surrogate in the range '\uDC00' to '\uDFFF'. If the 
 * character represented by a surrogate pair cannot be encoded by a given charset then a charset-dependent 
 * substitution sequence is written to the output stream. 
 *
 * A malformed surrogate element is a high surrogate that is not followed by a low surrogate or a low 
 * surrogate that is not preceeded by a high surrogate. It is illegal to attempt to write a character 
 * stream containing malformed surrogate elements. The behavior of an instance of this class when a 
 * malformed surrogate element is written is not specified. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class OutputStreamWriter extends Writer
{
}
?>