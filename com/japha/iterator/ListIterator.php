<?
namespace com\japha\iterator;

use japha\lang\Object;
use japha\util\Iterator;

/**
 * <code>class ArrayIterator</code>
 * This class will iterate over an array, index by index.
 * The usage for this class would probably be seen best in the following:
 *
 * $iter = new ArrayIterator(array( 1, 2, 4, 5, 6, 7, 9 ));
 * for($i = $iter->reset(); $i < $iter->end(); $i = $iter->next())
 * {
 *    echo $iter->current();
 * }
 *
 * or
 *
 * $iter = new ListIterator(array(1, 2, 3, 4, 5, 6));
 * while( $iter->hasNext() )
 * {
 *    echo $iter->current();
 *    $iter->next();
 * }
 */
class ListIterator extends _Iterator
{
	/**
	 * Current index/counter
	 *
	 * @access protected
	 * @var
	 */
	protected $index = 0;

	/**
	 * Last indice of $this->string
	 *
	 * @access public
	 * @var
	 */
	public $END;
	
	/**
	 * Array to iterate over
	 *
	 * @access private
	 * @var
	 */
	private $list = array();

	/**
	 * Takes the array as a parameter, and initilizes all of the variables
	 * e.g.// length, end, reset
	 *
	 * @access public
	 * @param list A list to iterator over
	 */
	function __construct( AbstractList $list )
	{
		$this->list = $list->getList();
		$this->END = count( $this->list );
		$this->reset( true );
	}

	/**
	 * Iterates to the next index in the array
	 *
	 * @access public
	 * @return int the next index of the list
	 */
	public function next()
	{
		return (Object)++$this->index;
	}

	/**
	 * Checks if the next index in the current array exists
	 *
	 * @access public
	 * @return boolean true iff there is another element in the list
	 *
	 * !! Weird functionality -- It only works if you check the current index
	 */
	public function hasNext()
	{
	   if( isset( $this->list[ $this->index ] ) )
	       return true;
	   else
	       return false;
	}

	/**
	 * Returns the value of the array at the current index
	 *
	 * @return Object Value of Array at the current index
	 * @access public
	 */
	public function current()
	{
		return $this->list[ $this->index ];
		/*
		foreach($this->list[ $this->index ] as $key => $value)
		{
         	return $value;
		}
		*/
	}

	/**
	 * Moves the iterator once character backwords on the String
	 *
	 * @access public
	 * @return int the previous element
	 */
	public function previous()
	{
		return --$this->index;
	}

	/**
	 * Checks if the previous index in the current array exists
	 *
	 * @access public
	 * @return boolean true iff there is a previous element in the list
	 */
	public function hasPrevious()
	{
	   if( isset( $this->list[ $this->index - 1 ] ) )
	       return true;
	   else
	       return false;
	}

	public function panic()
	{
     	return print_r($this->list);
	}
}