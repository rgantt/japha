<?
package("japha.io");

import("japha.io.Writer");

/**
 * $Id: IoWriterWrapper.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class IoWriterWrapper extends Writer
{
	private $pointer;
	
	public function __construct( $filename )
	{
		$this->pointer = fopen( $filename, "w" );
	}

	public function close()
	{
		$this->flush();
		fclose( $this->pointer );
		if(!$this->pointer)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function flush()
	{
		fflush( $this->pointer );
	}

	public function writeLine( $line )
	{
		for($i = 0; $i < strlen($line); $i++)
		{
			$this->write( $line{$i} );
		}
	}

	public function write( $c )
	{
		fputs( $this->pointer, $c, 1 );
	}
}
?>