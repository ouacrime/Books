<?php

include "config.php" ;

error_reporting(0) ;

$id = htmlentities($_GET['id']) ;

$sql = "SELECT * FROM auteur WHERE IdAuteur = ?" ;
$stmt = $db->prepare($sql);
$stmt->execute(array($id));
$user = $stmt->fetch();

$nom = $user["nom"] ;
$prenom = $user["prenom"] ;
$nombre = $user["nombreOeuvre"] ;

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( empty($_POST['nom']) ) {
        $nomErr = "This Field is required." ;
    } else {
        $nom = test( $_POST['nom'] ) ;
        if ( !preg_match( "/^[a-zA-Z-' ]*$/", $nom ) ) {
            $nomErr = "Only letters and white space allowed." ; 
        }
    }

    if ( empty($_POST["prenom"]) ) {
        $prenomErr = "This Field is required." ;
    } else {
        $prenom = test( $_POST['prenom'] ) ;
        if ( !preg_match( "/^[a-zA-Z-' ]*$/", $prenom ) ) {
            $prenomErr = "Only letters and white space allowed." ; 
        }
    }

    if ( empty($_POST["nombre"]) ) {
        $nombreErr = "This Field is required." ;
    } else { 
            $nombre = test( $_POST["nombre"] ) ;
    }
}

function test($data) {
    $data = trim( $data );
    $data = htmlspecialchars( $data );
    $data = stripcslashes( $data );
    return $data;
}


if ( isset($_POST['submit']) ) {
    if ( empty($nomErr) && empty($prenomErr) && empty($nombreErr) ) {
        $sql = "UPDATE auteur set nom = '$nom' , prenom = '$prenom'  , nombreOeuvre = '$nombre'  WHERE IdAuteur = ?" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute(array( $id )) ;
        $status =  '<div class="alert alert-primary d-flex align-items-center" role="alert">
                        <div>
                            Cool, Auteur updated.
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
            <p class="login-text">Update Auteur</p>
            <div class="input-group">
                <span> <?php echo $nomErr ; ?></span>
                <input type="text" placeholder="Nom" name="nom" value="<?php echo $nom; ?>"> <br>
            </div>
            <div class="input-group">
            <span> <?php echo $prenomErr ; ?></span>
                <input type="text" placeholder="Prenom" name="prenom" value="<?php echo $prenom; ?>">
            </div>
            <div class="input-group">
            <span> <?php echo $nombreErr ; ?></span>
                <input type="number" min="1" max="5"placeholder="nombre" name="nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
            <a href="listAuteur.php"><button type="button" class="btn btn-primary">Back</button></a> 
        </form>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>