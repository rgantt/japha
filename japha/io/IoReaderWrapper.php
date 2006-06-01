<?
package("japha.io");

import("japha.io.Reader");

/**
 * $Id: IoReaderWrapper.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class IoReaderWrapper extends Reader
{
	private $closed = false;
	private $pointer = null;
	private $read = 0;
	private $lines = 0;
	private $eof = false;
	protected $eol = array("\n", "\r", "\n\r");

	public function __construct( $filename )
	{
		if(file_exists($filename))
		{
			$this->pointer = fopen( $filename, "r" );
		}
		else
		{
			throw new Exception($filename." does not exist!");
		}
	}

	public function close()
	{
		fclose( $this->pointer );
		$this->closed = true;
	}

	public function read()
	{
		if(!$this->closed)
		{
			return !feof( $this->pointer ) ? fgetc( $this->pointer ) : null;
			$this->read++;
		}
		return null;
	}

	public function readLine( $len )
	{
		while($c = $this->read() && !in_array( $c, $this->eol ))
		{
			$lineBuffer .= $this->read();
		}
		++$this->lines;
		return $lineBuffer;
	}

	public function mark( $readAheadLimit )
	{
		if($this->markSupported())
		{
			$this->mark = $this->read;
		}
		else
		{
			throw new Exception("Mark not supported on the current file stream. Next time check with IoReaderWrapper::markSupported() before setting a mark.");
		}
	}

	public function markSupported()
	{
		if(!$this->closed && !( $this->pointer == null ))
		{
			return true;
		}
		return false;
	}

	public function ready()
	{
		# WTF -- Need to put some checks here. Java/IO is a *little* different than PHP/IO. =]
		return true;
	}

	public function reset()
	{
		if(isset($this->mark))
		{
			$this->setPos( $this->mark );
		}
		else
		{
			$this->setPos( 0 );
		}
	}

	private function setPos( $pos )
	{
		if(!$this->closed)
		{
			$this->read = $pos;
		}
		else
		{
			throw new Exception("File stream closed.");
		}
	}

	public function isEof()
	{
		return $this->eof;
	}

	public function skip( $n )
	{
		$curRead = $this->read;
		$haveRead = 0;
		do
		{
			$c = $this->read();
			if(isset($c))
			{
				$haveRead++;
			}
		}
		while($this->read < ( $curRead + $n ) );
		return $haveRead;
	}
}
?>
