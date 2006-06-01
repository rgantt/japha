<?
package("japha.swing");

import("japhax.swing.PTextComponent");

/**
 * $Id: PTextArea.php,v 1.4 2004/07/14 22:27:05 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:05 $
 */
class PTextArea extends PTextComponent
{
    /**
     * The height of the text field
     *
     * @access public
     * @var
     */
    protected $rows = 0;
    
    /**
     * The width of the text field
     *
     * @access public
     * @var
     */
    protected $cols = 0;
    
    /**
     * Sets the default options for the textarea
     *
     * @access public
     * @param name The name of the component
     * @param rows The height of the text area
     * @param cols The width of the text area
     * @param value The default text value of the text area
     */
    function __construct( $name, $rows, $cols, $value )
    {
        $this->setName( $name );
        $this->setRows( $rows );
        $this->setCols( $cols );
        $this->setText( $value );
    }  
    
    /**
     * Mutates the number of rows (and thus, the height) of the text area
     *
     * @access public
     * @param rows The new height of the text area
     * @throws ArgumentDataTypeException if the passed value is not of type integer
     */
    public function setRows( $rows )
    {
        if(is_integer($rows))
        {
            $this->rows = $rows;
        }
        else
        {
            throw new Exception("ArgumentDataTypeException in PLabel::setRows( int ), argument must be of type integer!");
        }   
    }
    
    /**
     * Mutates the number of columns (and thus, the width) of the text area
     *
     * @access public
     * @param cols The new width of the text area
     * @throws ArgumentDataTypeException if the passed value is not of type integer
     */
    public function setCols( $cols )
    {
        if(is_integer($cols))
        {
            $this->cols = $cols;
        }
        else
        {
            throw new Exception("ArgumentDataTypeException in PLabel::setCols( int ), argument must be of type integer!");
        }   
    }
    
    /**
     * Returns the number of rows (the height) of the current text area
     *
     * @access public
     * @return int The number of rows in the text area
     */
    public function getRows()
    {
        return $this->rows;
    }
    
    /**
     * Returns the number of columns (the width) of the current text area
     *
     * @access public
     * @return int The number of columns in the text area
     */
    public function getCols()
    {
        return $this->cols;
    }
    
    /**
     * Creates a new text area based on the default values and the styles from the superclass
     *
     * @access public
     */
    public function genArea()
    {
        $sb = new StringBuffer("<textarea ");
        $sb->append("name=\"".$this->getName()."\" ");
        $sb->append("rows=\"".$this->getRows()."\" ");
        $sb->append("cols=\"".$this->getCols()."\" ");
        $sb->append("style=\"");
        
        $sb->append("border:".$this->getBorder()."px ".$this->getBorderStyle()."; ");
        $sb->append("background-color:".$this->getBackground()."; ");
        $sb->append("color:".$this->getForeground()."; ");
        $sb->append("font-family:".$this->getFont()."; ");
        $sb->append("font-size:".$this->getFontSize()."; ");
        if(!$this->getEnabled())
            $sb->append("disabled");
        $sb->append("\">");
        
        $sb->append($this->getText());
        $sb->append("</textarea>");
        return $sb;
    }
    
    /**
     * Paints the component to the screen, or returns its value to be drawn later
     *
     * @param return set to true if you want to return the component instead of displaying it
     * @return StringBuffer for use later on
     */
    public function paint( $return = false )
    {        
        $sb = $this->genArea();
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