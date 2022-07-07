<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<?php
if (isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message']) && (isset($_POST['radio_male']) || isset($_POST['radio_female']))) {
    $errors;
    $mail = htmlspecialchars($_POST['email']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);
    if ($_POST['radio_male'])
        $civility = $_POST['radio_male'];
    else
        $civility = $_POST['radio_female'];
        
    if (false == filter_var($mail, FILTER_VALIDATE_EMAIL))
        $errors[] = 'Cet email n\'est pas valide';
    else if (strlen($message) < 15)
        $errors[] = 'Le message doit contenir au minimum 15 caractères';
    else if ((strcmp(strtolower($sujet), 'proposition de stage') !== 0) && (strcmp(strtolower($sujet), 'proposition d\'emploi') !== 0) && (strcmp(strtolower($sujet), 'demande de projet') !== 0)) {
        $errors[] = 'Le sujet n\'est pas valide';
    } else if (!isset($_POST['radio_male']) && !isset($_POST['radio_female'])) {
        $errors[] = 'Vous êtes non binaire ?';
    } else
        $isok = true;
}

?>

<body>
    <div class="bg-gray-200 mx-auto p-4 text-center flex justify-center">
        <form action="" method="post" style="width: 210px;">
            <span>Civilité</span>
            <div class="flex justify-between mt-5">
                  <input type="radio" id="html" name="radio_male" value="monsieur" checked="checked">
                  <label for="html">Monsieur</label><br>
                  <input type="radio" id="css" name="radio_female" value="madame">
                  <label for="css">Madame</label><br>
            </div>
            <label for="fname" class="mb-5">Email</label>
            <input class="mt-5 mb-5" type="text" id="email" name="email" placeholder="mail">
            <br />
            <label for="lname" class="mb-5">Sujet</label>
            <input class="mt-5 mb-5" type="text" id="sujet" name="sujet" placeholder="sujet">
            <br />
            <label for="lname" class="mt-5">Message</label>
            <input class="mt-5 mb-5" type="text" id="message" name="message" placeholder="message">

            <p><input class="mt-5" type="submit" value="Envoyer le message" action="contact.php"></p>
            <?php if (isset($errors)) { ?>
                <div class="bg-gray-200 max-w-lg mx-auto p-4 text-center flex justify-center" style="width: 300px;">
                    <p style="margin-right: 8px;">Problemes: <?php echo ' ' ?></p>
                    <?php foreach ($errors as $error) {
                    echo "<br /> $error <br>";
                }?>
                </div>
            <?php }
                if (isset($isok)){
                    echo '<p class="mx-2">Votre message à bien été envoyé</p>';
                    echo '<p class="mx-2">Civilite: </p>'. $civility;
                    echo '<p class="mx-2">Mail: </p>'. $mail;
                    echo '<p class="mx-2">Sujet: </p>'. $sujet;
                    echo '<p class="mx-2">message: </p>'. $message;
                } ?>
                    
        </form>
    </div>
</body>
