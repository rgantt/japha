<?
package("japhax.servlet.http");

/**
 * $Id$
 *
 * Interface that will define all of the actions that can be taken during Http Requests.
 *
 * Known subclasses: HttpRequestWrapper
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface HttpServletRequest
{
	/**
	* Returns the names of the parameter variables
	*
	* @access public
	* @return String[] An array containing all of the parameter names
	*/
	public function getParameterNames();

	/**
	 * Get the value of the parameter.  If it doesn't exist, <i>null</i> will be returned.
	 * If it exists but is empty, it will be a string.
	 *
	 * @return Object The value of the requested parameter
	 * @access public
	 */
	public function getParameter( $name );

	/**
	 * Set the specified request variable to the specified value.
	 *
	 * @access public
	 * @param name The key of the parameter to set
	 * @param value The value of the parameter to set
	 */
	public function setParameter( $name, $value );

	/**
	 * Remove the specified request variable if it exists.
	 *
	 * @access public
	 * @param name The key of the value to remove
	 */
	public function removeParameter( $name );

	/**
	 * Determine if parameter exists.
	 *
	 * @access public
	 * @return boolean True iff the key exists in the parameters array
	 */
	public function parameterExists( $name );

	/**
	 * Return the method name of the http request.
	 *
	 * @return	String The type of method being used by the request -- usually GET or POST
	 * @access public
	 */
	public function getMethod();

	/**
	 * Get the running session or create a new one if it doesn't exist
	 *
	 * @return Session a new instance of session, unless one already exists
	 * @access public
	 * @singleton
	 */
	public function getSession();

	/**
	 * Returns the part of this request's Url from the protocol name up to
	 * the query string in the first line of the HTTP request.
	 *
	 * @return string The requests URL
	 * @access public
	 */
	public function getRequestUri();

	/**
	 * Returns the name of the scheme used to make this request, for example,
	 * http, https, or ftp. Different schemes have different rules for
	 * constructing URLs
	 *
	 * @access public
	 * @return String http or https, depending on whether or not we are in secure mode
	 */
	public function getScheme();

	/**
	 * Reconstructs the Url the client used to make the request.
	 * The returned Url contains a protocol, server name, port number, and
	 * server path, but it does not include query string parameters.
	 *
	 * @return String Rebuilds and returns the path to the current server
	 * @access public
	 */
	public function getRequestUrl();

	/**
	 * Get the qualified hostname of the server.
	 *
	 * @return String The hostname of the server
	 * @access public
	 */
	public function getServerName();

	/**
	 * Get the port on which the request was made
	 *
	 * @return int The port on which the request was made
	 * @access public
	 */
	public function getServerPort();

	/**
	 * Determine if this was a secure requests.
	 * The port used is a class constant
	 *
	 * @return boolean true if we are in https (secure) mode
	 * @access public
	 */
	public function isSecure();

	/**
	 * Get the qualified hostname of the client
	 * If no qualified hostname exists, the IP address is used
	 *
	 * @return String The hostname of the client
	 * @access public
	 */
	public function getRemoteHost();

	/**
	 * Get the IP address of the client
	 *
	 * @return String The ip address of the client
	 * @access public
	 */
	public function getRemoteAddr();

	/**
	 * Get the accepting locale for the client.  If no locale is
	 * sent, use the default from the server
	 *
	 * @return String The accepted locale of the client
	 * @access public
	 */
	public function getLocale();

	/**
	 * Get the file path on the server for the requested script
	 *
	 * @return String Complete path to the requested script
	 * @access public
	 */
	public function getRealPath();

	/**
	 * Returns the part of this request's Url that calls the script.
	 *
	 * @return String The part of this request's Url that calls the script
	 * @access public
	 */
	public function getScriptPath();

	/**
	 * Returns the information after the script name and before the query string
	 * If the uri is /webapp/index.php/hello.php?foo=bar it would return /hello.php
	 *
	 * @return String Returns a short version of the scriptPath
	 * @access public
	 */
	public function getPathInfo();
	
	/**
	 * Get the query string, which is the part of the Url after the first ?
	 *
	 * @return String The query string after the URL of the request
	 * @access public
	 */
	public function getQueryString();

	/**
	 * Returns the value of the specified request header. If the request did
	 * not include a header of the specified name, this method returns null.
	 *
	 * @return String Get the value of the specified request header
	 * @access public
	 */
	public function getHeader( $name );
	
    /**
	 * Returns all of the current server cookies
	 *
	 * @return String[] an array containing all of the current server cookies
	 * @access public
	 */
	public function getCookies();
}
?>