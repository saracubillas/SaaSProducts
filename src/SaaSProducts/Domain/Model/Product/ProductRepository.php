<?php

namespace SaaSProducts\Domain\Model\Product;

/**
 * Interface ProductRepository
 * @package SaaSProducts\Domain\Model\Product
 */
interface ProductRepository
{
    /**
     * @param $productId
     * @return mixed
     */
    public function productOfId($productId);

    /**
     * @param Product $product
     */
    public function persist(Product $product);

    /**
     * @param Product $product
     */
    public function remove(Product $product);

}
