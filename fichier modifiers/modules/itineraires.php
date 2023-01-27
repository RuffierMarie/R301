<?php
/**
* définition de la classe itineraire
*/
class Itineraire {
	private $_iditi;   
	private $_idmembre;
	private $_lieudepart;
	private $_lieuarrivee;
	private $_heuredepart;
	private $_datedepart;
	private $_tarif;
	private $_nbplaces;
	private $_bagagesautorises;
	private $_details;
		
	// contructeur
	public function __construct(array $donnees) {
	// initialisation d'un produit à partir d'un tableau de données
		if (isset($donnees['iditi']))       { $this->_iditi =       $donnees['iditi']; }
		if (isset($donnees['idmembre']))    { $this->_idmembre =    $donnees['idmembre']; }
		if (isset($donnees['lieudepart']))  { $this->_lieudepart =  $donnees['lieudepart']; }
		if (isset($donnees['lieuarrivee'])) { $this->_lieuarrivee = $donnees['lieuarrivee']; }
		if (isset($donnees['heuredepart'])) { $this->_heuredepart = $donnees['heuredepart']; }
		if (isset($donnees['datedepart']))  { $this->_datedepart =  $donnees['datedepart'];}		
		if (isset($donnees['tarif']))       { $this->_tarif =       $donnees['tarif']; }
		if (isset($donnees['nbplaces']))    { $this->_nbplaces =    $donnees['nbplaces']; }
		if (isset($donnees['bagagesautorises'])) { $this->_bagagesautorises = $donnees['bagagesautorises']; }
		if (isset($donnees['details']))     { $this->_details =     $donnees['details']; }
	}           
	// GETTERS //
	public function idIti()       { return $this->_iditi;}
	public function idMembre()    { return $this->_idmembre;}
	public function lieuDepart()  { return $this->_lieudepart;}
	public function lieuArrivee() { return $this->_lieuarrivee;}
	public function heureDepart() { return $this->_heuredepart;}
	public function dateDepart()  { return $this->_datedepart;}
	public function tarif()       { return $this->_tarif;}
	public function nbPlaces()    { return $this->_nbplaces;}
	public function bagagesAutorises() { return $this->_bagagesautorises;}
	public function details()     { return $this->_details;}
		
	// SETTERS //
	public function setIditi($iditi)             { $this->_iditi = $iditi; }
	public function setIdMembre($idmembre)       { $this->_idmembre = $idmembre; }
	public function setLieuDepart($lieudepart)   { $this->_lieudepart= $lieudepart; }
	public function setLieuArrivee($lieuarrivee) { $this->_lieuarrivee = $lieuarrivee; }
	public function setHeureDepart($heuredepart) { $this->_heuredepart = $heuredepart; }
	public function setDateDepart($datedepart)   { $this->_datedepart = $datedepart; }
	public function setTarif($tarif)             { $this->_tarif = $tarif; }
	public function setNbPlaces($nbplaces)       { $this->_nbplaces = $nbplaces; }
	public function setBagagesAutorises($bagagesautorises) { $this->_bagagesautorises = $bagagesautorises; }
	public function setDetails($details)         { $this->_details = $details; }	

}

