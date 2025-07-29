<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un employé</title>
</head>
<body>
    <?php
    include_once("../connexion.php");
    include_once("../includes/header.php");
    include_once("../includes/nav.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $telephone = $_POST["telephone"];
        $fonction = $_POST["fonction"];
        $domaine = $fonction; // correspondance directe

        // Préparation de la requête
        $sql = "INSERT INTO $fonction (nom_employe, prenom, domaine, telephone)
                VALUES (:nom, :prenom, :domaine, :telephone)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":domaine" => $domaine,
            ":telephone" => $telephone
        ]);

        echo "<p>✅ Employé ajouté avec succès dans $fonction !</p>";
    }
    ?>

    <h2>Ajouter un employé</h2>
    <form class="formulaire" method="POST">
        <label>Nom </label>
        <input type="text" name="nom" required>

        <label>Prénom </label>
        <input type="text" name="prenom" required>

        <label>Téléphone </label>
        <input type="text" name="telephone" required>

        <label>Fonction </label>
        <select name="fonction" required>
            <option value="">-- Choisir --</option>
            <option value="secretaire">Secrétaire</option>
            <option value="technicien">Technicien</option>
            <option value="metreur">Métreur</option>
            <option value="conducteur">Conducteur</option>
            <option value="commercial">Commercial</option>
        </select>

        <button type="submit">Ajouter</button>
    </form>

    <p><a class="btn" href="../index.php">← Retour au menu</a></p>
    <?php include_once("../includes/footer.php"); ?>
</body>
</html>
