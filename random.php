<?php

function random($n) {
	$string = "";
	$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	for($i=0; $i<$n; $i++) {
		$string .= $chaine[rand()%strlen($chaine)];
	}
	
	return $string;
}
