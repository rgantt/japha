<?php
namespace japha\beans;

use japha\beans\FeatureDescriptor;

/**
 * $Id$
 *
 * @author <a href="mailto:gantt@cs.montana.edu">Ryan Gantt</a>
 * @version $Revision$
 */
class PropertyDescriptor extends FeatureDescriptor
{
    private $propertyName;
    private $propertyType;
    
    private $getter;
    private $getterName;
    private $setter;
    private $setterName;
    
    private $propertyEditorClass;
    private $bound;
    private $constrained;
    
    private $beanClass;
    
    public function __construct()
    {
        $argv = func_get_args();
        switch( func_num_args() )
        {
            case 2:
                $this->PropertyDescriptor0( $argv[0], $argv[1] );
                break;
            case 3:
                $this->PropertyDescriptor1( $argv[0], $argv[1], $argv[2] );
                break;
            case 4:
                $this->PropertyDescriptor2( $argv[0], $argv[1], $argv[2], $argv[3] );
                break;   
        }    
    }
    
    public function PropertyDescriptor0( String $propertyName, _Class $beanClass )
    {
        $this->propertyName = $propertyName;
        $this->beanClass = $beanClass;
    }
    
    public function PropertyDescriptor1( String $propertyName, _Class $beanClass, String $getterName, String $setterName )
    {
        $this->propertyName = $propertyName;
        $this->beanClass = $beanClass;
        $this->getterName = $getterName;
        $this->setterName = $setterName;
    }
    
    public function PropertyDescriptor2( String $propertyName, Method $getter, Method $setter )
    {
        $this->propertyName = $propertyName;
        $this->getter = $getter;
        $this->setter = $setter;
    }
    
    public function equals( Object $obj )
    {
        if( $obj instanceof PropertyDescriptor )
        {
            if( $obj->getReadMethod()->equals( $this->getReadMethod() ) && $obj->getWriteMethod()->equals( $this->getWriteMethod() ) )
            {
                if( $obj->isBound()->equals( $this->isBound ) && $obj->isConstrained()->equals( $this->isConstrained() ) )
                {
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;   
    }
    
    public function getPropertyEditorClass()
    {
        return $this->propertyEditorClass();
    }
    
    public function getPropertyType()
    {
        return _Class::forName( $this->propertyType, true );   
    }
    
    public function getReadMethod()
    {
        return $this->getter;   
    }
    
    public function getWriteMethod()
    {
        return $this->setter;
    }
    
    public function isBound()
    {
        return $this->bound;   
    }
    
    public function isConstrained()
    {
        return $this->constrained;   
    }
    
    public function setBound( $bool )
    {
        $this->bound = $bool;   
    }
    
    public function setConstrained( $bool )
    {
        $this->constrained = $bool;
    }
    
    public function setPropertyEditorClass( _Class $propertyEditorClass )
    {
        $this->propertyEditorClass = $propertyEditorClass;   
    }
    
    public function setReadMethod( Method $getter )
    {
        $this->getter = $getter;
    }
    
    public function setWriteMethod( Method $setter )
    {
        $this->setter = $setter;
    }
}