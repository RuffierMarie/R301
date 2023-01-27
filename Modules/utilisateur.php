<?php
//création class
class Utilisateur {
        private string $_nom_utilisateur;
        private string $_prenom;
        private string $_nom;
		private string $_mail;
		private string $_date_naiss;
		private string $_date_inscr;
        private string $_mdp;
		private string $_admin;
		
        // contructeur
        public function __construct(array $donnees) {
		// initialisation d'un produit à partir d'un tableau de données
			if (isset($donnees['nom_utilisateur'])) { $this->_nom_utilisateur = $donnees['nom_utilisateur']; }
			if (isset($donnees['prenom'])) { $this->_prenom = $donnees['prenom']; }
            if (isset($donnees['nom'])) { $this->_nom = $donnees['nom']; }
			if (isset($donnees['mail'])) { $this->_mail = $donnees['mail']; }
			if (isset($donnees['date_naiss'])) { $this->_date_naiss = $donnees['date_naiss']; }
			if (isset($donnees['date_inscr'])) { $this->_date_inscr = $donnees['date_inscr']; }
			if (isset($donnees['mdp'])) { $this->_mdp = $donnees['mdp']; }
			if (isset($donnees['admin'])) { $this->_admin = $donnees['admin']; }
        }           
        // GETTERS //
		public function nom_utilisateur() { return $this->_nom_utilisateur;}
		public function prenom() { return $this->_prenom;}
        public function nom() { return $this->_nom;}
		public function mail() { return $this->_mail;}
		public function date_naiss() { return $this->_date_naiss;}
		public function date_inscr() { return $this->_date_inscr;}
		public function mdp() { return $this->_mdp;}
		public function admin() { return $this->_admin;}
		
		// SETTERS //
		public function setNomUtilisateur(int $idmembre) { $this->_idmembre = $idmembre; }
		public function setPrenom(string $prenom) { $this->_prenom = $prenom; }
        public function setNom(string $nom) { $this->_nom= $nom; }
		public function setMail(string $mail) { $this->_mail = $mail; }
		public function setDateNaiss(string $date_naiss) { $this->_date_naiss = $date_naiss; }
		public function setDateInscr(int $date_inscr) { $this->_date_inscr = $date_inscr; }
		public function setSexe(string $mdp) { $this->_mdp = $mdp; }	
		public function setAdmin(int $admin) { $this->_admin = $admin; }		

    }

?>