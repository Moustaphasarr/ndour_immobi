<?php
session_start();

// Rediriger si l'utilisateur est déjà connecté
if (isset($_SESSION["utilisateur_id"])) {
    header("Location: index.php");
    exit;
}

require_once("connexion.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Préparation de la requête avec récupération de id_employe
    $sql = "SELECT id, nom_utilisateur, mot_de_passe, role, id_employe FROM utilisateur WHERE nom_utilisateur = :nom";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":nom" => $nom_utilisateur]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur["mot_de_passe"])) {
        $_SESSION["utilisateur_id"] = $utilisateur["id"];
        $_SESSION["nom_utilisateur"] = $utilisateur["nom_utilisateur"];
        $_SESSION["role"] = $utilisateur["role"];
        $_SESSION["id_employe"] = $utilisateur["id_employe"]; // <- Nouvel ajout

        header("Location: index.php");
        exit;
    } else {
        $message = "❌ Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Edu+SA+Hand:wght@400..700&display=swap" rel="stylesheet">
    <title>🔐 Connexion - Ndour Family Immo</title>
</head>
<body>
    <section>
        <h1>Bienvenue dans la société Ndour Family Immo</h1>
        <h2>🔐 Connexion</h2>
        <form method="post">
            <label>Nom d'utilisateur :</label>
            <input type="text" name="nom_utilisateur" required><br>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required><br>

            <button type="submit">Se connecter</button>
        </form>

        <p style="color:red;"><?= htmlspecialchars($message) ?></p>
    </section>
</body>
</html>
