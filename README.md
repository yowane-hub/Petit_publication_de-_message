# Livre d'Or Interactif en PHP

Un petit projet web dynamique développé en PHP permettant aux visiteurs de laisser un message public. Ce projet a été réalisé pour mettre en pratique les concepts fondamentaux de PHP sans utiliser de base de données MySQL.

---

## Fonctionnement du projet

L'application fonctionne selon une architecture simple centrée sur la gestion des requêtes HTTP et le traitement de fichiers texte :

1. **Saisie du message :** L'utilisateur remplit un formulaire HTML (Pseudo et Message) qui soumet les données via la méthode `POST`.
2. **Sécurisation des données :** Avant tout traitement, le script PHP assainit les saisies utilisateur à l'aide d'une fonction personnalisée combinant `trim()` (suppression des espaces superflus) et `htmlspecialchars()` (protection contre l'injection de code HTML/XSS).
3. **Stockage persistant :** Les données validées sont formatées sous la forme `Pseudo : Message` puis écrites à la suite dans le fichier `messages.txt` grâce à `file_put_contents()` avec l'option `FILE_APPEND`.
4. **Affichage dynamique :** À chaque chargement de la page, le fichier `messages.txt` est lu par la fonction `file()`, qui convertit chaque ligne du fichier en élément de tableau. Une boucle `foreach` génère ensuite dynamiquement la liste HTML des messages.

---

## Structure des fichiers

```text
.
├── header.php       # Contient la structure du haut de page HTML (doctype, head, h1, hr)
├── footer.php       # Contient le bas de page HTML avec la date dynamique PHP
├── index.php        # Fichier principal : contient la logique PHP (POST, fonctions, stockage) et le formulaire HTML
└── messages.txt     # Fichier texte servant de base de données minimale pour stocker l'historique


## Démo en ligne
🔗 [Accéder au Livre d'Or en direct](http://littlephp.42web.io)
