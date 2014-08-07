<?php

class Core_IndexController extends Zend_Controller_Action
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

        $this->view->entries = $this->blogSrv->fetchLastArticles($this->getRequest()->getParam("nb"));
    }

    public function viewAction()
    {
        $id = (int) $this->getRequest()->getParam("id");
        if(0 === $id) throw new Zend_Controller_Action_Exception("Article inconnu", 404);

        $article = $this->blogSrv->fetchArticleById($this->getRequest()->getParam("id"));
        if(!$article) throw new Zend_Controller_Action_Exception("Article inconnu", 404);
        
        //Cible le conteneur Zend_Navigation principal
        $nav = Zend_Registry::get('Zend_Navigation');
        //Cible le sous conteneur Article (page)
        $articleNav = $nav->findById('coreIndexIndex');
		//Crée la nouvelle pahe correspondant à l'article en cours
		$articlePage = Zend_Navigation_Page::factory(
			array (
				'type' => 'mvc',
				'module' => 'Core',
				'controller' => 'index',
				'action' => 'view',
				'params' => array('id' => $id),
				'route' => 'coreIndexView',
				'visible' => false,
				'label' => $article->getTitle()
			)
		);
		//Injecte la nouvelle page dans le sous conteneur Articles
        $articleNav->addPage($articlePage);
        
        
        $this->view->article = $article;
    }

    public function createAction()
    {
        $request = $this->getRequest();
        $form = new Core_Form_Create();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $this->blogSrv->createArticle($form);
                return $this->_helper->redirector('index');
            }
        }
        return $this->view->form = $form;
    }


    public function deleteAction()
    {
        $this->blogSrv->deleteArticle($this->getRequest()->getParam('id'));
        return $this->_helper->redirector('index');
    }
    
    public function signinAction()
    {
    	$this->_helper->layout()->setLayout('signin');
    	$request = $this->getRequest();
    	$form = new Core_Form_SignIn();
    	
    	if ($request->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$login = $form->getValue('id');
    			$psw = $form->getValue('psw');
    			
    			$adapter = new Zend_Auth_Adapter_DbTable();
    			$adapter->setTableName('users')
    					->setIdentityColumn('login')
    					->setCredentialColumn('password')
    					->setIdentity($login)
    					->setCredential($psw);
    			
    			$auth = Zend_Auth::getInstance();
    			
    			$authResult = $auth->authenticate($adapter);
    			
    			if($authResult->getCode() ==  Zend_Auth_Result::SUCCESS) {
	    			return $this->_helper->redirector('index');
    			}
    		}
    	}
    	return $this->view->form = $form;
    }
    
    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	return $this->_helper->redirector('index');
    }
    
    
    
}
