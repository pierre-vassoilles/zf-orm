<?php
abstract class Core_Model_Mapper_MapperAbstract
{
	
	protected $dbTable;
	protected $dbTableClassname;
	const COL_ID = null;
	
	public function __construct() 
	{
		if (empty($this->dbTableClassname)) {
			$this->dbTableClassname = str_replace("Mapper", "DbTable", get_called_class());
		} 
		$this->dbTable = new $this->dbTableClassname;
		$this->init();
	}
	
	
	public function fetchAll($where = null, $order = null, $count = null, $offset = null)
	{
		$rowset = $this->dbTable->fetchAll($where, $order, $count, $offset);
	
		$result = array();
		if (0 === count($rowset)) {
			return $result;
		}
		foreach ($rowset as $row) {
			$result[] = $this->rowToObject($row);
		}
		return $result;
	}
	
	public function find($id)
	{
		$row = $this->dbTable->find($id)->current();
		return $this->rowToObject($row);
	}



	/**
	 * MÃ©thode insert or update d'un objet Core_Model_Article
	 * @param Core_Model_Article $article
	 */
	public function save(Core_Model_Interface $object)
	{
		
		if(null === static::COL_ID){
			throw new BadMethodCallException("La méthode save() générique ne peut fonctionner qu'avec les mappers pourvus d'une constante COL_ID.
												Vous devez implémenter votre propre méthode save() pour le mapper actuel.");
		}
		
		$origin = $this->dbTable->find($object->getId())->current();
		$row = $this->objectToRow($object);
		if($origin instanceof Zend_Db_Table_Row_Abstract){
			//update
			$where = array(static::COL_ID . ' = ?' => $object->getId());
			$this->dbTable->update($row, $where);
		}else{
			//insert
			unset($row[static::COL_ID]);
			
			$row[static::COL_DATE] = date("Y-m-d");
			
			$this->dbTable->insert($row);
		}
	
	}
	
	/**
	 * Supprime l'élément dont l'indentifiant est en paramÃ¨tre
	 * @param number $id
	 * @throws Zend_Db_Table_Row_Exception
	 * @return boolean
	 */
	public function delete($id)
	{
		$row = $this->dbTable->find($id)->current();
		if(!$row instanceof Zend_Db_Table_Row_Abstract) {
			throw new Zend_Db_Table_Row_Exception("Impossible de supprimer l'element n°$id");
		}
		return (bool) $row->delete();
	}
	
	/**
	 * Méthode facultative : pseudo constructeur
	 */
	public function init(){}
	
	/**
	 * Méthode à surcharger obligatoirement dans toutes les classes filles
	 * @param Zend_Db_Table_Row $row
	 */
	abstract public function rowToObject(Zend_Db_Table_Row $row);
	
	abstract public function objectToRow(Core_Model_Interface $object);
	
	
}