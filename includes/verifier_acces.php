<?php
function verifier_acces(array $roles_autorises) {
    if (!isset($_SESSION["role"])) {
        echo "<p style='color:red'>❌ Accès refusé. Veuillez vous <a href='../login.php'>connecter</a>.</p>";
        exit;
    }

    if (!in_array($_SESSION["role"], $roles_autorises)) {
        echo "<p style='color:red'>❌ Accès réservé au  : " . implode(" ou ", $roles_autorises) . "</p>";
        echo "<p><a href='../index.php'>← Retour au menu</a></p>";
        exit;
    }
}
