<?
package("japhax.swing");

import("japhax.swing.PComponent");
/**
 * $Id$
 *
 * JTextComponent</code> is the base class for swing text 
 * components.  It tries to be compatible with the
 * <code>java.awt.TextComponent</code> class
 * where it can reasonably do so.  Also provided are other services
 * for additional flexibility (beyond the pluggable UI and bean
 * support).
 * You can find information on how to use the functionality
 * this class provides in
 * <a href="http://java.sun.com/docs/books/tutorial/uiswing/components/generaltext.html">General Rules for Using Text Components</a>,
 * a section in <em>The Java Tutorial.</em>
 *
 * <dl>
 * <dt><b><font size=+1>Caret Changes</font></b>
 * <dd>
 * The caret is a pluggable object in swing text components.
 * Notification of changes to the caret position and the selection
 * are sent to implementations of the <code>CaretListener</code>
 * interface that have been registered with the text component.
 * The UI will install a default caret unless a customized caret 
 * has been set.
 * 
 * <p>
 * <dt><b><font size=+1>Commands</font></b>
 * <dd>
 * Text components provide a number of commands that can be used
 * to manipulate the component.  This is essentially the way that
 * the component expresses its capabilities.  These are expressed
 * in terms of the swing <code>Action</code> interface,
 * using the <code>TextAction</code> implementation.
 * The set of commands supported by the text component can be
 * found with the <A HREF="../../../javax/swing/text/JTextComponent.html#getActions()"><CODE>getActions()</CODE></A> method.  These actions
 * can be bound to key events, fired from buttons, etc.
 * 
 * <p>
 * <dt><b><font size=+1>Text Input</font></b>
 * <dd>
 * The text components support flexible and internationalized text input, using 
 * keymaps and the input method framework, while maintaining compatibility with 
 * the AWT listener model.
 * <p>
 * A <A HREF="../../../javax/swing/text/Keymap.html"><CODE>Keymap</CODE></A> lets an application bind key
 * strokes to actions. 
 * In order to allow keymaps to be shared across multiple text components, they 
 * can use actions that extend <code>TextAction</code>.
 * <code>TextAction</code> can determine which <code>JTextComponent</code>
 * most recently has or had focus and therefore is the subject of 
 * the action (In the case that the <code>ActionEvent</code>
 * sent to the action doesn't contain the target text component as its source). 
 * <p>
 * The <a href="../../../../guide/imf/spec.html">input method framework</a>
 * lets text components interact with input methods, separate software
 * components that preprocess events to let users enter thousands of
 * different characters using keyboards with far fewer keys.
 * <code>JTextComponent</code> is an <em>active client</em> of 
 * the framework, so it implements the preferred user interface for interacting 
 * with input methods. As a consequence, some key events do not reach the text 
 * component because they are handled by an input method, and some text input 
 * reaches the text component as committed text within an <A HREF="../../../java/awt/event/InputMethodEvent.html"><CODE>InputMethodEvent</CODE></A> instead of as a key event.
 * The complete text input is the combination of the characters in
 * <code>keyTyped</code> key events and committed text in input method events.
 * <p>
 * The AWT listener model lets applications attach event listeners to
 * components in order to bind events to actions. Swing encourages the
 * use of keymaps instead of listeners, but maintains compatibility
 * with listeners by giving the listeners a chance to steal an event
 * by consuming it.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class PTextComponent extends PComponent
{
    /**
     * Whether or not this element can be accessed/pressed. Used for form elements.
     *
     * @access protected
     */
    protected $enabled = true;
    
    /*
     * Alt text for the current element
     *
     * @access protected
     */
    protected $toolTipText = "";
    
    /**
     * The text to display on the current element.
     *
     * @access protected
     */
    protected $text = "";
     
    /** 
     * Creates a new instance of this class.. of course 
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /** 
     * Mutates whether or not the current textComponent is editable 
     *
     * @access public
     * @param bool pass whatever you want the component to be set to
     */
    public function setEnabled( $bool )
    {
        if(is_bool($bool))
        {
            $this->enabled = $bool;   
        }   
        else
        {
            throw new Exception("ArugmentTypeException in PTextComponant::setEnabled( Bool ), first agrument must be of type Boolean!");
        }
    }
    
    /** 
     * Returns whether or not the current textComponent is editable 
     *
     * @access public
     * @return boolean true if the current Component is enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
    /** 
     * Sets the toolTip (alt) text for the current component 
     *
     * @access public
     * @param String the string to set the tooltip text to
     */
    public function setToolTipText( $String )
    {
        if(is_string($String))
        {
            $this->toolTipText = $String;
        }
        else
        {
            throw new Exception("ArgumentTypeException in PTextComponent::setToolTipText( String ), first argument must be of type String!");
        }
    }
    
    /** 
     * Returns the toolTip (alt) text for the current component 
     *
     * @access public
     * @return String the current tooltip text
     */
    public function getToolTipText()
    {
        return $this->toolTipText;
    }
    
    /** 
     * Sets the text value of the current component 
     *
     * @access public
     * @param String the text to set the current label to
     */
    public function setText( $String )
    {
        if(is_string($String))
        {
            $this->text = $String;
        }
        else
        {
            throw new Exception("ArgumentTypeException in PTextComponent::setText( String ), first argument must be of type String!");
        }
    }
    
    /** 
     * Returns the current text value of the current component 
     *
     * @access public
     * @return String the current label of the componet
     */
    public function getText()
    {
        return $this->text;   
    }
}
?>