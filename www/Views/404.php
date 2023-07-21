<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur Trokos</title>
    <meta name="description" content="Trokos">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php $configFilePath = './config.json';
    if (!file_exists($configFilePath)) {?>
    <script type='module' src="/index.js" async></script>
    <?php } ?>
</head>

<body>

    <?php include 'navbar.php'; 
        ?>


    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="display-1">404</h1>
                <h2>Page non trouvée</h2>
                <p class="lead">Désolé, la page que vous cherchez n'existe pas ou a été déplacée.</p>
                <a href="/" class="btn btn-outline-light">Retour à l'accueil</a>
            </div>
        </div>
    </div>


<?php
$message = $_GET['message'] ?? '';
if (!empty($message)) {
    echo $message;
}
?>
<br>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>