<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil';
include "header.php";

if ($idm -> getRole() == "admin") {
	include 'toolbar_admin.php';

	echo "<h1 class=center>Hello " . htmlspecialchars($idm->getIdentity())."!</h1>";
	echo "<p class=center style='color: green'>Bienvenue sur la platforme de gestion pour administrateur vous pouvez modifier, supprimer et ajouter des recettes ou des supplements, vous pouver également gérer les commandes, les terminer et les livrer !</p>";
}else{
	include 'toolbar.php';

	echo "<h1 class=center>Hello " . htmlspecialchars($idm->getIdentity())."!</h1>";
	echo "<p class=center style='color: green'>Bienvenue sur la platforme de gestion pour utilisateur ou vous pouver gérer vos commandes; voir les détails de vos commandes, effectuer de nouvelles commandes et modifier les commandes qui ne sont pas encore pretes !</p>";
}


include("footer.php");

?>