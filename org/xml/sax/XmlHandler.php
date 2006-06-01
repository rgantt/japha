<?
package("org.xml.sax");

/**
 * $Id: XmlHandler.php,v 1.3 2004/07/14 22:27:05 japha Exp $
 *
 * A universal xml handler for parsed XML data. All of these methods are actually imported at the end of
 * the file, making them globally avaiable throughout the file.
 *
 * The only thing this file will do when called is redisplay the xml file to the browser, making the full,
 * dull, pointless loop from XML->PHP->XML. It is only meant as an example of what to do with an XML
 * Handler class. The best move would be to chance the bodies of these functions to work with databases,
 * or open files, or authenticate... whatever you want.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $ $Date: 2004/07/14 22:27:05 $
 */
class XmlHandler extends Object
{
    /**
     * This method is called when the parser encounters an openeing element tag
     *
     * @access public
     * @param parser the parser object
     * @param name the name of the element
     * @param attribs an array of attributes for the element
     */
    public function startElement( $parser, $name, $attribs )
    {
        $sb = new StringBuffer("<");
        $sb->append($name);
        if(array_key_exists(0, $attribs))
        {
            var_dump($attribs);
        }
        else
        {
            foreach($attribs as $key => $value)
            {
                $sb->append(" ".$key."=\"".$value."\" ");   
            }   
        }
        $sb->append(">");
        echo $sb->toString();
    }
    
    /**
     * This method is called when the parser encounters a closing element tag
     *
     * @access public
     * @param parser the parser object
     * @param name the name of the element to close
     */
    public function endElement( $parser, $name )
    {
        $sb = new StringBuffer("</");
        $sb->append($name);
        $sb->append(">");
        echo $sb->toString();
    }
    
    /**
     * This method is called when the parser encounters character data within the opening and closing
     * xml element tags
     *
     * @access public
     * @param parser the parser object
     * @param data the character data to parse
     */
    public function characterData( $parser, $data )
    {
        echo $data;
    }
}

// Import all of the methods from the class so that they can be used globally throughout the file
# They took off the damn 'import' statement in beta 1 -- WTF!
function startElement( $parser, $name, $attribs )
{
	XmlHandler::startElement( $parser, $name, $attribs );
}

function endElement( $parser, $name )
{
	XmlHandler::endElement( $parser, $name );
}

function characterData( $parser, $data )
{
	XmlHandler::characterData( $parser, $data );
}
?>
