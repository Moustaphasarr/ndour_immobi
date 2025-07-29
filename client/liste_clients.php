<?php
session_start();
require_once("../connexion.php");
?>

<?php include_once("../includes/header.php"); ?>
<?php include('../includes/nav.php'); ?>

<h2>Liste des clients</h2>
    <section class="listeform">
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Numéro</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>

            <?php
            $stmt = $conn->query("SELECT * FROM CLIENT ORDER BY NUMERO_CLIENT");
            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['numero_client']}</td>
                        <td>{$row['nom_client_']}</td>
                        <td>{$row['prenom_client']}</td>
                        <td>{$row['adresse']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telephone']}</td>
                    </tr>";
            }
            ?>
        </table>
    </section>
<p><a class="btn" href="../index.php">← Retour au menu</a></p>
<?php include_once("../includes/footer.php"); ?>
