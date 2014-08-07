<?php
class Core_SandboxController extends Zend_Controller_Action
{
	
	protected $userAuth;

	public function init()
	{		
		$this->_helper->viewRenderer->setNoRender(true);
		//$this->_helper->layout->disableLayout();
		
		$auth = Zend_Auth::getInstance();
		$this->userAuth = $auth->getIdentity();
	}
	
	public function indexAction()
	{
		echo "<div class='page-header'><h1><small> - </small>Sandbox<small> - </small></h1></div>";	
		echo "<pre>";
		//$acl = new Zend_Acl();
		$acl = Zend_Registry::get('Zend_Acl');
		
		//echo $acl->hasRole('Admin');
		
		// isAllowed($role, $resource, $privilege)
		//var_dump($this->userAuth);
		
		if($acl->isAllowed($this->userAuth, 'Article', 'publish')) {
			echo "Bienvenue!";
		} else {
			return $this->_helper->redirector('index', 'index');
		}
		
		$userMapper = new Core_Model_Mapper_User;
		echo "<table class='table table-hover'>";
		echo "<thead><tr><th>Login</th><th>Password</th></tr></thead><tbody>";
		foreach($userMapper->fetchAll() as $user){
			echo "<tr>";
			echo "<td>" . $user->getLogin() . "</td>";
			echo "<td>" . $user->getPassword() . "</td>";
			echo "</tr>";
		}
		echo "</tbody></table>";
		
		echo "</pre>";
	}
}