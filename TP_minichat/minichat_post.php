<?php
if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    // Protection des données qui vont être envoyées à la base de donnée contre une potentielle faille XSS
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $message = htmlspecialchars($_POST['message']);
    
    // Accès à la base de donnée
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
    // Insertion du pseudo et du message dans la base de donnée 'minichat'
	$requete = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(?, ?)');
	$requete->execute(array($pseudo, $message));
}

header('Location: minichat.php');
?>