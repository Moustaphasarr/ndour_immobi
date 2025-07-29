<?php
session_start();
require_once("../connexion.php");

// Vérification de l'accès : rôle = admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo "<p style='color:red;'>⛔ Accès réservé à l’administrateur.</p>";
    exit;
}

$message = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_utilisateur = trim($_POST["nom_utilisateur"]);
    $mot_de_passe = $_POST["mot_de_passe"];
    $confirm = $_POST["confirm_mot_de_passe"];
    $role = $_POST["role"];
    $id_employe = intval($_POST["id_employe"]);

    if ($mot_de_passe !== $confirm) {
        $message = "❌ Les mots de passe ne correspondent pas.";
    } else {
        // Vérifie si le nom d'utilisateur existe déjà
        $stmt = $conn->prepare("SELECT COUNT(*) FROM utilisateur WHERE nom_utilisateur = :nom");
        $stmt->execute([":nom" => $nom_utilisateur]);

        if ($stmt->fetchColumn() > 0) {
            $message = "❌ Ce nom d'utilisateur est déjà utilisé.";
        } else {
            $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            try {
                $stmt = $conn->prepare("INSERT INTO utilisateur (nom_utilisateur, mot_de_passe, role, id_employe)
                                        VALUES (:nom, :mdp, :role, :id_emp)");
                $stmt->execute([
                    ":nom" => $nom_utilisateur,
                    ":mdp" => $hash,
                    ":role" => $role,
                    ":id_emp" => $id_employe
                ]);
                $message = "✅ Utilisateur ajouté avec succès.";
            } catch (PDOException $e) {
                $message = "❌ Erreur : " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
</head>
<body>
<?php include_once("../includes/header.php"); ?>
<?php include_once("../includes/nav.php"); ?>

<h2 class="ajout">➕ Ajouter un nouvel utilisateur</h2>

<?php if ($message): ?>
    <p style="color: <?= strpos($message, '✅') !== false ? 'green' : 'red' ?>"><?= $message ?></p>
<?php endif; ?>

<form class="formulaire" method="POST">
    <label>Nom d'utilisateur </label>
    <input type="text" name="nom_utilisateur" required>

    <label>Mot de passe </label><br>
    <input type="password" name="mot_de_passe" required>

    <label>Confirmer le mot de passe </label>
    <input type="password" name="confirm_mot_de_passe" required>

    <label>Rôle </label>
    <select name="role" required>
        <?php
        $roles = ['secretaire', 'commercial', 'technicien', 'conducteur', 'metreur'];
        foreach ($roles as $r) {
            echo "<option value='$r'>" . ucfirst($r) . "</option>";
        }
        ?>
    </select>

    <label>ID de l’employé (déjà présent dans la table correspondante) </label>
    <input type="number" name="id_employe" required>

    <button type="submit">Ajouter</button>
</form>

<p><a class="btn" href="../index.php">← Retour au menu</a></p>
<?php include_once("../includes/footer.php"); ?>
</body>
</html>
