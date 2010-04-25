<?
package("japhax.swing");

/**
 * $Id$
 *
 * The base class for all Swing components except top-level containers.
 * To use a component that inherits from <code>JComponent</code>,
 * you must place the component in a containment hierarchy
 * whose root is a top-level Swing container.
 * Top-level Swing containers --
 * such as <code>JFrame</code>, <code>JDialog</code>, 
 * and <code>JApplet</code> --
 * are specialized components
 * that provide a place for other Swing components to paint themselves.
 * For an explanation of containment hierarchies, see
 * <a href="http://java.sun.com/docs/books/tutorial/uiswing/overview/hierarchy.html">Swing Components and the Containment Hierarchy</a>,
 * a section in <em>The Java Tutorial</em>.
 *
 * <p>
 * The <code>JComponent</code> class provides:
 * <ul>
 * <li>The base class for both standard and custom components
 *    that use the Swing architecture.
 * <li>A "pluggable look and feel" (L&F) that can be specified by the
 *    programmer or (optionally) selected by the user at runtime.
 *    The look and feel for each component is provided by a 
 *    <em>UI delegate</em> -- an object that descends from
 *    <A HREF="../../javax/swing/plaf/ComponentUI.html"><CODE>ComponentUI</CODE></A>.
 *    See <a href="http://java.sun.com/docs/books/tutorial/uiswing/misc/plaf.html">How to 
 *    Set the Look and Feel</a>
 *    in <em>The Java Tutorial</em>
 *    for more information.
 *  <li>Comprehensive keystroke handling.
 *      See the document <a
 *  href="http://java.sun.com/products/jfc/tsc/special_report/kestrel/keybindings.html">Keyboard
 *      Bindings in Swing</a>,
 *      an article in <em>The Swing Connection</em>,
 *      for more information.
 *  <li>Support for tool tips --
 *      short descriptions that pop up when the cursor lingers
 *      over a component.
 *      See <a
 *  href="http://java.sun.com/docs/books/tutorial/uiswing/components/tooltip.html">How
 *      to Use Tool Tips</a>
 *      in <em>The Java Tutorial</em>
 *      for more information.
 *  <li>Support for accessibility.
 *      <code>JComponent</code> contains all of the methods in the
 *      <code>Accessible</code> interface,
 *      but it doesn't actually implement the interface.  That is the
 *      responsibility of the individual classes
 *      that extend <code>JComponent</code>.
 *  <li>Support for component-specific properties.
 *      With the <A HREF="../../javax/swing/JComponent.html#putClientProperty(java.lang.Object, java.lang.Object)"><CODE>putClientProperty(java.lang.Object, java.lang.Object)</CODE></A>
 *      and <A HREF="../../javax/swing/JComponent.html#getClientProperty(java.lang.Object)"><CODE>getClientProperty(java.lang.Object)</CODE></A> methods,
 *      you can associate name-object pairs
 *      with any object that descends from <code>JComponent</code>.
 *  <li>An infrastructure for painting
 *      that includes double buffering and support for borders.
 *      For more information see <a href="http://java.sun.com/docs/books/tutorial/uiswing/overview/draw.html">Painting</a> and
 *  <a href="http://java.sun.com/docs/books/tutorial/uiswing/misc/border.html">How
 *      to Use Borders</a>,
 *      both of which are sections in <em>The Java Tutorial</em>.
 *  </ul>
 *  For more information on these subjects, see the
 *  <a href="package-summary.html#package_description">Swing package description</a> 
 *  and <em>The Java Tutorial</em> section
 *  <a href="http://java.sun.com/docs/books/tutorial/uiswing/components/jcomponent.html">The JComponent Class</a>.
 *  <p>
 *  <strong>Warning:</strong>
 *  Serialized objects of this class will not be compatible with
 *  future Swing releases. The current serialization support is
 *  appropriate for short term storage or RMI between applications running
 *  the same version of Swing.  As of 1.4, support for long term storage
 *  of all JavaBeans<sup><font size="-2">TM</font></sup>
 *  has been added to the <code>java.beans</code> package.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
abstract class PComponent extends Object
{
    /*
     * Current status of border. Units are in pixels.
     *
     * @access protected
     */
    protected $border = 1;
    
    /**
     * Style of the border... The default is solid, and the value must be contained in the borders array
     *
     * @access protected
     */
    protected $borderStyle = "solid";
    
    /**
     * An array with all of the legal border styles
     *
     * @access constant
     */
    private $borders = array("dotted", "dashed", "double", "groove", "ridge", "inset", "outset", "none");
    
    /*
     * Height dimensions. Current, Preferred, Minimum, Maximum
     *
     * @access protected
     */
    protected $height, $pHeight, $minHeight, $maxHeight;
    
    /*
     * Width dimensions. Current, Preferred, Minimim, Maximum
     *
     * @access protected
     */
    protected $width, $pWidth, $minWidth, $maxWidth;
    
    /*
     * Font face. Must be compatible with XHTML 1.0
     *
     * @access protected
     */
    protected $font = "Arial";
    
    /*
     * Font face. Must be compatible with XHTML 1.0
     *
     * @access protected
     */
    protected $fontSize = 12;
    
    /*
     * Foreground (text) color for the current component.
     *
     * @access protected
     */
    protected $foreground = "black";

    /*
     * Background color for the current component.
     *
     * @access protected
     */
    protected $background = "white";
    
    /*
     * Sets whether scrollbars should be displayed on the current element.
     *
     * @access protected
     */
    protected $autoScrolls = true;
    
    /**
     * The name of the current form element
     *
     * @access protected
     */
    protected $name = "";
    
    /** 
     * Returns the current value of the background color, either in Hex or String format 
     *
     * @access public
     * @return String the string or hex representation of the current background color
     */
    public function getBackground()
    {
        return $this->background;   
    }
    
    /** 
     * Returns the current value of the foreground color, either in Hex or String format 
     *
     * @access public
     * @return String the string or hex representation of the current foreground color
     */
    public function getForeground()
    {
        return $this->foreground;   
    }
    
    /** 
     * Returns the current border width, in pixels 
     *
     * @access public
     * @return int the width of the current border (in pixels)
     */
    public function getBorder()
    {
        return (int)$this->border;
    }
    
    /** 
     * Returns the string value of the current border style 
     *
     * @access public
     * @return String the current border style
     */
    public function getBorderStyle()
    {
        return (String)$this->borderStyle;   
    }
    
    /** 
     * Returns the value of the current font face 
     *
     * @access public
     * @return String the current font face
     */
    public function getFont()
    {
        return (String)$this->font;   
    }
    
    /** 
     * Returns the current size of the font, in 72 dot/inch format 
     *
     * @access public
     * @return int the current font size (in pixels)
     */
    public function getFontSize()
    {
        return (int)$this->fontSize;   
    }
    
    /** 
     * Returns the default locale information of the current machine 
     *
     * @access public
     * @return String the current locale information
     */
    public function getDefaultLocale()
    {
        return setlocale(LC_ALL, NULL);
    }
    
    /** 
     * Returns the height of the current component object in pixels 
     *
     * @access public
     * @return int the current height (in pixels)
     */
    public function getHeight()
    {
        return (int)$this->height;
    }
    
    /** 
     * Returns the width of the currect component object in pixels 
     *
     * @access public
     * @return int the current width (in pixels)
     */
    public function getWidth()
    {
        return (int)$this->width;
    }
    
    /** */
    public function getPreferredSize()
    {
    }
    
    /** */
    public function getSize()
    {
    }
    
    /** 
     * Mutates the name of the current component (ex// in a PForm element)
     *
     * @access public
     * @param name String that contains the name of the component
     */
    public function setName( $name )
    {
        $this->name = $name;   
    }
    
    /** 
     * Returns the name of the current component 
     *
     * @access public
     * @return String the name of the current component
     */
    public function getName()
    {
        return $this->name;   
    }
    
    /** 
     * Returns true if the maximum preferred size is the same as the current size 
     *
     * @access public
     * @return boolean true iff the current size is the maximum allowed size
     */
    public function isMaximumSizeSet()
    {
        if(($this->height == $this->maxHeight) && ($this->width == $this->maxWidth))
        {
            return true;
        }
        else
        {
            return false;   
        }
    }
    
    /** 
     * Returns true if the minimum preferred size is the same as the current size 
     *
     * @access public
     * @return boolean true iff the current size is the minimum allowed size
     */
    public function isMinimumSizeSet()
    {
        if(($this->height == $this->minHeight) && ($this->width == $this->minWidth))
        {
            return true;
        }
        else
        {
            return false;   
        }
    }
    
    /** 
     * Returns true if the preferres size is the same as the current size 
     *
     * @access public
     * @return boolean true iff the current size is the preferred size
     */
    public function isPreferredSizeSet()
    {
        if(($this->height == $this->pHeight) && ($this->width == $this->pWidth))
        {
            return true;   
        }
        else
        {
            return false;
        }
    }
    
    /** 
     * Sets whether or not components should automatically have a scrollbar if they outgrow their frame 
     *
     * @access public
     * @param bool turn the autoscrolls on, or turn them off
     */
    public function setAutoScrolls( $bool )
    {
        if(is_boolean($bool))
        {
            $this->autoScrolls = $bool;
        }
        else
        {
            throw new ArgumentTypeException("PComponent::setAutoScrolls( Boolean ), argument must be of type Boolean!");
        }
    }
    
    /** 
     * Mutates the current background color 
     *
     * @access public
     * @param color String ocntaining the color to set the background to
     */
    public function setBackground( $color )
    {
        $this->background = $color;
    }
    
    /** 
     * Mutates the current border size in pixels 
     *
     * @access public
     * @param size int stating the new border size (in pixels)
     */
    public function setBorder( $size )
    {
        $this->border = $size;
    }
    
    /** 
     * Changes the locale information on this machine for the lifetime of the current component object 
     *
     * @access public
     * @param category The locale category ex // LC_ALL
     * @param the locale.. ex // en_us
     */
    public function setDefaultLocale( $category = "LC_ALL" , $locale = "en_US" )
    {
        setlocale( $category, $locale );
    }
    
    /**
     * Mutates the current font family of the component 
     *
     * @access public
     * @param font String containing the font size to change to
     */
    public function setFont( $font )
    {
        if(is_string($font))
        {
            $this->font = $font;
        }
        else
        {
            throw new ArgumentTypeException("PComponent::setFont( String ), argument must be of type String!");
        }
    }
    
    /** 
     * Mutates the current font size in 72 dots/inch format for the current component 
     *
     * @access public
     * @param size int containing the font size (in pixels)
     */
    public function setFontSize( $size )
    {
        $this->fontSize = $size;   
    }
    
    /** 
     * Sets the foreground color in Hex or String format for the current component 
     *
     * @access public
     * @param color String containing the color of the foreground
     */
    public function setForeground( $color )
    {
        $this->foreground = $color;
    }
    
    /** 
     * Set the maximum size in pixels for the current component 
     *
     * @access public
     * @param height The maximum allowed height
     * @param width The maximum allowed width
     */
    public function setMaximumSize( $height, $width )
    {
        $this->maxHeight = $height;
        $this->maxWidth = $width;
    }
    
    /** 
     * Set the minimum size in pixels for the current component 
     *
     * @access public
     * @param height The minimum allowed height
     * @param width The minumum allowed width
     */
    public function setMinimumSize( $height, $width )
    {
        $this->minHeight = $height;
        $this->minWidth = $width;
    }
    
    /** 
     * Sets the preferred size in pixels for the current component 
     *
     * @access public
     * @param height The preferred height
     * @param width The preferred width
     */
    public function setPreferredSize( $height, $width )
    {
        $this->pHeight = $height;
        $this->pWidth = $width;
    }
    
    /** 
     * Mutates the width of the current component 
     *
     * @access public
     * @param width The width of the component (in pixels)
     */
    public function setWidth( $width )
    {
        if(is_integer($width))
        {
            $this->width = $width;   
        }
        else
        {
            throw new ArgumentTypeException("PComponent::setWidth( Int ), argument must be of type Integer!");
        }
    }
    
    /** 
     * Mutates the border style of the current component 
     *
     * @access public
     * @param style The border style.. Must exist in the legal borders array
     */
    public function setBorderStyle( $style )
    {
        if(in_array($style, $this->borders))
        {
            $this->borderStyle = $style;   
        }
        else
        {       
            throw new BorderStyleException("PComponent::setBorderStyle( String ), argument must be a valid CSS border style!");
        }
    }
    
    /** 
     * Children of this class must define the paint method in order to be drawn! 
     *
     * @access public
     * @abstract
     */
    abstract public function paint();
}
?>