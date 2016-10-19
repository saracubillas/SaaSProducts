<?php

namespace SaaSProducts\Infrastructure\Persistence\MySQL;

use SaaSProducts\Domain\Model\Product\Product;
use SaaSProducts\Domain\Model\Product\ProductRepository as ProductRepositoryInterface;

/**
 * Class ProductRepository
 * @package SaaSProducts\Infrastructure\Persistence\MySQL
 */
class ProductRepository implements  ProductRepositoryInterface
{

    protected $databaseConnection;

    protected $cache;
    public function __construct($databaseConnection, $cache)
    {
        $this->databaseConnection = $databaseConnection;
        $this->cache = $cache;

    }
    /**
     * @param $productId
     * @return mixed
     */
    public function productOfId($productId)
    {
        $sql = "SELECT id, name, url, tags FROM Products WHERE id = ?";
        $searchedProduct = $this->databaseConnection->Execute($sql);
        while ($record = $searchedProduct->FetchRow()) {
            $product = new Product($record->name, $record->url, $record->tags, $record->id);
            $products[] = $product;
        }

        return $products;
    }


    /**
     * @param Product $product
     * @throws \Exception
     */
    public function persist(Product $product)
    {
        $sql = "INSERT INTO Products "
            . "(id, name, url, tags) "
            . " VALUES "
            . "(?, ?, ?, ?) ";
        $binds = [$product->id(), $product->name(), $product->twitter(), implode(',', $product->tags())];
        try {
            $this->databaseConnection->Execute($sql, $binds);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param Product $product
     */
    public function remove(Product $product)
    {
        $sql = "DELETE FROM Products WHERE id = ?";
        $binds = $product->id();
        $this->databaseConnection->Execute($sql, $binds);
    }

}