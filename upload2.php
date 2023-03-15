<?php
// echo "<pre>";
// var_dump($_FILES);
// "<pre>";

// On vérifie si un fichier a été envoyé
if (isset($_FILES["image"]) && ($_FILES["image"]["error"]) === 0) {
    // On a reçu l'image
    // var_dump($_FILES);

    // On procède aux vérifications 
    // On verifie toujours l'extension et le type Mime ( pour évitez les virus du genre une image avec du php dedans) et le Mime = image/jpeg, cf internet.

    // On liste les différentes extensions ( type Mime ) que l'on souahite autorisé
    $allowed = [
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png"
    ];

    // Je dis ce que je souhaite récupérer, ici, le nom , le type et taille du fichier image , c'est onfo sont dans le var_dump
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];

    // echo $filetype;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    //On verifie l'absence de l'extension dans les clés de $allowed ou l'absence du type MIME dans les valeurs




    //array_key_exists — Vérifie si une clé existe dans un tableau
    if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
        // Ici soit l'extension soit le type est incorect 
        //Explication Anthony : l'extension et le type n'est pas la mâme chose , le type c'est le types réel du ducument , l'extension c'est l'utilisateur qui l'a modifie s'il le veux , par ex en changeant le .txt par .jpg. donc il va falloir emettre une double protaction pour s'assurer que le type et l'extension réelle corresponde , car le type réel peut être un txt. et l'extensiobn annoncé comme jpeg. le fichier est envoyé et cela constitu un virus. Bon ici le code n'eest pas approprié pour , on a simplement fait une première protection. c'est le push 3.
        die("Erreur : format de fichier incorrect");
    }
};
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title> envoie de fichier </title>
</head>

<body>
    <h1>Ajout de fichier</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="fichier">Fichier</label>
            <input type="file" name="image" id="fichier">
        </div>
        <button type="submit">Envoyer</button>
    </form>

</body>