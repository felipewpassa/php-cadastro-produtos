<?php
include './../app/config.php';
include './../app/Libraries/Route.php';
include './../app/Libraries/Controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NAME?></title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        $routes = new Route();
    ?>

    <script src="<?=URL?>/public/js/index.js"></script>
</body>
</html>