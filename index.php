<?php
  session_start();  // utilisation des sessions

  include "connect.php"; // connexion au SGBD
  include "moteurtemplate.php";

  include "Controllers/jeuController.php";
  include "Controllers/utilisateurController.php";
  include "Controllers/categorieController.php";
  include "Controllers/noteController.php";
  $jeuController = new JeuController($bdd, $twig);
  $utilisateurController = new UtilisateurController($bdd, $twig);
  $noteController = new NoteController($bdd, $twig);
  $categorieController = new CategorieController($bdd, $twig);

  // ============================== connexion / deconnexion - sessions ==================
  $message = "";

  //chargement de la page d'accueil
  if (!isset($_GET["action"]) && empty ($_POST)) { 
    $jeuController->listeJeu('');
  } 
  
  // si la variable de session n'existe pas, on la crée
  if (!isset($_SESSION['acces'])) {     
   $_SESSION['acces']="non";
  }

  // click sur le bouton connexion
  if (isset($_GET["action"])  && $_GET["action"]=="login") {
    $utilisateurController->utilisateurFormulaire(); 
  }
   // Après avoir cliquer sur se connecter
  if (isset($_POST["connexion"])) {     
   $message = $utilisateurController->utilisateurConnexion($_POST);
   $jeuController->listeJeu($message);
  }

  // deconnexion : click sur le bouton deconnexion
  if (isset($_GET["action"]) && $_GET['action']=="logout") { 
    $message= $utilisateurController->utilisateurDeconnexion();
    $jeuController->listeJeu($message);
  } 

  // affiche la liste des jeux
  // if (isset($_GET["action"]) && $_GET['action']=="listjeu") { 
  //    $jeuController->listeJeu();
  // } 
  // affiche la liste des utilisateurs
  if (isset($_GET["action"]) && $_GET['action']=="listuti") { 
    $message= $utilisateurController->listeUti();
  } 
  // doit afficher les jeux d'un utilisateur
  if (isset($_GET["action"]) && $_GET['action']=="jeu" && isset($_GET["nom"])) { 
    $jeuController->sesjeux($_GET["nom"]);
  } 

  // click sur le bouton plus
  if (isset($_GET["action"]) && $_GET['action']=="plus" && isset($_GET["Id"])) { 
    $jeuController->afficheJeu($_GET["Id"]);
  } 

  // click sur s'enregistrer
  if (isset($_GET["action"]) && $_GET['action']=="enregistre" ) { 
    $utilisateurController-> enregistre();
  } 
  // après avoir valider le formulaire enregistrer
  if (isset($_POST["inscription"])) {     
    $message = $utilisateurController->utilisateurInscription($_POST);
    $jeuController->listeJeu($message);
   }

   // click sur ajout
  if (isset($_GET["action"]) && $_GET['action']=="ajout" ) { 
    $jeuController-> ajout($_SESSION['sessionUti']['nom_utilisateur']);
  } 

  // valider formulaire ajout jeu
  if (isset($_POST["ajout_jeu"])) {     
    $message = $jeuController->jeuOk($_POST);
    $jeuController->listeJeu($message);
   }


  // click sur le bouton mes jeux
  if (isset($_GET["action"])  && $_GET["action"]=="mesjeu") {
    $jeuController->mesJeux($_SESSION['sessionUti']['nom_utilisateur']); 
  }


  // click sur le bouton supprimer le jeu
  if (isset($_GET["action"])  && $_GET["action"]=="suppr" && isset($_GET["Id"])) {
    $message = $jeuController->supprimer($_GET["Id"]);
    $jeuController->listeJeu($message); 
  }

  // click sur le bouton modifier le jeu
  if (isset($_GET["action"])  && $_GET["action"]=="modif" && isset($_GET["Id"])) {
    $jeuController->formModif($_GET["Id"]); 
  }  
  // valider le formulaire modifier
  if (isset($_POST["validerModif"])) {     
    $message = $jeuController->modifOk($_POST);
    $jeuController->listeJeu($message);
   }

   // valider le formulaire recherche
   if (isset($_POST["valider_recherche"])) {     
    $jeuController->recherche($_POST);
   }


   // click sur le bouton noter
  if (isset($_GET["action"]) && $_GET['action']=="noter" && isset($_GET["Id"])) { 
    $noteController->noterJeu($_GET["Id"]);
  } 

  if (isset($_POST["publier"])) {     
     $noteController->publier($_POST);
    $jeuController->listeJeu($message);
   }

?>