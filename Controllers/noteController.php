<?php
include "Modules/note.php";
include "Models/noteManager.php";
/**
* Définition d'une classe permettant de gérer les itinéraires 
*   en relation avec la base de données	
*/
class NoteController {
    
	//private $_db; // Instance de PDO - objet de connexion au SGBD
	private $noteManager; // instance du manager
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db, $twig) {
		//$this->_db=$db;
		$this->noteManager = new NoteManager($db);
		$this->twig=$twig;
	}

	
	// affiche page commenter et noter
	public function noterJeu($Id) {
		echo $this->twig->render('commenter/commenter.html.twig', [ 'session'=>$_SESSION, 'Id' =>$Id,'nom_utilisateur'=>$_SESSION["sessionUti"]["nom_utilisateur"]]);
	}


	// publier un commentaire
	public function publier($data) {
		$note = new Note($_POST);
		$note = $this->noteManager->addNote($note);
		if ($note) {
			$message = "Note et commentaire ajouté" ;
		}
		
		else {
			$message = "Probleme lors de l'ajout de la note et du commentaire";
		}
			return $message;
	}
}
