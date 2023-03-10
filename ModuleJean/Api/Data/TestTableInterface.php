<?php

namespace TestJean\ModuleJean\Api\Data;

interface TestTableInterface
{
    const NAME = 'name';

    const EMAIL = 'email';

    const ENTITY_ID = 'entity_id';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email);
}