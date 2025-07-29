<?php
session_start();
require_once("../connexion.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo "<p style='color:red;'>⛔ Accès réservé à l’administrateur.</p>";
    exit;
}

$utilisateurs = $conn->query("SELECT id, nom_utilisateur, role FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php include_once("../includes/header.php"); ?>
<?php include_once("../includes/nav.php"); ?>

<h2 class="ajout">📋 Liste des utilisateurs</h2>
<section class="listeform">
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($utilisateurs as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u["id"]) ?></td>
                <td><?= htmlspecialchars($u["nom_utilisateur"]) ?></td>
                <td><?= htmlspecialchars($u["role"]) ?></td>
                <td>
                    <a href="modifier_utilisateur.php?id=<?= $u["id"] ?>">✏️ Modifier</a> |
                    <a href="supprimer_utilisateur.php?id=<?= $u["id"] ?>" onclick="return confirm('Confirmer la suppression ?')">🗑️ Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<p><a class="btn" href="../index.php">← Retour au menu</a></p>
<?php include_once("../includes/footer.php"); ?>
</body>
</html>
