<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(dirname(__DIR__)));
define('SRC_PATH', ROOT_PATH . DS . 'src');
define('PUBLIC_PATH', SRC_PATH . DS . 'public');
define('VENDOR_PATH', ROOT_PATH . DS . 'vendor');
define('LIB_PATH', ROOT_PATH . DS . 'library');
define('APP_PATH', SRC_PATH . DS . 'application');
define('APP_ENV', getenv('APPLICATION_ENV') ?: 'production');


require_once VENDOR_PATH . DS . 'autoload.php';

//$autoloader = Zend_Loader_Autoloader::getInstance();

// Mise en place de la gestion des erreurs
if ('development' === APP_ENV) {
	\php_error\reportErrors();
} else {
	set_exception_handler(array('\Iplib\Error', 'handleException'));
	set_error_handler(array('\Iplib\Error', 'handleError'));
}

//try {
	$application = new Zend_Application(
				APP_ENV, 
				APP_PATH . DS . 'Core' . DS . 'configs' . DS . 'application.ini'
	);
	
	$application->bootstrap()->run();
/*} catch (Zend_Config_Exception $e) {
	echo 'Problème de config : ' . $e->getMessage();
	if('development' === APP_ENV){
		echo '<pre>' . $e->getTraceAsString() . '</pre>';
	}
} catch (Zend_Application_Exception $e) {
	echo 'Problème d\'application : ' . $e->getMessage();
	if('development' === APP_ENV){
		echo '<pre>' . $e->getTraceAsString() . '</pre>';
	}
} catch (Exception $e) {
	echo 'Autre problème : ' . $e->getMessage();
	if('development' === APP_ENV){
		echo '<pre>' . $e->getTraceAsString() . '</pre>';
	}
}*/
	
	
	
function exceptionHandler($e)
{
	echo 'Erreur de l\'application';
	//logger dans syslog
	//envoyer mail admin...
}

function errorHandler($errno, $errstr, $errfile, $errline, $context)
{
	echo 'Erreur de l\'application';
}