<?php
/**
* Définition d'une classe permettant de gérer les categories
*   en relation avec la base de données	
*/
class CategorieManager {
    
	private $_db; // Instance de PDO - objet de connexion au SGBD
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db) {
		$this->_db=$db;
	}


	public function getCategories() {
		$categories = array();
		$req = "SELECT nom_categorie FROM categorie";
		$stmt = $this->_db->prepare($req);
		$stmt->execute();
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		// recup des données
		while ($donnees = $stmt->fetch())
		{
			$categories[] = new Categorie($donnees);
		}
		return $categories;
	}




}

