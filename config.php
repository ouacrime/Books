<?php

$dsn =  "mysql:host=localhost;dbname=library" ;
$user  = "root" ;
$pass = "" ;

try {
    $db = new PDO( $dsn , $user , $pass ) ;
} catch (PDOException $chater) {
    die( "Not Connected : " . $chater->getMessage() ) ;
} 