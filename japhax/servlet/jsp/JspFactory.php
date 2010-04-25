<?
package("japhax.servlet.jsp");

/**
 * $Id$
 *
 * The JspFactory is an abstract class that defines a number of factory methods available to a 
 * JSP page at runtime for the purposes of creating instances of various interfaces and classes 
 * used to support the JSP implementation. 
 *
 * A conformant JSP Engine implementation will, during it's initialization instantiate an 
 * implementation dependent subclass of this class, and make it globally available for use by 
 * JSP implementation classes by registering the instance created with this class via the static 
 * setDefaultFactory() method. 
 *
 * The PageContext and the JspEngineInfo classes are the only implementation-dependent classes 
 * that can be created from the factory. 
 *
 * JspFactory objects should not be used by JSP page authors. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
abstract class JspFactory extends Object
{
	/**
	 * @returns the default factory for this implementation
	 */
	public function getDefaultFactory(){}
	
	/**
	 * Called to get implementation-specific information on the current JSP engine 
	 * @returns a JspEngineInfo object describing the current JSP engine
	 */
	public function getEngineInfo(){}
	
	/**
	 * Obtains an instance of an implementation dependent javax.servlet.jsp.PageContext 
	 * abstract class for the calling Servlet and currently pending request and response. 
	 *
	 * This method is typically called early in the processing of the _jspService() method 
	 * of a JSP implementation class in order to obtain a PageContext object for the request 
	 * being processed. 
	 *
	 * Invoking this method shall result in the PageContext.initialize() method being invoked. 
	 * The PageContext returned is properly initialized. 
	 *
	 * All PageContext objects obtained via this method shall be released by invoking 
	 * releasePageContext(). 
	 *
	 * @param servlet the requesting servlet
	 * @param config the ServletConfig for the requesting Servlet
	 * @param request the current request pending on the servlet
	 * @param response the current response pending on the servlet
	 * @param errorPageURL the URL of the error page for the requesting JSP, or null
	 * @param needsSession true if the JSP participates in a session
	 * @param buffer size of buffer in bytes, PageContext.NO_BUFFER if no buffer, PageContext.DEFAULT_BUFFER if implementation default.
	 * @param autoflush should the buffer autoflush to the output stream on buffer overflow, or throw an IOException?
	 * @returns the page context
	 * @see PageContext
	 */
	public function getDefaultContext( 	Servlet $servlet, 
										ServletRequest $request,
										ServletResponse $response,
										$errorPageUrl,
										$needsSession,
										$buffer,
										$autoFlush ){}
										
	/**
	 * called to release a previously allocated PageContext object. Results in 
	 * PageContext.release() being invoked. This method should be invoked prior to returning 
	 * from the _jspService() method of a JSP implementation class. 
	 *
	 * @param pc A PageContext previously obtained by getPageContext()
	 */
	public function releasePageContext( PageContext $pc ){}
	
	/**
	 * set the default factory for this implementation. It is illegal for any principal other 
	 * than the JSP Engine runtime to call this method. 
	 *
	 * @param default The default factory implementation
	 */
	public function setDefaultFactory( JspFactory $default ){}
}
?>