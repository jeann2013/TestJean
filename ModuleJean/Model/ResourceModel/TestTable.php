<?php

namespace TestJean\ModuleJean\Model\ResourceModel;

class TestTable extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('test_table', 'entity_id');
    }
}