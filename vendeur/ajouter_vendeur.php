<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["commercial",]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un vendeur</title>
</head>
<body>
<?php
include_once("../includes/header.php");
include_once("../includes/nav.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $contact = $_POST["contact"];

    $sql = "INSERT INTO vendeur (nom, contact) VALUES (:nom, :contact)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":nom" => $nom,
        ":contact" => $contact
    ]);

    echo "<p>✅ Vendeur ajouté avec succès !</p>";
}
?>

<h2 class="ajout">Ajouter un vendeur</h2>

<form class="formulaire" method="POST">
    <label>Nom </label>
    <input type="text" name="nom" required>

    <label>Contact </label>
    <input type="number" name="contact" required>

    <button type="submit">Ajouter</button>
</form>

<p><a class="btn" href="../index.php">← Retour au menu</a></p>

<?php include_once("../includes/footer.php"); ?>
</body>
</html>
