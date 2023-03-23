<?php

session_start() ;

require_once "config.php" ;

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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Document</title>
    <style>
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        table th, table td {
            color: #fff;
            line-height: 34px; 
            width: 22% ;
        }
        body {
            background-color: #000 ;
        }
        a {
            width: fit-content;
        }
        .btn {
            padding: 5px 15px ;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 70px ;        
        }
        .btnn {
            display: flex ;
        }
        .bt {
            margin-right: 20px ;
        }
        h1 {
            color: #eae1e1 !important ;
            margin: 0 ;
        }
        @media (max-width: 769px) {
            h1 {
                margin-bottom: 40px ;
            }
        }
        i {
            color: #fff ;
            transition: 0.2s ;
        }
        i:hover {
            color: #0d6efd ;
        }
        .fa-pen {
            margin-right: 15px ;
            margin-left: 0px ;
        }
        .alert {
            background-color: #0d6efd ;
            color: #fff ;
            border: none ;
        }
        .act {
            width: 20% !important ;
            text-align: right ;
        }
        .act2 {
            text-align: right ;
        }
        .nb {
            padding-left: 63px !important ;
        }
        nav {
            margin-top: 60px ;
            display: flex !important ;
            justify-content: center !important ;
        }
        nav li a {
            background-color: #0d6efd !important ;
            color: #fff !important ;
            border: 1px solid #0a58ca !important ;
            transition: 0.3 s !important ;
        }
        nav li a:hover {x
            background-color: #0a58ca !important ;
        }
        @media (max-width: 769px) {
            .top {
                flex-direction: column !important ;
            }
        }
    </style>
</head>
<body>
<?php
        if ( isset($_SESSION["status"]) ) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Cool, Auteur has been deleted.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>' ;
                    
            unset($_SESSION['status']) ;
        }
        ?>
    <div class="container">
        <div class="top">
            <h1>Author Details</h1>
            <div class="btnn">
                <a href="addAuteur.php"><button type="button" class="btn bt btn-primary">Add New</button></a>
                <a href="home.php"><button type="button" class="btn btn-primary">Back</button></a>
            </div>
        </div>
        <?php
        echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Id Auteur</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Nombre Oeuvre</th>
                            <th class="act">Action</th>
                        </tr>
                    </thead>
                    <tbody>' ;
        
        
        $limit = 4 ;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = (int)($page - 1) * (int)$limit;
        $sql = "SELECT * FROM auteur LIMIT $start, $limit" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute() ; 
        $users = $stmt->fetchAll() ;
        $sql2 = "SELECT count(IdAuteur) FROM auteur" ;
        $stmt2 = $db->prepare($sql2) ;
        $stmt2->execute() ;
        $usersCount = $stmt2->fetchAll() ;
        $total = $usersCount[0][0] ;
        $pages = ceil($total / $limit) ;
        foreach ($users as $user) {
            $update = '<a onClick="javascript: return confirm(\'Please confirm updating\');" href="updateAuteur.php?id=' .  $user['IdAuteur'] . '&page='.$page . '"><i class="fa-solid fa-pen"></i></a>' ;
            $delete = '<a onClick="javascript: return confirm(\'Please confirm deletion\');" href="deleteAuteur.php?id='.$user['IdAuteur'].'&page='.$page.'" name="delete"><i class="fa-solid fa-trash-can"></i></a>' ;
            echo '<tr>
                        <td>' . $user["IdAuteur"] .'</td>
                        <td>' . $user["nom"] .'</td>
                        <td>' . $user["prenom"] . '</td>
                        <td class="nb">' . $user["nombreOeuvre"] . '</td>
                        <td class="act2">' . $update . ' ' . $delete . '</td>
                    </tr>' ;
        }
        
        echo "</tbody>
            </table>" ;

        $Previous = $page > 1 ? $page - 1 : $page ;
        $Next = $page < $pages ? $page + 1  : $page ;

        ?>

        <nav aria-label="...">
            <ul class="pagination">
            <li class="page-item <?php if ( $page == 1 ) { echo 'disabled' ; } ?>"><a class="page-link" href="listAuteur.php?page=<?= $Previous ?>">Previous</a></li>
                <?php for( $i = 1 ; $i <= $pages ; $i++ ) : ?>
                <li class="page-item"><a class="page-link" href="listAuteur.php?page=<?= $i ?>"><?= $i ; ?></a></li>

                <?php  if ( $i == 3 ) { ?>
                        <li class="page-item disabled"><a class="page-link" href="">...</a></li>
                        <?php break ; } endfor ; ?>
                        <?php  if ( $usersCount[0][0] > 16 ) { ?>
                            <li class="page-item"><a class="page-link" href="listAuteur.php?page=<?= $pages ?>"><?= $pages ; ?></a></li>
                        <?php ; } ?>
                <li class="page-item <?php if ( $page == $pages  ) { echo 'disabled' ; } ?>"><a class="page-link" href="listAuteur.php?page=<?= $Next ?>">Next</a></li>
            </ul>
        </nav>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>