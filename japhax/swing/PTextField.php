<?
package("japhax.swing");

import("japhax.swing.PTextComponent");

/** 
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class PTextField extends PTextComponent
{
    /**
     * The name of the current component
     *
     * @access protected
     */
    protected $name;
    
    /**
     * The maximum field length of the current component
     *
     * @access protected
     */
    protected $maxLength;
    
    /**
     * Creates a new TextComponent based on the passed information
     *
     * @access public
     * @param name the name of the component
     * @param length the length of the component
     * @param maxLength the maximum field length of the component
     * @param value the default value of the current component
     */
    function __construct( $name, $length, $maxLength, $value = "" )
    {
        parent::__construct();
        $this->setName( $name );
        $this->setText( $value );
        $this->setWidth( $length );
        $this->setMaxLength( $maxLength );
    }
    
    /**
     * Sets the maximum length of the component
     *
     * @access public
     * @param length the length
     */
    public function setMaxLength( $length )
    {
        $this->maxLength = $length;   
    }
    
    /**
     * Returns the maximum length of the component
     *
     * @access public
     * @return int the current maximum field length
     */
    public function getMaxLength()
    {
        return $this->maxLength;   
    }
    
    /**
     * Does all of the work in creating the TextField
     *
     * @access public
     */
    private function genField()
    {
        // Create a new StringBuffer for our PTextField
        $sb = new StringBuffer("<input type=\"text\" ");
        $sb->append("name=\"".$this->getName()."\" ");
        $sb->append("value=\"".$this->getText()."\" ");
        
        // Append the styles to the PTextField
        $sb->append("style=\"");
        $sb->append("width:".$this->getWidth()."px; ");
        $sb->append("border:".$this->getBorder()."px ".$this->getBorderStyle()."; ");
        $sb->append("font-family:".$this->getFont()."; ");
        $sb->append("font-size:".$this->getFontSize()."; ");
        $sb->append("background-color:".$this->getBackground()."; ");
        $sb->append("color:".$this->getForeground()."; ");
        $sb->append("\" ");
        
        // Don't know the style for maximum length... Will use this for now.
        $sb->append("maxlength=\"".$this->getMaxLength()."\" ");
        if(!$this->getEnabled())
            $sb->append("disabled");
        $sb->append("/>\n");
        
        return $sb;   
    }
    
    /**
     * Paints the TextField to the screen
     *
     * @access public
     * @return StringBuffer the converted textField
     */
    public function paint( $return = false )
    {        
        $sb = $this->genField();
        if( $return )
        {
            return $sb->toString();
        }
        else
        {
            echo $sb->toString();   
        }   
    }
}
?>