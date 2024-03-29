<?php
package("japha.lang.reflect");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class Modifier extends Object
{
    // these can't be constants, since they're PHP reserved words
	static $ABSTRACT;
	static $FINAL;
	static $INTERFACE;
	static $NATIVE;
	static $PRIVATE;
	static $PROTECTED;
	static $PUBLIC;
	static $STATIC;
	static $STRICT;
	static $SYNCHRONIZED;
	static $TRANSIENT;
	static $VOLATILE;
	
	public function __construct(){}
	
	static function isAbstract(){} //boolean
	static function isFinal(){}
	static function isInterface(){}
	static function isNative(){}
	static function isPrivate(){}
	static function isProtected(){}
	
	static function isPublic()
	{
	   return true;
	}
	
	static function isStatic(){}
	static function isStrict(){}
	static function isSynchronized(){}
	static function isTransient(){}
	static function isVolatile(){}
	public function toString( $mod ){} // static
}
?>