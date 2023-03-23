<?php

session_start() ;

include_once "config.php" ;

error_reporting(0) ;

$id =htmlentities($_GET["id"]);
$page = htmlentities($_GET["page"]);
// $query = http_build_query($_GET);
// $query = urlencode(http_build_query($_GET));

$sql = "DELETE from auteur Where IdAuteur = :id" ;
$stmt = $db->prepare($sql);
// $stmt = $db->binParam()
$stmt->execute(array(":id" => $id));

$_SESSION["status"] = "okay" ;

header('Location:listAuteur.php'."?".$query) ;

?>