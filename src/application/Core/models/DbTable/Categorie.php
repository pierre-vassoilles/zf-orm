<?php

class Core_Model_DbTable_Categorie extends Zend_Db_Table_Abstract
{
    /**
     * @var string
     */
    protected $_name = 'categories';

    /**
     * @var string
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
     * @param string $_name
     */
    public function setName($_name)
    {
        $this->_name = $_name;
        return $this;
    }

	/**
     * @param Ambigous <string, mixed> $_primary
     */
    public function setPrimary($_primary)
    {
        $this->_primary = $_primary;
        return $this;
    }


    /**
     * @return the $_dependentTables
     */
    public function getDependentTables()
    {
        return $this->_dependentTables;
    }

	/**
     * @param multitype: $_dependentTables
     */
    public function setDependentTables(Array $_dependentTables)
    {
        $this->_dependentTables = $_dependentTables;
        return $this;
    }

	/**
     * Getter générique
     * @param string $attr
     */
    public function __get($attr)
    {
        $method = 'get' . ucfirst($attr);
        return $this->$method();
    }




}