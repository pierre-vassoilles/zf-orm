<?php
class Core_CategorieController extends Zend_Controller_Action
{
	/**
	 * @var Core_Service_Blog
	 */
	protected $blogSrv;
	
	public function init()
	{
		$this->blogSrv = new Core_Service_Blog();
	}
	
	public function indexAction() 
	{
		$this->view->categories = $this->blogSrv->fetchAllCategories();
	}
	
	public function viewAction()
	{
		$id = (int) $this->getRequest()->getParam("id");
        if(0 === $id) throw new Zend_Controller_Action_Exception("Article inconnu", 404);
		
		$this->view->articles = $this->blogSrv->fetchLastArticlesByCategories($id);
		$this->view->categorie = $this->blogSrv->findCategorie($id);
		
	}
	
	
	
}