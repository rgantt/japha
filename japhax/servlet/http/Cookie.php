<?
package("japhax.servlet.http");

/**
 * $Id$
 *
 * Cookies. Manage, edit, delete, set cookies.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class Cookie
{
	/**
	 * The String identifier of the current cookie
	 */
	protected $name;

	/**
	 * The String value of the current cookie -- This can be anything; hashed string, gzipped string,
	 * serialized class: whatever.
	 */
	protected $value;

	/**
	 * The amount of time for the cookie to remain on the client's computer
	 */
	protected $timeout = false;

	/**
	 * Constructor DOES NOT create the cookie, it simply sets the passed values to the fields (if they are even set)
	 *
	 * @access public
	 * @param name The name of the cookie (defaults to null)
	 * @param value The value of the cookie (defaults to null)
	 */
	public function __construct( $name = null, $value = null )
	{
		if(isset($name))
		{
			$this->name = $name;
		}
		if(isset($value))
		{
			$this->value = $value;
		}
	}

	/**
	 * Change the name of the current cookie -- Note: This will not work if the cookie has already been set,
	 * or if the headers have already been sent out.
	 *
	 * @access public
	 * @param name The name of the cookie
	 */
	public function setName( $name )
	{
		$this->name = $name;
	}

	/**
	 * Returns the name of the current cookie. Will work after headers have been sent out, and after
	 * the cookie has been set (so you can compare it.)
	 *
	 * @access public
	 * @return String The name of the cookie
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Changes the value of the current cookie. This, unlike setName, WILL work after the headers/cookie have been
	 * sent out. You just cant change it if the headers have been sent out -- For OBVIOUS reasons.
	 *
	 * @access public
	 * @param value The value of the current cookie
	 */
	public function setValue( $value )
	{
		$this->value = $value;
	}

	/**
	 * Returns the value of the current cookie
	 *
	 * @access public
	 * @return String The value of the current cookie
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set the amount of time that the current cookie will remain on the computer of the client (in seconds)
	 *
	 * @access public
	 * @param seconds The number of seconds that the cookie is going to stay on the client computer
	 */
	public function setTimeout( $seconds )
	{
		if(is_integer($seconds))
		{
			$this->seconds = $seconds;
		}
	}

	/**
	 * Return the number of seconds that this cookie will live on the client computer
	 *
	 * @access public
	 * @return int The number of seconds that the cookie will remain on the client computer
	 */
	public function getTimeout()
	{
		return $this->timeout;
	}

	/**
	 * Writes the current cookie -- This will not work if the headers have already been sent out. If there is
	 * a name for the cookie, but no value, then this will set a blank cookie. Duh.
	 *
	 * @access public
	 */
	public function saveCookie()
	{
		# To do -- Add more options here (secure, paths, etc.)
		if(!headers_sent())
		{
			setcookie($this->name, $this->value, $this->timeout);
		}
	}

	public function updateCookie()
	{
		$this->saveCookie();
	}

	/**
	 * This can be called at any time -- Obvious use would be to delete a cookie that is no longer necessary
	 *
	 * @access public
	 */
	public function deleteCookie()
	{
		unset($_COOKIE[$this->name]);
	}

	/**
	 * Returns true if the passed cookie exists in the cookie globals array
	 *
	 * @access public
	 * @param name The key (name) of the cookie to check
	 * @return bool True iff the cookie $name already exists on the server/client
	 */
	public function cookieExists( $name )
	{
		return isset($_COOKIE[$name]);
	}

	/**
	 * Returns true if there is already a cookie set with the same name as $this. If there is, we'll just overwrite it.
	 *
	 * @access public
	 * @return bool True iff the current cookie already exists on the client's computer
	 */
	public function currentCookieExists()
	{
		return $this->cookieExists( $this->name );
	}
}
?>
