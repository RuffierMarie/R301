
<?php
include "config.inc.php";
error_reporting(E_ALL);
try
{
	$bdd = new PDO("mysql:host=$server;dbname=$database", $user, $passwd);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->exec("SET NAMES utf8");
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>