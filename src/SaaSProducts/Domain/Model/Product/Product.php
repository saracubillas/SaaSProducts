<?php

namespace SaaSProducts\Domain\Model\Product;

/**
 * Class Product
 * @package SaaSProducts\Domain\Model\Product
 */
class Product
{
    /**
     * @var
     */
    protected $productId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Array
     */
    protected $tags;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var \DateTime
     */
    protected $updatedOn;

    public function __construct($name, $tags, $twitter, $productId = null)
    {
        $this->name = $name;
        $this->tags = $tags;
        $this->url = $twitter;
        $this->productId = $productId === null ? uniqid() : $productId;
    }

    public function id()
    {
        return $this->productId;
    }

    public function twitter()
    {
        return $this->url;
    }

    public function name()
    {
        return $this->name;
    }

    public function tags()
    {
        return $this->tags;
    }

}
