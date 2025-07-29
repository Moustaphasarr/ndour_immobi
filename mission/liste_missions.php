<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
?>
<!-- mission/liste_missions.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des missions</title>
</head>
<body>

    <?php
    include_once("../connexion.php");
    include_once("../includes/header.php");
    include_once("../includes/nav.php");

    $missions = $conn->query("
        SELECT rm.id_projet, rm.id_sous_traitant, st.nom AS sous_traitant, 
            rm.statut_mission, rm.date, rm.description_du_mission
        FROM recoit_mission rm
        JOIN sous_traitant st ON rm.id_sous_traitant = st.id_sous_traitant
    ")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2 class="ajout">Liste des missions</h2>
    <section class="listeform">
        <table border="1" cellpadding="5">
            <tr>
                <th>Projet</th>
                <th>Sous-traitant</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Description</th>
            </tr>

            <?php foreach ($missions as $mission): ?>
                <tr>
                    <td><?= htmlspecialchars($mission["id_projet"]) ?></td>
                    <td><?= htmlspecialchars($mission["sous_traitant"]) ?></td>
                    <td><?= htmlspecialchars($mission["statut_mission"]) ?></td>
                    <td><?= htmlspecialchars($mission["date"]) ?></td>
                    <td><?= htmlspecialchars($mission["description_du_mission"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <p><a class="btn" href="../index.php">← Retour au menu</a></p>

    <?php include_once("../includes/footer.php"); ?>

</body>
</html>
