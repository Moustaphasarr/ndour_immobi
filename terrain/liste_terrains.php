<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
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

$terrains = $conn->query("SELECT * FROM terrain")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Liste des terrains</h2>

<section class="listeform">
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>ID Vendeur</th>
            <th>Localisation</th>
            <th>Prix</th>
            <th>Superficie (m²)</th>
        </tr>

        <?php foreach ($terrains as $terrain): ?>
            <tr>
                <td><?= htmlspecialchars($terrain["id_terrain"]) ?></td>
                <td><?= htmlspecialchars($terrain["id_vendeur"]) ?></td>
                <td><?= htmlspecialchars($terrain["localisation"]) ?></td>
                <td><?= htmlspecialchars($terrain["prix"]) ?></td>
                <td><?= htmlspecialchars($terrain["superficie2"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<p><a class="btn" href="../index.php">← Retour au menu</a></p>

<?php include_once("../includes/footer.php"); ?>

</body>
</html>