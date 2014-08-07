<?php

class Core_Bootstrap extends Zend_Application_Module_Bootstrap
{

	protected function _initAutoloading()
	{
		$autoloader = new Zend_Application_Module_Autoloader(
			array(
				'namespace' => 'Core',
				'basePath'  => APP_PATH . '/Core'
			)		
		);
		
		$autoloader->addResourceType('assert', 'asserts', 'Assert');
	}
	
	protected function _initAcl()
	{
		$acl = new Zend_Acl();
		
		$acl->addRole('Guest')
			->addRole('Staff', 'Guest') //Membre du blog pouvant mettre des commentaires
			->addRole('Editor', 'Staff') //Author hérite des droits de All
			->addRole('Admin'); //Rôle Admin hérite des droits de Member et de Author (il suffirait d'hériter de Author, mais c'est pour l'exemple)
		
		$acl->addResource(new Zend_Acl_Resource('Article')) //Accès à tous les articles
			->addResource('Author') // Administrer le blog
			->addResource('Categorie')
			->addResource('Categorie8ans', 'Categorie')
			->addResource('Categorie18ans', 'Categorie')
			->addResource('Core::index::index')
			->addResource('Core::index::view')
			->addResource('Core::index::create')
			->addResource('Core::index::delete')
			->addResource('Core::index::archiver')
			->addResource('Core::index::signin')
			->addResource('Core::index::logout')
			->addResource('Core::categorie::index')
			->addResource('Core::categorie::view')
			->addResource('Core::sandbox::index')
			->addResource('Core::error::error');


		
		//$acl->allow($role, $resource, $privileges, $assert);
		$acl->allow('Guest', 'Core::index::index', 'access') //Voir tous les articles
			->allow('Guest', 'Core::index::view', 'access') //Voir un article
			->allow('Guest', 'Core::categorie::index', 'access') //Voir les catégories
			->allow('Guest', 'Core::categorie::view', 'access') //Voir les articles d'une catégorie
			->allow('Guest', 'Core::index::signin', 'access') //Accès à la page de connexion
			->allow('Guest', null, 'connexion')
			->deny('Guest', null, 'deconnexion')
			
			->allow('Staff', 'Article', 'submit') //Soumettre un article
			->allow('Staff', 'Article', 'modify') //Modifier un article
			->allow('Staff', 'Article', 'review') //Relire un article
			->allow('Staff', 'Author', 'modify') //Modifier un auteur
			
			->allow('Editor', 'Article', 'publish') //Publier un article
			->allow('Editor', 'Article', 'archive') //Archiver un article
			->allow('Editor', 'Article', 'delete') //Supprimer un article
			
			->allow('Admin') //All rights
			->allow('Staff', 'Core::index::logout', 'access') //Droit de se déconnecter (car staff/editeur = user connecté)
			->allow('Staff', null, 'deconnexion')
			->deny(array('Admin', 'Staff'), 'Core::index::signin', 'access') //On retire les droits de connexion car déjà connecté
			->deny(array('Admin', 'Staff'), null, 'connexion')
		
			->allow(null, null, null, new Core_Assert_CleanIp());
			
		Zend_Registry::set('Zend_Acl', $acl);
		
	}
	
	protected function _initPlugins()
	{
		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Core_Plugin_Navigation())
		   //->registerPlugin(new Core_Plugin_Auth())
		   ->registerPlugin(new Core_Plugin_AccessHandler());
	}
	
}