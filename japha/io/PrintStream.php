<?php
package("japha.io");

import("japha.io.FilterOutputStream");

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class PrintStream extends FilterOutputStream
{
    private $context;
    
    const WEB_FORMATTED = 0;
    const WEB_PLAIN     = 1;
    
	public function __construct( /*OutputStream*/ $out )
	{
	   parent::__construct( $out );
	}	
	
	public function setError(){}
	
	public function write(){}
	
	public function println()
	{
	   $argv = func_get_args();
	   switch( func_num_args() )
	   {
	       case 0:
	           return $this->println0(); // PrintStream::println()
	           break;
	       case 1:
	           return $this->println1( $argv[0] ); // PrintStream::println( String $str )
	           break;   
	   }   
	}
	
	public function println0()
	{
	   switch( $this->context )
	   {
	       default:
	       case PrintStream::WEB_FORMATTED:
	           $this->out->write( "<br/>" );
	           break;
	       case PrintStream::WEB_PLAIN:
	           $this->out->write( "\n" );
	           break;
	   }
	}
	
	public function println1( $str )
	{
	   $this->out->write( $str );
	   $this->println();   
	}
	
    public function context( $c )
    {
        switch( $c )
        {
            default:
            case PrintStream::WEB_FORMATTED:
                $this->context = PrintStream::WEB_FORMATTED;
                break;
            case PrintStream::WEB_PLAIN:
                $this->context = PrintStream::WEB_PLAIN;   
                break;
        }
    }
	
	public function _print( $str )
	{
	    $this->out->write( $str );
	}
	
	public function flush(){}
	
	public function close(){}
	
	public function checkError(){}
}
?>