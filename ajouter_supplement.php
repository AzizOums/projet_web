<?php

require("auth/EtreAuthentifie.php");
$title = 'Ajouter une recette';
include 'header.php';

if ($idm->getRole() == "admin") {
	include 'toolbar_admin.php';
	$head = "Ajouter un supplement";
	$bouton = "Ajouter";
	if(empty($_POST["nom"]) || empty($_POST["prix"])){
		echo "<p class=center>veuillez saisir le nom et le prix du supplément</p>";
		include 'form_ajout.php';
	}else {
		if(is_numeric($_POST["prix"]) && $_POST["prix"] > 0){
			$sql = "SELECT * FROM supplements WHERE nom = ?";
			$req = $db -> prepare($sql);
			$res = $req -> execute(array($_POST["nom"]));
			$test = $req -> rowcount() == 0;
			if ($test) {
				$sql = "INSERT INTO supplements values(null, ?, ?)";
				$req = $db -> prepare($sql);
				$res = $req -> execute(array($_POST["nom"], $_POST["prix"]));
				if($res){
					echo "<div class='center'>supplément ajoutée avec succès!</div>";
				}else{
					echo "<p class='error'>erreur inconnu</p>";
				}
			}else {
				echo "<p class='error'>le supplement saisi existe déja</p>";
				include 'form_ajout.php';
			}
			
		}else{
			echo "<p class='error'>le prix est incorrecte</p>";
			include 'form_ajout.php';
		}
	}
}else{
	echo "<p class=erreur>vous n'etes pas administrateur</p>";
}

include 'footer.php';

?>