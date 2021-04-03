<?php
/*il faut inclure le fichier en début des scripts qui en auront besoin :*/
require_once '_connec.php';
/*une connexion au début de ton code PHP (avant d'effectuer la moindre requête SQL), selon la syntaxe suivante :*/
$pdo = new \PDO(DSN, USER, PASS);

/*requête pour récupérer tous les enregistrements.

/*La méthode query() de l'objet PDO (préalablement instancié et stocké dans la variable $pdo)*/
$query = "SELECT * FROM friend";

/*La méthode retourne un objet de type PDOStatement (c'est pour cela que la variable a été nommée $statement).*/
$statement = $pdo->query($query);

/*Ce nouvel objet possède lui-même plusieurs méthodes (dont fetchAll() utilisée ici) permettant de récupérer les données sous différents formats.*/
$friends = $statement->fetchAll();

/*Dans ce cas, ce n'est plus query() que tu devras utiliser, mais la méthode exec()*/
//$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
//$statement = $pdo->exec($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>friends</title>
</head>
<body>
    <a href="">Aujourd'hui nous sommes le <?php print date('d/m/Y h:i:s'); ?></a>
    <p>Si tu veux changer de prénom, <a href="/form.php">clique ici</a> pour revenir à la page formulaire.php.</p>
</body>
</html>