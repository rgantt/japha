<?php
namespace com\japha\iterator;

use japha\lang\_Iterator;

/**
 * Class <code>DirectoryIterator</code> provides a simple iterator for traversing the
 * files in a directory.
 * <p>
 *   On construction a directory name must be passed, and the contents can then be
 *   iterated over like any other <code>Iterator</code>. If the iterator is use
 *   normally (from front to back completely), the internal directory pointer is
 *   closed automatically when the end of the directory is reached. If the standard
 *   iteration loop is not completed, the directory pointer should be closed
 *   explicitly by calling <code>close()</code> on the iterator. For example:
 * </p>
 * <pre>
 *   $closed =  true;
 *   $it     =& new DirectoryIterator('/home/user');
 *   for ( ; $it->isValid(); $it->next())
 *   {
 *       $file =& $it->getCurrent();
 *       if ($file == 'stopfile.txt')
 *       {
 *           $closed = false;
 *           break;
 *       }
 *       echo $file . "\n";
 *   }
 *   if (!$closed)
 *   {
 *       $it->close();
 *   }
 * </pre>
 * <p>
 *   If the directory to be read can't be opened for one reason or another, this
 *   class will not fail. Instead, it will simply 'iterate over nothing'. Of
 *   course, PHP will still log warnings and/or errors somewhere, depending on
 *   how this is configured.
 * </p>
 */
class DirectoryIterator extends _Iterator
{
	/**
	 * The name of the directory
	 *
	 * @access private
	 * @var
	 */
	private $dirname;

	/**
	 * The directory pointer in the open directory
	 *
	 * @access private
	 * @var
	 */
	private $pointer;

	/**
	 * The current file in the directory
	 *
	 * @access private
	 * @var
	 */
	private $file;

	/**
	 * Constructor... Creates a new iterator
	 *
	 * @access public
	 * @param dirname the name of the directory to iterate over
	 */
	function __construct( $dirname )
	{
		$this->dirname = $dirname;
		$this->pointer = false;
		$this->file = false;
		$this->reset();
	}

	/**
	 * Close the internal directory pointer.  This method must be called
	 * if the iteration is stopped before it is completed (that is: before the
	 * end of the directory is reached).
	 *
	 * @access public
	 * @return void
	 */
	public function close()
	{
		if ($this->pointer !== false)
		{
			closedir($this->pointer);
			$this->pointer = false;
			$this->file    = false;
		}
	}

	/**
	 * Read a file from the directory
	 *
	 * @return String the name of the current file (not . or .. )
	 * @access private
	 */
	private function readFile()
	{
		do
		{
			$file = readdir($this->pointer);
		} 
		while ($file == '.' && $file == '..');

		return (($file != '.') && ($file != '..')) ? $file : NULL;
	}

	/**
	 * Rewind to the beginning of the directory
	 *
	 * @return void
	 * @access public
	 */
	public function reset()
	{
		if ($this->pointer)
		{
			rewinddir($this->dir);		
		}
		else
		{
			$this->pointer = opendir($this->dirname);
		}

		$this->file = ($this->pointer !== false) ? $this->readFile() : false;
	}

	/**
	 * Move to the next file
	 *
	 * @access public
	 * @return void
	 */
	public function next()
	{
	   $this->file = $this->readFile();
	}
	
	/**
	 * Returns true iff there is another file in the directory
	 *
	 * @access public
	 * @return boolean true iff there is another file in the directory
	 */
	public function hasNext()
	{
	   if( $this->readFile() != NULL )
	   {
	       return true;   
	   }
	   return false;
	}
	
	/**
	 * Determine if we are at the end of the directory
	 *
	 * @return boolean true iff the current file is actually a file
	 * @access public
	 */
	public function isValid()
	{
		if ($this->file === false)
		{
			$this->close();
			return false;
		}
		
		return true;
	}

	/**
	 * Get the current file
	 *
	 * @return String the name of the current file
	 */
	public function current()
	{
		return $this->file;
	}
}