<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
?>
<!-- acompte/liste_versements.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des versements</title>
</head>
<body>
    <?php
    include_once("../includes/header.php");
    include_once("../includes/nav.php");

    $sql = "SELECT v.id_employe, v.numero_client, c.nom_client_, v.id_devis, v.id_acompte, v.date_de_versement, v.montant
            FROM verser v
            JOIN client c ON v.numero_client = c.numero_client
            ORDER BY v.date_de_versement DESC";

    $versements = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2 class="ajout">Liste des acomptes versés</h2>

    <section class="listeform">
        <table border="1" cellpadding="5">
            <tr>
                <th>Client</th>
                <th>ID Devis</th>
                <th>ID Acompte</th>
                <th>Montant</th>
                <th>Date</th>
                <th>ID Secrétaire</th>
            </tr>
            <?php foreach ($versements as $v): ?>
                <tr>
                    <td><?= htmlspecialchars($v["numero_client"]) ?> - <?= htmlspecialchars($v["nom_client_"]) ?></td>
                    <td><?= $v["id_devis"] ?></td>
                    <td><?= $v["id_acompte"] ?></td>
                    <td><?= $v["montant"] ?> FCFA</td>
                    <td><?= $v["date_de_versement"] ?></td>
                    <td><?= $v["id_employe"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <p><a class="btn" href="../index.php">← Retour au menu</a></p>
    <?php include_once("../includes/footer.php"); ?>
    </body>
</html>