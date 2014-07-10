<?php

class Core_Model_Mapper_Categorie
{
    protected $dbTable;

    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Categorie();
    }

    /**
     * Retourne un tableau de catégories
     * @param string $where
     * @param string $order
     * @param string $count
     * @param string $offset
     * @return multitype:|multitype:Core_Model_Categorie
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $rowset = $this->dbTable->fetchAll($where, $order, $count, $offset);

        $categories = array();
        if (0 === count($rowset)) {
            return $categories;
        }
        foreach ($rowset as $row) {
            $categories[] = $this->rowToObject($row);
        }
        return $categories;
    }

    /**
     * Trouve une catégorie dont l'identifiant est passé en paramètre
     * @param numer $id
     * @return Core_Model_Categorie
     */
    public function find($id)
    {
        $row = $this->dbTable->find($id)->current();
        return $this->rowToObject($row);
    }

    /**
     * Transforme une ligne de base de données Zend_Db_Table_Row en objet Core_Model_Categorie
     *
     * @param Zend_Db_Table_Row $row
     * @return Core_Model_Categorie
     */
    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $categ = new Core_Model_Categorie();
        $categ->setId($row['id'])
              ->setNom($row['nom'])
              ->setColor($row['color']);
        return $categ;
    }

}