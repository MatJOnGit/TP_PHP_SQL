<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css" />
        <title>Mon super blog</title>
    </head>
    
    <body>
        <h1>Mon super blog !</h1>
        <p>Derniers billets du blog :</p>
        <?php
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // Récupération des 10 derniers messages
            $reponse = $bdd->query('SELECT id, titre, contenu, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, HOUR(date_creation) AS heure, MINUTE(date_creation) AS minute, SECOND(date_creation) AS seconde FROM billets ORDER BY ID DESC LIMIT 5');

            // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
            while ($donnees = $reponse->fetch()) {
                echo '<div class="news"><h3>' . $donnees['titre'] . ' <em>le ' . $donnees['jour'] . '/' . $donnees['mois'] . '/' . $donnees['annee'] . ' à ' . $donnees['heure'] . 'h' . $donnees['minute'] . 'min' . $donnees['seconde'] . 's</em></h3><p>' . $donnees['contenu'] . '<br/><a href=\'commentaire.php?billet=' . $donnees['id'] . '\'>Commentaires</a></p></div><br/>';
            }

            $reponse->closeCursor();
        ?>
    </body>
</html>