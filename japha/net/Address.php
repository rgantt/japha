<?php
package("japha.net");

/**
 * $Id$
 *
 * Note: This is like the URL or URI class in Java
 * It will soon be replaced by a tighter port of the latter
 *
 * Class address. This is an abstract data type for an internet address.
 * The format on the address can be any that is supported by the web: ex// ftp, http, https, etc.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class Address extends Object
{
	/** 
	 *the current address for the instance 
	 *
	 *@access public
	 * @var
	 */
	public $address;
	
	/**
	 *Does nothing except set the given parameter to the current address
	 *
	 *@param address the hostname to connect through
	 *@access public
	 */
	function __construct( $address = 'localhost' )
	{
		$this->address = $address;
	}
	
	/**
	 *Return the address uri of the current server
	 *
	 *@return String the current server uri
	 *@access public
	 */
	public function getServerName()
	{
		return $_SERVER['SERVER_NAME'];
	}
	
	/**
	 *Return the port (unless 80 || 8080) of the current server
	 *
	 *@return int port of the current server
	 *@access public
	 */
	public function getServerPort()
	{
		return ereg('$80^', $_SERVER['SERVER_PORT']) ? "" : ":".$_SERVER['SERVER_PORT'];
	}
	
	/**
	 *Returns every part of the address after the initial ?
	 *
	 *@return String string representation of the $_GET array
	 *@access public
	 */
	public function getQueryString( $delimiter="&")
	{
		$count = 0;
		foreach($_GET as $key => $value)
		{
			$query .= $key."=".$value;
			if($count <= count($_GET))
			{
				$query .= $delimiter;
			}
	    $count++;
		}
		return $query;
	}

	/**
	 *Checks if we are in secure mode
	 *
	 *@return String http or https
	 *@access public
	 */
	public function getAddressType()
	{
		return isset($_SERVER['HTTPS']) ? 'https' : 'http';
	}

	/**
	 *Return a string representation of the current address
	 *
	 *@return String current address
	 *@access public
	 */
	public function buildAddress()
	{
		echo "Address::buildAddress deprecated. Use Address::buildUri instead.\n";
		return $this->buildUri();
	}

	public function buildUri()
	{
		return $this->getAddressType()."://".$this->getServerName().$this->getServerPort()."?".$this->getQueryString();
	}
}
?>
