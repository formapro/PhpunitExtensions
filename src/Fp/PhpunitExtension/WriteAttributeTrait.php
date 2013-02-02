<?php
namespace Fp\PhpunitExtension;

trait WriteAttributeTrait
{
    /**
     * @param string|object $classOrObject
     * @param string $attributeName
     * @param mixed $attributeValue
     * 
     * @return void
     */
    public function writeAttribute($classOrObject, $attributeName, $attributeValue)
    {
        $rp = new \ReflectionProperty($classOrObject, $attributeName);
        
        $rp->setAccessible(true);
        $rp->setValue($classOrObject, $attributeValue);
        $rp->setAccessible(false);
    }

    /**
     * @param string|object $classOrObject
     * @param mixed $attributeValue
     *
     * @return void
     */
    public function writeIdAttribute($classOrObject, $attributeValue)
    {
        $this->writeAttribute($classOrObject, 'id', $attributeValue);
    }
}