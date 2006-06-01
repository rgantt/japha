<?
package("japha.util");

import("japha.lang.Object");
import("japha.util.Collection");
import("japha.util.PList");
import("japha.util.Vector");
import("japha.util.Comparator");
import("japha.util.Enumeration");

/**
 * $Id: Collections.php,v 1.4 2004/07/22 17:46:58 japha Exp $
 *
 * This class consists exclusively of static methods that operate on or return collections. It 
 * contains polymorphic algorithms that operate on collections, "wrappers", which return a new 
 * collection backed by a specified collection, and a few other odds and ends. 
 *
 * The methods of this class all throw a NullPointerException if the collections provided to them 
 * are null. 
 *
 * The documentation for the polymorphic algorithms contained in this class generally includes a 
 * brief description of the implementation. Such descriptions should be regarded as implementation 
 * notes, rather than parts of the specification. Implementors should feel free to substitute other 
 * algorithms, so long as the specification itself is adhered to. (For example, the algorithm used 
 * by sort does not have to be a mergesort, but it does have to be stable.) 
 *
 * The "destructive" algorithms contained in this class, that is, the algorithms that modify the 
 * collection on which they operate, are specified to throw UnsupportedOperationException if the 
 * collection does not support the appropriate mutation primitive(s), such as the set method. 
 * These algorithms may, but are not required to, throw this exception if an invocation would 
 * have no effect on the collection. For example, invoking the sort method on an unmodifiable 
 * list that is already sorted may or may not throw UnsupportedOperationException. 
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/22 17:46:58 $
 */
class Collections extends Object
{
	static $EMPTY_LIST = "";
	static $EMPTY_MAP = "";
	static $EMPTY_SET = "";
	
	// Used by every single method to check for null list pointers
	static public function checkNull( Collection $obj, $methodName )
	{
		if( $obj == null )
		{
			throw new NullPointerException("Null list pointer in Collections::".$methodName."()!");
		}
	}
	
	// How do you do a search like this on an object?
	static public function binarySearch( PList $list, Object $key, Comparator $c = null )
	{
    	$high = $list->size() - 1;
    	echo "high is ".$high."\n";
    	$low = -1; 
    	while( $high - $low > 1 )
    	{
	        $probe = ( $high + $low ) / 2;
	        echo "probe is ".$probe."\n";
	        echo "high is ".$high."\nlow is ".$low."\n";
	        print_r( $list->get( $probe ) );
        	if ( $list->get( $probe ) > $key )
	            $low = $probe;
        	else
	            $high = $probe;
	    }
	    if ( $high == $list->size() || $list->get( $high ) != $key )
        	return -1;
    	else
	        return $high;
	}
	
	static public function copy( PList $src, PList $dest )
	{
		Collections::checkNull( $src, "copy" );
		Collections::checkNull( $dest, "copy" );
		$i = $src->iterator();
		while( $i->hasNext() )
		{
			$dest->add( $i->current() );	
			$i->next();
		}
	}
	
	static public function fill( PList $list, Object $obj )
	{
		Collections::checkNull( $list, "fill" );
		for( $i = 0; $i < $list->size(); $i++ )
		{
			// Set every single index to the same value
			$list->set( $obj, $i );	
		}
	}
	
	static public function nCopies( $n, Object $obj )
	{
		// Vector is the closest instantiable child to PList
		$list = new Vector();
		for( $i = 0; $i <= $n; $i++ )
		{
			$list->add( $obj );	
		}
		return $list;
	}
	
	static public function swap( PList $list, $i, $j )
	{
		Collections::checkNull( $list, "swap" );
		$tempI = $list->get( $i );
		$list->set( $tempI, $j );
		$tempJ = $list->set( $j );
		$list->set( $tempJ, $i );
	}
	
	static public function reverse( PList $list )
	{
		Collections::checkNull( $list, "reverse" );
		// This works, but the implementation of AbstractList::add() is buggy
		$i = $list->listIterator();
		$c = $list->size();
		$temp = $list->clone();
		while( $i->hasNext() && ( $c-- > 0 ) )
		{
			$temp->set( $i->current(), $c );
			$i->next();
		}
		$list = $temp;
	}
	
	// Even though we are already thread safe (at least under apache 1.x), we still need to at least return
	static public function synchronizedCollection( Collection $col )
	{
	    return $col;
	}
	
	static public function synchronizedList( PList $list )
	{
	    return $list;
	}
	
	static public function synchronizedMap( Map $map )
	{
	   return $map;
	}
	
	static public function synchronizedSet( Set $set )
	{
	    return $set;
	}
	
	static public function synchronizedSortedMap( Map $map )
	{
	    return $map;
	}
	
	static public function synchronizedSortedSet( Set $set )
	{
	   return $list;
	}
	//------
	
	// how can we make these collections unmodifiable? a private var flag?
	static public function unmodifiableCollection( Collection $col )
	{
	    return $col;
	}
	
	static public function unmodifiableList( PList $list )
	{
	    return $list;
	}
	
	static public function ummodifiableMap( Map $map )
	{
	    return $map;
	}
	
	static public function unmodifiableSet( Set $set )
	{
	    return $set;
	}
	
	static public function unmodifiableSortedMap( Map $map )
	{
	    return $map;
	}
	
	static public function unmodifiableSortedSet( Set $set )
	{
	    return $set;
	}

	static public function enumeration( Collection $c ){}
	static public function indexOfSubList( PList $src, PList $target ){}
	static public function lastIndexOfSubList( PList $src, PList $target ){}
	static public function pList( Enumeration $e ){}
	static public function max( Collection $col, Comparator $comp = null ){}
	static public function min( Collection $col, Comparator $comp = null ){}
	static public function replaceAll( PList $list, Object $oldVal, Object $newVal ){}
	static public function reverseOrder(){} // wtf does this do???
	static public function rotate( PList $list, $distance ){}
	static public function shuffle( PList $list, Random $rndm = null ){}
	static public function singleton( Object $o ){}
	static public function singletonList( Object $o ){}
	static public function singletonMap( Object $o ){}
	static public function sort( PList $list, Comparator $c = null ){}
}
?>