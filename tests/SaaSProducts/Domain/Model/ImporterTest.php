<?php

namespace SaaSProducts\Domain\Model;


use SaaSProducts\Domain\Model\Product\Product;
use SaaSProducts\Infrastructure\Persistence\InMemory\ProductRepository;

class ImporterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ProductRepository */
    public $repository;
    /** @var  Parser */
    public $parser;
    /** @var  Importer */
    public $importer;

    public function setUp()
    {
        $this->repository = new ProductRepository();
        $this->parser = new DummyParser();
        $this->importer = new Importer($this->repository, $this->parser);
    }

    /** @test */
    public function import()
    {
        $this->importer->import();
        $product1 = new Product('product1',['some', 'tags'], __DIR__. '/../../DummyProducts/a', 'testProduct1');
        $product2 = new Product('product2',['some', 'tags'], __DIR__. '/../../DummyProducts/b', 'testProduct2');
        $this->assertEquals(['testProduct1' => $product1, 'testProduct2' => $product2], $this->repository->findAllProducts());
    }

}

class DummyParser implements Parser
{
    public function parse()
    {
        $product1 = new Product('product1',['some', 'tags'], __DIR__. '/../../DummyProducts/a', 'testProduct1');
        $product2 = new Product('product2',['some', 'tags'], __DIR__. '/../../DummyProducts/b', 'testProduct2');

        return [$product1, $product2];
    }
}