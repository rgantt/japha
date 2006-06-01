<?
package("japhax.servlet.jsp");

import("japhax.servlet.Servlet");

/**
 * $Id: JspPage.php,v 1.2 2004/07/14 22:27:04 japha Exp $
 *
 * The JspPage interface describes the generic interaction that a JSP Page Implementation 
 * class must satisfy; pages that use the HTTP protocol are described by the HttpJspPage 
 * interface. 
 *
 * Two plus One Methods 
 *
 * The interface defines a protocol with 3 methods; only two of them: jspInit() and 
 * jspDestroy() are part of this interface as the signature of the third method: 
 * _jspService() depends on the specific protocol used and cannot be expressed in a 
 * generic way in Java. 
 *
 * A class implementing this interface is responsible for invoking the above methods at the 
 * appropriate time based on the corresponding Servlet-based method invocations. 
 *
 * The jspInit() and jspDestroy() methods can be defined by a JSP author, but the 
 * _jspService() method is defined automatically by the JSP processor based on the contents 
 * of the JSP page. 
 *
 * _jspService() 
 *
 * The _jspService()method corresponds to the body of the JSP page. This method is defined 
 * automatically by the JSP container and should never be defined by the JSP page author. 
 *
 * If a superclass is specified using the extends attribute, that superclass may choose to 
 * perform some actions in its service() method before or after calling the _jspService() 
 * method. See using the extends attribute in the JSP_Engine chapter of the JSP specification. 
 *
 * The specific signature depends on the protocol supported by the JSP page. 
 *
 * public void _jspService(ServletRequestSubtype request, ServletResponseSubtype response)
 *       throws ServletException, IOException;
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.2 $ $Date: 2004/07/14 22:27:04 $
 */
interface JspPage extends Servlet
{
	/**
	 * The jspDestroy() method is invoked when the JSP page is about to be destroyed. A JSP 
	 * page can override this method by including a definition for it in a declaration 
	 * element. A JSP page should redefine the destroy() method from Servlet.
	 */
	public function jspDestroy();
	
	/**
	 * The jspInit() method is invoked when the JSP page is initialized. It is the 
	 * responsibility of the JSP implementation (and of the class mentioned by the extends 
	 * attribute, if present) that at this point invocations to the getServletConfig() method 
	 * will return the desired value. A JSP page can override this method by including a 
	 * definition for it in a declaration element. A JSP page should redefine the init() 
	 * method from Servlet.
	 */
	public function jspInit();
}