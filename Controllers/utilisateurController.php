<?php
include "Modules/utilisateur.php";
include "Models/utilisateurManager.php";
/**
* Définition d'une classe permettant de gérer les membres 
*   en relation avec la base de données	
*/
class UtilisateurController {
    
	//private $_db; // Instance de PDO - objet de connexion au SGBD
	private $jeuManager; // instance du manager
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db, $twig) {
		//$this->_db=$db;
		$this->utilisateurManager = new UtilisateurManager($db);
		$this -> twig = $twig;
	}


	/**
	* liaison connexion à inscription
	* @param aucun
	* @return rien
	*/

	public function enregistre() {
		echo $this->twig->render('enregistrement/enregistrement.html.twig', ['session'=>$_SESSION]);

	}

	/**
	* enregistrement d'un utilisateur
	* @param aucun
	* @return rien
	*/

	public function utilisateurInscription($data) {
		$data['nom_utilisateur'] = filter_input(INPUT_POST, 'nom_utilisateur', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['prenom'] = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['nom'] = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['mail'] = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        $date['date_naiss'] = filter_input(INPUT_POST, 'date_naiss', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['mdp'] = filter_input(INPUT_POST, 'mdp', FILTER_UNSAFE_RAW);
        $uti = New Utilisateur($data);
    $utilisateur = $this->utilisateurManager->newUti($uti);
	$message='Merci pour votre inscription!';
    return $message;

	}

	/**
	* liste de tous les utilisateurs
	* @param aucun
	* @return rien
	*/

	public function listeUti() {
		$utilisateurs = $this->utilisateurManager->listuti();
		echo $this->twig->render('utilisateurs/list.html.twig', ['utilisateurs'=> $utilisateurs, 'session'=>$_SESSION]);

	}
        
	/**
	* connexion
	* @param aucun
	* @return message string -> message de retour vers l'utilisateur
	*    qu'il est bien connecté ou pas
	*/
	function utilisateurConnexion($data) {
		 // verif du login et mot de passe
		if (($uti=$this -> utilisateurManager -> verif_identification($data ['login'], $data ['passwd']))!=false)
		{ // acces autorisé : variable de session acces = oui
			$_SESSION['acces'] = "oui";
			unset($_SESSION['sessionUti']);
			$_SESSION['sessionUti']= ["nom_utilisateur"=>$uti->nom_utilisateur(),"prenom"=>$uti->prenom(), "nom"=>$uti->nom(),"mail"=>$uti->mail(),
			"date_naiss"=>$uti->date_naiss(),"date_inscr"=>$uti->date_inscr(),"mdp"=>$uti->mdp(),"admin"=>$uti->admin()];
			$message ="Bonjour ".$uti->prenom()."!";
			
		}
		else
		{ // acces non autorisé : variable de session acces = non
			$message="Identification incorrecte";
			$_SESSION['acces'] = "non";
			unset($_SESSION['sessionUti']);
			
		} 
		return $message;
		}	
	

	/**
	* deconnexion
	* @param aucun
	* @return message string -> message de retour vers l'utilisateur
	*/
	function utilisateurDeconnexion() {
		$_SESSION['acces'] = "non";
		unset($_SESSION['nom_utilisateur']);
		$message = "Vous êtes déconnecté";
		return $message;
	}

	/**
	* formulaire de connexion
	* @param aucun
	* @return rien
	*/
	function utilisateurFormulaire() {
		echo $this->twig->render('form/form.html.twig', ['session'=>$_SESSION]);

	}
}	
