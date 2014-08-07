<?php

class Core_Service_Blog
{


    /**
     * Retourne les $nb derniers articles
     *
     * @param number $nb
     *            : default 5
     */
    public function fetchLastArticles($nb = 5)
    {
        $nb = (int) $nb;

        if (0 === $nb) {
            throw new \InvalidArgumentException("Le nombre d'articles doit être un entier supérieur à 0");
        }
        $mapper = new Core_Model_Mapper_Article();
        return $mapper->fetchAll(null, 'id DESC', $nb);
    }

    /**
     * Retourne l'article n° $id
     *
     * @param number $id
     * @throws \InvalidArgumentException
     * @throws \Exception
     * @return Core_Model_Entry
     */
    public function fetchArticleById($id)
    {
        if (0 === (int) $id) {
            throw new \InvalidArgumentException("L'identifiant de l'article doit être supérieur à 1");
        }
        $mapper = new Core_Model_Mapper_Article();
        $article = $mapper->find($id);
        return $article;
    }
    
    public function fetchLastArticlesByCategories($idCategorie)
    {

    	$mapper = new Core_Model_Mapper_Article();
    	$where = array(Core_Model_Mapper_Article::COL_CAT . " = ?" => $idCategorie);
    	return $mapper->fetchAll($where, 'id DESC');
    }

    /**
     * Supprime un article dont l'indentifiant est passé en paramètre
     * @param number $id
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public function deleteArticle($id)
    {
        if (0 === (int) $id) {
            throw new \InvalidArgumentException("L'identifiant de l'article doit être supérieur à 1");
        }
        $mapper = new Core_Model_Mapper_Article();
        return $mapper->delete($id);
    }


    public function createArticle(Zend_Form $form)
    {
        $mapper = new Core_Model_Mapper_Article();
        $mapper->save($mapper->formToArticle($form));
    }



    public function findCategorie($id)
    {
        if (0 === (int) $id) {
            throw new \InvalidArgumentException("L'identifiant de l'article doit être supérieur à 1");
        }
        $mapper = new Core_Model_Mapper_Categorie();
        $categ = $mapper->find($id);
        return $categ;
    }

    public function fetchAllCategories($asArray = false)
    {
        $mapper = new Core_Model_Mapper_Categorie();
        $result = $mapper->fetchAll(null, 'nom ASC');
        if(!$asArray) {        	
        	return $result;
        } else {
        	$resArray = array();
        	foreach($result as $categ){
        		$resArray[$categ->getId()] = html_entity_decode($categ->getNom());
        	}
        	return $resArray;
        }
    }
    
    
    public function fetchAllAuthors($asArray = false)
    {
    	$mapper = new Core_Model_Mapper_Auteur();
    	$result = $mapper->fetchAll(null, 'fullname ASC');
    	if (!$asArray) {
    		return $result; 
    	} else {
    		$arrayAuteurs = array();
    		foreach($result as $auteur){
    			$arrayAuteurs[$auteur->getId()] = html_entity_decode($auteur->getUsername() . ' - ' . $auteur->getFullname());
    		}
    		return $arrayAuteurs;
    	}
    }
}
