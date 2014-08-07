<?php

class Core_Form_Create extends Zend_Form
{
    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setAction('')->setMethod(Zend_Form::METHOD_POST);

        // Un élément Titre
        $this->addElement('text', 'title', array(
            'label'      => 'Titre de l\'article:',
            'required'   => true,
            'class'      => "form-control",
            'filters'    => array('StringTrim'),
        ));
        $this->getElement('title')
        	 ->addValidator(new Zend_Validate_NotEmpty());

        // Un élément pour le commentaire
        $this->addElement('textarea', 'content', array(
            'label'      => 'L\'article:',
            'required'   => true,
            'class'      => "form-control"
        ));
        $this->getElement('content')
        	 ->addValidator(new Zend_Validate_NotEmpty());

        // Un élément Select Categories
        $blog = new Core_Service_Blog();

        $this->addElement('select', 'categorie', array(
            'label'      => 'Choisissez une categorie:',
            'class'      => "form-control",
            'multiOptions'    => $blog->fetchAllCategories(true),
        ));
        $this->getElement('categorie')
        	 ->addValidator(new Zend_Validate_NotEmpty());

        $this->addElement('select', 'author', array(
        		'label'      => 'Choisissez un auteur:',
        		'class'      => "form-control",
        		'multiOptions'    => $blog->fetchAllAuthors(true),
        ));
        $this->getElement('author')
        	 ->addValidator(new Zend_Validate_NotEmpty());
        
        // Un bouton d'envoi
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'class'    => "btn btn-default",
            'label'    => 'Enregistrer',
        ));



    }
}