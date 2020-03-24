<?php

require("auth/EtreAuthentifie.php");
$title = 'Suppression';
include 'header.php';


if($idm -> getRole() == "admin"){
	include 'toolbar_admin.php';
	if(!empty($_GET["rid"])){
		$test = $db -> prepare("SELECT nom FROM recettes WHERE rid = ?");
		$res = $test -> execute(array($_GET["rid"]));
		if($res){
			if($test -> rowcount() > 0){
				$req = $db -> prepare("DELETE FROM recettes WHERE rid = ?");
				$res = $req -> execute(array($_GET["rid"]));
				if($res)
					echo "<p class='center'>Recette supprimée</p>";
				else
					echo "<p class='error'>Une erreur s'est produite !</p>";
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
				$req = $db -> prepare("DELETE FROM supplements WHERE sid = ?");
				$res = $req -> execute(array($_GET["sid"]));
				if($res)
					echo "<p class='center'>Supplement supprimée</p>";
				else
					echo "<p class='error'>Une erreur s'est produite !</p>";
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
