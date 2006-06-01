<?
package("japha.lang");

/**
 * $Id: Package.php,v 1.4 2004/07/19 17:28:43 japha Exp $
 *
 * Package objects contain version information about the implementation and specification of a Java package. 
 * This versioning information is retrieved and made available by the ClassLoader instance that loaded the class(es). 
 * Typically, it is stored in the manifest that is distributed with the classes.
 *
 * The set of classes that make up the package may implement a particular specification and if so the specification title, 
 * version number, and vendor strings identify that specification. An application can ask if the package is compatible with 
 * a particular version, see the isCompatibleWith method for details.
 *
 * Specification version numbers use a "Dewey Decimal" syntax that consists of positive decimal integers separated by 
 * periods ".", for example, "2.0" or "1.2.3.4.5.6.7". This allows an extensible number to be used to represent major, 
 * minor, micro, etc versions. The version number must begin with a number.
 *
 * The implementation title, version, and vendor strings identify an implementation and are made available conveniently 
 * to enable accurate reporting of the packages involved when a problem occurs. 
 * The contents all three implementation strings are vendor specific. The implementation version strings have no 
 * specified syntax and should only be compared for equality with desired version identifers. Within each ClassLoader 
 * instance all classes from the same java package have the same Package object. The static methods allow a 
 * package to be found by name or the set of all packages known to the current class loader to be found.
 *
 * @author <a href="mailto:gantt@cs.monana.edu">Ryan Gantt</a>
 * @version $Revision: 1.4 $
 */
class Package extends Object
{
	static $packages = array();
	
	private $used = false;
	
	private $name;
	private $specTitle;
	private $specVersion;
	private $specVendor;
	private $implTitle;
	private $implVersion;
	private $implVendor;
	private $sealBase;
	
	public function getPackage( $name ){}
	public function getPackages(){}
	public function hashCode(){}
	
	public function getImplementationTitle()
	{
		return $this->implTitle;
	}
	
	public function getImplementationVendor()
	{
		return $this->implVendor;
	}
	
	public function getImplementationVersion()
	{
		return $this->implVersion;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getSpecificationTitle()
	{
		return $this->specTitle;
	}
	
	public function getSpecificationVendor()
	{
		return $this->specVendor;
	}
	
	public function getSpecificationVersion()
	{
		return $this->specVersion;
	}
	
	public function isCompatibleWith( $desired )
	{
		$desArray = explode(".", $desired);
		$verArray = explode(".", $this->specVersion);
		for($i = 0; $i < count($desArray); $i++)
		{
			if($desArray[$i] > $verArray[$i])
			{
				return false;
			}
			else if($desArray[$i] < $verArray[$i])
			{
				return true;
			}
			else if($desArray[$i] == $verArray[$i])
			{
				continue;
			}
		}
	}
	
	public function isSealed( URL $url )
	{
		if($this->sealBase->toString() == $url->toString())
		{
			return true;
		}
		return false;
	}
	
	public function toString()
	{
		$sb = new StringBuffer("package ");
		$sb->append($this->name." ");
		if($this->specTitle)
			$sb->append($this->specTitle." ");
		if($this->specVersion)
			$sb->append($this->specVersion." ");
		return $sb->toString();
	}
	
	private function loadInfo( $name, $specTitle, $specVersion, $specVendor, $implTitle, $implVersion, $implVendor, $sealBase )
	{
		if(!$this->used)
		{
			if(in_array($this->packages, $name))
			{
				throw new IllegalArgumentException("Package name ".$name." is attempting to duplicate an existing package");
			}
			array_push($this->packages, $name);
			$this->name = $name;
			$this->specTitle = $specTitle;
			$this->specVersion = $specVersion;
			$this->specVendor = $specVendor;
			$this->implTitle = $implTitle;
			$this->implVersion = $implVersion;
			$this->implVendor = $implVendor;
			if((!($sealBase == null)) && ($sealBase instanceof URL) )
			{
				$this->sealBase = $sealBase;
			}
			$this->used = true;
		}
	}
}
?>