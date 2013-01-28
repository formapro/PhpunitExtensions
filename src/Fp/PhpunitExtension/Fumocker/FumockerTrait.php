<?php
namespace Fp\PhpunitExtension\Fumocker;

trait FumockerTrait 
{
    /**
     * @var \Fumocker\Fumocker
     */
    private $fumocker;

    /**
     * Implement these methods in your test case or use SetUpTrait extension
     */
    abstract public function setUpExtensions();

    /**
     * Implement these methods in your test case or use SetUpTrait extension
     */
    abstract public function tearDownExtensions();

    /**
     * @return void
     */
    public function setUpFumocker()
    {
        if (false == class_exists('Fumocker\Fumocker')) {
            $this->markTestSkipped('The extension requires fp\fumocker lib be installed.');
        }
        
        $this->fumocker = new \Fumocker\Fumocker;
    }

    /**
     * @return void
     */
    public function tearDownFumocker()
    {
        $this->fumocker->cleanup();
    }

    /**
     * @param string $namespace
     * @param string $functionName
     * 
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getFunctionMock($namespace, $functionName)
    {
        return $this->fumocker->getMock($namespace, $functionName);
    }
}