<?php
/**
* Définition d'une classe permettant de gérer les jeux 
*   en relation avec la base de données	
*/
class JeuManager {
    
	private $_db; // Instance de PDO - objet de connexion au SGBD
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db) {
		$this->_db=$db;
	}

	/**
	* retourne les details d'un jeu
	* @return Jeu[]
	*/
	
	public function afficheJeu($Id) {
		$req = "SELECT * FROM jeu where Id_jeu=?";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($Id));
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		
		// récup des données
		
			$jeu = new Jeu($stmt->fetch());
		return $jeu;
	}
        
	/**
	* ajout d'un jeu dans la BD
	* @param jeu à ajouter
	* @return int true si l'ajout a bien eu lieu, false sinon
	*/
	public function add(Jeu $jeu) {
		// calcul d'un nouveau code de jeu non déja utilisé = Maximum + 1
		$stmt = $this->_db->prepare("SELECT max(Id_jeu) AS maximum FROM jeu");
		$stmt->execute();
		$jeu->setId_jeu($stmt->fetchColumn()+1);
		
		// requete d'ajout dans la BD
		$req = "INSERT INTO jeu (Id_jeu,titre,temps,regles,materiel,nb_joueurs,age_min,img_jeu,nom_categorie,nom_utilisateur) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->_db->prepare($req);
		$res  = $stmt->execute(array($jeu->Id_jeu(), $jeu->titre(), $jeu->temps(), $jeu->regles(), $jeu->materiel(),$jeu->nb_joueurs(), $jeu->age_min(), $jeu->img_jeu(), $jeu->nom_categorie(), $jeu->nom_utilisateur()));		
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		return $res;
	}
        
	/**
	* nombre de jeux dans la base de données
	* @return int le nb de jeux
	*/
	public function count() {
		$stmt = $this->_db->prepare('SELECT COUNT(*) FROM jeu');
		$stmt->execute();
		return $stmt->fetchColumn();
	}
        
	/**
	* suppression d'un jeu dans la base de données
	* @param Jeu
	* @return boolean true si suppression, false sinon
	*/
	public function delete( $Id_jeu) {
		$req = "DELETE FROM noter_et_commenter WHERE Id_jeu = ?";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($Id_jeu));
		$req = "DELETE FROM jeu WHERE Id_jeu = ?";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($Id_jeu));
		


	}
		
	/**
	* echerche dans la BD d'un jeu à partir de son id
	* @param int $Id_jeu
	* @return Jeu 
	*/
	public function get($Id_jeu) {	
		$jeu = array();
		$req = 'SELECT * FROM jeu WHERE Id_jeu=?';
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($Id_jeu));
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}

		$jeu = new Jeu($stmt->fetch());
		return $jeu;
	}		
		
	/**
	* retourne l'ensemble des jeux présents dans la BD 
	* @return Jeu[]
	*/
	public function listJeu() {
		$jeux = array();
		$req = "SELECT * FROM jeu";
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
			$jeux[] = new Jeu($donnees);
		}
		return $jeux;
	}

	/**
	* retourne l'ensemble des jeux présents dans la BD pour un utilisateur
	* @param int nom_utilisateur
	* @return Jeu[]
	*/
	public function getMesJeux($nom_utilisateur) {
		$jeux = array();
		$req = "SELECT * FROM jeu WHERE nom_utilisateur=?";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($nom_utilisateur));
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		// recup des données
		while ($donnees = $stmt->fetch())
		{
			$jeux[] = new Jeu($donnees);
		}
		return $jeux;
	}

	public function getSesJeux($nom) {
		$jeux = array();
		$req = "SELECT * FROM jeu WHERE nom_utilisateur=?";
		$stmt = $this->_db->prepare($req);
		$stmt->execute(array($nom));
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		// recup des données
		while ($donnees = $stmt->fetch())
		{
			$jeux[] = new Jeu($donnees);
		}
		return $jeux;
	}
	/**
	* méthode de recherche d'un jeu dans la BD à partir des critères passés en paramètre
	* @return Jeu[]
	*/
	public function search($titre, $materiel, $nom_categorie, $nb_joueurs, $age_min) {
		$req = "SELECT * FROM jeu";
		$cond = '';

		if ($titre<>"") 
		{ 	$cond = $cond . " titre like '%". $titre ."%'";
		}
		if ($materiel<>"") 
		{ 	if ($cond<>"") $cond .= " AND ";
			$cond = $cond . " materiel like '%" . $materiel ."%'";
		}
		if ($nom_categorie<>"") 
		{ 	if ($cond<>"") $cond .= " AND ";
			$cond = $cond . " nom_categorie = '" . $nom_categorie ."'";
		}
		if ($nb_joueurs<>"") 
		{ 	if ($cond<>"") $cond .= " AND ";
			$cond = $cond . " nb_joueurs = '" . $nb_joueurs ."'";
		}
		if ($age_min<>"") 
		{ 	if ($cond<>"") $cond .= " AND ";
			$cond = $cond . " age_min <= '" . $age_min ."'";
		}

		if ($cond <>"")
		{ 	$req .= " WHERE " . $cond;
		}
		// execution de la requete				
		$stmt = $this->_db->prepare($req);
		$stmt->execute();
		// pour debuguer les requêtes SQL
		$errorInfo = $stmt->errorInfo();
		if ($errorInfo[0] != 0) {
			print_r($errorInfo);
		}
		$jeux = array();
		while ($donnees = $stmt->fetch())
		{
			$jeux[] = new Jeu($donnees);
		}
		return $jeux;
	}
	
	/**
	* modification d'un jeu dans la BD
	* @param Jeu
	* @return boolean 
	*/
	public function update(Jeu $jeu) {
		$req = "UPDATE jeu SET titre = :titre, "
					. "temps = :temps, "
					. "regles = :regles, "
					. "materiel  = :materiel, "
					. "nb_joueurs = :nb_joueurs, "
					. "age_min = :age_min, "
					. "nom_categorie = :nom_categorie" 
					. " WHERE Id_jeu = :Id_jeu";
		//var_dump($jeu);

		$stmt = $this->_db->prepare($req);
		$stmt->execute(array(":titre" => $jeu->titre(),
								":temps" => $jeu->temps(),
								":regles" => $jeu->regles(),
								":materiel" => $jeu->materiel(),
								":nb_joueurs" => $jeu->nb_joueurs(), 
								":age_min" => $jeu->age_min(),
								":nom_categorie" => $jeu->nom_categorie(),
								":Id_jeu" => $jeu->Id_jeu() ));
		return $stmt->rowCount();
		
	}
}

// fontion de changement de format d'une date
// tranformation de la date au format j/m/a au format a/m/j
function dateChgmtFormat($date) {
//echo "date:".$date;
		list($j,$m,$a) = explode("/",$date);
		return "$a/$m/$j";
}

?>


