<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["commercial"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un projet</title>
</head>
<body>
    <?php
    include_once("../includes/header.php");
    include('../includes/nav.php');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_formulaire = $_POST['id_formulaire'];
    $id_secretaire = $_POST['id_secretaire'];
    $id_commercial = $_POST['id_commercial'];
    $id_technicien = $_POST['id_technicien'];
    $id_conducteur = $_POST['id_conducteur'];
    $id_metreur = $_POST['id_metreur'];
    $id_terrain = $_POST['id_terrain'];
    $montant_estime = $_POST['montant_estime'];
    $duree_estime = $_POST['duree_estime'];
    $avis = $_POST['avis'];
    $statut = $_POST['statut'];
    $date_lancement = $_POST['date_lancement'];

    $stmt = $conn->prepare("INSERT INTO projet (
        id_employe, com_id_employe, con_id_employe, met_id_employe,
        tec_id_employe, id_formulaire, statut, montant_estime,
        avis_de_faisabilite, duree_estimer, id_terrain, date_de_lancement
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $id_secretaire, $id_commercial, $id_conducteur, $id_metreur,
        $id_technicien, $id_formulaire, $statut, $montant_estime,
        $avis, $duree_estime, $id_terrain, $date_lancement
    ]);

    echo "<p>✅ Projet ajouté avec succès !</p>";
}
?>

<h2 class="ajout">Ajout d'un nouveau projet</h2>

<form  method="post">
    <label>Formulaire :</label>
    <select name="id_formulaire" required>
        <?php
        $res = $conn->query("SELECT f.id_formulaire, c.nom_client_, prenom_client FROM formulaire f JOIN client c ON f.numero_client = c.numero_client");
        foreach ($res as $row)
            echo "<option value='{$row['id_formulaire']}'>#{$row['id_formulaire']} - {$row["prenom_client"]}  {$row['nom_client_']}</option>";
        ?>
    </select><br><br>

    <?php
    function afficherSelect($conn, $table, $name, $label) {
        echo "<label>$label :</label><select name='$name' required>";
        $res = $conn->query("SELECT id_employe, nom_employe, prenom FROM $table");
        foreach ($res as $row)
            echo "<option value='{$row['id_employe']}'>{$row['prenom']} {$row['nom_employe']}</option>";
        echo "</select><br><br>";
    }

    afficherSelect($conn, 'secretaire', 'id_secretaire', 'Secrétaire');
    afficherSelect($conn, 'commercial', 'id_commercial', 'Commercial');
    afficherSelect($conn, 'technicien', 'id_technicien', 'Technicien');
    afficherSelect($conn, 'conducteur', 'id_conducteur', 'Conducteur');
    afficherSelect($conn, 'metreur', 'id_metreur', 'Métreur');
    ?>

    <label>Terrain :</label>
    <select name="id_terrain" required>
        <?php
        $res = $conn->query("SELECT id_terrain, localisation FROM terrain");
        foreach ($res as $row)
            echo "<option value='{$row['id_terrain']}'>#{$row['id_terrain']} - {$row['localisation']}</option>";
        ?>
    </select><br><br>

    <label>Montant estimé (€) :</label>
    <input type="number" name="montant_estime" step="0.01" required><br><br>

    <label>Durée estimée (YYYY-MM-DD) :</label>
    <input type="date" name="duree_estime" required><br><br>

    <label>Faisabilité :</label>
    <select name="avis" required>
        <option value="Faisable">Faisable</option>
        <option value="Non faisable">Non faisable</option>
    </select><br><br>

    <label>Statut :</label>
    <input type="text" name="statut" required><br><br>

    <label>Date de lancement :</label>
    <input type="date" name="date_lancement" required><br><br>

    <input type="submit" value="Ajouter le projet">
</form>

<p><a class="btn" href="../index.php">← Retour au menu</a></p>

<?php include_once("../includes/footer.php"); ?>

</body>
</html>