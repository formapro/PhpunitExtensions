<?php
namespace Fp\PhpunitExtension;

class SetUpTrait 
{
    /**
     * @return void
     */
    public function setUpExtensions()
    {
        $ro = new \ReflectionObject($this);
        foreach ($ro->getMethods() as $rm) {
            if (0 === strpos($rm->getName(), 'setUp')) {
                $rm->invoke($this);
            }
        }
    }

    /**
     * @return void
     */
    public function tearDownExtensions()
    {
        $ro = new \ReflectionObject($this);
        foreach ($ro->getMethods() as $rm) {
            if (0 === strpos($rm->getName(), 'tearDown')) {
                $rm->invoke($this);
            }
        }
    }
}