<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'uid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "/projet_ProgWeb/login.php",
    "logout" => "/projet_ProgWeb/logout.php",
    "adduser" => "/projet_ProgWeb/adduser.php",
    "root"   => "/projet_ProgWeb/home.php",
];

const SKEY = '_Redirect';