<?
package("org.xml.sax");

/**
 * $Id$
 *
 * The purpose of the XML interface is to define guidelines for child classes, so that we can have unity
 * whether we are working with the SAX or the DOM.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface XML
{
    /**
     * Sets the default function for the element openings and closings
     * This must be a FUNCTION, NOT a METHOD... If you need to use a method from a class, use the import
     * statement to make that function global to the file
     * 
     * @access public
     * @param sFunction the function to handle opening tags
     * @param eFunction the funciton to handle closing tags
     */
    public function setElementHandler( $sFunction, $eFunction );
    
    /**
     * Sets the default function for the character data within the element tags
     * This must be a FUNCTION, NOT a METHOD... If you need to use a method from a class, use the import
     * statement to make that function global to the file
     *
     * @access public
     * @param function the function to use for handling character data
     */
    public function setCharacterDataHandler( $function );
    
    /**
     * You must define a method in the class that you are implementing this interface from that will
     * parse through the elements and die on errors and such. Remember to exit gracefull, since XML
     * is kind of a touchy format.
     *
     * @access public
     */
    public function parse(); 
}
?>