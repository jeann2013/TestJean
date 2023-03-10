<?php
namespace TestJean\ModuleJean\Model;

use TestJean\ModuleJean\Api\Data\TestTableInterface;

class TestTable extends \Magento\Framework\Model\AbstractModel implements TestTableInterface
{
     /**
     * Contruct
     */
    protected function _construct()
    {
        $this->_init('TestJean\ModuleJean\Model\ResourceModel\TestTable');
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param mixed $id
     * @return \Magento\Framework\Model\AbstractModel|TestTableInterface|TestTable
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param $content
     * @return TestTableInterface|TestTable
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param $title
     * @return TestTableInterface|TestTable
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }
}