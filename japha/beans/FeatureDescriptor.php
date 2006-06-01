<?
package("japha.beans");

/**
 * $Id: FeatureDescriptor.php,v 1.3 2004/07/14 22:27:03 japha Exp $
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision: 1.3 $
 */
class FeatureDescriptor extends Object
{
    private $attributes;
    private $displayName;
    private $name;
    private $shortDescription;
    private $value;
    private $expert;
    private $hidden;
    private $preferred;
    
    public function __construct(){}
    
    public function attributeNames()
    {
        // instanceof Enumeration
        return array_keys( $this->attributes );   
    }
    
    public function getDisplayName()
    {
        return $this->displayName;   
    }
    
    public function getName()
    {
        return $this->name;   
    }
    
    public function getShortDescription()
    {
        return $this->shortDescription;
    }
    
    public function getValue( String $attribute )
    {
        return $this->attributes[ $attribute ];   
    }
    
    public function isExpert()
    {
        return $this->expert;   
    }
    
    public function isHidden()
    {
        return $this->hidden;
    }
    
    public function isPreffered()
    {
        return $this->preferred;   
    }
    
    public function setDisplayName( $displayName )
    {
        $this->displayName = $displayName;
    }
    
    public function setName( $name )
    {
        $this->name = $name; 
    }  
    
    public function setShortDescription( $sd )
    {  
        $this->shortDescription = $sd;
    }
    
    public function setValue( String $atttr, Object $value )
    {
        $this->attributes[ $attr->toString() ] = $value;
    }
    
    public function setExpert( $bool )
    {
        $this->expert = $bool;   
    }
    
    public function setHidden( $bool )
    {
        $this->hidden = $bool;   
    }
    
    public function setPreferred( $bool )
    {
        $this->preferred = $bool;   
    }
}
?>