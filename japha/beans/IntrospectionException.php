<?php
namespace japha\beans;

use japha\lang\Exception;

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class IntrospectionException extends Exception
{
	public function __construct( String $mess )
	{
		$this->message = $mess;
	}
}