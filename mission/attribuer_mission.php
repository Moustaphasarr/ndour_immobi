<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["conducteur"]);

?>

<!-- mission/attribuer_mission.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attribuer une mission</title>
</head>
<body>

<?php
include_once("../includes/header.php");
include_once("../includes/nav.php");

// Récupérer les projets et les sous-traitants
$projets = $conn->query("SELECT id_projet FROM projet")->fetchAll(PDO::FETCH_ASSOC);
$sous_traitants = $conn->query("SELECT id_sous_traitant, nom FROM sous_traitant")->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_projet = $_POST["id_projet"];
    $id_sous_traitant = $_POST["id_sous_traitant"];
    $statut_mission = $_POST["statut_mission"];
    $date = $_POST["date"];
    $description = $_POST["description"];

    $sql = "INSERT INTO recoit_mission (id_projet, id_sous_traitant, statut_mission, date, description_du_mission)
            VALUES (:id_projet, :id_sous_traitant, :statut_mission, :date, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":id_projet" => $id_projet,
        ":id_sous_traitant" => $id_sous_traitant,
        ":statut_mission" => $statut_mission,
        ":date" => $date,
        ":description" => $description
    ]);

    echo "<p>✅ Mission attribuée avec succès.</p>";
}
?>

<h2>Attribuer une mission</h2>

<form class="formulaire" method="POST">
    <label>Projet :</label>
    <select name="id_projet" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach ($projets as $projet): ?>
            <option value="<?= $projet['id_projet'] ?>"><?= $projet['id_projet'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Sous-traitant :</label>
    <select name="id_sous_traitant" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach ($sous_traitants as $sous): ?>
            <option value="<?= $sous['id_sous_traitant'] ?>"><?= htmlspecialchars($sous['nom']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Statut mission :</label>
    <input type="text" name="statut_mission" required>

    <label>Date </label>
    <input type="date" name="date" required>

    <label>Description </label>
    <textarea name="description" required></textarea>

    <button type="submit">Attribuer</button>
</form>

<p><a class="btn" href="../index.php">← Retour au menu</a></p>

<?php include_once("../includes/footer.php"); ?>

</body>
</html>
