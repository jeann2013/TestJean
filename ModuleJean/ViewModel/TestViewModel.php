<?php

namespace TestJean\ModuleJean\ViewModel;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use TestJean\ModuleJean\Api\Data\TestTableInterface;
use TestJean\ModuleJean\Model\TestTableRepository;
use TestJean\ModuleJean\Model\ResourceModel\CollectionFactory;

class TestViewModel implements ArgumentInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;
    /**
     * @var BlogRepository
     */
    private $testTableRepository;

    public function __construct(
        CollectionFactory $collectionFactory,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        TestTableRepository $testTableRepository
    ) {
        $this->collectionFactory = $collectionFactory->create();
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->testTableRepository = $testTableRepository;
    }

    public function getTestTableRepositoryCollection()
    {
        $filters[] = $this->filterBuilder->setConditionType('like')
            ->setField(TestTableInterface::NAME)
            ->setValue('Name%')
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($this->sortOrderBuilder
            ->setField(TestTableInterface::ENTITY_ID)
            ->setDirection(SortOrder::SORT_DESC)
            ->create());
        $this->searchCriteriaBuilder->setPageSize(10);
        $this->searchCriteriaBuilder->setCurrentPage(1);
        return $this->testTableRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }

    public function getTestTableCollection()
    {
        return $this->collectionFactory
            ->addFieldToFilter(TestTableInterface::Name, ['like' => 'Name%'])
            ->setOrder(TestTableInterface::ENTITY_ID, SortOrder::SORT_DESC)
            ->setPageSize(2)
            ->setCurPage(1);
    }   
}
