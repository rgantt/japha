<?
package("com.japha.native");

import("japha.lang.Object");
import("japha.io.*");

/**
 * $Id$
 *
 * Includes Japha io package:
 * Reader, Writer, IoReaderWrapper, IoWriterWrapper -- { true === ($we == need($this)) }
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class LinkedFiles extends Object
{
	static $count;
	private $object;

	function __construct()
	{
		$this->count++;
	}

	public function setObject( &$object )
	{
		$this->object = $object;
	}

	public function &getObject()
	{
		return $this->object;
	}

	public function _previous()
	{
		return $this->count - 1;
	}

	public function _next()
	{
		return $this->count + 1;
	}
}

class GlueFile
{
	private $name = "";
	private $size = 0;
	private $checksum = "";
	private $data = array();
	static $count = 0;

	function __construct()
	{
		$this->count++;
	}

	public function __get( $key, &$value )
	{
		if(isset($this->$key))
		{
			$value = $this->$key;
			return true;
		}
		return false;
	}

	public function __set( $key, $value )
	{
		$this->$key = $value;
		return true;
	}

	public function compareSum( $newSum )
	{
		if(!strlen($newSum) == 32)
		{
			$newSum = md5($newSum);
		}
		return $this->checksum === $newSum ? true : false;
	}

	public function compareSize( $size )
	{
		if(!is_integer($size))
		{
			$size = (int)$size;
		}
		return $this->size === $size ? true : false;
	}

	public function appendLine( $data )
	{
		$this->data[] = $data;
	}

	private function returnFile()
	{
		foreach($this->data as $key => $value)
		{
			$total .= $value."\n";
		}
		return $total;
	}
}
overload("GlueFile");

/**
 * Class UnMelder
 * -=-=-=-=-=-=-=
 * Unpacks and unglues a melded data file
 * --
 *
 * Since this will probably get used by people other than me --
 * It has been engineered to acheieve black-box functionality
 *
 * I.E. -- Put a file in, get a file out. No questions asked.
 * All functions are private. All members are private.
 *
 * @author Ryan Gantt
 */
class UnMelder
{
	private $count = 0;
	private $filename;
	private $delimeter = "~";
	private $isCode = false;

	// Data is a Linked List.
	private $data = array();

	function __construct( $filename, $destination, $delimeter = "~" )
	{
		if(file_exists($filename))
		{
			$this->reader = new IoReaderWrapper( $filename );
		}
		else
		{
			throw new Exception($filename." does not exist!");
		}
		$this->delimeter = $delimeter;
		$this->destination = $destination;
	}

	private function parseFile()
	{
		while(false !== ($line = $this->readLine()))
		{
			$this->parseLine( $line );
		}
	}

	private function parseLine( $line )
	{
		if($this->isCode)
		{
			$this->{data[$this->count]}->appendLine( $line );
		{
		else
		{
			$this->differentiate( $line );
		}
	}

	private function differentiate( $data )
	{
		switch( substr( $data, 0, 1 ) )
		{
			case '#':
				if(in_array(substr($data, 1, 4)))
					$this->{data[$this->count]}->substr($data, 1, 4) = substr($data, 5);
				break;
			case $this->delimeter:
				++$this->count;
				$this->data[$this->count] = new GlueFile();
				break;
			case '!':
				if(eregi( "!#start#!", $data ))
					$this->isCode = true;
				else if(eregi( "!#stop#!", $data ))
					$this->isCode = false;
				break;
		}
	}

	private function readLine()
	{
		return $this->reader->readLine( 4096 );
	}
}

$u = new UnMelder( "newShizzy.shizzle", "." );
?>
