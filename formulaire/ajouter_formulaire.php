<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["secretaire", "commercial"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un formulaire</title>
</head>
<body>
    <?php include_once("../includes/header.php"); ?>
    <?php include('../includes/nav.php'); ?>


<?php
// Récupérer les clients et commerciaux existants
$clients = $conn->query("SELECT numero_client, nom_client_, prenom_client FROM CLIENT")->fetchAll();
$commerciaux = $conn->query("SELECT id_employe, nom_employe, prenom FROM COMMERCIAL")->fetchAll();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO FORMULAIRE (numero_client, id_employe, budget, superficie, nombre_de_piece, date_remise)
                           VALUES (:numero_client, :id_employe, :budget, :superficie, :nombre_de_piece, CURRENT_DATE)");

    $stmt->execute([
        ':numero_client' => $_POST['numero_client'],
        ':id_employe' => $_POST['id_employe'],
        ':budget' => $_POST['budget'],
        ':superficie' => $_POST['superficie'],
        ':nombre_de_piece' => $_POST['nombre_de_piece']
    ]);

    echo "<p style='color: green;'>Formulaire ajouté avec succès !</p>";
}
?>

<h2 class="ajout">Ajouter un formulaire de demande</h2>

<form class="formulaire" method="POST">
    <label>Client :</label>
    <select name="numero_client" required>
        <option value="">-- Sélectionner un client --</option>
        <?php foreach ($clients as $client): ?>
            <option value="<?= $client['numero_client'] ?>">
                <?= $client['nom_client_']." ".$client['prenom_client'] ?> (<?= $client['numero_client'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label>Commercial :</label>
    <select name="id_employe" required>
        <option value="">-- Sélectionner un commercial --</option>
        <?php foreach ($commerciaux as $com): ?>
            <option value="<?= $com['id_employe']?>"><?= $com['nom_employe']." ".$com["prenom"]  ?></option>
        <?php endforeach; ?>
    </select>

    <label>Budget (€) :</label>
    <input type="number" name="budget" step="0.01" required>

    <label>Superficie (m²) :</label>
    <input type="number" name="superficie" step="0.01" required>

    <label>Nombre de pièces :</label>
    <input type="number" name="nombre_de_piece" required>

    <input type="submit" value="Enregistrer">
</form>

<p><a class="btn" href="../index.php">← Retour au menu</a></p>

<?php include_once("../includes/footer.php"); ?>

</body>
</html>