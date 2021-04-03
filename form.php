<?php
//inclure le fichier 
require_once '_connec.php';
//une connexion
$pdo = new \PDO(DSN, USER, PASS);

$friends = $pdo->query("SELECT * FROM friend")->fetchAll(PDO::FETCH_ASSOC);


        $errors = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['firstname']) && strlen($_POST['firstname']) <= 45 && !empty($_POST['lastname']) && strlen($_POST['lastname']) <= 45) {

        

        /* traiter les elements que on a reçu en method $_POST*/
        //securisé les entrées 
        $data = array_map('trim', $_POST);
        $securePrenom = htmlentities($data['firstname']);
        $secureName = htmlentities($data['lastname']);
        $limit = $_GET['limit'];
        $query = "INSERT INTO friend (firstname, lastname)  VALUES (:firstname,:lastname )";


        $prepareInsert = $pdo->prepare($query);
        $prepareInsert->bindValue(':lastname', $_POST['lastname'], \PDO::PARAM_STR);
        $prepareInsert->bindValue(':firstname', $_POST['firstname'], \PDO::PARAM_STR);
        $prepareInsert->execute();
        header('Location: form.php');


       

    } else {
        $errors = "Erreur veuillez recommencer!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formFriends</title>
</head>

<body>

    <form action="form.php" method="POST">
        <?php
        if (!empty($errors)) { ?>
            <div class="alerte">
                <p><?php echo $errors; ?></p>
            </div>
        <?php } ?>

        <div class="bloc_form">
            <h2>Name :</h2>
            <label for="lastname" class="form_label"></label>
            <input type="text" class="form_control" name="lastname" id='lastname' />
        </div>

        <div class="bloc_form">
            <h2>Prenom :</h2>
            <label for="firstname" class="form_label"></label>
            <input type="text" class="form_control" name="firstname" id='firstname' />
        </div>


        <div class="btn_form">
            <button type="submit" class="btn_ajouter">Ajouter</button>
        </div>


    </form>

    <div>
        <ul>
            <?php
            foreach ($friends as $friend) {
                echo "<li>" . $friend['firstname'] . " " . $friend['lastname'] . " </li>";
            }
            ?>
        </ul>
    </div>

</body>

</html>