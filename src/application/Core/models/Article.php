<?php

class Core_Model_Article
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
        $this->author = $author;
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
            $categ = new Core_Model_Categorie();
            $categ->setId($categorie);
        }else{
            $categ = $categorie;
        }
        $this->categorie = $categ;
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