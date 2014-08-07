<?php

class Core_Model_Categorie implements Core_Model_Interface
{
    /**
     * @var number
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $color;
    /**
     * @var array of Core_Model_Article
     */
    private $articles = array();
    /**
     * @var Core_Model_Categorie 
     */
    private $parent_categ;


	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $nom
     */
    public function getNom()
    {
        return $this->nom;
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
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return the $color
     */
    public function getColor()
    {
        return $this->color;
    }

	/**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

	/**
     * @return the $articles
     */
    public function getArticles()
    {
        return $this->articles;
    }

	/**
     * @param Array of Core_Model_Article
     */
    public function setArticles(Array $articles)
    {
        $this->articles = $articles;
        return $this;
    }

    public function addArticle(Core_Model_Article $art)
    {
        $this->articles[] = $art;
        return $this;
    }
    /**
     * @return the $parent_categ
     */
    public function getParent_categ() {
    	return $this->parent_categ;
    }
    
    /**
     * @param Core_Model_Categorie $parent_categ
     */
    public function setParent_categ($parent_categ) {
    	$this->parent_categ = $parent_categ;
    	return $this;
    }

	/**
     * Getter générique
     * @param unknown $attr
     */
    public function __get($attr)
    {
        $method = 'get' . ucfirst($attr);
        return $this->$method();
    }

  

}