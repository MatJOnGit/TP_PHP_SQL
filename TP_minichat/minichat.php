<h1>Mini-chat</h1>

<form action="minichat_post.php" method="post">
<p>
    <label>Pseudo : <br/><input type="text" name="pseudo" /></label><br/>
    <label>Message : <br/><textarea name="message" rows="8" cols="45"></textarea></label><br/>
    <input type="submit" value="Envoyer" />
</p>
</form>

<div>
<?php
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // Récupération des 10 derniers messages
    $reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

    // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
    while ($donnees = $reponse->fetch())
    {
        echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> dit : ' . htmlspecialchars($donnees['message']) . '</p>';
    }

    $reponse->closeCursor();
?>
</div>