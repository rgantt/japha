<?
package("japhax.servlet.jsp");

import("japha.lang.Object");

/**
 * $Id: JspEngineInfo.php,v 1.3 2004/07/20 21:12:42 japha Exp $
 *
 * The JspEngineInfo is an abstract class that provides information on the current JSP engine.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $ $Date: 2004/07/20 21:12:42 $
 */
abstract class JspEngineInfo extends Object
{
	/**
	 * Return the version number of the JSP specification that is supported by this JSP engine. 
	 * Specification version numbers that consists of positive decimal integers separated by 
	 * periods ".", for example, "2.0" or "1.2.3.4.5.6.7". This allows an extensible number to 
	 * be used to represent major, minor, micro, etc versions. The version number must begin 
	 * with a number. 
	 *
	 * @returns the specification version, null is returned if it is not known
	 */
	abstract public function getSpecificationVersion();
}
?>