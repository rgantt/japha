<?php
namespace japhax\servlet\http;

class HttpServletResponseWrapper implements HttpServletResponse {
	/**
	 * Sends out an HTTP header. If headers have already been sent out, then an exception is thrown.
	 *
	 * @access public
	 * @param name Name of the header to add
	 * @param value value of the header to add... Ex "Location: index.html", location is name, index.html is value
	 * @throws HeadersSentException if the headers have already been sent out
	 */
	public function addHeader( $name, $value ) {
		if (!headers_sent()) {
			header( $name . ": " . $value);
		} else {
	        throw new HeadersSentException("Headers have already been sent out in HttpResponse::addHeader()!");
	    }
	}

	/**
	 * Adds a remote cookie based on an existing cookie object. If headers have already been send out, an Exception is throw
	 *
	 * @access public
	 * @param cookie Cookie object that is to be sent out
	 */
	public function addCookie( Cookie $cookie = null ) {
		$cookie->saveCookie();
	}

    /**
     * Sets the content-type of the page... An example of a valid type would be text/xml or text/html
     *
     * @access public
     * @param contentType the content type to set the page to
     * @throws HeadersSentException if the headers have already been sent out
     */
	public function setContentType( $contentType ) {
		if ( !headers_sent() ) {
			header('Content-type: ' . $contentType);
		} else {
	        throw new HeadersSentException("Headers have already been sent out in HttpResponse::setContentType()!");
	    }
	}

	/**
	 * Redirects the current client to a different page.
	 *
	 * @access public
	 * @param location the URI to redirect to
	 * @throws HeadersSentException if the headers have already been sent out
	 */
	public function sendRedirect( $location ) {
	    if( !headers_sent() ) {
	       header("Location: " . $location);
	    } else {
	        throw new HeadersSentException("Headers have already been sent out in HttpResponse::setRedirect()!");
	    }
	}
}