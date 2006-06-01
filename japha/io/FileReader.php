<?
package("japha.io");

import("japha.io.InputStreamReader");

/**
 * $Id: FileReader.php,v 1.4 2004/07/14 22:27:03 japha Exp $
 *
 * Convenience class for reading character files. The constructors of this class assume that 
 * the default character encoding and the default byte-buffer size are appropriate. To specify 
 * these values yourself, construct an InputStreamReader on a FileInputStream. 
 *
 * FileReader is meant for reading streams of characters. For reading streams of raw bytes, 
 * consider using a FileInputStream. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/14 22:27:03 $
 */
class FileReader extends InputStreamReader
{
	private $closed = false;
	private $pointer = null;
	private $read = 0;
	private $eof = false;
	protected $eol = array( '\n', '\r', '\n\r' );
	
	public function __construct( File $filename )
	{
		if( file_exists( $filename->toString() ) )
		{
			$this->pointer = fopen( $filename->toString(), 'r' );
		}
		else
		{
			throw new Exception( $filename->toString().' does not exist!' );
		}
	}

	public function getEncoding()
	{
		return "ISO-8559-1";	
	}
	
	public function close()
	{
		fclose( $this->pointer );
		$this->closed = true;
	}

	public function read()
	{
		if( !$this->closed )
		{
			$this->read++;
			return !feof( $this->pointer ) ? fgetc( $this->pointer ) : -1;
		}
		return -1;
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

	private function isEof()
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
