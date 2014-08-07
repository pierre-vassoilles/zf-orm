<?php
class Core_Navigation_PageArticle extends Zend_Navigation_Page_Mvc
{
	/**
	 * @see Zend_Navigation_Page::getHref()
	 */
	public function getHref() {
		// TODO Auto-generated method stub
		return "";
	}
	
	public function __construct()
	{
		$articleId = $this->getParam('id');
		
		var_dump($articleId);
		//$blogSrv = new Core_Service_Blog();	
	}

	
}