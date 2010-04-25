<?
package("org.xml.sax");

import("org.xml.sax.Xml");

/**
 * $Id$
 *
 * Defines the guidelines that all XML parsing classes must follow.
 *
 * The main point of an XML parser is to, obviously, run over XML
 * data and handle element opening and closing tags, and handle the 
 * character data within those tags, until E.O.F. is reached.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class XmlParser extends Object implements XML
{
    /**
     * The parser object... NULL/False until you create a new one
     *
     * @access private
     * @var
     */
    private $parser = false;
    
    /**
     * The file to parse
     *
     * @access protected
     * #var
     */
    protected $file;
    
    /**
     * Creats a mew instance of the class on a certain file
     *
     * @access public
     * @param fileName the path of the file to iterate over
     */
    public function __construct( $fileName )
    {
        $this->file = $fileName;
    }
    
    /**
     * Create a new parser object within the class
     *
     * @access public
     * @abstract
     */
    abstract public function parserCreate();
    
    /**
     * Sets an option on the current parser -- parser must exist
     *
     * @access public
     * @abstract
     * @param option the option to set
     * @param bool the true or false response to set this option to
     */
    abstract public function setOption( $option, $bool );
    
    /**
     * Releases (deletes) the current parser -- parser must exist
     *
     * @access public
     * @abstract
     */
    abstract public function parserFree();
    
    /**
     * Sets the element handler method for the current parser -- parser must exist
     *
     * @access public
     * @abstract
     * @param sFunciton the function to use for opening xml tags
     * @param eFunction the funciton to use for closing xml tags
     */
    //abstract public function setElementHandler( $sFunction, $eFunction );
    
    /**
     * Sets the character data handler for the current parser -- parser must exist
     *
     * @access public
     * @abstract
     * @param function the function//method to use for parsing character data
     */
    //abstract public function setCharacterDataHandler( $function );
    
    /**
     * Sets an object... ??
     *
     * @access public
     * @abstract
     * @param obj the object to set
     */
    abstract public function setObject( $obj );
    
    /**
     * Run the parser over the data -- parser must exist
     *
     * @access public
     * @abstract
     * @param data the data to iterate over
     * @param end a hint on when to stop parsing... ex// feof()
     */
    //abstract public function parse( $data, $end );
}
?>