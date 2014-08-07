<?php

class Core_Model_Mapper_Article extends Core_Model_Mapper_MapperAbstract
{
	
	const TABLE = 'entries';
	const COL_ID = 'id';
	const COL_TITLE = 'title';
	const COL_CONTENT = 'content';
	const COL_DATE = 'published_date';
	const COL_AUTH = 'author_id';
	const COL_CAT = 'categorie';

	//protected $dbTableClassname = 'Core_Model_DbTable_Article';




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
                ->setContent($row[self::COL_CONTENT])
                ->setTitle($row[self::COL_TITLE])
                ->setPublished_date($row[self::COL_DATE])
                ->setId($row[self::COL_ID])
                ->setCategorie($categ);

        $categ->addArticle($article);

        return $article;
    }

    /**
     * Transforme un objet Zend_Model_Article en tableau de données
     * @param Core_Model_Article $article
     * @return Array
     */
    public function objectToRow(Core_Model_Interface $article)
    {
        return array(
           self::COL_ID => $article->getId(),
           self::COL_TITLE => $article->getTitle(),
           self::COL_CONTENT => $article->getContent(),
           self::COL_DATE => $article->getPublished_date(),
           self::COL_AUTH => $article->getAuthor()->getId(),
           self::COL_CAT => $article->getCategorie()->getId()
        );
    }

    /**
     * Transforme un Zend_Form en Core_Model_Article
     * @param Zend_Form $form
     * @return Core_Model_Article
     */
    public function formToArticle(Zend_Form $form)
    {
        return $this->arrayToObject($form->getValues());
    }
    
    /**
     * Transforme un Array en Core_Model_Article
     * @param Zend_Form $form
     * @return Core_Model_Article
     */
    public function arrayToObject(array $array = array())
    {
    	$article = new Core_Model_Article();
    	
    	if(array_key_exists('id', $array)) {
    		$article->setId($array['id']);
    	}
    	$article->setContent($array['content'])
    			->setTitle($array['title']);
    	
    	$mapperCateg = new Core_Model_Mapper_Categorie();
    	$article->setCategorie($mapperCateg->find($array['categorie']));
    	
    	$mapperAuthor = new Core_Model_Mapper_Auteur();
    	$article->setAuthor($mapperAuthor->find($array['author']));
    	
    	/*foreach($array as $key => $val)
    	{
    		$method = 'set' . ucfirst($key);
    		if(method_exists($article, $method)){
    			$article->$method(htmlspecialchars($val));
    		}
    	}*/
    	return $article;
    }


}
