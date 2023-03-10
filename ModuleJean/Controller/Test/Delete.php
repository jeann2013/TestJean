<?php

namespace TestJean\ModuleJean\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use TestJean\ModuleJean\Model\UserFactory;
use TestJean\ModuleJean\Model\UserRepository;
use TestJean\ModuleJean\Model\ResourceModel\Blog;

class Delete extends Action
{
    /**
     * @var TestJean\ModuleJean\Model\UserFactory
     */
    private $UserFactory;
    /**
     * @var TestJean\ModuleJean\Model\ResourceModel\TestTable
     */
    private $blogResource;
    /**
     * @var UserRepository
     */
    private $UserRepository;

    public function __construct(
        Context $context,
        UserFactory $UserFactory,
        TestTable $testTableResource,
        UserRepository $UserRepository
    ) {
        parent::__construct($context);
        $this->UserFactory = $UserFactory;
        $this->testTableResource = $testTableResource;
        $this->UserRepository = $UserRepository;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $this->UserRepository->deleteById($id);
        } catch (\Exception $e) {

        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('special_url_key/test/test');
        return $result;
    }
}
