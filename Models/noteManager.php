<?php
/**
* Définition d'une classe permettant de gérer les notes et commentaires
*   en relation avec la base de données	
*/
class NoteManager {
    
	private $_db; // Instance de PDO - objet de connexion au SGBD
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db) {
		$this->_db=$db;
	}

	public function noteCommentaire($Id) {
		$notes = array();
		$req = "SELECT * FROM noter_et_commenter WHERE Id_jeu = ?";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($Id));
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		// récup des données
		while ($donnees = $stmt->fetch())
		{
			$notes[] = new Note($donnees);
		}
		return $notes;
	}

	public function addNote($note) {
	
		$req = "INSERT INTO noter_et_commenter (nom_utilisateur,Id_jeu,date_ajout,commentaire,note) VALUES (?,?,?,?,?)";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($note->nom_utilisateur(),$note->Id_jeu(),date("Y-m-d H:i:s"),$note->commentaire(),$note->note(),));
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		// récup des données
		while ($donnees = $stmt->fetch())
		{
			$note[] = new Note($donnees);
		}
		return $note;
	}
}
