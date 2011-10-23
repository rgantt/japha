<?php
require_once('../../../japha.php');

use japha\util\Vector;
use japha\lang\String;

/**
 * Unit tests for Vector class. 
 */
class VectorTest extends PHPUnit_Framework_TestCase {
	private $v1;
	private $v2;
	
	private $cases = array();
	
	protected function setUp() {	
		$this->v1 = new Vector();
		$this->v2 = new Vector();
		
		$j = rand( 5, 100 );
		for( $i = 0; $i <= $j; $i++ ) {
			$val = new String( rand( 0, 1 ) );
			$this->cases[] = $val;
			$this->v1->add( $val );
		}
		$this->v2->addAll( $this->cases );
	}
	
	protected function tearDown() {
		unset( $this->v1 );
		unset( $this->v2 );
	}
	
	public function testGet() {
		$v = new Vector();
		$v->add( new String('these') );
		$v->add( new String('are') );
		$v->add( new String('the') );
		$v->add( new String('words') );
		$v->add( new String('of') );
		$v->add( new String('a') );
		$v->add( new String('sentence') );

		$n = new Vector();
		$n->addAll( $v );
		$str = '';
		
		$it = $n->iterator();
		while( $it->hasNext() ) {
			$str .= $it->current();
			$it->next();
		}		
		$this->assertEquals( $str, 'thesearethewordsofasentence' );
	}
	
	public function testEquals() {
		$v = new Vector();
		$v->addAll( $this->cases );
		$this->assertEquals( $this->v1, $this->v2 );
		$this->assertEquals( $this->v1, $v );
	}
	
	public function testSize() {
		$v = new Vector();
		$v->addAll( $this->cases );
		$this->assertEquals( count( $this->cases ), $v->size() );
	}
	
	public function testContains() {
		$this->assertTrue( $this->v1->containsAll( $this->v2 ) );
		$this->assertTrue( $this->v2->containsAll( $this->v1 ) );

		$v = new Vector();
		$v->addAll( $this->cases );
		$n = new Vector();
		$n->addAll( $this->cases );
		
		$v->removeElementAt( rand( 0, $v->size() ) );
		
		// confirm the subset/superset relationship
		$this->assertTrue( $this->v1->containsAll( $v ) );
		$this->assertFalse( !$v->containsAll( $this->v1 ) );
	}
	
	public function testRemove() {
		$v = new Vector();
		$v->addAll( $this->cases );
		$n = new Vector();
		$n->addAll( $this->cases );
		
		$this->assertEquals( $v, $n );
		$v->removeElementAt( rand( 0, $v->size() ) );
		$this->assertNotEquals( $v, $n );		
	}
}