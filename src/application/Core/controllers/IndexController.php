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

        $this->view->article = $article;
    }

    public function createAction()
    {
        $request = $this->getRequest();
        $form = new Core_Form_Create();

        if ($this->getRequest()->isPost()) {
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
}
