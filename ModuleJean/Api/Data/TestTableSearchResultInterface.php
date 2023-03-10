<?php

namespace TestJean\ModuleJean\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TestTableSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \TestJean\ModuleJean\Api\Data\TestTableInterface[]
     */
    public function getItems();

    /**
     * @param \TestJean\ModuleJean\Api\Data\TestTableInterface[] $items
     * @return SearchResultsInterface
     */
    public function setItems(array $items);
}