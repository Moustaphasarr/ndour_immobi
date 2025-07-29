<?php
require_once("../connexion.php");
session_start();
require_once("../includes/verifier_acces.php");
verifier_acces(["conducteur"]); // Accès restreint
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
    <?php include_once("../includes/nav.php"); ?>

    <h2>Ajouter un sous-traitant</h2>
    <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $domaine = $_POST["domaine"];
    $disponibilite = $_POST["disponibilite"];
    $telephone = $_POST["telephone"];

    try {
        $stmt = $conn->prepare("INSERT INTO sous_traitant (id_sous_traitant, nom, domaine, disponibilite, telephone)
                                VALUES (DEFAULT, :nom, :domaine, :disponibilite, :telephone)");
        $stmt->execute([
            ":nom" => $nom,
            ":domaine" => $domaine,
            ":disponibilite" => $disponibilite,
            ":telephone" => $telephone
        ]);
        echo "<p style='color:green;'>✅ Sous-traitant ajouté avec succès.</p>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>❌ Erreur : " . $e->getMessage() . "</p>";
    }
    }
    ?>
    <form class="formulaire" action="" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Domaine :</label>
        <select name="domaine" required>
            <option value="electricite">Électricité</option>
            <option value="plomberie">Plomberie</option>
            <option value="maçonnerie">Maçonnerie</option>
            <!-- Ajoute selon ta définition ENUM -->
        </select>

        <label>Disponibilité :</label>
        <select name="disponibilite" required>
            <option value="disponible">Disponible</option>
            <option value="occupe">Occupé</option>
        </select>

        <label>Téléphone :</label>
        <input type="text" name="telephone" maxlength="15" required>

        <button type="submit">Ajouter</button>
    </form>
    <p><a class="btn" href="../index.php">← Retour au menu</a></p>
    <?php include_once("../includes/footer.php"); ?>
</body>
</html>