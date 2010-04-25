<?
package("org.xml.sax");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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