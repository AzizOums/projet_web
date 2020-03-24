<?php

$hostname = "localhost";
$dbname = "2019_projet4_pizza";
$username = "root";
$password = "";

$dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8";

/*
 Définition de la BD:
 Pour MySQL:

  CREATE TABLE users
(
    userid INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    login VARCHAR(30) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user' NOT NULL
)
*/