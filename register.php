<?php
//On demarre la session php 
session_start();

// video 14 , si je suis connecté, j'ai pas besoin de m'inscrire , tu va direct a mon profil 
if (isset($_SESSION["user"]["pseudo"])) {
    header("Location: profil.php");
    exit;
}
// on verifie si le formulaire a été envoyé
if (!empty($_POST)) {
    var_dump($_POST);


    // "!empty" vérifie que $_POST n'est pas vide , et "is set" vérifie que $_POST est définie
    //A ce stade le formulaire a été envoyé


    //On vérifie que TOUS les champs requis sont remplis
    // Attention : pour le isset , ce qui compte c'est ce qu'on a mis a l'intérieur du name !!! dans les input
    // On vérifie que TOUS les champs 
    if (
        isset($_POST["nickname"], $_POST["email"], $_POST["pass"])
        && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["pass"])
    ) {
        //le formulaire est complet 
        // On récupére les données en les protégeant
        $pseudo = strip_tags($_POST["nickname"]);

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) // est ce qu'il ne contient pax un email
        {
            die("l'adresse email est incorrecte");
        }



        // On va hasher le mot de passe 
        $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

        //Ajouter ici tous les contôles souhaités ( a savoir que c'est ici que l'on ajoute la double vérification du mot de passe, que l'adresse mail et le mot de passe sont unique,pour éviter nottamment l'incription plusieur fois de suite avec la même adresse mail et des mots de passes différents )

        //On enregistre le mot de passe en bdd
        //D'abord se connecter a la bdd avec require_once
        require_once "connect.php";

        $sql = "INSERT INTO `utilisateurs`(`email`, `password`, `roles`, `username`) VALUES (:email, '$pass', '[\"ROLE_USER\"]', :pseudo)";
        // Explication : la syntaxe de roles, c'est parce que c'est du JSON. 
        // Attention , ici comme on va rentrer des données utilisateurs dans la bdd , il va falloir mettre en place la sécurité (explication en attente)

        // Preparation de la requête 
        $query = $db->prepare($sql);

        //Faire des bindValue pour connecter les variables php à leur paramètre SQL
        // 3 paramètres : identifiant du paramètre , donc sont id = : pseudo , sa valeur , ici placé dans une variable ($pseudo = strip_tags($_POST["nickname"]));, puis le type , ici ce sera toujours PDO::PARAM_
        //Ainsi on remet une couche de protection car on lie un paramètre à une variable , le paramètre ici c'est out doit être en string avec PDO::PARAM_STR
        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        // On récupère l'id du nouvel utilisateur 
        $id = $db->lastInsertId();

        // Connecter l'utilisateur , car c'est toujours mieux d'être connecté tout de suite que de refaire un formulaire de connexion, copie colle le session start 
        // session_start();----------------commenter par video 14 ( cf profil.php)---------------------
        $_SESSION["user"] = [
            "id" => $id,
            "email" => $_POST["email"],
            "roles" => ["ROLE_USER"],
            "pseudo" => $pseudo
        ];

        // On a adapter les variables en leur donnant d'autre nom , car nous n'avons pas le $user, $user et seulement défini dans login , il désigne la requête 
        header("Location: profil.php");

        die($pass);
    } else {

        die("le formulaire est incomplet");
    }
}











// On inclu le header 
include "header.php";
?>

<h1> Inscription </h1>
<form method="post">
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="nickname" id="pseudo">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">M'inscrire</button>
</form>
<?php
//on inclu le footer 
include "footer.php"
?>