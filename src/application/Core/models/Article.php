<?php

class Core_Model_Article implements Core_Model_Interface, Zend_Acl_Resource_Interface
{

    /**
     * @var number
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;
    /**
     * @var date
     */
    private $published_date;
    /**
     * @var number
     */
    private $author;
    /**
     * @var Core_Model_Categorie
     */
    private $categorie;


	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

	/**
     * @return the $content
     */
    public function getContent()
    {
        return $this->content;
    }

	/**
     * @return the $published_date
     */
    public function getPublished_date()
    {
        return $this->published_date;
    }

	/**
     * @return the $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

	/**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

	/**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

	/**
     * @param date $published_date
     */
    public function setPublished_date($published_date)
    {
        $date = DateTime::createFromFormat('Y-m-d', $published_date);
        $this->published_date = $date->format('d/m/Y');
        return $this;
    }

	/**
     * @param number $author
     */
    public function setAuthor($author)
    {
    	if ($author instanceof Core_Model_Auteur) {
    		$this->author = $author;
    	} elseif (!$author instanceof Core_Model_Auteur && 0 !== (int) $author) {
    		$mapperAuthor = new Core_Model_Mapper_Auteur();    		
        	$this->author = $mapperAuthor->find($author);
    	}
        return $this;
    }

    /**
     * @return the $categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

	/**
     * @param Core_Model_Categorie $categorie
     */
    public function setCategorie($categorie)
    {
        if(!$categorie instanceof Core_Model_Categorie && 0 !== (int) $categorie){
            $mapperCateg = new Core_Model_Mapper_Categorie();
        	$categ = $mapperCateg->find($categorie);
        	if(null === $categ) {
        		throw new Zend_Db_Table_Exception('La catégorie sélectionnée n\'existe pas !');
        	}
        }else{
            $categ = $categorie;
        }
        $this->categorie = $categ;
        return $this;
    }

	/**
     * Getter gÃ©nÃ©rique
     * @param unknown $attr
     */
    public function __get($attr)
    {
        $method = 'get' . ucfirst($attr);
        return $this->$method();
    }
    
	/* (non-PHPdoc)
	 * @see Zend_Acl_Resource_Interface::getResourceId()
	 */
	public function getResourceId() {
		// TODO Auto-generated method stub
		return 'Article';
	}

    
    


}