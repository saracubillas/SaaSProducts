<?php

namespace SaaSProducts\Domain\Model;


use SaaSProducts\Domain\Model\Product\Product;

class JsonParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SoftwareAdviceParser
     */
    private  $JsonParser;
    private $dummyFeed;

    public function setUp()
    {
        $this->JsonParser = new SoftwareAdviceParser();
        $this->dummyFeed = '{"products": [{"tags": ["some","tags"],"twitter": "@saracubillas","title": "someName"}]}';
    }


    /** @test */
    public function parserGlorf()
    {
        $this->JsonParser = $this->getMock(
            SoftwareAdviceParser::class,
            ['getFeed']
        );
        $this->JsonParser
            ->expects($this->any())
            ->method('getFeed')
            ->will($this->returnValue($this->dummyFeed));

        $expectedValue[] = new Product('someName', ['some', 'tags'], '@saracubillas');
        $videos = $this->JsonParser->parse();
        $this->assertInstanceOf(Product::class, $videos[0]);

    }
}
 