<?
package("japhax.servlet");

import('japhax.servlet.ServletConfig');

/**
 * $Id: ServletConfigWrapper.php,v 1.1 2004/11/28 09:41:04 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.1 $
 */
class ServletConfigWrapper implements ServletConfig
{
	public function getInitParameter( $name )
	{	
	}
	
	public function getInitParameterNames()
	{
	}
	
	public function getServletContext()
	{
	}
	
	public function getServletName()
	{
	}
}
?>
