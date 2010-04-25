<?php
require_once('../japha.php');

import('jpunit.framework.TestCase');
import('jpunit.framework.Assert');
import('jpunit.ui.textui.TestRunner');

class VectorTest extends TestCase
{
	private $v1;
	private $v2;
	
	private $cases = array();
	
	protected function setUp()
	{	
		$this->v1 = new Vector();
		$this->v2 = new Vector();
		
		$j = rand( 5, 100 );
		for( $i = 0; $i <= $j; $i++ )
		{
			$val = new String( rand( 0, 1 ) );
			$this->cases[] = $val;
			$this->v1->add( $val );
		}
		$this->v2->addAll( $this->cases );
	}
	
	protected function tearDown()
	{
		unset( $this->v1 );
		unset( $this->v2 );
	}
	
	public function testGet()
	{
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
		while( $it->hasNext() )
		{
			$str .= $it->current();
			$it->next();
		}		
		Assert::assertEquals( $str, 'thesearethewordsofasentence' );
	}
	
	public function testEquals()
	{
		$v = new Vector();
		$v->addAll( $this->cases );
		Assert::assertEquals( $this->v1, $this->v2 );
		Assert::assertEquals( $this->v1, $v );
	}
	
	public function testContains()
	{
		$v = new Vector();
		$v->addAll( $this->cases );
		$n = new Vector();
		$n->addAll( $this->cases );
		
		$v->removeElementAt( rand( 0, $v->size() ) );
		Assert::assertEquals( $v, $n );
		
		Assert::assertTrue( $this->v1->containsAll( $this->v2 ) );
		Assert::assertTrue( $this->v2->containsAll( $this->v1 ) );
		
		// confirm the subset/superset relationship
		Assert::assertTrue( $this->v1->containsAll( $v ) );
		Assert::assertTrue( !$v->containsAll( $this->v1 ) );
	}
	
	public static function suite() 
	{
	    $suite = new TestSuite();
	    $suite->addTest( new VectorTest('testEquals') );
	    $suite->addTestSuite( _Class::forName('VectorTest') );
	    return $suite;
	}
	
	public static function main( $args = array() )
	{
    	    TestRunner::run( VectorTest::suite() );
	}
}

echo '<pre>';
VectorTest::main();