<?php

include "config.php" ;

error_reporting(0) ;

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

    if ( empty($_POST["adresse"]) ) {
        $adresseErr = "This Field is required." ;
    } else { 
            $adresse = test( $_POST["adresse"] ) ;
            if ( strlen($adresse ) > 50 ) {
                $adresseErr = "Only 50 Character allowed" ; 
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

    if ( empty($nomErr) && empty($prenomErr) && empty($adresseErr) ) {
                $sql = "INSERT INTO adherent (nom , prenom , adresse) VALUES (? , ? , ?)" ;
                $stmt = $db->prepare($sql) ;
                $stmt->execute(array($nom, $prenom, $adresse)) ;
                $cool =  '<div class="alert alert-primary d-flex align-items-center" role="alert">
                                <div>
                                    Added successfully.
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <?php echo $cool ; ?>
        <form class="login-email" action="" method="post">
            <p class="login-text">Add Adherent</p>
            <div class="input-group">
                <span> <?php echo $nomErr ; ?></span>
                <input type="text" placeholder="Nom" name="nom" value="<?php echo $nom; ?>"> <br>
            </div>
            <div class="input-group">
            <span> <?php echo $prenomErr ; ?></span>
                <input type="text" placeholder="Prenom" name="prenom" value="<?php echo $prenom; ?>">
            </div>
            <div class="input-group">
            <span> <?php echo $adresseErr ; ?></span>
                <input type="text" placeholder="Adresse" name="adresse" value="<?php echo $adresse; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" name="submit">Add</button>
            </div>
            <a href="listAdherent.php"><button type="button" class="btn btn-primary">Back</button></a> 
        </form>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>