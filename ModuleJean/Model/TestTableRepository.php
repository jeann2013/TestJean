<?php

namespace TestJean\ModuleJean\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use TestJean\ModuleJean\Api\TestTableRepositoryInterface;
use TestJean\ModuleJean\Api\Data\TestTableInterface;
use TestJean\ModuleJean\Api\Data\TestTableSearchResultInterfaceFactory;
use TestJean\ModuleJean\Api\Data\TestTableSearchResultInterface;
use TestJean\ModuleJean\Model\ResourceModel\CollectionFactory;

class TestTableRepository implements TestTableRepositoryInterface
{
    /**
     * @var ResourceModel\TestTable
     */
    private $testTableResource;
    /**
     * @var TestTableFactory
     */
    private $testTableFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var TestTableSearchResultInterfaceFactory
     */
    private $testTableSearchResultInterfaceFactory;

    public function __construct(
        \TestJean\ModuleJean\Model\ResourceModel\TestTable $testTableResource,
        TestTableFactory $testTableFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        TestTableSearchResultInterfaceFactory $testTableSearchResultInterfaceFactory
    ) {
        $this->testTableResource = $testTableResource;
        $this->testTableFactory = $testTableFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->testTableSearchResultInterfaceFactory = $testTableSearchResultInterfaceFactory;
    }

    /**
     * @param TestTableInterface $testTable
     * @return TestTableInterface
     * @throws CouldNotDeleteException
     */
    public function save(TestTableInterface $testTable)
    {
        try {
            $this->testTableResource->save($testTable);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return $testTable;
    }

    /**
     * @param $testTableId
     * @return TestTableInterface|TestTable
     * @throws NoSuchEntityException
     */
    public function getById($testTableId)
    {
        $testTableModel = $this->testTableFactory->create();
        $this->testTableResource->load($testTableModel, $testTableId);
        if (!$testTableModel->getId()) {
            throw new NoSuchEntityException(__('%1 does not exist', $testTableId));
        }

        return $testTableModel;
    }

    /**
     * @param TestTableInterface $testTable
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(TestTableInterface $testTable)
    {
        try {
            $this->testTableResource->delete($testTable);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    /**
     * @param $testTableId
     * @return bool|void
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($testTableId)
    {
        $this->delete($this->getById($testTableId));
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TestTableSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \TestJean\ModuleJean\Api\Data\TestTableSearchResultInterface $searchResult */
        $searchResult = $this->testTableSearchResultInterfaceFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }
}
