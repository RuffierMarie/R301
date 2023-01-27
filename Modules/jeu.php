<?php

// création classe jeu

class Jeu {
	private $_Id_jeu;   
	private $_titre;
	private $_temps;
	private $_regles;
	private $_materiel;
	private $_nb_joueurs;
	private $_age_min;
	private $_img_jeu;
	private $_nom_categorie;
	private $_nom_utilisateur;
		
	// contructeur
	public function __construct(array $donnees) {
	// initialisation d'un produit à partir d'un tableau de données
		if (isset($donnees['Id_jeu']))       { $this->_Id_jeu =       $donnees['Id_jeu']; }
		if (isset($donnees['titre']))    { $this->_titre =    $donnees['titre']; }
		if (isset($donnees['temps']))  { $this->_temps =  $donnees['temps']; }
		if (isset($donnees['regles'])) { $this->_regles = $donnees['regles']; }
		if (isset($donnees['materiel'])) { $this->_materiel = $donnees['materiel']; }
		if (isset($donnees['nb_joueurs']))  { $this->_nb_joueurs =  $donnees['nb_joueurs'];}		
		if (isset($donnees['age_min']))       { $this->_age_min =       $donnees['age_min']; }
		if (isset($donnees['img_jeu']))    { $this->_img_jeu =    $donnees['img_jeu']; }
		if (isset($donnees['nom_categorie'])) { $this->_nom_categorie = $donnees['nom_categorie']; }
		if (isset($donnees['nom_utilisateur']))     { $this->_nom_utilisateur =     $donnees['nom_utilisateur']; }
	}           
	// GETTERS //
	public function Id_jeu()       { return $this->_Id_jeu;}
	public function titre()    { return $this->_titre;}
	public function temps()  { return $this->_temps;}
	public function regles() { return $this->_regles;}
	public function materiel() { return $this->_materiel;}
	public function nb_joueurs()  { return $this->_nb_joueurs;}
	public function age_min()       { return $this->_age_min;}
	public function img_jeu()    { return $this->_img_jeu;}
	public function nom_categorie() { return $this->_nom_categorie;}
	public function nom_utilisateur()     { return $this->_nom_utilisateur;}
		
	// SETTERS //
	public function setId_jeu($Id_jeu)             { $this->_Id_jeu = $Id_jeu; }
	public function setTitre($titre)       { $this->_titre = $titre; }
	public function setTemps($temps)   { $this->_temps= $temps; }
	public function setRegles($regles) { $this->_regles = $regles; }
	public function setMateriel($materiel) { $this->_materiel = $materiel; }
	public function setNbJoueurs($nb_joueurs)   { $this->_nb_joueurs = $nb_joueurs; }
	public function setAgeMin($age_min)             { $this->_age_min = $age_min; }
	public function setImgJeu($img_jeu)       { $this->_img_jeu = $img_jeu; }
	public function setNomCategorie($nom_categorie) { $this->_nom_categorie = $nom_categorie; }
	public function setNomUtilisateur($nom_utilisateur)         { $this->_nom_utilisateur = $nom_utilisateur; }	

}
