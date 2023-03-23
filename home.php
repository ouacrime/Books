<?php

session_start();


if ( !isset( $_SESSION["name"] ) ) {
    header("Location:index.php") ;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color : #000 !important ;
        }
        .col {
            flex: 0 0 0 !important ;
            margin: 20px auto !important
        }
        .card-img-top {
            height: 280px ;
        }
        .card {
            border: none !important ;
        }
        h1 {
            text-align: center;
            color: #eae1e1 !important ;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px ;
        }
        @media (max-width: 769px) {
            .top {
                flex-direction: column !important ;
            }
        }
        @media (min-width: 1400px) {
            body {
                display: flex ; 
                justify-content: center ;
                align-items: center ;
                height: 100vh ;
            }
        }
        @media (max-width: 1400px) {
            h1 {
                margin: 30px 0 !important ;
            }
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="top">
        <h1> Welcome <?php echo $_SESSION["name"] ; ?> </h1>
        <a href="logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
    </div>
        <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="imgs/auteur.jpg" class="card-img-top" alt="Auteur">
                <div class="card-body">
                    <h5 class="card-title">Author</h5>
                    <p class="card-text">This page contains information about Authors.. And if you would like to see this information..</p>
                    <a href="listAuteur.php" class="btn btn-primary">Click here</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="imgs/book.jpg" class="card-img-top" alt="oeuvre">
                <div class="card-body">
                    <h5 class="card-title">Ouevre</h5>
                    <p class="card-text">This page contains information about Ouevres.. And if you would like to see this information..</p>
                    <a href="listOeuvre.php" class="btn btn-primary">Click here</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="imgs/exemplaire.jpg" class="card-img-top" alt="exemplaire">
                <div class="card-body">
                    <h5 class="card-title">Exemplaire</h5>
                    <p class="card-text">This page contains information about Copies.. And if you would like to see this information..</p>
                    <a href="listExemplaire.php" class="btn btn-primary">Click here</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="imgs/adherent.webp" class="card-img-top" alt="adherent">
                <div class="card-body">
                    <h5 class="card-title">Adherent</h5>
                    <p class="card-text">This page contains information about Adherent.. And if you would like to see this information..</p>
                    <a href="listAdherent.php" class="btn btn-primary">Click here</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>