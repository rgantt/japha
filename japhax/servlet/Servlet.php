<?php
namespace japhax\servlet;

/**
 * To implement this interface, you can write a generic servlet that extends 
 * javax.servlet.GenericServlet or an HTTP servlet that extends javax.servlet.http.HttpServlet. 
 *
 * This interface defines methods to initialize a servlet, to service requests, and to remove 
 * a servlet from the server. These are known as life-cycle methods and are called in the 
 * following sequence: 
 *
 * <ol><li/>The servlet is constructed, then initialized with the init method. 
 * <li/>Any calls from clients to the service method are handled. 
 * <li/>The servlet is taken out of service, then destroyed with the destroy method, then garbage collected and finalized. </ol>
 * 
 * In addition to the life-cycle methods, this interface provides the getServletConfig method, 
 * which the servlet can use to get any startup information, and the getServletInfo method, 
 * which allows the servlet to return basic information about itself, such as author, version, 
 * and copyright.
 */
interface Servlet {
	/**
	 * Called by the servlet container to indicate to a servlet that the servlet is being 
	 * taken out of service. This method is only called once all threads within the 
	 * servlet's service method have exited or after a timeout period has passed. After the 
	 * servlet container calls this method, it will not call the service method again on 
	 * this servlet. This method gives the servlet an opportunity to clean up any resources 
	 * that are being held (for example, memory, file handles, threads) and make sure that 
	 * any persistent state is synchronized with the servlet's current state in memory.
	 */
	public function destroy();
	
	/**
	 * Returns a ServletConfig object, which contains initialization and startup parameters 
	 * for this servlet. The ServletConfig object returned is the one passed to the init method. 
	 * Implementations of this interface are responsible for storing the ServletConfig object 
	 * so that this method can return it. The GenericServlet class, which implements this 
	 * interface, already does this.
	 *
	 * @returns the ServletConfig object that initializes this servlet
	 * @see init(javax.servlet.ServletConfig)
	 */
	public function getServletConfig();
	
	/**
	 * Returns information about the servlet, such as author, version, and copyright. 
	 * The string that this method returns should be plain text and not markup of any kind 
	 * (such as HTML, XML, etc.).
	 *
	 * @returns a String containing servlet information
	 */
	public function getServletInfo();
	
	/**
	 * Called by the servlet container to indicate to a servlet that the servlet is being 
	 * placed into service.
	 * 
	 * The servlet container calls the init method exactly once after instantiating the 
	 * servlet. The init method must complete successfully before the servlet can receive 
	 * any requests. 
	 *
	 * The servlet container cannot place the servlet into service if the init method 
	 *  	Throws a ServletException 
	 * 		Does not return within a time period defined by the Web server 
	 *
	 * @param config a ServletConfig object containing the servlet's configuration and initialization parameters
	 * @throws ServletException if an exception has occurred that interferes with the servlet's normal operation
	 * @see UnavailableException, getServletConfig()
	 */
	public function init( ServletConfig $config );
	
	/**
	 * Called by the servlet container to allow the servlet to respond to a request. 
	 *
	 * This method is only called after the servlet's init() method has completed successfully. 
	 *
	 * The status code of the response always should be set for a servlet that throws or sends 
	 * an error. 
	 *
	 * Servlets typically run inside multithreaded servlet containers that can handle multiple 
	 * requests concurrently. Developers must be aware to synchronize access to any shared 
	 * resources such as files, network connections, and as well as the servlet's class and 
	 * instance variables. More information on multithreaded programming in Java is available 
	 * in the Java tutorial on multi-threaded programming.
	 *
	 * @param req the ServletRequest object that contains the client's request
	 * @param res the ServletResponse object that contains the servlet's response
	 * @throws ServletException if an exception occurs that interferes with the servlet's normal operation
	 * @throws IOException if an input or output exception occurs
	 */
	public function service( ServletRequest $req, ServletResponse $resp );	
}