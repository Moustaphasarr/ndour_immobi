<?php
require_once("../connexion.php");
session_start();
require_once("../includes/verifier_acces.php");
verifier_acces(["admin", "secretaire"]);

$sous_traitants = $conn->query("SELECT * FROM sous_traitant")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include_once("../includes/header.php"); ?>
    <?php include('../includes/nav.php'); ?>
    <h2 class="ajout">Liste des sous-traitants</h2>
    <section class="listeform">
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Domaine</th>
                <th>Disponibilité</th>
                <th>Téléphone</th>
            </tr>
            <?php foreach ($sous_traitants as $st): ?>
                <tr>
                    <td><?= htmlspecialchars($st["id_sous_traitant"]) ?></td>
                    <td><?= htmlspecialchars($st["nom"]) ?></td>
                    <td><?= htmlspecialchars($st["domaine"]) ?></td>
                    <td><?= htmlspecialchars($st["disponibilite"]) ?></td>
                    <td><?= htmlspecialchars($st["telephone"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <p><a class="btn" href="../index.php">← Retour au menu</a></p>
    <?php include_once("../includes/footer.php"); ?>
</body>
</html>