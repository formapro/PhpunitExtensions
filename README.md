PhpunitExtensions
=================

Write attribute extension
-------------------------

It is simple extension which allows to access protected properties. It is like readAttribute shipped with phpunit.

```php
<?php

class Foo
{
    protected $id;
    
    public function getId()
    {
        return $this->id;
    }
}

class FooTest extends PHPUnit_Framework_TestCase
{
    use \Fp\PhpunitExtension\WriteAttributeTrait;

    public function testReturnExpectedId()
    {
        $foo = new Foo;
        $this->writeAttribute($foo, 'id', 10);

        $this->assertEquals(10, $foo->getId());
        
        //or
        
        $this->writeIdAttribute($foo, 20);
        
        $this->assertEquals(20, $foo->getId());
    }
}
```

Stub extension
--------------

```php
<?php

class Foo
{
    public function __construct($anArgument) {}

    public function bar() {}
    
    public function baz($a) {}
}

class FooTest extends PHPUnit_Framework_TestCase
{
    use \Fp\PhpunitExtension\StubTrait;

    public function testFoo()
    {
        $fooStub = $this->getStub('Foo', array(
            'bar' => 'barResult',
            'baz' => $this->returnValueMap(array(
                array('theArg', 'bazResult')
            ))
        ));

        $this->assertEquals('barResult', $fooStub->bar());
        $this->assertEquals('bazResult', $fooStub->baz('theArg'));
    }
}
```

As you can see the constructor is **overwritten**. 
You can define returned values or pass instance of `PHPUnit_Framework_MockObject_Stub`.
There is an [issue](https://github.com/sebastianbergmann/phpunit/issues/550) at phpunit.

Fumocker extension
------------------

This extension could be used to mock function. For that you have to install [fp\fumocker](https://github.com/formapro/Fumocker) lib first.

```php
<?php

class FooTest extends PHPUnit_Framework_TestCase
{
    use \Fp\PhpunitExtension\SetUpTrait;
    use \Fp\PhpunitExtension\Fumocker\FumockerTrait;

    public function setUp()
    {
        $this->setUpExtensions();
    }
    
    public function tearDown()
    {
        $this->tearDownExtensions();
    }

    public function testFoo()
    {
        $expectedEmailTo = 'admin@example.com';
        
        /**
         * @var $mock \PHPUnit_Framework_MockObject_MockObject
         */
        $mock = $this->getFunctionMock('Namespace/Where/Tested/Class/Is', 'mail');
        $mock
            ->expects($this->once())
            ->method('mail')
            ->with($expectedEmailTo)
        ;

        //test your Namespace/Where/Tested/Class/Is/Foo class
    }
}