<?
package("japhax.swing");

import("japhax.swing.PComponent");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class PPanel extends PComponent
{
    /**
     * The number of rows in the current table
     *
     * @access protected
     * @var
     */
    protected $rows;
    
    /**
     * The numer of columns in the current table
     *
     * @access protected
     * @var
     */
    protected $cols;
    
    /**
     * Creates a new table based on the passed integers
     *
     * @access public
     * @param rows The number of rows in the table
     * @param cols The number of columns in the table
     */
    function __construct( $rows, $cols )
    {
        parent::__construct();
        if(is_integer($rows) && is_integer($cols))
        {
            $this->rows = $rows;
            $this->cols = $cols;
        }
        else
        {
            throw new Exception("ConstructorArgumentDataTypeException in PPanel::__construct( int, int ), argument must be of type integer!");   
        }
    }
    
    /**
     * Mutates the number of rows in the table
     *
     * @access public
     * @throws ArgumentDataTypeException If the passed number of rows is not of type integer
     * @param rows The number of rows
     */
    public function setRows( $rows )
    {
        if(is_integer($rows))
        {
            $this->rows = $rows;
        }
        else
        {
            throw new Exception("ArgumentDataTypeException in PPanel::setRows( int ), argument must be of type integer!");
        }   
    }
    
    /**
     * Returns the current number of rows
     *
     * @access public
     * @return int The number of current rows
     */
    public function getRows()
    {
        return $this->rows;   
    }
    
    /**
     * Mutates the number of columns in the table
     *
     * @access public
     * @throws ArgumentDataTypeException If the passed number of columns is not of type integer
     * @param cols The number of columns
     */
    public function setCols( $cols )
    {
        if(is_integer($cols))
        {
            $this->cols = $cols;
        }
        else
        {
            throw new Exception("ArgumentDataTypeException in PPanel::setCols( int ), argument must be of type integer!");
        }
    }
    
    /**
     * Returns the number of columns currently in the table
     *
     * @access public
     * @return int The number of columns in the table
     */
    public function getCols()
    {
        return $this->cols;   
    }
    
    /**
     * Creates a StringBuffer that will generate a new table based on the current row/col information
     * and the styles in the superclass
     *
     * @access public
     */
    public function genPanel()
    {
        $sb = new StringBuffer("<table border=\"1\">\n");
        for($i = 0; $i < $this->rows; $i++)
        {
            $sb->append("\t<tr>\n");
            for($j = 0; $j < $this->cols; $j++)
            {
                $sb->append("\t\t<td>&nbsp;</td>\n");   
            }   
            $sb->append("\t</tr>\n");
        }
        $sb->append("</table>\n");
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
        $sb = $this->genPanel();
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