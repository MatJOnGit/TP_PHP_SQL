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
        <a href='index.php'>Retour à la liste des billets</a><br/>
        <?php
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            if (isset($_GET['billet'])) {
                
                $reponsebillet = $bdd->prepare('SELECT id, titre, contenu, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, HOUR(date_creation) AS heure, MINUTE(date_creation) AS minute, SECOND(date_creation) AS seconde FROM billets WHERE id=? ORDER BY ID DESC LIMIT 5');
                $reponsebillet->execute(array($_GET['billet']));
                                                
                while ($donneesbillet = $reponsebillet->fetch()) {
                    echo '<div class="news"><h3>' . $donneesbillet['titre'] . ' <em>le ' . $donneesbillet['jour'] . '/' . $donneesbillet['mois'] . '/' . $donneesbillet['annee'] . ' à ' . $donneesbillet['heure'] . 'h' . $donneesbillet['minute'] . 'min' . $donneesbillet['seconde'] . 's</em></h3><p>' . $donneesbillet['contenu'] . '</p></div>';
                }
                
                $reponsebillet->closeCursor();
                
                echo '<h2>Commentaires</h2>';
                
                $reponsecommentaire = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DAY(date_commentaire) AS jour, MONTH(date_commentaire) AS mois, YEAR(date_commentaire) AS annee, HOUR(date_commentaire) AS heure, MINUTE(date_commentaire) AS minute, SECOND(date_commentaire) AS seconde FROM commentaires WHERE id_billet=? ORDER BY date_commentaire');
                $reponsecommentaire->execute(array($_GET['billet']));
                
                while ($donneescommentaire = $reponsecommentaire->fetch()) {
                    echo '<p><b>' . $donneescommentaire['auteur'] . '</b> le ' . $donneescommentaire['jour'] . '/' . $donneescommentaire['mois'] . '/' . $donneescommentaire['annee'] . ' à ' . $donneescommentaire['heure'] . 'h' . $donneescommentaire['minute'] . 'min' . $donneescommentaire['seconde'] . 's</p>' . $donneescommentaire['commentaire'] . '<p></p>';
                }
                
                $reponsecommentaire->closeCursor();

            }
        ?>
    </body>
</html>