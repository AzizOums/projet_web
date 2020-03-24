<?php

require("auth/EtreAuthentifie.php");
$title = 'Modifier recette';
include 'header.php';


if($idm -> getRole() == "admin"){
	include 'toolbar_admin.php';
	if(!empty($_GET["rid"])){
		$test = $db -> prepare("SELECT nom FROM recettes WHERE rid = ?");
		$res = $test -> execute(array($_GET["rid"]));
		if($res){
			if($test -> rowcount() > 0){
				$bouton = "Modifier";
				$head = "Modifier une Recette";
				if(empty($_POST["nom"]) || empty($_POST["prix"])){
					echo "<p class=center>veuillez saisir le nom et le prix de la recette</p>";
					include 'form_ajout.php';
				}else {
					if(is_numeric($_POST["prix"]) && $_POST["prix"] > 0){
						$sql = "SELECT * FROM recettes WHERE nom = ? AND rid != ?";
						$req = $db -> prepare($sql);
						$res = $req -> execute(array($_POST["nom"], $_GET["rid"]));
						$test = $req -> rowcount() == 0;
						if ($test) {
							$sql = "UPDATE recettes SET nom = ?, prix = ? WHERE rid = ?";
							$req = $db -> prepare($sql);
							$res = $req -> execute(array($_POST["nom"], $_POST["prix"], $_GET["rid"]));
							if($res){
								echo "<div class='center'>recette modifiée avec succès!</div>";
							}else{
								echo "<p class='error'>erreur inconnu</p>";
							}
						}else {
							echo "<p class='error'>le nom saisi existe déja</p>";
							include 'form_ajout.php';
						}
						
					}else{
						echo "<p class='error'>le prix est incorrecte</p>";
						include 'form_ajout.php';
					}
				}
			} else{
				echo "<p class='error'>Cette recette n'existe pas !</p>";
			}
		} else{
			echo "<p class='error'>Une erreur s'est produite !</p>";
		}
	} else if (!empty($_GET["sid"])){
		$test = $db -> prepare("SELECT nom FROM supplements WHERE sid = ?");
		$res = $test -> execute(array($_GET["sid"]));
		if($res){
			if($test -> rowcount() > 0){
				$bouton = "Modifier";
				$head = "Modifier un Supplement";
				if(empty($_POST["nom"]) || empty($_POST["prix"])){
					echo "<p class='center'>veuillez saisir le nom et le prix du supplement</p>";
					include 'form_ajout.php';
				}else {
					if(is_numeric($_POST["prix"]) && $_POST["prix"] > 0){
						$sql = "SELECT * FROM supplements WHERE nom = ? AND sid != ?";
						$req = $db -> prepare($sql);
						$res = $req -> execute(array($_POST["nom"], $_GET["sid"]));
						$test = $req -> rowcount() == 0;
						if ($test) {
							$sql = "UPDATE supplements SET nom = ?, prix = ? WHERE sid = ?";
							$req = $db -> prepare($sql);
							$res = $req -> execute(array($_POST["nom"], $_POST["prix"], $_GET["sid"]));
							if($res){
								echo "<div class='center'>Supplement modifiée avec succès!</div>";
							}else{
								echo "<p class='error'>erreur inconnu</p>";
							}
						}else {
							echo "<p class='error'>le nom saisi existe déja</p>";
							include 'form_ajout.php';
						}
						
					}else{
						echo "<p class='error'>le prix est incorrecte</p>";
						include 'form_ajout.php';
					}
				}
			} else{
				echo "<p class='error'>Ce supplement n'existe pas !</p>";
			}
		} else{
			echo "<p class='error'>Une erreur s'est produite !</p>";
		}
	} else{
		echo "<p class='error'>Error !</p>";
	}
	
}

include 'footer.php';

?>
