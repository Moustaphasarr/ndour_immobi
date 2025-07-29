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
    <title>Liste des formulaires</title>
</head>
<body>
    <?php include_once("../includes/header.php"); ?>
    <?php include('../includes/nav.php'); ?>

    <h2>Liste des formulaires de demande</h2>

    <Section class="listeform">
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Commercial</th>
                    <th>Budget (€)</th>
                    <th>Superficie (m²)</th>
                    <th>Pièces</th>
                    <th>Date de remise</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "
                    SELECT f.id_formulaire, 
                        c.nom_client_, c.prenom_client, 
                        com.nom_employe AS commercial,prenom,
                        f.budget, f.superficie, f.nombre_de_piece, f.date_remise
                    FROM formulaire f
                    JOIN client c ON f.numero_client = c.numero_client
                    JOIN commercial com ON f.id_employe = com.id_employe
                    ORDER BY f.id_formulaire DESC
                ";
                $formulaires = $conn->query($sql)->fetchAll();

                foreach ($formulaires as $formulaire):
                ?>
                    <tr>
                        <td><?= $formulaire['id_formulaire'] ?></td>
                        <td><?= htmlspecialchars($formulaire["prenom_client"]." ".$formulaire['nom_client_']) ?></td>
                        <td><?= htmlspecialchars($formulaire['prenom']." ".$formulaire['commercial']) ?></td>
                        <td><?= $formulaire['budget'] ?></td>
                        <td><?= $formulaire['superficie'] ?></td>
                        <td><?= $formulaire['nombre_de_piece'] ?></td>
                        <td><?= $formulaire['date_remise'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <p><a class="btn" href="../index.php">← Retour au menu</a></p>

    <?php include_once("../includes/footer.php"); ?>

</body>
</html>