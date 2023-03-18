
<?php

require 'includes/funciones.php';
incluirTempleate('header_interno');

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <title>Descubrir</title>
</head>
<body>
    <h1>Descubrir</h1>

    <div class="card">
        <div class="content">
            <h2>Fabiola Villalobos, 24</h2>
            <a href="#">Ver Perfil </a>
        </div>
    </div>
</body>

<?php
incluirTempleate('footer');
?>
</html>