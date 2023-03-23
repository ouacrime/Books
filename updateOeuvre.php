<?php

include "config.php" ;

error_reporting(0) ;

$id = htmlentities($_GET['id']) ;

$sql = "SELECT * FROM oeuvre WHERE noOeuvre = ?" ;
$stmt = $db->prepare($sql);
$stmt->execute(array($id));
$user = $stmt->fetch();

$titre = $user["titre"] ;
$dateParution = $user["dateParution"] ;
$IdAuteur = $user["IdAuteur"] ;

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( empty($_POST['titre']) ) {
        $titreErr = "This Field is required." ;
    } else {
        $titre = test( $_POST['titre'] ) ;
        if ( !preg_match( "/^[a-zA-Z-' ]*$/", $titre ) ) {
            $titreErr = "Only letters and white space allowed." ; 
        }
    }

    if ( empty($_POST["dateParution"]) ) {
        $dateParutionErr = "*    This Field is required." ;
    } else {
            $dateParution = test( $_POST["dateParution"] ) ;
        }


    $sql = "SELECT IdAuteur FROM auteur" ;
    $stmt = $db->prepare($sql) ;
    $stmt->execute() ;
    $users = $stmt->fetchAll() ;

    if ( empty($_POST["IdAuteur"]) ) {
        $IdAuteurErr = "This Field is required." ;
    } else {
        $IdAuteur = test( $_POST['IdAuteur'] ) ;
        $flag = False ;
        foreach ($users as $user) {
            if ( $user["IdAuteur"] == $IdAuteur ) {
                $flag = True ;
            }
        }
        if ( $flag == False ) {
            $IdAuteurErr = "Not Match." ;
        }
    }
}

function test($data) {
    $data = trim( $data );
    $data = htmlspecialchars( $data );
    $data = stripcslashes( $data );
    return $data;
}


if ( isset($_POST['submit']) ) {
    if ( empty($titreErr) && empty($dateParutionErr) && empty($IdAuteurErr) ) {
            $sql = "UPDATE oeuvre set titre = '$titre' , dateParution = '$dateParution'  , IdAuteur = '$IdAuteur'  WHERE noOeuvre = ?" ;
            $stmt = $db->prepare($sql) ;
            $stmt->execute(array( $id )) ;
            $status =  '<div class="alert alert-primary d-flex align-items-center" role="alert">
                            <div>
                                Cool, Oeuvre updated.
                            </div>
                        </div>' ;
    } 
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="cs.css">
    <title>Login Form - Pure Coding</title>
    <style>
    .btnn {
        display: block;
        width: 100%;
        padding: 15px 20px;
        text-align: center;
        border: none;
        background: #a29bfe;
        outline: none;
        border-radius: 30px;
        font-size: 1.2rem;
        color: #FFF;
        cursor: pointer;
        transition: .3s;
        text-decoration: none;
    }

    .btnn:hover {
        transform: translateY(-5px);
        background: #6c5ce7;
        color: #FFF;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php echo $status ; ?>
        <form class="login-email" action="" method="post">
            <p class="login-text">Update Oeuvre</p>
            <div class="input-group">
                <span> <?php echo $titreErr ; ?></span>
                <input type="text" placeholder="Title" name="titre" value="<?php echo $titre; ?>"> <br>
            </div>
            <div class="input-group">
            <span> <?php echo $dateParutionErr ; ?></span>
                <input type="date" placeholder="Date Parution" name="dateParution" value="<?php echo $dateParution; ?>">
            </div>
            <div class="input-group">
            <span> <?php echo $IdAuteurErr ; ?></span>
                <input type="number" placeholder="Id Auteur" name="IdAuteur" value="<?php echo $IdAuteur; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
            <a href="listOeuvre.php"><button type="button" class="btn btn-primary">Back</button></a> 
        </form>
    </div>


    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>