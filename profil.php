<?php
session_start();

include "header.php";
?>

<h1>Profil de <?= $_SESSION["user"]["pseudo"]
                // Attention : à l'appel de $_SESSION , il faut toujours commencer par l'appel de la fonction associé , ici , session_start(); 
                // On reprend "user" en paramètre 1 car c'est comme cela que l'on a définit dans login.php ensuite on met le pseudo car c'est comme àa qu'il est défini dans login.php , on demande donc d'afficher le username de user = affiche moi le pseudo. 

                //PS:@session_startpermet de reprendre les données de la connexion sans afficher de message d'erreur, du style que tu es déja connecté. réutilisable pour plus tard

                // Ace stade , nouvelle tecnho nous dit que le session start va nous poser problème et que la sécurité ++ est que l'orsque l'on appelle une fois session start dans une page , il faut obligatoirement le mettre tout en haut de la page, avant tous le reste. et donc l'enlever de la ou il était placé ( plus bas ) dans les autres pages, il faut cheker chaque page ou on l'a utilisé. LOL
                ?></h1>

<p>Pseudo :<?= $_SESSION["user"]["pseudo"] ?></p>
<p>Email :<?= $_SESSION["user"]["email"] ?></p>

<?php
//on inclu le footer 
include "footer.php"
?>