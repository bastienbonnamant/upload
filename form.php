
<?php

if($_SERVER['REQUEST_METHOD'] === "POST") {

    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = './image';

    // le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);


    // Je récupère l'extension du fichier
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

    // Les extensions autorisées
    $extensions_ok = ['jpg', 'jpeg', 'png', 'webp'];

    // Le poids max géré par PHP par défaut est de 2M
    $maxFileSize = 1000000;

    // Je sécurise et effectue mes tests

    /****** Si l'extension est autorisée *************/
    if ((!in_array($extension, $extensions_ok))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    printf("uniqid(): %s\r\n", uniqid());
    var_dump($_FILES);


    echo "<img src='$uploadFile' width='300px' ><br>";


        /****** Si je n'ai pas d"erreur alors j'upload *************/
        /**
         * TON SCRIPT D'UPLOAD
         */
    }

    if (isset($_POST['submit'])) {
        /* récupérer les données du formulaire en utilisant
           la valeur des attributs name comme clé
          */

        $nom = $_POST['Nom'];
        $prenom = $_POST['Prénom'];

        $age = $_POST['Age'];
        // afficher le résultat
        echo '<h3>Informations récupérées</h3>';
        echo 'Nom : ' . $nom . ' Age : ' . $age . ' Prénom : ' . $prenom;
        exit;

    }

?>
<link rel="stylesheet" href="style.css">
<form method="post" enctype="multipart/form-data" xmlns="http://www.w3.org/1999/html" class="form">
    <label for="imageUpload">Upload une image</label>
    <input type="file" name="avatar" id="imageUpload" />
    <input type="text" name="Nom" placeholder="Nom" class="champ">Nom</input>
    <input type="text" name="Prénom" placeholder="Prénom" class="champ">Prénom</input>
    <input type="number" name="Age" placeholder="Age" class="champ">Age</input>

    <button type="submit" name="submit">Envoyer</button>
</form>
