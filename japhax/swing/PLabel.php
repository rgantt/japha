<?
package("japhax.swing");

import("japhax.swing.PTextComponent");

/**
 * $Id: PLabel.php,v 1.4 2004/07/14 22:27:04 japha Exp $
 *
 * A display area for a short text string or an image, or both. A label does not react to input events. 
 * As a result, it cannot get the keyboard focus. A label can, however, display a keyboard alternative 
 * as a convenience for a nearby component that has a keyboard alternative but can't display it. 
 *
 * A JLabel object can display either text, an image, or both. You can specify where in the label's 
 * display area the label's contents are aligned by setting the vertical and horizontal alignment. 
 * By default, labels are vertically centered in their display area. Text-only labels are leading 
 * edge aligned, by default; image-only labels are horizontally centered, by default. 
 *
 * You can also specify the position of the text relative to the image. By default, text is on the 
 * trailing edge of the image, with the text and image vertically aligned. 
 *
 * A label's leading and trailing edge are determined from the value of its ComponentOrientation 
 * property. At present, the default ComponentOrientation setting maps the leading edge to left and 
 * the trailing edge to right. 
 *
 * Finally, you can use the setIconTextGap method to specify how many pixels should appear between the 
 * text and the image. The default is 4 pixels. 
 *
 * Warning: Serialized objects of this class will not be compatible with future Swing releases. The 
 * current serialization support is appropriate for short term storage or RMI between applications 
 * running the same version of Swing. As of 1.4, support for long term storage of all JavaBeansTM has 
 * been added to the java.beans package. Please see XMLEncoder. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:04 $
 */
class PLabel extends PTextComponent
{
    /** 
     * Construct that constructs the object 
     *
     * @access public
     * @param name The name of the label to create
     * @param value The default value of the label
     */
    function __construct( $name, $value )
    {
        $this->setName( $name );
        $this->setText( $value );
    }  
    
    /** 
     * Creates the PLabel after (hopefully) all of the options have been set 
     *
     * @access public
     */
    public function genLabel()
    {
        $sb = new StringBuffer("<div ");
        
        $sb->append("style=\"");
        $sb->append("width:".$this->getWidth()."px; ");
        $sb->append("border:".$this->getBorder()."px ".$this->getBorderStyle()."; ");
        $sb->append("background-color:".$this->getBackground()."; ");
        $sb->append("color:".$this->getForeground()."; ");
        $sb->append("font-family:".$this->getFont()."; ");
        $sb->append("font-size:".$this->getFontSize()."; ");
        $sb->append("\">");
        $sb->append($this->getText());
        $sb->append("</div>\n");
        return $sb;   
    }
    
    /** 
     * Overridden paint method that shows the PLabel 
     *
     * @access public
     * @param return set to true if you want the label returned instead of echoed
     */
    public function paint( $return = false )
    {
        $sb = $this->genLabel();   
        if($return)
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