<?php
include "Modules/jeu.php";
include "Models/jeuManager.php";
/**
* Définition d'une classe permettant de gérer les jeux
*   en relation avec la base de données	
*/
class JeuController {
    
	//private $_db; // Instance de PDO - objet de connexion au SGBD
	private $jeuManager; // instance du manager
	private $noteManager;
        
	/**
	* Constructeur = initialisation de la connexion vers le SGBD
	*/
	public function __construct($db, $twig) {
		//$this->_db=$db;
		$this->jeuManager = new JeuManager($db);
		$this->categorieManager = new CategorieManager($db);
		$this->noteManager = new NoteManager($db);
		$this->twig=$twig;
	}
        
	/**
	* liste de tous les jeux
	* @param aucun
	* @return rien
	*/

	// affiche le liste des jeux
	public function listeJeu($message) {
		$jeux = $this->jeuManager->listjeu();
		$categories = $this->categorieManager->getCategories();
		if ($_SESSION['acces']=="non"){
			echo $this->twig->render('jeux/liste.html.twig', ['jeux'=> $jeux, 'categories'=>$categories, 'session'=>$_SESSION, 'message'=>$message]);
		}
		else{
			echo $this->twig->render('jeux/liste.html.twig', ['jeux'=> $jeux, 'categories'=>$categories, 'session'=>$_SESSION, 'admin' => $_SESSION['sessionUti']['admin'], 'message'=>$message]);
		}
		}

	// affiche le jeu
	public function afficheJeu($Id) {
		$jeu = $this->jeuManager->afficheJeu($Id);
		$note = $this->noteManager->noteCommentaire($Id);
		echo $this->twig->render('jeu/jeu.html.twig', ['jeu'=> $jeu, 'session'=>$_SESSION, 'note' => $note]);

	}

	// retour accueil apres connexion
	// public function accueil($message) {
	// 	echo $this->twig->render('index.html.twig', ['message'=> $message, 'session'=>$_SESSION]);
	// }

	/**
	* liste de mes jeux
	* @param aucun
	* @return rien
	*/
	public function mesJeux($nom_utilisateur) {
		$jeux = $this->jeuManager->getMesJeux($nom_utilisateur);
		echo $this->twig->render('mesjeux/mesjeux.html.twig', ['jeux'=>$jeux, 'session'=>$_SESSION]);
	}

	public function sesjeux($nom) {
		$jeux = $this->jeuManager->getSesJeux($nom);
		echo $this->twig->render('sesjeux/sesjeux.html.twig', ['jeux'=>$jeux, 'session'=>$_SESSION, 'nom' => $nom]);
	}

	/**
	* formulaire ajout jeu
	* @param aucun
	* @return rien
	*/
	public function ajout($nom_utilisateur) {
		$categories = $this->categorieManager->getCategories();
		echo $this->twig->render('ajout/ajout.html.twig', ['session'=>$_SESSION, 'categories'=>$categories,'nom_utilisateur'=>$nom_utilisateur]);
	}

	/**
	* ajout dans la BD d'un jeu à partir du form
	* @param aucun
	* @return rien
	*/
	public function jeuOk($data) {
		
		if ($_FILES["img_jeu"]["error"]==UPLOAD_ERR_OK) { 

            $uploaddir = "./img/"; 
            $uploadfile = $uploaddir . basename($_FILES["img_jeu"]["name"]);
            if (!move_uploaded_file($_FILES["img_jeu"]["tmp_name"], $uploadfile)) {
            echo "Probleme lors du telechargement"; } 
            }
        $newJeu = $_POST;
        $newJeu['img_jeu'] = basename($_FILES["img_jeu"]["name"]);;
        $jeu = new Jeu($newJeu);

		$jeu = $this->jeuManager->add($jeu);
		if ($jeu) {
			$message = "Jeu ajouté" ;
		}
		
		else {
			$message = "Probleme lors de l'ajout";
		}
			return $message;
	}

	/**
	* suppression dans la BD d'un jeu à partir de l'id 
	* @param aucun
	* @return rien
	*/
	public function supprimer($Id_jeu) {
		$jeu = new Jeu($_POST);
		$jeu = $this->jeuManager->delete($Id_jeu);
		$count =$this->jeuManager->count();
		if ($jeu){
			$message = "Probleme lors de la supression" ;
		} 
			
		else {
			$message = "Jeu supprimé";
		}
			
			return $message;
	}
	
	
	/**
	* form de saisi des nouvelles valeurs du jeu à modifier
	* @param aucun
	* @return rien
	*/
	public function formModif($Id_jeu) {
		$jeu = $this->jeuManager->get($Id_jeu);
		$categories = $this->categorieManager->getCategories();
		echo $this->twig->render('modif/modif.html.twig', ['session'=> $_SESSION, 'categories'=>$categories, 'nom_utilisateur'=>$_SESSION["sessionUti"]["nom_utilisateur"], 'jeu'=>$jeu]);
	}

	/**
	* modification dans la BD d'un jeu à partir des données du form précédent
	* @param aucun
	* @return rien
	*/
	public function modifOk() {
		$jeu =  new Jeu($_POST);
		$jeu = $this->jeuManager->update($jeu);
	
		if ($jeu) {
			$message = "Jeu modifié" ;
		
			}else {
				$message = "Probleme lors de la modification";
		
			}
			return $message;
	}
	
	/**
	* recherche dans la BD d'un jeu' à partir des données du form précédent
	* @param aucun
	* @return rien
	*/
	public function recherche($data) {
		$data['titre'] = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
		$data['materiel'] = filter_input(INPUT_POST, 'materiel', FILTER_SANITIZE_SPECIAL_CHARS);
		$data['nom_categorie'] = filter_input(INPUT_POST, 'nom_categorie', FILTER_SANITIZE_SPECIAL_CHARS);
		$data['nb_joueurs'] = filter_input(INPUT_POST, 'nb_joueurs', FILTER_SANITIZE_SPECIAL_CHARS);
		$data['age_min'] = filter_input(INPUT_POST, 'age_min', FILTER_SANITIZE_SPECIAL_CHARS);
		$jeux=new Jeu($data);
		$jeux = $this->jeuManager->search($_POST["titre"], $_POST["materiel"], $_POST["nom_categorie"], $_POST["nb_joueurs"], $_POST["age_min"]);
		$categories = $this->categorieManager->getCategories();
		echo $this->twig->render('jeux/liste.html.twig', ['session'=>$_SESSION, 'jeux'=>$jeux, 'categories'=>$categories]);
	}

	
}

