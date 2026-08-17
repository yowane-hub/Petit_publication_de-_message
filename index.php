<?php
// 1. Inclusion de l'en-tête HTML
include 'header.php';



// 2. Fonction de nettoyage de sécurité
function nettoyer_saisie($donnee) {
    $donnee = trim($donnee);
    $donnee = htmlspecialchars($donnee);
    return $donnee;
}



// 3. Traitement de la réception du formulaire (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Extraction du pseudo
    if (isset($_POST['pseudo'])) {
        $pseudo = nettoyer_saisie($_POST['pseudo']);
    } else {
        $pseudo = '';
    }

    // Extraction du message
    if (isset($_POST['message'])) {
        $message = nettoyer_saisie($_POST['message']);
    } else {
        $message = '';
    }

    // Validation et enregistrement
    if (!empty($pseudo) && !empty($message)) {

        // Assemblage du message
        $ligne_a_enregistrer = $pseudo . " : " . $message . PHP_EOL;

        // Écriture à la suite dans le fichier
        file_put_contents('messages.txt', $ligne_a_enregistrer, FILE_APPEND);

        echo "<p style='color: green;'>Votre message a été publié avec succès !</p>";
    } else {
        echo "<p style='color: red;'>Veuillez remplir tous les champs du formulaire.</p>";
    }
}
?>



<!-- 4. Formulaire HTML d'envoi -->
<h2>Laissez un mot sur le Livre d'Or</h2>

<form action="index.php" method="POST">
    <label for="pseudo">Votre pseudo :</label><br>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <label for="message">Votre message :</label><br>
    <textarea id="message" name="message" rows="3" required></textarea><br><br>

    <button type="submit">Publier le message</button>
</form>

<hr>



<!-- 5. Lecture et affichage dynamique des messages -->
<h2>Historique des messages</h2>

<?php
if (file_exists('messages.txt')) {

    // On transforme le fichier en tableau
    $messages = file('messages.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!empty($messages)) {
        echo "<ul>";

        // Boucle d'affichage de chaque message
        foreach ($messages as $msg) {
            echo "<li>" . $msg . "</li>";
        }

        echo "</ul>";
    } else {
        echo "<p>Aucun message posté pour le moment.</p>";
    }

} else {
    echo "<p>Aucun message enregistré.</p>";
}
?>



<?php
// 6. Inclusion du pied de page HTML
include 'footer.php';
?>