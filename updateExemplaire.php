<?php

include "config.php" ;

error_reporting(0) ;

$id = htmlentities($_GET['id']) ;

$sql = "SELECT * FROM exemplaire WHERE noExemplaire = ?" ;
$stmt = $db->prepare($sql);
$stmt->execute(array($id));
$user = $stmt->fetch();

$dateAchat = $user["dateAchat"] ;
$pu = $user["pu"] ;
$noOeuvre = $user["noOeuvre"] ;

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( empty($_POST["dateAchat"]) ) {
        $dateAchatErr = "*    This Field is required." ;
    } else {
            $dateAchat = test( $_POST["dateAchat"] ) ;
        }
    
    if ( empty($_POST['pu']) ) {
        $puErr = "This Field is required." ;
    } else {
        $pu = test( $_POST['pu'] ) ;
        if ( !preg_match( "/^[a-zA-Z-' ]*$/", $pu ) ) {
            $puErr = "Only letters and white space allowed." ; 
        }
    }

    $sql = "SELECT noOeuvre FROM oeuvre" ;
    $stmt = $db->prepare($sql) ;
    $stmt->execute() ;
    $users = $stmt->fetchAll() ;

    if ( empty($_POST["noOeuvre"]) ) {
        $noOeuvreErr = "This Field is required." ;
    } else {
        $noOeuvre = test( $_POST['noOeuvre'] ) ;
        $flag = False ;
        foreach ($users as $user) {
            if ( $user["noOeuvre"] == $noOeuvre ) {
                $flag = True ;
            }
        }
        if ( $flag == False ) {
            $noOeuvreErr = "Not Match." ;
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
    if ( empty($dateAchatErr) && empty($puErr) && empty($noOeuvreErr) ) {
            $sql = "UPDATE exemplaire set dateAchat = '$dateAchat' , pu = '$pu'  , noOeuvre = '$noOeuvre'  WHERE noExemplaire = ?" ;
            $stmt = $db->prepare($sql) ;
            $stmt->execute(array( $id )) ;
            $status =  '<div class="alert alert-primary d-flex align-items-center" role="alert">
                            <div>
                                Cool, Exemplaire updated.
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
        <p class="login-text">Update Exemplaire</p>
            <div class="input-group">
                <span> <?php echo $dateAchatErr ; ?></span>
                <input type="date" placeholder="Date Achat" name="dateAchat" value="<?php echo $dateAchat; ?>"> <br>
            </div>
            <div class="input-group">
            <span> <?php echo $puErr ; ?></span>
                <input type="text" placeholder="Pu" name="pu" value="<?php echo $pu; ?>">
            </div>
            <div class="input-group">
            <span> <?php echo $noOeuvreErr ; ?></span>
                <input type="number" placeholder="noOeuvre" name="noOeuvre" value="<?php echo $noOeuvre; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
            <a href="listExemplaire.php"><button type="button" class="btn btn-primary">Back</button></a> 
        </form>
    </div>


    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>