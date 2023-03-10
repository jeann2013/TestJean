<?php

namespace TestJean\ModuleJean\Model\ResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init('TestJean\ModuleJean\Model\TestTable',
            'TestJean\ModuleJean\Model\ResourceModel\TestTable');
    }
}
