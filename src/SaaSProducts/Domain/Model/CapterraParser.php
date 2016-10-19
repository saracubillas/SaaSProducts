<?php

namespace SaaSProducts\Domain\Model;

use SaaSProducts\Domain\Model\Product\Product;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser as SymfonyYamlParser;

class CapterraParser implements Parser
{
    CONST SOURCE = 'capterra.yaml';

    public function parse()
    {
        try {
            $yaml = new SymfonyYamlParser();
            $yamlContent = $yaml->parse(file_get_contents(self::FEED_FOLDER.self::SOURCE, FILE_USE_INCLUDE_PATH));
            $products = [];
            foreach ($yamlContent as $product)
            {
                $tags = isset($product['tags']) ? explode(',' , $product['tags']) : [];
                $products[] = new Product($product['name'], $tags , $product['twitter']);
            }

            return $products;

        } catch (\Exception $e) {
            throw new ParsingErrorException("Unable to parse the YAML string. ". $e->getMessage());
        }
    }
}
