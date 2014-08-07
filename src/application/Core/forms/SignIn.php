<?php
class Core_Form_SignIn extends Zend_Form
{
	
	public function init()
	{
		// La méthode HTTP d'envoi du formulaire
		$this->setAction('')->setMethod(Zend_Form::METHOD_POST);
		
		// Un élément Titre
		$this->addElement('text', 'id', array(
				'placeholder'      => 'Username',
				'required'   => true,
				'class'      => "form-control",
				'filters'    => array('StringTrim'),
		));
		$this->getElement('id')
		->addValidator(new Zend_Validate_NotEmpty());
		
		// Un élément Titre
		$this->addElement('password', 'psw', array(
				'placeholder'      => 'Password',
				'required'   => true,
				'class'      => "form-control",
				'filters'    => array('StringTrim'),
		));
		$this->getElement('psw')
		->addValidator(new Zend_Validate_NotEmpty());
		
		// Un bouton d'envoi
		$this->addElement('submit', 'submit', array(
				'ignore'   => true,
				'class'    => "btn btn-primary",
				'label'    => 'Sign in',
		));
	}
}