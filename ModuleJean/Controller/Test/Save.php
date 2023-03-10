<?php

namespace TestJean\ModuleJean\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use TestJean\ModuleJean\Model\TestTableRepository;
use TestJean\ModuleJean\Model\ResourceModel\TestTable;

class Save extends Action
{
    /**
     * @var TestJean\ModuleJean\Model\TestTableRepository
     */
    private $testTableFactory;
    /**
     * @var TestJean\ModuleJean\Model\ResourceModel\TestTable
     */
    private $testTableResource;
    /**
     * @var TestTableRepository
     */
    private $testTableRepository;
    /**
     * @var \Magento\PageCache\Model\Cache\Type
     */
    private $fullPageCache;
    /**
     * @var \Magento\Framework\App\CacheInterface
     */
    private $cache;

    public function __construct(
        Context $context,
        TestTableFactory $testTableFactory,
        TestTable $testTableResource,
        TestTableRepository $testTableRepository,
        \Magento\PageCache\Model\Cache\Type $fullPageCache,
        \Magento\Framework\App\CacheInterface $cache
    ) {
        parent::__construct($context);
        $this->testTableFactory = $testTableFactory;
        $this->testTableResource = $testTableResource;
        $this->testTableRepository = $testTableRepository;
        $this->fullPageCache = $fullPageCache;
        $this->cache = $cache;
    }

    public function execute()
    {
        $name = $this->getRequest()->getParam('name');
        $email = $this->getRequest()->getParam('email');
        $blogPost = $this->testTableFactory->create();
        $blogPost->setData([
            'name' => $name,
            'email' => $email
        ]);
        try {
            $this->testTableRepository->save($blogPost);
            $this->cache->clean(['BLOG_TAG']);
            $this->fullPageCache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG, ['BLOG_TAG']);
//            $this->blogResource->save($blogPost);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $result->setPath('special_url_key/test/test');
        return $result;
    }
}
