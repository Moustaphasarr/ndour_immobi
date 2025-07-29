<nav>
    <ul>
        <li><a href="/ndour_immo/index.php">🏠 Accueil</a></li>
        <li><a href="/ndour_immo/client/liste_clients.php">👤 Clients</a></li>
        <li><a href="/ndour_immo/formulaire/liste_formulaires.php">📝 Formulaires</a></li>
        <li><a href="/ndour_immo/projet/liste_projets.php">🏗️ Projets</a></li>
        <li><a href="/ndour_immo/devis/liste_devis.php">💰 Devis</a></li>
        <?php if (isset($_SESSION["role"])): ?>
            <li style="float:right">
                <a href="/ndour_immo/logout.php">🚪 Déconnexion (<?= htmlspecialchars($_SESSION["nom_utilisateur"]) ?>)</a>
            </li>
         <?php endif; ?>
    </ul>
    
</nav>
