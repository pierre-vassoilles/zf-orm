<?php
class Core_Plugin_Navigation extends Zend_Controller_Plugin_Abstract 
{
	
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
	{
		$blogSrv = new Core_Service_Blog();
		$categories = $blogSrv->fetchAllCategories();
		
		
		//Cible le conteneur Zend_Navigation principal
		$nav = Zend_Registry::get('Zend_Navigation');
		//Cible le sous conteneur Article (page)
		$categorieNav = $nav->findById('coreCategorieIndex');

		foreach ($categories as $categ) {
			//Crée la nouvelle pahe correspondant à l'article en cours
			$categoriePage = Zend_Navigation_Page::factory(
					array (
							'type' => 'mvc',
							'module' => 'Core',
							'controller' => 'categorie',
							'action' => 'view',
							'params' => array('id' => $categ->getId()),
							'route' => 'coreCategorieView',
							'visible' => true,
							'label' => html_entity_decode($categ->getNom())
					)
			);
			//Injecte la nouvelle page dans le sous conteneur Articles
			$categorieNav->addPage($categoriePage);
		}
	}
	
	
}