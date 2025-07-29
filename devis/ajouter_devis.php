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
    <title>Document</title>
</head>
<body>

    <?php
    include_once("../connexion.php");
    include_once("../includes/header.php");
    include_once("../includes/nav.php");

    $clients = $conn->query("SELECT numero_client, nom_client_, prenom_client FROM client")->fetchAll();
    $projets = $conn->query("SELECT id_projet FROM projet")->fetchAll();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_projet = $_POST["id_projet"];
        $numero_client = $_POST["numero_client"];
        $montant = $_POST["montant"];
        $statut = $_POST["statut"];
        $date_emission = $_POST["date_emission"];
        $date_signature = $_POST["date_signature"] ?: null;

        $sql = "INSERT INTO devis (id_projet, numero_client, montant, statut, date_emission, date_de_signature)
                VALUES (:id_projet, :numero_client, :montant, :statut, :date_emission, :date_signature)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":id_projet" => $id_projet,
            ":numero_client" => $numero_client,
            ":montant" => $montant,
            ":statut" => $statut,
            ":date_emission" => $date_emission,
            ":date_signature" => $date_signature
        ]);

        echo "<p>✅ Devis ajouté avec succès.</p>";
    }
    ?>

    <h2 class="ajout">💰 Ajouter un devis</h2>

    <form class="formulaire" method="POST">
        <label>Projet </label>
        <select name="id_projet" required>
            <?php foreach ($projets as $p): ?>
                <option value="<?= $p["id_projet"] ?>">Projet #<?= $p["id_projet"] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Client :</label>
        <select name="numero_client" required>
            <?php foreach ($clients as $c): ?>
                <option value="<?= $c["numero_client"] ?>">
                    <?= $c["nom_client_"] . " " . $c["prenom_client"] ?> (<?= $c["numero_client"] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label>Montant (FCFA) </label>
        <input type="number" name="montant" step="0.01" required>

        <label>Statut </label>
        <input type="text" name="statut" required>

        <label>Date d’émission </label>
        <input type="date" name="date_emission" required>

        <label>Date de signature (facultative) </label>
        <input type="date" name="date_signature">

        <button type="submit">Ajouter</button>
    </form>

    <p><a class="btn" href="../index.php">← Retour au menu</a></p>

    <?php include_once("../includes/footer.php"); ?>

</body>
</html>