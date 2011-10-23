<?php
namespace japhax\servlet\http;

use japha\lang\Object;

/**
 * This class is the interface to all the requests of the http protocol.
 * Most of the work is actually done by PHP to setup the variables, so this
 * class is just an interface to that PHP layer.
 */
class HttpServletRequestWrapper extends Object implements HttpServletRequest {
	/**
	 * Default port uses for regular (insecure) requests
	 * 
	 * @access protected
	 * @var
	 */
	const DEFAULT_PORT = 80;

	/**
	 * Port of a secure connection
	 *
	 * @access protected
	 * @var
	 */
	const DEFAULT_SECURE_PORT = 443;

	/**
	 * Array of headers sent by the request
	 *
	 * @access private
	 * @var
	 */
	private $headers;

	/**
	 * Array of parameters sent by the request (either GET or POST)
	 *
	 * @access private
	 * @var
	 */
	private $parameters;
	
	/**
	 * Class constructor. Starts by loading up all of the HTTP variables into the parameter arrays
	 *
	 * @access public
	 */
	public function HttpRequest() {
		$this->headers = getallheaders();
		switch ( $this->getMethod() ) {
			case 'GET':	{
				$this->parameters = $_GET;
				break;
			}
			default:
			case 'POST': {
				$this->parameters = $_POST;
				break;
			}
		}
	}

	/**
	 * Get the names of all the parameters as an array.
	 *
	 * @access public
	 * @return String[] An array of all of the parameter names
	 */
	public function getParameterNames()	{
		return array_keys( $this->parameters );
	}
	
	/**
	 * Get the value of the parameter.  If it doesn't exist, <i>null</i> will be returned.
	 * If it exists but is empty, it will be a string.
	 *
	 * @return String An object that is represented in one of the parameters
	 * @param name The key of the value in the parameters array
	 * @access public
	 */
	public function getParameter( $name ) {
		if ( isset( $this->parameters[ $name ] ) ) {
			return $this->parameters[ $name ];
		}
		return null;
	}

	/**
	 * Set the specified request variable to the specified value.
	 *
	 * @access public
	 * @param name The key of the parameter
	 * @param value The value of the parameter
	 */
	public function setParameter( $name, $value ) {
		if ( is_null( $value ) ) {
			$this->removeParameter( $name );
			return;
		}
		$this->parameters[ $name ] = $value;
	}

	/**
	 * Remove the specified request variable if it exists.
	 *
	 * @access public
	 * @param name The key of the parameter you want to remove
	 */
	public function removeParameter( $name ) {
		unset( $this->parameters[ $name ] );
	}

	/**
	 * Determine if parameter exists.
	 *
	 * @access public
	 * @param name Key of the parameter to check
	 * @return boolean true iff the key exists and there is a real value
	 */
	public function parameterExists( $name ) {
		return isset( $this->parameters[$name] );
	}

	/**
	 * Return the method name of the http request.
	 *
	 * @access public
	 * @return	String the method used -- GET or POST
	 */
	public function getMethod() {
		return isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : false;
	}

	/**
	 * Get the running session or create a new one if it doesn't exist
	 *
	 * @access public
	 * @return Session a new instance of session, unless one already exists
	 * @singleton
	 */
	public function getSession() {
		static $instance = false;
		if ( !$instance ) {
			$instance = new HttpSession();
		}
		return $instance;
	}

	/**
	 * Returns the part of this request's Url from the protocol name up to
	 * the query string in the first line of the HTTP request.
	 *
	 * @return string The requests URL
	 * @access public
	 */
	public function getRequestUri() {
		// php's request uri includes the query string, so let's strip it
		list( $requestUri ) = explode( '?', $_SERVER['REQUEST_URI'] );
		return $requestUri;
	}

	/**
	 * Returns the name of the scheme used to make this request, for example,
	 * http, https, or ftp. Different schemes have different rules for
	 * constructing URLs
	 *
	 * @access public
	 * @return String http or https, depending on whether or not we are in secure mode
	 */
	public function getScheme() {
		return ( 'http' . ( ( $this->isSecure() ) ? 's' : '' ) );
	}

