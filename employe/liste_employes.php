<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
include_once("../connexion.php");
include_once("../includes/header.php");
include_once("../includes/nav.php");

$tables = [
    "secretaire" => "Secrétaires",
    "technicien" => "Techniciens",
    "metreur" => "Métreurs",
    "conducteur" => "Conducteurs",
    "commercial" => "Commerciaux"
];

echo "<h2>Liste des employés</h2>";

foreach ($tables as $table => $label) {
    $employes = $conn->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>$label</h3>";
    if (count($employes) > 0) {
        echo "<table border='1' cellpadding='5'>
                <tr>
                    <th>ID</th><th>Nom</th><th>Prénom</th>
                    <th>Domaine</th><th>Téléphone</th>";
        echo "</tr>";

        foreach ($employes as $e) {
            echo "<tr>
                <td>{$e['id_employe']}</td>
                <td>{$e['nom_employe']}</td>
                <td>{$e['prenom']}</td>
                <td>{$e['domaine']}</td>
                <td>{$e['telephone']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p><em>Aucun $label enregistré.</em></p>";
    }
}

echo '<p><a class="btn" href="../index.php">← Retour au menu</a></p>';
include_once("../includes/footer.php");
?>

</body>
</html>