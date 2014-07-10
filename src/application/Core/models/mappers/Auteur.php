<?php

class Core_Model_Mapper_Auteur
{
    protected $dbTable;

    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Auteur();
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

        $auteurs = array();
        if (0 === count($rowset)) {
            return $auteur;
        }
        foreach ($rowset as $row) {
            $auteurs[] = $this->rowToObject($row);
        }
        return $auteurs;
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
        $auteur = new Core_Model_Auteur();
        $auteur->setId($row['id'])
               ->setUsername($row['username'])
               ->setFullname($row['fullname'])
               ->setEmail($row['email'])
               ->setUrl($row['url']);
        return $auteur;
    }
}