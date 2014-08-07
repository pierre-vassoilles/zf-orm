<?php

class Core_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    /**
     * @var unknown
     */
    protected $_name = Core_Model_Mapper_User::TABLE;

    /**
     * @var unknown
     */
    protected $_primary = Core_Model_Mapper_User::COL_ID;



	/**
     * @return the $_name
     */
    public function getName()
    {
        return $this->_name;
    }

	/**
     * @return the $_primary
     */
    public function getPrimary()
    {
        return $this->_primary;
    }


	/**
     * @param Ambigous <string, unknown> $_name
     */
    public function setName($_name)
    {
        $this->_name = $_name;
        return $this;
    }

	/**
     * @param Ambigous <unknown, mixed> $_primary
     */
    public function setPrimary($_primary)
    {
        $this->_primary = $_primary;
        return $this;
    }


}