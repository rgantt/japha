<?
package("japhax.xml.parsers");

/** 
 * $Id: SAXParser.php,v 1.3 2004/07/14 22:27:05 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class SaxParser extends Object
{
    /**
     * Creates a new instance of the XML parser on the passed file path
     *
     * @access public
     * @param fileName the path/filename to the file that will be parsed
     */
    public function __construct( $fileName )
    {
        parent::__construct( $fileName );
    }
    
    /**
     * Creates a new instance of the Sax Parser
     *
     * @access public
     * @throws ParserAlreadyExistsException if there is already an instance of the parser
     */
    public function parserCreate()
    {
        if($this->parser == false)
        {
            $this->parser = xml_parser_create();   
        }
        else
        {
            throw new Exception("ParserAlreadyExistsException in SaxParser::parserCreate() - You cannot have two xml parsers running in the same instance.");
        }
    }
    
    /**
     * Sets a boolean option on the parser
     *
     * @access public
     * @throws ParserNotCreatedException if there is no instance of the xml parser
     * @param option the text of the option to set
     * @param bool the boolean answer of the option, ex// true or false.. duh
     */
    public function setOption( $option, $bool )
    {
        if($this->parser != false)
        {
            xml_parser_set_option( $this->parser, $option, $bool );
        }
        else
        {
            throw new Exception("ParserNotCreatedException in XmlParser::setOption() - You must have an instance of an XML parser in order to set an option for it.");   
        }
    }
    
    /**
     * Delets (frees) the current instance of the parser
     *
     * @access public
     * @throws ParserNotCreatedException if no parser has been instantiated
     */
    public function parserFree()
    {
        if($this->parser != false)
        {
            xml_parser_free( $this->parser );   
            $this->parser = false;
        }
        else
        {
            throw new Exception("ParserNotCreatedException in XmlParser::parserFree() - You must have an instance of an XML parser in order to delete one.");
        }
    }
    
    /**
     * Sets the method of the default element tag handler
     *
     * @access public
     * @param sFunction the starting function handler
     * @param eFunction the ending function handler
     */
    public function setElementHandler( $sFunction, $eFunction )
    {
        xml_set_element_handler( $this->parser, $sFunction, $eFunction );
    }
    
    /**
     * Sets the method of the default character data handler
     *
     * @access public
     * @param function the character data handling function
     */
    public function setCharacterDataHandler( $function )
    {
        xml_set_character_data_handler( $this->parser, $function );
    }
    
    /** */
    public function setObject( $obj ){}
    
    /**
     * Parses a part of an xml file... Namely the part before the !end flag
     *
     * @access public
     * @param data the data to parse over
     * @param end the flag on which to end parsing
     */
    public function parse( $data, $end )
    {
        if($data !== $end)
        {
               
        }
    }
    
    /**
     * Parses the entire contents of an xml file
     *
     * @access public
     */
    public function parseFile()
    {
        $fp = fopen( $this->file, 'r' ) or die("Can't read xml data.");
        
        while( $data = fread($fp, 4096) )
        {
            xml_parse($this->parser, $data, feof($fp)) or die("Can't parse xml data." . $php_errormsg);
        }
        
        fclose($fp);   
    }
}
?>