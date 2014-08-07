<?php

class Core_Model_Mapper_User extends Core_Model_Mapper_MapperAbstract
{
	const TABLE = 'users';
	const COL_ID = 'id';
	const COL_LOGIN = 'login';
	const COL_PWD = 'password';


	//protected $dbTableClassname = 'Core_Model_DbTable_User';

    /**
     * Transforme une ligne de base de données Zend_Db_Table_Row en objet Core_Model_User
     *
     * @param Zend_Db_Table_Row $row
     * @return Core_Model_Categorie
     */
    public function rowToObject(Zend_Db_Table_Row $row)
    {
        $user = new Core_Model_User();
        $user->setId($row[self::COL_ID])
               ->setLogin($row[self::COL_LOGIN])
               ->setPassword($row[self::COL_PWD]);
        return $user;
    }
    
    /**
     * Retourne une utilisateur avec les information d'autentification
     * @param stdClass $row
     * @return Core_Model_User
     */
    public function authenticate(stdClass $row)
    {
    	$user = new Core_Model_User();
    	$col_id = self::COL_ID;
    	$col_login = self::COL_LOGIN;
    	$user->setId($row->$col_id)
    		 ->setLogin($row->$col_login);
    	return $user;
    }
    
    /**
     * Transforme un objet Core_Model_Auteur en tableau de données
     * @param Core_Model_User $user
     * @return Array
     */
    public function objectToRow(Core_Model_Interface $user)
    {
    	return array(
    			self::COL_ID => $auteur->getId(),
    			self::COL_LOGIN => $auteur->getUsername(),
    			self::COL_PWD => $auteur->getPassword()
    	);
    }
    
    /**
     * Renvoie un invit�
     */
    public function getGuestUser()
    {
    	$user = new Core_Model_User;
    	return $user->setLogin('Guest');
    }
}