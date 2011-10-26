<?php
package("japhax.servlet.jsp");

import("japhax.servlet.jsp.JspPage");

/**
 * $Id$
 *
 * The HttpJspPage interface describes the interaction that a JSP Page Implementation Class 
 * must satisfy when using the HTTP protocol. 
 *
 * The behaviour is identical to that of the JspPage, except for the signature of the 
 * _jspService method, which is now expressible in the Java type system and included explicitly 
 * in the interface. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface HttpJspPage extends JspPage
{
	/**
	 * The _jspService()method corresponds to the body of the JSP page. This method is defined 
	 * automatically by the JSP container and should never be defined by the JSP page author. 
	 * If a superclass is specified using the extends attribute, that superclass may choose 
	 * to perform some actions in its service() method before or after calling the _jspService() 
	 * method. See using the extends attribute in the JSP_Engine chapter of the JSP specification.
	 */
	public function _jspService( HttpServletRequest $req, HttpServletResponse $resp );
}