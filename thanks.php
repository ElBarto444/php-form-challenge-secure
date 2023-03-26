<?php

$errors = [];

foreach ($_POST as $key => $value) {
    $contact[$key] = trim($value);
}

if (empty($contact['user_firstname'])) {
    $errors[] = 'Votre prénom est obligatoire';
}
if (empty($contact['user_name'])) {
    $errors[] = 'Votre nom est obligatoire';
}
$contactNameLength = 30;
if (strlen($contact['user_name']) > $contactNameLength) {
    $errors[] = 'Votre nom doit faire moins de ' . $contactNameLength . ' caractères';
}

if (empty($contact['user_email'])) {
    $errors[] = 'Votre adresse e-mail est obligatoire';
}
if (!filter_var($contact['user_email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Votre adresse doit être valide. (xxxxx@xxxxx.xxx)';
}
if (empty($contact['user_message'])) {
    $errors[] = 'Veuillez renseigner votre message.';
}

$contactMessageLength = 10;
if (strlen($contact['user_message']) < $contactMessageLength) {
    $errors[] = 'Le message doit faire plus de ' . $contactMessageLength . ' caractères';
}

if ($contact['subject'] == "empty") {
    $errors[] = 'Veuillez selectionner un sujet concernant votre requête.';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Formulaire</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <main>
        <?php

        if (count($errors) > 0) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            </div>
        <?php endif; ?>
        <p>
            "Merci <?= htmlentities($contact['user_firstname']) ?> <?= htmlentities($contact['user_name']) ?> de nous avoir contacté à propos de <?= htmlentities($contact['subject']) ?>.

            Un de nos conseillers vous contactera soit à l’adresse <?= htmlentities($contact['user_email']) ?> ou par téléphone au <?= htmlentities($contact['user_phone']) ?> dans les plus brefs délais pour traiter votre demande :<br>

            "<?= htmlentities($contact['user_message']) ?>"
        </p>
    </main>
</body>
</html>