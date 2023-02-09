# Instalation a faire pour lancer le projet : 
1/ Veuillez installer XAMPP (https://www.apachefriends.org/fr/download.html)  ou WAMPP ( https://www.wampserver.com/) 
j'ai utiliser XAMPP pour mon projet.
2/Téléchargez un IDE qui supporte php , j'utilise Visual studio code (https://code.visualstudio.com/)

#Les langages de programmations sont: php , html , css , sql
1/ index.php : fichier qui gére la creation du formulaire pour la connexion et l'inscription .
                #La connexion :
               - Si une adresse mail et le mot de passe figure dans la base de données la connexion est permise , sinon le programme renvoi 
               l'erreur: " ce compte n'existe pas,essayer de vous inscrire ".
               -Si un des  champs  est manquants , le programme rends l'erreur : "Champs manquant".
               -Si il n' a pas d'erreur , le programme redirige vers la page bienvenu.php ou l'utilisateur peut se deconnecter si il a fini sa session.
               
               #L'inscription : 
               - Si l'utilisateur saisie un champs qui ne corresponds pas au champs de confirmation , le programme rends 
                  l' erreur (cas pour le mail ) : "Veuillez renseigner un email ou verifier si vous avez bien confimer l'email" , 
                  (cas pour le champs mot de passe ) : "Veuillez renseigner un mot de passe ou verifier  si vous avez bien confimer votre mot  de passe".
               -Si le champs email ne corresponds pas a une adresse mail par exemple (jessy@gam.comm) , le programme renvois
                  l'erreur : "Veuillez renseigner un email ou verifier si vous avez bien    confimer l'email".
               -Si le mot de passe saisie est trop court alors le programme rends l'erreur : "Le mot de passe est trop court. Il doit comporter au moins 
                  8 caractères".
               -Si le mot de passe saisie ne contient pas au moins une majiscule , miniscule ,un chiffre ou un symbole  alors le programme rends l'erreur :
                 Le mot de passe n'est pas assez complexe. Il doit comporter au moins une majuscule, un chiffre et un symbole".
               -Si il n y'a aucune erreur le programme chiffre le mot de passe et le stock dans la base de donnée.
               -L'utilisateur peut ainsi se connecter.
               
 2/config.php : ce fichier contient les fonctions : 
                  -validatePasswordLength($password) : prends en paramettre une chaine de caractere et verifie si la longeur est supperieur un  8.
                  -validatePasswordComplexity($password) : prends en paramettre une chaine de caractere et verifie si il contienet au moins  une majiscule ,
                    miniscule , un chiffre ou un symbole  .
                  -hashPassword($password) : prends en paramettre une chaine de caractere et la chiffre.
 
 3/ bienvenu.php : ce fichier contient la session de connexion de l'utilisateur .
                   -l'utilisateur peut se deconnecter on appuyant sur le bouton  deconnexion .
                   -Quand l'utilisateur appuie sur deconnexion il est rediriger vers la page (logout.php).
                   
 4/logout.php : ce fichier detruit la session de connexion quand il detecte une , et renvois l'utilisateur vers la page de connexion(index.php).
 
 5/style.css : fichier qui comporte la stylisation du programme.
 
 
               
