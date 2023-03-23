<?php

session_start() ;

include_once "config.php" ;

$id =htmlentities($_GET["id"]);
$page = htmlentities($_GET["page"]);
$query = http_build_query($_GET);
$query = urlencode(http_build_query($_GET));

$sql = "DELETE from adherent Where idherent = ?" ;
$stmt = $db->prepare($sql);
$stmt->execute(array($id));

$_SESSION["status"] = "okay" ;

header('Location:listAdherent.php'."?".$query) ;

?>