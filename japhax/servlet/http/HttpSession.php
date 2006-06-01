<?
package("japhax.servlet.http");

/** 
 * $Id: HttpSession.php,v 1.5 2004/11/28 09:41:04 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.5 $
 */
class HttpSession extends Object
{
    /**
     * ID Number of the current Session
     *
     * @access private
     * @var
     */
	private $id;

	/**
	 * Time (in SERVER TIME) that the current session was started
	 *
	 * @access private
	 * @var
	 */
	private $creationTime;

	/**
	 * Constructor
	 * Do not call this directly, should be intialized using the
	 * HttpRequest getSession() method to ensure it is only created once
	 *
	 * @access public
	 */
	public function __construct()
	{
		session_set_cookie_params(0, dirname($_SERVER['PHP_SELF']));
		session_start();
		$this->id = session_id();
		$this->creationTime = time() - date('Z');
	}

	/**
	 * Returns the ID of the current session
	 *
	 * @return int The ID of the current session
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns the SERVER time that the session was created.
	 *
	 * @access public
	 * @return String Server time in a format
	 */
	public function getCreationTime()
	{
		return $this->creationTime;
	}

	/**
	 * Returns an attribute specified by the passed key
	 *
	 * @param name The key to search the attributes array for
	 * @access public
	 * @return String the value of the found attribute
	 */
	public function getAttribute($name)
	{
		return $_SESSION[$name];
	}

	/**
	 * Sets the value of an attribute array to the passed value
	 *
	 * @param name The key to add to the array
	 * @param value the value to add to the array
	 * @access public
	 */
	public function setAttribute($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	/**
	 * Removes the value that resides at the specified key in the attributes array
	 *
	 * @access public
	 * @param name The key to remove from the array
	 */
	public function removeAttribute($name)
	{
		unset($_SESSION[$name]);
	}

	/**
	 * Forces the deletion of the Session, which could potentially cripple some pages
	 * Sets the SESSIONS array to a null array, deletes all session cookies, and kills session
	 * Let's just say we are definately getting the job done.
	 *
	 * @access public
	 */
	public function invalidate()
	{
		$_SESSION = array();
		unset($_COOKIE[session_name()]);
		session_destroy();
	}

	/**
	 * Return an array of all of the attribute names in the Session
	 *
	 * @access public
	 * @return String[] An array of all the attribute names in the Session
	 */
	public function getAttributeNames()
	{
		return array_keys($_SESSION);
	}

	/**
	 * Checks whether or not this is a new Session
	 *
	 * @access public
	 * @return boolean true iff the session is a new session
	 */
	public function isNew()
	{
	}
}
?>
