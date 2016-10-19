<?php

namespace SaaSProducts\Infrastructure\Persistence\Cassandra;

use SaaSProducts\Domain\Model\Product\Product;
use SaaSProducts\Domain\Model\Product\ProductRepository as ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @param $productId
     * @return mixed
     */
    public function productOfId($productId)
    {
        // TODO: Implement productOfId() method.
    }

    /**
     * @param Product $product
     */
    public function persist(Product $product)
    {
        // TODO: Implement persist() method.
    }

    /**
     * @param Product $product
     */
    public function remove(Product $product)
    {
        // TODO: Implement remove() method.
    }


}