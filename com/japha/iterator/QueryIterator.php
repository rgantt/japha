<?
namespace com\japha\iterator;

use japha\lang\Iterator;

/**
 * <code>class QueryIterator</code>
 * This class will iterate over an sql result object, field by field.
 * The usage for this class would probably be seen best in the following:
 */
class QueryIterator extends Iterator {
	/**
	 * Result set to iterate over
	 *
	 * @access protected
	 * @var
	 */
	protected $query;
	
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
	 * Takes the array as a parameter, and initilizes all of the variables
	 * e.g.// length, end, reset
	 *
	 * @access public
	 */
	function __construct( $query ) {
		$this->query = $query;
		$this->END = $this->query->num_rows($this->query);
		$this->reset(true);
	}
	
	/**
	 * Iterates to the next index in the array
	 *
	 * @access public
	 * @return int The next index of the Query
	 */
	public function next() {
		$this->index++;
		return $this->index;
	}
	
	/**
	 * Checks whether or not the Iterator can be incremented
	 *
	 * @access public
	 * @return boolean true iff the Iterator can be incremented
	 */
	public function hasNext() {
	   if( $this->query->fetch_row($this->index+1, 'array') != NULL ) {
	       return true;
	   } else {
	       return false;
	   }
	}
	
	/**
	 * Returns the value of the array at the current index
	 *
	 * @access public
	 * @return MySQL Value of Array at the current index
	 */
	public function current() {
		return $this->query->fetch_row($this->index, 'array');
	}
	
	/**
	 * Moves the iterator once character backwords on the String
	 *
	 * @access public
	 * @return int The previous index of the Query
	 */
	public function previous() {
		$this->index--;
		return $this->index;
	}
	
	/**
	 * Checks whether or not the Iterator can be de-incremented
	 *
	 * @access public
	 * @return boolean true iff the Iterator can be de-incremented
	 */
	public function hasPrevious() {
	   if( $this->query->fetch_row($this->index-1, 'array') != NULL ) {
	       return true;
	   } else {
	       return false;
	   }
	}
}