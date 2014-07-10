<?php

class Core_Model_DbTable_Auteur extends Zend_Db_Table_Abstract
{
    /**
     * @var unknown
     */
    protected $_name = 'author';

    /**
     * @var unknown
     */
    protected $_primary = 'id';


    /**
     * @var array
     */
    protected $_dependentTables = array(
        'Core_Model_DbTable_Article'
    );


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
     * @return the $_dependentTables
     */
    public function getDependentTables()
    {
        return $this->_dependentTables;
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

	/**
     * @param multitype: $_dependentTables
     */
    public function setDependentTables($_dependentTables)
    {
        $this->_dependentTables = $_dependentTables;
        return $this;
    }





}