<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["commercial","admin","technicien","metreur","conducteur"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des projets</title>
</head>
<body>
    <?php
    require_once '../includes/header.php';
    include_once("../connexion.php");
    include('../includes/nav.php');
try {
    $stmt = $conn->query("
        SELECT 
            p.id_projet,
            p.montant_estime,
            p.statut,
            p.duree_estimer,
            p.date_de_lancement,
            p.avis_de_faisabilite,
            c.nom_client_,
            f.budget,
            t.localisation
        FROM projet p
        JOIN formulaire f ON p.id_formulaire = f.id_formulaire
        JOIN client c ON f.numero_client = c.numero_client
        JOIN terrain t ON p.id_terrain = t.id_terrain
        ORDER BY p.id_projet DESC
    ");

    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<div class="container">
    <h2>Liste des projets</h2>

    <?php if (count($projets) > 0): ?>
        <Section class="listeform">
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Statut</th>
                        <th>Budget</th>
                        <th>Montant Estimé</th>
                        <th>Terrain</th>
                        <th>Durée Estimée</th>
                        <th>Avis de faisabilité</th>
                        <th>Date de lancement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projets as $projet): ?>
                        <tr>
                            <td><?= htmlspecialchars($projet['id_projet']) ?></td>
                            <td><?= htmlspecialchars($projet['nom_client_']) ?></td>
                            <td><?= htmlspecialchars($projet['statut']) ?></td>
                            <td><?= htmlspecialchars($projet['budget']) ?> FCFA</td>
                            <td><?= htmlspecialchars($projet['montant_estime']) ?> FCFA</td>
                            <td><?= htmlspecialchars($projet['localisation']) ?></td>
                            <td><?= htmlspecialchars($projet['duree_estimer']) ?></td>
                            <td><?= htmlspecialchars($projet['avis_de_faisabilite']) ?></td>
                            <td><?= htmlspecialchars($projet['date_de_lancement']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    <?php else: ?>
        <p>Aucun projet enregistré.</p>
    <?php endif; ?>

    <br><br>

    <a href="ajouter_projet.php" class="btn">➕ Ajouter un nouveau projet</a>
    <br><br>
    <a href="../index.php" class="btn">← Retour au menu principal</a>
</div>

<?php require_once '../includes/footer.php'; ?>

</body>
</html>
