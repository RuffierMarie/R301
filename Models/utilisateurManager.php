<?php

/**
* Définition d'une classe permettant de gérer les membres 
* en relation avec la base de données
*
*/

class UtilisateurManager
    {
        private $_db; // Instance de PDO - objet de connexion au SGBD
        
		/** 
		* Constructeur = initialisation de la connexion vers le SGBD
		*/
        public function __construct($db) {
            $this->_db=$db;
        }

		/**
	* retourne l'ensemble des utilisateur présents dans la BD 
	* @return Jeu[]
	*/
	public function listuti() {
		$jeux = array();
		$req = "SELECT * FROM utilisateur";
		$stmt = $this->_db->prepare($req);
		$stmt->execute();
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		// récup des données
		while ($donnees = $stmt->fetch())
		{
			$utilisateurs[] = new Utilisateur($donnees);
		}
		return $utilisateurs;
	}
		

		/**
		* verification de l'identité d'un utilisateur (Login/password)
		* @param string $login
		* @param string $password
		* @return utilisateur si authentification ok, false sinon
		*/
		public function verif_identification($login, $password) {
		//echo $login." : ".$password;
		$req ="SELECT nom_utilisateur, prenom,nom, mail, date_naiss, date_inscr,mdp,admin FROM utilisateur WHERE mail=? and mdp=?";
		$stmt =$this ->_db->prepare($req);
		$stmt->execute(array($login, $password));
		if ($data=$stmt->fetch()){
			$utilisateur =new Utilisateur($data);
			return $utilisateur;
			}
		else return false;
		}

		// création d'un nouvel utilisateur
		public function newUti($uti){
            $req = "INSERT INTO utilisateur(nom_utilisateur,prenom,nom, mail, date_naiss, mdp, date_inscr, admin) VALUES (?,?,?,?,?,?,?,0)";
            $stmt=$this->_db->prepare($req);
            $stmt->execute(array($uti->nom_utilisateur(), $uti->prenom(), $uti->nom(), $uti->mail(), $uti->date_naiss(), $uti->mdp(), date("Y-m-d H:i:s")));
            if ($uti=$stmt->fetch()){
                $utilisateur =new Utilisateur($uti);
                return $utilisateur;
                }
            else return false;
            }


		}


		
?>