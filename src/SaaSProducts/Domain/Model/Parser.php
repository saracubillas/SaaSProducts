<?php

namespace SaaSProducts\Domain\Model;

interface Parser
{
    CONST FEED_FOLDER = __DIR__.'/../../../../feed-products/';

    public function parse();
} 