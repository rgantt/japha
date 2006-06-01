<?
package("japha.lang");

/**
 * $Id: Math.php,v 1.4 2004/07/19 17:28:43 japha Exp $
 *
 * The class Math contains methods for performing basic numeric operations such as the elementary 
 * exponential, logarithm, square root, and trigonometric functions.
 *
 * Unlike some of the numeric methods of class StrictMath, all implementations of the equivalent 
 * functions of class Math are not defined to return the bit-for-bit same results. 
 * This relaxation permits better-performing implementations where strict reproducibility is not required.
 * 
 * By default many of the Math methods simply call the equivalent method in StrictMath for their implementation. 
 * Code generators are encouraged to use platform-specific native libraries or microprocessor 
 * instructions, where available, to provide higher-performance implementations of Math methods. 
 * Such higher-performance implementations still must conform to the specification for Math.
 *
 * The quality of implementation specifications concern two properties, accuracy of the returned result
 * and monotonicity of the method. Accuracy of the floating-point Math methods is measured in terms of ulps, 
 * units in the last place. For a given floating-point format, an ulp of a specific real number value 
 * is the difference between the two floating-point values closest to that numerical value. 
 * When discussing the accuracy of a method as a whole rather than at a specific argument, the number of 
 * ulps cited is for the worst-case error at any argument. If a method always has an error less than 0.5 ulps, 
 * the method always returns the floating-point number nearest the exact result; such a method is correctly rounded. 
 * A correctly rounded method is generally the best a floating-point approximation can be; however, 
 * it is impractical for many floating-point methods to be correctly rounded. Instead, for the Math class, 
 * a larger error bound of 1 or 2 ulps is allowed for certain methods. Informally, with a 1 ulp error bound, 
 * when the exact result is a representable number the exact result should be returned; otherwise, either of 
 * the two floating-point numbers closest to the exact result may be returned. Besides accuracy at individual 
 * arguments, maintaining proper relations between the method at different arguments is also important. 
 * Therefore, methods with more than 0.5 ulp errors are required to be semi-monotonic: whenever the mathematical 
 * function is non-decreasing, so is the floating-point approximation, likewise, whenever the mathematical function 
 * is non-increasing, so is the floating-point approximation. Not all approximations that have 1 ulp accuracy will 
 * automatically meet the monotonicity requirements. 
 * 
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $ $Date: 2004/07/19 17:28:43 $
 */
class Math extends Object
{
	static $E = M_E;
	static $PI = M_PI;
	
	static function abs( $a )
	{
		return abs( $a );
	}
	
	static function acos( $a )
	{
		return acos( $a );
	}
	
	static function asin( $a )
	{
		return asin( $a );
	}
	
	static function atan( $a )
	{
		return atan( $a );
	}
	
	static function atan2( $a )
	{
		return atan2( $a );
	}
	
	static function ceil( $a )
	{
		return ceil( $a );
	}
	
	static function cos( $a )
	{
		return cos( $a );
	}
	
	static function exp( $a )
	{
		return exp( $a );
	}
	
	static function floor( $a )
	{
		return floor( $a );
	}
	
	// An implementation of the IEEE 754 standard Remainder algorithm. A very bad one.
	static function IEEEremainder( $f1, $f2 )
	{
		if( (is_nan($f1) || is_nan($f2)) || is_infinite($f1) || ($f2 == 0) )
		{
			// A string isn't a number =]
			return "nan";
		}
		else if( is_finite($f1) && is_infinite($f2) )
		{
			return $f1;
		}
		else
		{
			$n = (int)($f1/$f2);
			return $f1 - $f2 * $n;
		}
	}
	
	static function log( $a )
	{
		return log( $a );
	}
	
	static function max( $a, $b )
	{
		return max( $a, $b );
	}
	
	static function min( $a, $b )
	{
		return min( $a, $b );
	}
	
	static function pow( $a, $b )
	{
		return pow( $a, $b );
	}
	
	static function random()
	{
		return rand();
	}
	
	static function rint( $a )
	{
		if(is_infinite($a) || is_nan($a) || ($a == 0))
		{
			return $a;
		}
		else
		{
			return (double)$this->round( $a );
		}
	}
	
	static function round( $a )
	{
		// Seed the random number generator with a nice healthy integer
		srand( ( double ) microtime() * 100000 );
		return round( $a );
	}
	
	static function sin( $a )
	{
		return sin( $a );
	}
	
	static function sqrt( $a )
	{
		return sqrt( $a );
	}
	
	static function tan( $a )
	{
		return tan( $a );
	}
	
	static function toDegress( $rad )
	{
		return rad2deg( $rad );
	}
	
	static function toRadians( $deg )
	{
		return deg2rad( $deg );
	}
}
?>