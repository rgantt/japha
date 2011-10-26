<?php
namespace japha\util;

use japha\lang\Object;

/**
 * <code>abstract class Iterator</code>
 * This class will be inherited by various child iterators.
 */
 
abstract class _Iterator extends Object
{
	/**
	 * Current index/counter
	 *
	 * @access protected
	 * @var
	 */
	protected $index;

	/**
	 * Last indice of $this->string
	 *
	 * @access public
	 * @var
	 */
	public $END;

	/**
	 * Iterates to the next index
	 *
	 * @access public
	 * @abstract
	 */
	abstract public function next();

	/**
	 * Returns true if there is another index to iterate to
	 *
	 * @access public
	 * @abstract
	 * @return boolean true iff the iterator can move forward
	 */
	abstract public function hasNext();

	/**
	 * Moves the iterator one index backwords
	 *
	 * @access public
	 * @abstract
	 */
	abstract public function previous();

	/**
	 * Returns true if there is a previous element
	 *
	 * @access public
	 * @abstract
	 * @return boolean true iff the iterator can be moved backward
	 */
	abstract public function hasPrevious();

	/**
	 * Returns the value at the current index
	 *
	 * @access public
	 * @abstract
	 * @return The value at the current index
	 */
	abstract public function current();

	/**
	 * Resets the location of the iterator back to the beginning
	 *
	 * @access public
	 * @return int 0
	 */
	public function reset( $count = false )
	{
		if($count)
		{
			$this->index = 0;
			return $this->index;
		}
		else
			return 0;
	}

	/**
	 * Returns the value of the index at the very end
	 *
	 * @access public
	 * @return int The maximum number of iterations
	 */
	public function end()
	{
		return $this->END;
	}
}