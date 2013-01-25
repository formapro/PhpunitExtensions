PhpunitExtensions
=================

StubTrait
---------

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