<?php
session_start();
require_once("../connexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
    include_once("../includes/header.php");
    include_once("../includes/nav.php");

    $devis = $conn->query("SELECT * FROM devis")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2 class="ajout">📋 Liste des devis</h2>

    <section class="listeform">
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Projet</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Émission</th>
                <th>Signature</th>
            </tr>

            <?php foreach ($devis as $d): ?>
                <tr>
                    <td><?= $d["id_devis"] ?></td>
                    <td><?= $d["id_projet"] ?></td>
                    <td><?= $d["numero_client"] ?></td>
                    <td><?= $d["montant"] ?></td>
                    <td><?= $d["statut"] ?></td>
                    <td><?= $d["date_emission"] ?></td>
                    <td><?= $d["date_de_signature"] ?? "—" ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <p><a class="btn" href="../index.php">← Retour au menu</a></p>

    <?php include_once("../includes/footer.php"); ?>

</body>
</html>