<?php

namespace TestJean\ModuleJean\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use TestJean\ModuleJean\Api\Data\TestTableInterface;
use TestJean\ModuleJean\Api\Data\TestTableSearchResultInterface;

interface TestTableRepositoryInterface
{
    /**
     * @param TestTableInterface $testTable
     * @return TestTableInterface
     */
    public function save(TestTableInterface $testTable);

    /**
     * @param $testtableId
     * @return TestTableInterface
     */
    public function getById($testtableId);

    /**
     * @param TestTableInterface $testTable
     * @return bool
     */
    public function delete(TestTableInterface $testTable);

    /**
     * @param $testtableId
     * @return bool
     */
    public function deleteById($testtableId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TestTableSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}