<?php

class Core_Model_DbTable_Article extends Zend_Db_Table_Abstract
{
    /**
     * @var string
     */
    protected $_name = Core_Model_Mapper_Article::TABLE;

    /**
     * @var string
     */
    protected $_primary = Core_Model_Mapper_Article::COL_ID;


    protected $_referenceMap = array(
    	'FK_categorie'=> array(
            'columns' => array(Core_Model_Mapper_Article::COL_CAT),
    	    'refTableClass' => 'Core_Model_DbTable_Categorie',
    	    'refColumns' => array(Core_Model_Mapper_Categorie::COL_ID),
    	    'onUpdate' => self::CASCADE,
    	    'onDelete' => self::RESTRICT
        ),
        'FK_auteur'=> array(
            'columns' => array(Core_Model_Mapper_Article::COL_AUTH),
            'refTableClass' => 'Core_Model_DbTable_Auteur',
            'refColumns' => array(Core_Model_Mapper_Auteur::COL_ID),
            'onUpdate' => self::CASCADE,
            'onDelete' => self::RESTRICT
        )
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
     * Getter générique
     * @param string $attr
     */
    public function __get($attr)
    {
        $method = 'get' . ucfirst($attr);
        return $this->$method();
    }


}