	/**
	 * Reconstructs the Url the client used to make the request.
	 * The returned Url contains a protocol, server name, port number, and
	 * server path, but it does not include query string parameters.
	 *
	 * @return String Rebuilds and returns the path to the current server
	 * @access public
	 */
	public function getRequestUrl() {
		$port = $this->getServerPort();
		if ($port == DEFAULT_PORT || $port == DEFAULT_SECURE_PORT) {
			$port = '';
		} else {
			$port = ':' . $port;
		}
		return $this->getScheme() . '://' . $this->getServerName() . $port . $this->getRequestUri();
	}
	
	/**
	 * Get the qualified hostname of the server.
	 *
	 * @return String The hostname of the server
	 * @access public
	 */
	public function getServerName() {
		return $_SERVER['SERVER_NAME'];
	}

	/**
	 * Get the port on which the request was made
	 *
	 * @return int The port on which the request was made
	 * @access public
	 */
	public function getServerPort() {
		return $_SERVER['SERVER_PORT'];
	}

	/**
	 * Determine if this was a secure requests.
	 * The port used is a class constant
	 *
	 * @return boolean true if we are in https (secure) mode
	 * @access public
	 */
	public function isSecure() {
		return !empty( $_SERVER['HTTPS'] );
	}

	/**
	 * Get the qualified hostname of the client
	 * If no qualified hostname exists, the IP address is used
	 *
	 * @return String The hostname of the client
	 * @access public
	 */
	public function getRemoteHost() {
		return $_SERVER['REMOTE_HOST'];
	}

	/**
	 * Get the IP address of the client
	 *
	 * @return String The ip address of the client
	 * @access public
	 */
	public function getRemoteAddr() {
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * Get the accepting locale for the client.  If no locale is
	 * sent, use the default from the server
	 *
	 * @return String The accepted locale of the client
	 * @access public
	 */
	public function getLocale() {
		return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	}

	/**
	 * Get the file path on the server for the requested script
	 *
	 * @return String Complete path to the requested script
	 * @access public
	 */
	public function getRealPath() {
		return $_SERVER['SCRIPT_FILENAME'];
	}

	/**
	 * Returns the part of this request's Url that calls the script.
	 *
	 * @return String The part of this request's Url that calls the script
	 * @access public
	 */
	public function getScriptPath() {
		return $_SERVER['SCRIPT_NAME'];
	}
	
	public function getServletPath() {
		return $this->getScriptPath();
	}

	/**
	 * Returns the information after the script name and before the query string
	 * If the uri is /webapp/index.php/hello.php?foo=bar it would return /hello.php
	 *
	 * @return String Returns a short version of the scriptPath
	 * @access public
	 */
	public function getPathInfo() {
		$requestUri = $this->getRequestUri();
		$scriptPath = $this->getScriptPath();
		if ( strlen( $requestUri ) == strlen( $scriptPath ) ) {
			return null;
		}
		return substr( $requestUri, strlen( $scriptPath ) );
	}

	/**
	 * Get the query string, which is the part of the Url after the first ?
	 *
	 * @return String The query string after the URL of the request
	 * @access public
	 */
	public function getQueryString() {
		return $_SERVER['QUERY_STRING'];
	}
	
	public function getContextPath() {
		return $this->getQueryString();
	}

	/**
	 * Returns the value of the specified request header. If the request did
	 * not include a header of the specified name, this method returns null.
	 *
	 * @return String Get the value of the specified request header
	 * @access public
	 */
	public function getHeader( $name ) {
		return isset( $this->headers[ $name ] ) ? $this->headers[ $name ] : null;
	}

	/**
	 * Returns all of the current server cookies
	 *
	 * @return String[] an array containing all of the current server cookies
	 * @access public
	 */
	public function getCookies() {
		return $_COOKIE;
	}
}
