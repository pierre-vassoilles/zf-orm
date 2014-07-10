<?php

class Core_Model_Mapper_Article
{
    protected $dbTable;

    public function __construct()
    {
        $this->dbTable = new Core_Model_DbTable_Article();
    }

    public function find($id)
    {
        $row = $this->dbTable->find($id)->current();
        return $this->rowToObject($row);
    }

    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $rowset = $this->dbTable->fetchAll($where, $order, $count, $offset);

        $articles = array();
        if (0 === count($rowset)) {
            return $articles;
        }
        foreach ($rowset as $row) {
            $articles[] = $this->rowToObject($row);
        }
        return $articles;
    }

    /**
     * Supprime l'article dont l'indentifiant est en paramètre
     * @param number $id
     * @throws Zend_Db_Table_Row_Exception
     * @return boolean
     */
    public function delete($id)
    {
        $row = $this->dbTable->find($id)->current();
        if(!$row instanceof Zend_Db_Table_Row_Abstract) {
            throw new Zend_Db_Table_Row_Exception("Impossible de supprimer l'article n°$id");
        }
        return (bool) $row->delete();
    }

    /**
     * Méthode insert or update d'un objet Core_Model_Article
     * @param Core_Model_Article $article
     */
    public function save(Core_Model_Article $article)
    {
        $origin = $this->dbTable->find($article->getId())->current();
        $row = $this->objectToRow($article);
        if($origin instanceof Zend_Db_Table_Row_Abstract){
            //update
            $where = array('id = ?' => $article->getId());
            $this->dbTable->update($row, $where);
        }else{
            //insert
            unset($row['id']);
            $row['published_date'] = date("Y-m-d");
            $this->dbTable->insert($row);
        }

    }

    /**
     * Transforme une ligne de base de données Zend_Db_Table_Row en objet Core_Model_Article
     * @param Zend_Db_Table_Row $row
     * @return Core_Model_Article
     */
    public function rowToObject(Zend_Db_Table_Row $row)
    {

        $categMapper = new Core_Model_Mapper_Categorie();
        $categ = $categMapper->rowToObject($row->findParentRow('Core_Model_DbTable_Categorie'));

        $autorMapper = new Core_Model_Mapper_Auteur();
        $auteur = $autorMapper->rowToObject($row->findParentRow('Core_Model_DbTable_Auteur'));

        $article = new Core_Model_Article();
        $article->setAuthor($auteur)
                ->setContent($row['content'])
                ->setTitle($row['title'])
                ->setPublished_date($row['published_date'])
                ->setId($row['id'])
                ->setCategorie($categ);

        $categ->addArticle($article);

        return $article;
    }

    /**
     * Transforme un objet Zend_Model_Article en tableau de données
     * @param Core_Model_Article $article
     * @return Array
     */
    public function objectToRow(Core_Model_Article $article)
    {
        return array(
          'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'published_date' => $article->getPublished_date(),
            'author_id' => $article->getAuthor(),
            'categorie' => $article->getCategorie()->getId()
        );
    }

    /**
     * Transforme un Zend_Form en Core_Model_Article
     * @param Zend_Form $form
     * @return Core_Model_Article
     */
    public function formToArticle(Zend_Form $form)
    {
        $arrayForm = $form->getValues();
        $article = new Core_Model_Article();
        foreach($arrayForm as $key => $val)
        {
            $method = 'set' . ucfirst($key);
            if(method_exists($article, $method)){
                $article->$method(htmlspecialchars($val));
            }
        }
        return $article;
    }


}
