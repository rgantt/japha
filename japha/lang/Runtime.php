<?php
package("japha.lang");

/**
 * $Id$
 *
 * Every Java application has a single instance of class Runtime that allows the application to interface 
 * with the environment in which the application is running. The current runtime can be obtained from the getRuntime method.
 *
 * An application cannot create its own instance of this class. 
 * 
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class Runtime extends Object
{
	// This should be protected -- later
	function __construct( VirtualMachine $japha )
	{
		if(!$japha->isParentVM())
		{
			throw new Exception("Runtime cannot be instantiated by mortals!");
		}
	}
	
	public function addShutdownHook( Thread $hook ){}
	public function availableProcessors(){}
	public function exec(){}
	public function _exit( $status ){}
	public function freeMemory(){}
	
	public function gc()
	{
		// Run the garbage collector here (System calls this method through the VM)
	}
	
	public function getLocalizedInputStream( InputStream $in ){}
	public function getLocalizedOutputStream( OutputStream $out ){}
	public function load( $filename ){}
	public function loadLibrary( $libname ){}
	public function maxMemory(){}
	public function removeShutdownHook( Thread $hook ){}
	
	public function runFinalization()
	{
		// Run the finalization for objects awaiting it (System calls this method through the VM)
	}
	
	public function totalMemory(){}
	public function traceInstructions( $on ){}
	public function traceMethodCalls( $on ){}
}
?>
