<?php

// création classe note (et commentaire)

class Note {
	private $_nom_utilisateur;   
	private $_Id_jeu;
	private $_date_ajout;
	private $_commentaire;
	private $_note;
		
	// contructeur
	public function __construct(array $donnees) {
	// initialisation d'un produit à partir d'un tableau de données
		if (isset($donnees['nom_utilisateur']))       { $this->_nom_utilisateur =       $donnees['nom_utilisateur']; }
		if (isset($donnees['Id_jeu']))    { $this->_Id_jeu =    $donnees['Id_jeu']; }
		if (isset($donnees['date_ajout']))  { $this->_date_ajout =  $donnees['date_ajout']; }
		if (isset($donnees['commentaire'])) { $this->_commentaire = $donnees['commentaire']; }
		if (isset($donnees['note'])) { $this->_note = $donnees['note']; }
	}           
	// GETTERS //
	public function nom_utilisateur()       { return $this->_nom_utilisateur;}
	public function Id_jeu()    { return $this->_Id_jeu;}
	public function date_ajout()  { return $this->_date_ajout;}
	public function commentaire() { return $this->_commentaire;}
	public function note() { return $this->_note;}
		
	// SETTERS //
	public function setIdJeu($_nom_utilisateur)             { $this->_nom_utilisateur = $nom_utilisateur; }
	public function setId_jeu($Id_jeu)       { $this->_Id_jeu = $Id_jeu; }
	public function setdate_ajout($date_ajout)   { $this->_date_ajout= $date_ajout; }
	public function setcommentaire($commentaire) { $this->_commentaire = $commentaire; }
	public function setnote($note) { $this->_note = $note; }

}
