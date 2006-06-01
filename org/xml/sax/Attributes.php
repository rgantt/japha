<?
package("org.xml.sax");

/**
 * $Id: Attributes.php,v 1.2 2004/07/30 23:33:41 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.2 $
 */
interface Attributes
{
    public function getIndex();
    
    public function	getLength();
    
    public function	getLocalName( $index );
    
    public function getQName( $index );
    
    public function getType();
    
    public function getURI( $index );
    
    public function getValue();
}
?>