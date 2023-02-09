<?php 
include("./config.php");

if(isset($_POST['cnxBTN'])){
   $erreurcnx = [];
     // if(isset( $_POST['email']) and isset($_POST['mdp'] )){
        $email = htmlspecialchars($_POST['email']) ;
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);

     if(!empty($_POST['mdp']) and !empty($_POST['email'])){
   
      $con = mysqli_connect('localhost:3300' , 'root' , '' ,'Formulaire');
      $q = "select * from utilisateur where email = ? ";
      $req = $con->prepare($q);
      $req->bind_param("s",$email);
       // $req = mysqli_query($con,"select * from utilisateur where email = '$email' and mdp = '$mdp' ");
      $req->execute();
      $res=$req->get_result();
     
     if($res->num_rows > 0){ //$req->num_rows
      $row = $res->fetch_assoc();
      if(password_verify($mdp , $row['mdp'])){
       
         session_start();
         $_SESSION['logged_in'] = true;
         header("Location:bienvenu.php");
         $_SESSION['email'] = $email;
       }

     }else{
      $erreurcnx['compte']  = "ce compte n'existe pas,essayer de vous inscrire";
      $con->close();    
     }
    }else{
      $erreurcnx['champs']  = "Champs manquant";
        //$erreur = "Adresse mail ou Mot de passe incorrecte ";
    }
    //cas d'inscription 
    }elseif(isset($_POST['inscBTN'])){

   $userMail =  htmlspecialchars($_POST['inscr-mail']);
   $confMaiL=  htmlspecialchars($_POST['conf-mail']);
   $userMDP = filter_input(INPUT_POST, 'inscr-mdp', FILTER_SANITIZE_STRING);
  
   
   if(empty($_POST['inscr-mail']) ||  $_POST['inscr-mail'] !== $_POST['conf-mail']  || !filter_var($_POST['inscr-mail'],FILTER_VALIDATE_EMAIL) ){

      $erreurs['inscr-mail'] = "-Veuillez renseigner un email ou verifier si vous avez bien confimer l'email";
   }else{
      $con = mysqli_connect('localhost:3300' , 'root' , '' ,'Formulaire');
      $query = "select * from utilisateur where email = ? ; " ;
      $r = $con->prepare($query);
      $r->bind_param("s",$_POST['inscr-mail']);
      $r->execute();
      $resu=$r->get_result();
      if($resu->num_rows >0){
         $erreurs['inscr-mail'] = "-cet email est déja pris";
         $con->close(); 
      }
      

   }

   if( empty($_POST['inscr-mdp']) || $_POST['inscr-mdp'] !== $_POST['conf-mdp']){
   
      $erreurs['inscr-mdp'] = "-Veuillez renseigner un mot de passe ou verifier si vous avez bien confimer votre mot de passe";
   
   }


   // Validation de la longueur du mot de passe
   if (!validatePasswordLength($userMDP)) {
      $erreurs['mdp-court'] = "-Le mot de passe est trop court. Il doit comporter au moins 8 caractères.";
     // exit;
   }

   // Validation de la complexité du mot de passe
   if (!validatePasswordComplexity($userMDP)) {
      $erreurs['mdp-complexe'] =  "-Le mot de passe n'est pas assez complexe. Il doit comporter au moins une minuscule, une majuscule, un chiffre et un symbole.";
      //exit;
   }


 //si ya pas d 'erreurs
  if(empty($erreurs)){

   
   $MDPhash =   hashPassword($_POST['inscr-mdp']);
   $con = mysqli_connect('localhost:3300' , 'root' , '' ,'Formulaire');


   $insert = $con->prepare('insert into utilisateur(email,mdp) values(?,?)');
   $insert->execute(array($userMail,$MDPhash ));
   $Felicitation = "";

  }
    }
   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire de connexion securisé</title>
</head>
<body>
   <section>
   <h1>Connexion</h1>
   <?php 
    if(isset($erreurcnx)){
      echo "<ul  class = 'Erreur'>";
      foreach($erreurcnx as &$erreur){
         echo "<li>".$erreur."</li>";
      }
      echo "</ul>";
   }
   ?>
   <form action="" method = "POST">
    <label >Adresse mail</label>
    <input class = "input" type="text" name ="email">
    <label >Mot de passe</label>
    <input  class = "input" type="password" name = "mdp">
    <input class = "input" type="submit" value  ="connexion" name ="cnxBTN">  
   </form>
   <p>Vous n'avez pas de compte?<span>s'inscrire</span><p>
   

   
    <form action="" method = "POST" class = "inscr">
        <h1> S'inscrire </h1> 
        <h4> C'est rapide</h4>
     <hr>
     
     <input type="email" class="input" placeholder = "email" name="inscr-mail">
     <input type="email" class="input" placeholder = "confirmer votre email" name="conf-mail">
     <input type="password" class="input" placeholder = "mot de passe" name="inscr-mdp">
     <input type="password" class="input" placeholder = "confirmer  le mot de passe" name="conf-mdp">
     <input class = "input" type="submit" value  ="inscription" name ="inscBTN">  


    </form>
    <?php 
    if(isset($erreurs)){
      echo "<ul  class = 'Erreur'>";
      foreach($erreurs as &$erreur){
         echo "<li>".$erreur."</li>";
      }
      echo "</ul>";
    }elseif(isset($Felicitation)) {
      echo " <p class = 'Felicitation'>Felicitation vous étes inscrit connectez vous a present! </p>";
    }
     
    
   ?>
    </section> 
  
</body>
</html>