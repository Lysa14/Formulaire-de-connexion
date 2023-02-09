<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Bienvenue</title>
</head>
<body>
    <div class = "container">


    <div class = "bien">
<?php
echo "bienvenue ". $_SESSION['email'];

?>
</div>
<div class ="dxn">
<button >
      <a href="logout.php"> Déconnexion  </a>      
      
      </button>
 </div>

</div>
</body>
</html>