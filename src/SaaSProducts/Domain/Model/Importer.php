<?php

namespace SaaSProducts\Domain\Model;

use SaaSProducts\Domain\Model\Product\Product;
use SaaSProducts\Domain\Model\Product\ProductRepository;

class Importer
{
    const PRODUCTS_FOLDER = '/../../../../products/';
    /**
     * @var ProductRepository
     */
    protected $repository;
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @param ProductRepository|string $repository
     * @param Parser $parser
     */
    public function __construct(ProductRepository $repository, Parser $parser)
    {
        $this->repository = $repository;
        $this->parser = $parser;
    }

    public function import()
    {
        /** @var Product[] $Products */
        $products = $this->parser->parse();

        foreach ($products as $product)
        {
            $this->repository->persist($product);
            $this->printOutput($product);
        }
    }

    private function printOutput(Product $product)
    {
        printf("importing: Name: ' %s '; Twitter: %s; Categories: %s; \n", $product->name(), $product->twitter(),
            implode(',' , $product->tags()));
    }

}