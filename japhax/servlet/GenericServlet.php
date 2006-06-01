<?
package("japhax.servlet");

import("japhax.servlet.Servlet");
import("japhax.servlet.ServletConfig");

/**
 * $Id: GenericServlet.php,v 1.3 2004/07/20 21:12:42 japha Exp $
 *
 * Defines a generic, protocol-independent servlet. To write an HTTP servlet for use on the Web, 
 * extend HttpServlet instead. 
 *
 * GenericServlet implements the Servlet and ServletConfig interfaces. GenericServlet may be 
 * directly extended by a servlet, although it's more common to extend a protocol-specific 
 * subclass such as HttpServlet. 
 *
 * GenericServlet makes writing servlets easier. It provides simple versions of the lifecycle 
 * methods init and destroy and of the methods in the ServletConfig interface. GenericServlet 
 * also implements the log method, declared in the ServletContext interface. 
 *
 * To write a generic servlet, you need only override the abstract service method. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $ $Date: 2004/07/20 21:12:42 $
 */
abstract class GenericServlet extends Object implements Servlet, ServletConfig, Serializable 
{
	//abstract public function destroy();
	abstract public function getInitParameter( $name );
	abstract public function getInitParameterNames();
	//abstract public function getServletConfig();
	abstract public function getServletContext();
	//abstract public function getServletInfo();
	abstract public function getServletName();
	//abstract public function init();
	abstract public function log();
	//abstract public function service( ServletRequest $req, ServletResponse $resp );
}
?>