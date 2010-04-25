<?
package("org.xml.sax");

import("org.xml.sax.SAXException");

/** 
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
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