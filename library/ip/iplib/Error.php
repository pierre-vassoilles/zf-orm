<?php
namespace Iplib;
/**
 * Classe qui permet de récupérer et traiter les erreurs/exceptions
 * 
 * 
 * @author pvassoi
 *
 */
class Error 
{
	/**
	 * Récupère une exception
	 * @param \Exception $e : exception catchée
	 */
	public static function handleException(\Exception $e)
	{
		echo 'Erreur de l\'application';
	}
	
	/**
	 * Récupère une erreur
	 * @param unknown $errno : numéro d'erreur
	 * @param String $errstr : message d'erreur
	 * @param String $errfile : fichier dans lequel on trouve l'erreur
	 * @param unknown $errline : ligne de l'erreur dans le $errfile
	 * @param unknown $context : ?
	 */
	public static function handleError($errno, $errstr, $errfile, $errline, $context)
	{
		echo 'Erreur de l\'application';
	}
	
}