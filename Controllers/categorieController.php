<?php
include "Modules/categorie.php";
include "Models/categorieManager.php";
/**
* Définition d'une classe permettant de gérer les itinéraires 
*   en relation avec la base de données	
*/
class CategorieController {
    
	//private $_db; // Instance de PDO - objet de connexion au SGBD
	private $categorieManager; // instance du manager
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db, $twig) {
		//$this->_db=$db;
		$this->CategorieManager = new CategorieManager($db);
		$this->twig=$twig;
	}
}