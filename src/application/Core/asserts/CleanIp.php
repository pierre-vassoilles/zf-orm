<?php
class Core_Assert_CleanIp implements Zend_Acl_Assert_Interface
{
	
	
	/* (non-PHPdoc)
	 * @see Zend_Acl_Assert_Interface::assert()
	 */
	public function assert(Zend_Acl $acl, Zend_Acl_Role_Interface $role = null, Zend_Acl_Resource_Interface $resource = null, $privilege = null) 
	{
		// Should return true or false
		return $this->isCleanIp($_SERVER['REMOTE_ADDR']);
	}
	
	protected function isCleanIp($ip)
	{
		return ($ip === '192.168.222.222');
	}

}