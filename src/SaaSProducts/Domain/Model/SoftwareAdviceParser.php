<?php

namespace SaaSProducts\Domain\Model;

use SaaSProducts\Domain\Model\Product\Product;

/**
 * Class SoftwareAdviceParser
 * @package SaaSProducts\Domain\Model
 */
class SoftwareAdviceParser implements Parser
{
    CONST SOURCE = 'softwareadvice.json';
    /**
     * @return array
     * @throws ParsingErrorException
     */
    public function parse()
    {
        try {
            $jsonContent = $this->getFeed();
            $objectContent = json_decode($jsonContent);
            $products = [];
            foreach ($objectContent->products as $product)
            {
                $products[] = new Product($product->title, $product->categories,
                    $product->twitter ? $product->twitter : '');
            }
            return $products;

        } catch (\Exception $e) {
            throw new ParsingErrorException("Unable to parse the JSON string. ". $e->getMessage());
        }
    }

    /**
     * @return string
     * @throws ParsingErrorException
     */
    protected function getFeed()
    {
        return file_get_contents(self::FEED_FOLDER.self::SOURCE, FILE_USE_INCLUDE_PATH);
    }
}
