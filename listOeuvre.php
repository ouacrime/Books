<?php

session_start();

include_once "config.php";

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
            margin: 20px 0 100px ;        }
        @media (max-width: 769px) {
            .top {
                flex-direction: column !important ;
            }
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
            text-align: right ;
        }
        .act2 {
            text-align: right ;
        }
        .nb {
            padding-left: 33px !important ;
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
        nav li a:hover {
            background-color: #0a58ca !important ;
        }
    </style>
</head>
<body>
    <?php
        if ( isset($_SESSION["status"]) ) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Cool, Oeuvre has been deleted.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>' ;                        
                unset($_SESSION['status']) ;
            }
        ?>
    <div class="container">
        <div class="top">
            <h1>Oeuvre Details</h1>
            <div class="btnn">
                <a href="addOeuvre.php"><button type="button" class="btn bt btn-primary">Add New</button></a>
                <a href="home.php"><button type="button" class="btn btn-primary">Back</button></a>
            </div>
        </div>
        <?php
        echo '<table class="table">
                    <thead>
                        <tr>
                            <th>No Oeuvre</th>
                            <th>Title</th>
                            <th>Date parution</th>
                            <th>Id Auteur</th>
                            <th class="act">Action</th>
                        </tr>
                    </thead>
                    <tbody>' ;
        
        
        $limit = 4 ;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;
        $sql = "SELECT * FROM oeuvre LIMIT $start, $limit" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute() ;
        $users = $stmt->fetchAll() ;
        $sql2 = "SELECT count(noOeuvre) FROM oeuvre" ;
        $stmt2 = $db->prepare($sql2) ;
        $stmt2->execute() ;
        $usersCount = $stmt2->fetchAll() ;
        $total = $usersCount[0][0] ;
        $pages = ceil($total / $limit) ;
        foreach ($users as $user) {
            $update = '<a onClick="javascript: return confirm(\'Please confirm updating\');" href="updateOeuvre.php?id=' .  $user['noOeuvre'] . '"><i class="fa-solid fa-pen"></i></a>' ;
            $delete = '<a onClick="javascript: return confirm(\'Please confirm deletion\');" href="deleteOeuvre.php?id=' .  $user['noOeuvre'] . '&page='.$page. '" name="delete"><i class="fa-solid fa-trash-can"></i></a>' ;
            echo '<tr>
                        <td>' . $user["noOeuvre"] .'</td>
                        <td>' . $user["titre"] .'</td>
                        <td>' . $user["dateParution"] . '</td>
                        <td class="nb">' . $user["IdAuteur"] . '</td>
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
        <li class="page-item <?php if ( $page == 1 ) { echo 'disabled' ; } ?>"><a class="page-link" href="listOeuvre.php?page=<?= $Previous ?>">Previous</a></li>
            <?php for( $i = 1 ; $i <= $pages ; $i++ ) : ?>
            <li class="page-item"><a class="page-link" href="listOeuvre.php?page=<?= $i ?>"><?= $i ; ?></a></li>

            <?php  if ( $i == 3 ) { ?>
                    <li class="page-item disabled"><a class="page-link" href="">...</a></li>
                    <?php break ; } endfor ; ?>
                    <?php  if ( $usersCount[0][0] > 16 ) { ?>
                        <li class="page-item"><a class="page-link" href="listOeuvre.php?page=<?= $pages ?>"><?= $pages ; ?></a></li>
                    <?php ; } ?>
                <li class="page-item <?php if ( $page == $pages  ) { echo 'disabled' ; } ?>"><a class="page-link" href="listOeuvre.php?page=<?= $Next ?>">Next</a></li>
            </ul>
        </nav>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>