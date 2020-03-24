<?php

require("auth/EtreAuthentifie.php");

$title = 'Profil';
include 'header.php';

if ($idm->getRole() == "admin") {
	include "toolbar_admin.php";
}else {
	include "toolbar.php";
}

if(!empty($_GET["modif"])){
	if($_GET["modif"] == "Nom"){
		if (empty($_POST["modif"])) {
			include 'modif_profil_form.php';
		}else {
			$req = $db -> prepare("UPDATE users SET nom = ? WHERE uid = ?");
			$res = $req -> execute(array($_POST["modif"], $idm->getUid()));
			if($res){
				echo "<p class='center'>Nom modifiée avec succès</p>";
			}else{
				echo "<p class='error'>Une erreur s'est produite veuillez contacter l'admin</p>";
			}
		}
	}
	else if($_GET["modif"] == "Prenom"){
		if (empty($_POST["modif"])) {
			include 'modif_profil_form.php';
		}else {
			$req = $db -> prepare("UPDATE users SET prenom = ? WHERE uid = ?");
			$res = $req -> execute(array($_POST["modif"], $idm->getUid()));
			if($res){
				echo "<p class='center'>Prenom modifiée avec succès</p>";
			}else{
				echo "<p class='error'>Une erreur s'est produite veuillez contacter l'admin</p>";
			}
		}
	}
	else if($_GET["modif"] == "Login"){
		if (empty($_POST["modif"])) {
			include 'modif_profil_form.php';
		}else {
			$req = $db -> prepare("UPDATE users SET login = ? WHERE uid = ?");
			$res = $req -> execute(array($_POST["modif"], $idm->getUid()));
			if($res){
				echo "<p class='center'>Login modifiée avec succès</p>";
			}else{
				echo "<p class='error'>Une erreur s'est produite veuillez contacter l'admin</p>";
			}
		}
	}
	else{
		echo "<p class='error'>Page introuvable</p>";
		exit();
	}
}
	echo "<br/>";

	$req = $db -> prepare("SELECT * FROM users WHERE uid = ?");
	$res = $req -> execute(array($idm -> getUid()));

	if($res){
		$row = $req -> fetch();
	?>

		<div class="center">
			<h1>Informations personnelles</h1>
			<table>
				<tr> <td> User id </td> <td> <?php echo htmlspecialchars($row["uid"]); ?> </td> </tr>
				<tr> <td> Nom </td> <td> <?php echo htmlspecialchars($row["nom"]); ?> </td> <td> <a class="btn btn-warning" href="Profil.php?modif=Nom">Modifier</a> </td> </tr>
				<tr> <td> Prenom </td> <td> <?php echo htmlspecialchars($row["prenom"]); ?> </td> <td> <a class="btn btn-warning" href="Profil.php?modif=Prenom">Modifier</a> </td> </tr>
				<tr> <td> Login </td> <td> <?php echo htmlspecialchars($row["login"]); ?> </td> <td> <a class="btn btn-warning" href="Profil.php?modif=Login">Modifier</a> </td> </tr>
			</table>
		</div>
	<?php
	}

include "footer.php";

?>
