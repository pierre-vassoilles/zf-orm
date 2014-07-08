<?php

class Single
{
	/**
	 * Variable de classe qui va contenir notre objet
	 * @var self
	 */
	private static $instances = array();
	
	
	/**
	 * Singleton = contructeur privé
	 */
	private function __construct()
	{
		//Do something here
	}
	
	/**
	 * Sert à instancier l'objet s'il ne l'est pas et à le renvoyer dans tous les cas
	 * @return Single $instance
	 */
	public static function getInstance()
	{
		$class = get_called_class();
		
		if (! isset(self::$instances[$class]) ) {
			self::$instances[$class] = new $class();
		}
		
		return self::$instances[$class];
	}

	/**
	 * Méthode privée pour qu'elle ne puisse pas être utilisée
	 */
	final public function __clone(){
		trigger_error('Clonage interdit', E_USER_ERROR);
	}
	
	
	
}