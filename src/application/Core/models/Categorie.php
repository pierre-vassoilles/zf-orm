<?php

class Core_Model_Categorie
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
     * Getter générique
     * @param unknown $attr
     */
    public function __get($attr)
    {
        $method = 'get' . ucfirst($attr);
        return $this->$method();
    }

}