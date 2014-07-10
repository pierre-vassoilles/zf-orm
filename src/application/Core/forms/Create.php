<?php

class Core_Form_Create extends Zend_Form
{
    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');

        // Un élément Titre
        $this->addElement('text', 'title', array(
            'label'      => 'Titre de l\'article:',
            'required'   => true,
            'class'      => "form-control",
            'filters'    => array('StringTrim'),
        ));

        // Un élément pour le commentaire
        $this->addElement('textarea', 'content', array(
            'label'      => 'L\'article:',
            'required'   => true,
            'class'      => "form-control"
        ));

        // Un élément Select Categories
        $blog = new Core_Service_Blog();
        $categories = $blog->fetchAllCategories();
        $arrayCateg = array();
        foreach($categories as $categ){
            $arrayCateg[$categ->getId()] = $categ->getNom();
        }

        $this->addElement('select', 'categorie', array(
            'label'      => 'Choisissez une question:',
            'class'      => "form-control",
            'multiOptions'    => $arrayCateg,
        ));

        $this->addElement('hidden', 'author', array(
            'value' => '1'
        ));

        // Un bouton d'envoi
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'class'    => "btn btn-default",
            'label'    => 'Enregistrer',
        ));



    }
}