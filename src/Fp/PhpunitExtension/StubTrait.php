<?php
namespace Fp\PhpunitExtension;

trait StubTrait 
{
    /**
     * @param string $originalClassName
     * @param array $methods
     * @param array $arguments
     * @param string $mockClassName
     * @param bool $callOriginalConstructor
     * @param bool $callOriginalClone
     * @param bool $callAutoload
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getStub($originalClassName, $methods = array(), array $arguments = array(), $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true)
    {
        $mock = $this->getMock(
            $originalClassName,
            array_keys($methods),
            $arguments,
            $mockClassName,
            $callOriginalConstructor,
            $callOriginalClone,
            $callAutoload
        );

        foreach ($methods as $name => $stub) {
            if (false == $stub instanceof \PHPUnit_Framework_MockObject_Stub) {
                $stub = $this->returnValue($stub);
            }

            $mock
                ->expects($this->any())
                ->method($name)
                ->will($stub)
            ;
        }

        return $mock;
    }
}