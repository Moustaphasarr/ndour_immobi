<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["secretaire", "commercial","admin"]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include_once("../includes/header.php"); ?>
    <?php include_once("../connexion.php"); ?>
    <?php include('../includes/nav.php'); ?>
    <h2 class="ajout">Ajouter un client</h2>

<form class="formulaire" action="" method="POST">
    <label>Numéro client :</label>
    <input type="text" name="numero" required>

    <label>Nom </label>
    <input type="text" name="nom" required>

    <label>Prénom </label>
    <input type="text" name="prenom" required>

    <label>Adresse </label>
    <input type="text" name="adresse" required>

    <label>Email </label>
    <input type="email" name="email" required>

    <label>Téléphone </label>
    <input type="text" name="telephone" required>

    <input type="submit" value="Enregistrer">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST["numero"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];

    $sql = "INSERT INTO CLIENT (NUMERO_CLIENT, NOM_CLIENT_, PRENOM_CLIENT, ADRESSE, EMAIL, TELEPHONE)
            VALUES (:numero, :nom, :prenom, :adresse, :email, :telephone)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            ':numero' => $numero,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':email' => $email,
            ':telephone' => $telephone
        ]);
        echo "<p style='color: green;'>Client ajouté avec succès !</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>
<p><a class="btn" href="../index.php">← Retour au menu</a></p>
<?php include_once("../includes/footer.php"); ?>


</body>
</html>