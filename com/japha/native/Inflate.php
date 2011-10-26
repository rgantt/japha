<?php
namespace com\japha\native;

/**
 * $Id$
 *
 * Takes two files and mashes them together, with no compression. Analogous to the tar format.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
class Melder extends Object
{
	private $files = array();
	private $delimeter = "~";
	private $countDelim = 20;
	private $total = array();

	function __construct( $files, $delimeter="~", $countDelim = 20 )
	{
		if(is_array($files))
		{
			$this->files = &$files;
		}
		$this->delimeter = $delimeter;
		$this->countDelim = $countDelim;
	}

	public function mergeFiles()
	{
		foreach($this->files as $key => $value)
		{
			$this->addDelimeter();
			$this->addFileInfo( $value );
			$this->getFile( $value );
		}
	}

	private function getFile( $filename )
	{
		if(file_exists($filename))
		{
			$w = fopen($filename, "r");
			while(!feof($w))
			{
				$this->total[] = fgets( $w, 4096 );
			}
			$this->total[] = "#!end!#";
		}
		else
		{
			throw new Exception($filename." does not exist!");
		}
	}

	public function saveFile( $newFileName )
	{
		$w = fopen( $newFileName, "w" );
		foreach($this->total as $key => $value)
		{
			fputs( $w, $value );
		}
		fclose($w);
	}

	private function addDelimeter()
	{
		$d .= "\n";
		for($i = 0; $i < $this->countDelim; $i++)
		{
			$d .= $this->delimeter;
		}
		$d .= "\n";
		$this->total[] = $d;
	}

	private function addFileInfo( $filename )
	{
		$this->total[] = "#name:".$filename."\n";
		$this->total[] = "#perm:".fileperms( $filename )."\n";
		$this->total[] = "#size:".filesize( $filename )."\n";
		$this->total[] = "\n!#start#!\n";
	}
}

class Compressor
{
	private $filename;
	private $total = array();

	function __construct( $filename )
	{
		if(file_exists($filename))
		{
			$this->filename = $filename;
		}
		else
		{
			throw new Exception($filename." does not exist!");
		}
	}

	public function compress()
	{
		$w = fopen( $this->filename, "r" );
		while(!feof($w))
		{
			$this->total[] = gzencode( fgets( $w, 4096 ), 5 );
		}
	}

	public function saveFile( $filename )
	{
		$s = gzopen( $filename, "w" );
		foreach( $this->total as $key => $value )
		{
			gzputs( $s, $key, 4096 );
		}
	}
}

$m = new Melder( array( "pdbc.php", "all.php", "xml.php" ) );
$m->mergeFiles();
$m->saveFile( "newShizzy.shizzle" );

$c = new Compressor( "newShizzy.shizzle" );
$c->compress();
$c->saveFile( "dsh" );
?>
