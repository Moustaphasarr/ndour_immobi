<?php
session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION["role"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Document</title>
</head>
<body>
    
    <!-- ndour_immo/index.php -->
<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>

<main>
    <h1>Bienvenue sur la plateforme de gestion</h1>
    <h2>Ndour Family Immo</h2>

    <section>
        <ul>
            <?php if (in_array($_SESSION["role"], ["admin", "secretaire", "commercial"])): ?>
                <li><a href="client/ajouter_client.php">➕ Ajouter un client</a></li>
            <?php endif; ?>

            <li><a href="client/liste_clients.php">📋 Liste des clients</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "secretaire", "commercial"])): ?>
                <li><a href="formulaire/ajouter_formulaire.php">📝 Remplir un formulaire</a></li>
            <?php endif; ?>

            <li><a href="formulaire/liste_formulaires.php">🔍 Voir les formulaires</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "commercial"])): ?>
                <li><a href="projet/ajouter_projet.php">🏗️ Lancer un projet</a></li>
            <?php endif; ?>

            <li><a href="projet/liste_projets.php">📋 Liste des projets</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "commercial"])): ?>
                <li><a href="devis/ajouter_devis.php">💰 Générer un devis</a></li>
            <?php endif; ?>

            <li><a href="devis/liste_devis.php">📋 Liste des devis</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "secretaire"])): ?>
                <li><a href="acompte/verser_acompte.php">💵 Verser un acompte</a></li>
            <?php endif; ?>

            <li><a href="acompte/liste_versements.php">📄 Liste des acomptes</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "conducteur"])): ?>
                <li><a href="mission/attribuer_mission.php">🧰 Attribuer une mission</a></li>
            <?php endif; ?>

            <li><a href="mission/liste_missions.php">📄 Liste des missions</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "commercial"])): ?>
                <li><a href="terrain/ajouter_terrain.php">🌍 Ajouter un terrain</a></li>
            <?php endif; ?>

            <li><a href="terrain/liste_terrains.php">📋 Liste des terrains</a></li>

            <?php if (in_array($_SESSION["role"], ["admin", "commercial"])): ?>
                <li><a href="vendeur/ajouter_vendeur.php">🏢 Ajouter un vendeur</a></li>
            <?php endif; ?>

            <li><a href="vendeur/liste_vendeurs.php">📋 Liste des vendeurs</a></li>

            <li><a href="sous_traitant/ajouter_sous_traitant.php">➕ Ajouter un sous-traitant</a></li>
            <li><a href="sous_traitant/liste_sous_traitants.php">📋 Liste des sous-traitants</a></li>
            <?php if ($_SESSION["role"] === "admin"): ?>
                <li><a href="employe/ajouter_employe.php">👷 Ajouter un employé</a></li>
                <li><a href="employe/liste_employes.php">📋 Liste des employés</a></li>
                <li><strong>🔧 Administration</strong></li>
                <li><a href="admin/ajouter_utilisateur.php">➕ Ajouter un utilisateur</a></li>
                <li><a href="admin/liste_utilisateurs.php">📋 Liste des utilisateurs</a></li>
            <?php endif; ?>
        </ul>


    </section>

</main>

<?php include("includes/footer.php"); ?>


</body>
</html>