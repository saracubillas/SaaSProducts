<?php

namespace SaaSProducts\Infrastructure\Persistence\InMemory;

use SaaSProducts\Domain\Model\Product\Product;
use SaaSProducts\Domain\Model\Product\ProductRepository as ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @var Product[]
     */
    private $products = [];

    /**
     * @param $productId
     * @return mixed
     */
    public function productOfId($productId)
    {
        return $this->products[$productId];
    }


    /**
     * {@inheritdoc}
     */
    public function persist(Product $product)
    {
        $this->products[$product->id()] = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Product $product)
    {
        unset($this->products[$product->id()]);
    }

    public function findAllProducts()
    {
        return $this->products;
    }
} 