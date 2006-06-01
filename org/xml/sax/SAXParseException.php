<?
package("org.xml.sax");

import("org.xml.sax.SAXException");

/** 
 * $Id: SAXParseException.php,v 1.4 2004/07/20 21:12:42 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $
 */
class SAXParseException extends SAXException
{
	function __construct( $message, Locator $locator ){}
	
	public function getColumnNumber(){}
	public function getLineNumber(){}
	public function getPublicId(){}
	public function getSystemId(){}
}
?>