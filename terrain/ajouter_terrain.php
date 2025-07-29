<?php
session_start();
require_once("../connexion.php");
require_once("../includes/verifier_acces.php");
verifier_acces(["commercial"]);

$message = "";
$erreur = "";

// Traitement du formulaire si soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_vendeur = $_POST["id_vendeur"] ?? null;
    $localisation = $_POST["localisation"] ?? "";
    $prix = $_POST["prix"] ?? "";
    $superficie = $_POST["superficie2"] ?? "";

    if ($id_vendeur && $localisation && $prix && $superficie) {
        try {
            $stmt = $conn->prepare("INSERT INTO terrain (id_vendeur, localisation, prix, superficie2) VALUES (:id_vendeur, :localisation, :prix, :superficie)");
            $stmt->execute([
                ':id_vendeur' => $id_vendeur,
                ':localisation' => $localisation,
                ':prix' => $prix,
                ':superficie' => $superficie
            ]);
            $message = "✅ Terrain ajouté avec succès.";
        } catch (PDOException $e) {
            $erreur = "❌ Erreur lors de l'ajout : " . $e->getMessage();
        }
    } else {
        $erreur = "❌ Tous les champs sont obligatoires.";
    }
}

// Récupération des vendeurs depuis la base
$vendeurs = [];
try {
    $stmt = $conn->query("SELECT id_vendeur, nom FROM VENDEUR");
    $vendeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors du chargement des vendeurs : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un terrain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php include_once("../includes/header.php"); ?>
<?php include('../includes/nav.php'); ?>

<h2 class="ajout">Ajouter un terrain</h2>

<!-- Affichage des messages -->
<?php if (!empty($message)) echo "<p style='color: green;'>$message</p>"; ?>
<?php if (!empty($erreur)) echo "<p style='color: red;'>$erreur</p>"; ?>

<form class="formulaire" action="" method="post">
    <label for="id_vendeur">Vendeur </label>
    <select name="id_vendeur" id="id_vendeur" required>
        <option value="">-- Sélectionner un vendeur --</option>
        <?php foreach ($vendeurs as $vendeur): ?>
            <option value="<?= $vendeur['id_vendeur'] ?>">
                <?= htmlspecialchars($vendeur['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="localisation">Localisation :</label>
    <input type="text" name="localisation" id="localisation" required>

    <label for="prix">Prix :</label>
    <input type="number" step="0.01" name="prix" id="prix" required>

    <label for="superficie2">Superficie (m²) :</label>
    <input type="number" step="0.01" name="superficie2" id="superficie2" required>

    <button type="submit">✅ Ajouter le terrain</button>
</form>

<br>
<a class="btn" href="../index.php">← Retour au menu</a>

<?php include_once("../includes/footer.php"); ?>

</body>
</html>
