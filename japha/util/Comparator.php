<?
package("japha.util");

import("japha.lang.Object");

/**
 * $Id$
 *
 * A comparison function, which imposes a total ordering on some collection of objects. Comparators 
 * can be passed to a sort method (such as Collections.sort) to allow precise control over the 
 * sort order. Comparators can also be used to control the order of certain data structures (such 
 * as TreeSet or TreeMap).
 *
 * The ordering imposed by a Comparator c on a set of elements S is said to be consistent with 
 * equals if and only if (compare((Object)e1, (Object)e2)==0) has the same boolean value as 
 * e1.equals((Object)e2) for every e1 and e2 in S.
 *
 * Caution should be exercised when using a comparator capable of imposing an ordering 
 * inconsistent with equals to order a sorted set (or sorted map). Suppose a sorted set (or 
 * sorted map) with an explicit Comparator c is used with elements (or keys) drawn from a set 
 * S. If the ordering imposed by c on S is inconsistent with equals, the sorted set (or sorted 
 * map) will behave "strangely." In particular the sorted set (or sorted map) will violate the 
 * general contract for set (or map), which is defined in terms of equals.
 *
 * For example, if one adds two keys a and b such that 
 *
 * (a.equals((Object)b) && c.compare((Object)a, (Object)b) != 0) 
 *
 * to a sorted set with comparator c, the second add operation will return false (and the size 
 * of the sorted set will not increase) because a and b are equivalent from the sorted set's 
 * perspective.
 *
 * Note: It is generally a good idea for comparators to implement java.io.Serializable, as they 
 * may be used as ordering methods in serializable data structures (like TreeSet, TreeMap). In 
 * order for the data structure to serialize successfully, the comparator (if provided) must 
 * implement Serializable.
 *
 * For the mathematically inclined, the relation that defines the total order that a given 
 * comparator c imposes on a given set of objects S is:
 *
 *      {(x, y) such that c.compare((Object)x, (Object)y) <= 0}.
 *
 * The quotient for this total order is:
 *
 *      {(x, y) such that c.compare((Object)x, (Object)y) == 0}.
 *
 * It follows immediately from the contract for compare that the quotient is an equivalence 
 * relation on S, and that the natural ordering is a total order on S. When we say that the 
 * ordering imposed by c on S is consistent with equals, we mean that the quotient for the 
 * natural ordering is the equivalence relation defined by the objects' equals(Object) method(s):
 *
 *      {(x, y) such that x.equals((Object)y)}.
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$ $Date$
 */
interface Comparator
{
	public function compare( Object $obj1, Object $obj2 );
	public function equals( Object $obj );
}
?>