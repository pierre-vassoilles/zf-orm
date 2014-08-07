<?php
class Core_Model_User implements Core_Model_Interface, Zend_Acl_Role_Interface
{

	/**
	 * @var number
	 */
	protected $id;
	/**
	 * @var string
	 */
	protected $login;
	/**
	 * @var string
	 */
	protected $password;



	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $login
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @param string $login
	 */
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	
	public function getRoleId()
	{
		return ucfirst($this->getLogin());
	}
	
	/**
	 * Getter générique
	 * @param unknown $attr
	 */
	public function __get($attr)
	{
		$method = 'get' . ucfirst($attr);
		return $this->$method();
	}


}
