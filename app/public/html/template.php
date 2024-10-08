<?php 
    if(empty($_SESSION)){
        header('Location:../index.php');
    }
    switch($_SESSION['idSessao']){
        case '1':
            $template = '../app/public/html/sidebarAluno.html';
        break;
        case '2':
            $template = '../app/public/html/sidebarEmpresa.html';
        break;
        case '3':
            $template = '../app/public/html/sidebarAdmin.html';
        break;
    }
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../app/public/css/sidebar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="../app/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../app/public/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../app/public/css/styleCandidatura.css">
    <script src="../app/public/js/jquery-3.7.1.js"></script>
    <script src="../app/public/js/urlConfig.js"></script>
</head>
<body>
<div class="main-container d-flex">
    <?php require_once $template?>
    <div class="content">
        <?php require_once "../app/public/html/navbar.html" ?>
        <div class="container">

        <?= $content; ?>
            
        </div>
    </div>
</div>
<script src="../app/public/js/sidebar.js"></script>
<script src="../app/lib/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../app/public/js/sweetalert2.all.min.js"></script>
</body>
</html>