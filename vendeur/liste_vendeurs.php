<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["commercial","admin"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des vendeurs</title>
</head>
<body>
    <?php
    include_once("../connexion.php");
    include_once("../includes/header.php");
    include_once("../includes/nav.php");

    $vendeurs = $conn->query("SELECT * FROM vendeur ORDER BY id_vendeur")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2 class="ajout">Liste des vendeurs</h2>

    <section class="listeform">
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Contact</th>
            </tr>

            <?php foreach ($vendeurs as $vendeur): ?>
                <tr>
                    <td><?= htmlspecialchars($vendeur["id_vendeur"]) ?></td>
                    <td><?= htmlspecialchars($vendeur["nom"]) ?></td>
                    <td><?= htmlspecialchars($vendeur["contact"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <p><a class="btn" href="../index.php">← Retour au menu</a></p>

    <?php include_once("../includes/footer.php"); ?>
</body>
</html>
