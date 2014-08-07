<?php
class Owner implements Zend_Acl_Assert_Interface
{
	/* (non-PHPdoc)
	 * @see Zend_Acl_Assert_Interface::assert()
	 */
	public function assert(Zend_Acl $acl, Zend_Acl_Role_Interface $role = null, Zend_Acl_Resource_Interface $resource = null, $privilege = null) {
		// TODO Auto-generated method stub
		//return $this->isOwner();
		
		
	}

	protected function isOwner()
	{
		
	}
}