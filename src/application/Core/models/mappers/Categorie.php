<?php

class Core_Model_Mapper_Categorie extends Core_Model_Mapper_MapperAbstract
{
	const TABLE = 'categories';
	const COL_ID = 'id';
	const COL_NOM = 'nom';
	const COL_COLOR = 'color';
	const COL_PARENT = 'categorie_parent_id';
	
	//protected $dbTableClassname = 'Core_Model_DbTable_Categorie';

    /**
     * Transforme une ligne de base de données Zend_Db_Table_Row en objet Core_Model_Categorie
     *
     * @param Zend_Db_Table_Row $row
     * @return Core_Model_Categorie
     */
    public function rowToObject(Zend_Db_Table_Row $row)
    {
    	

    	$artMapper = new Core_Model_Mapper_Article();
        $categ = new Core_Model_Categorie();
        $categ->setId($row[self::COL_ID])
              ->setNom($row[self::COL_NOM])
              ->setColor($row[self::COL_COLOR])
        	  ;//->setArticles($artMapper->fetchAll(Core_Model_Mapper_Article::COL_CAT . " = " . $row[self::COL_ID]));
        
        if($row[self::COL_PARENT] !== null) {
        	$categParentMapper = new Core_Model_Mapper_Categorie();
        	$resultset = $row->findParentRow('Core_Model_DbTable_Categorie');
        	if($resultset !== null){
        		$categParent = $categParentMapper->rowToObject($row->findParentRow('Core_Model_DbTable_Categorie'));
        		$categ->setParent_categ($categParent);
        	}
        }
        
        return $categ;
    }
    
    
    /**
     * Transforme un objet Core_Model_Categorie en tableau de données
     * @param Core_Model_Categorie $article
     * @return Array
     */
    public function objectToRow(Core_Model_Interface $categorie)
    {
    	return array(
    			self::COL_ID => $categorie->getId(),
    			self::COL_NOM => $categorie->getNom(),
    			self::COL_COLOR => $categorie->getColor(),
    			self::COL_PARENT => $categorie->getParent_categ()->getId()
    	);
    }

}