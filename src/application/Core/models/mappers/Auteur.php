<?php

class Core_Model_Mapper_Auteur extends Core_Model_Mapper_MapperAbstract
{
	const TABLE = 'author';
	const COL_ID = 'id';
	const COL_LOGIN = 'username';
	const COL_NAME = 'fullname';
	const COL_MAIL = 'email';
	const COL_URL = 'url';

	//protected $dbTableClassname = 'Core_Model_DbTable_Auteur';

    /**
     * Transforme une ligne de base de données Zend_Db_Table_Row en objet Core_Model_Categorie
     *
     * @param Zend_Db_Table_Row $row
     * @return Core_Model_Categorie
     */
    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $auteur = new Core_Model_Auteur();
        $auteur->setId($row[self::COL_ID])
               ->setUsername($row[self::COL_LOGIN])
               ->setFullname($row[self::COL_NAME])
               ->setEmail($row[self::COL_MAIL])
               ->setUrl($row[self::COL_URL]);
        return $auteur;
    }
    
    /**
     * Transforme un objet Core_Model_Auteur en tableau de données
     * @param Core_Model_Auteur $article
     * @return Array
     */
    public function objectToRow(Core_Model_Interface $auteur)
    {
    	return array(
    			self::COL_ID => $auteur->getId(),
    			self::COL_LOGIN => $auteur->getUsername(),
    			self::COL_NAME => $auteur->getFullname(),
    			self::COL_MAIL => $auteur->getEmail(),
    			self::COL_URL => $auteur->getUrl()
    	);
    }
}