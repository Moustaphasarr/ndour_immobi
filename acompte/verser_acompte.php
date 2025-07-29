<?php session_start();
 require_once("../connexion.php"); 
 require_once("../includes/verifier_acces.php"); 
 verifier_acces(["secretaire"]); ?> 

 <!DOCTYPE html> 
 <html lang="fr"> 
    <head> <meta charset="UTF-8"> 
       <title>Verser un acompte</title>
    </head>
    <body> 
        <?php include_once("../includes/header.php"); 
        include_once("../includes/nav.php"); 
        // Récupération des clients et devis 
        $clients = $conn->query("SELECT numero_client, nom_client_ FROM client")->fetchAll(PDO::FETCH_ASSOC); 
        $devis = $conn->query("SELECT id_devis, montant FROM devis")->fetchAll(PDO::FETCH_ASSOC); 
        // Traitement du formulaire 
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $id_employe = $_SESSION["id_employe"] ?? null; 
            if (!$id_employe) { 
                echo "<p style='color:red;'>❌ ID employé introuvable en session.</p>"; 
                exit; 
            } 
            // Récupération des champs du formulaire 
            $numero_client = $_POST["numero_client"]; 
            $id_devis = $_POST["id_devis"]; 
            $montant = $_POST["montant"]; 
            $date = $_POST["date_versement"]; 
            try { 
                $conn->beginTransaction(); 
                // Insertion dans acompte 
                $stmt1 = $conn->prepare("INSERT INTO acompte (montant) VALUES (:montant) RETURNING id_acompte"); 
                $stmt1->execute([":montant" => $montant]); 
                $id_acompte = $stmt1->fetchColumn(); 
                // Insertion dans verser 
                $stmt2 = $conn->prepare("INSERT INTO verser (id_employe, numero_client, id_devis, id_acompte, date_de_versement, montant) VALUES (:id_employe, :numero_client, :id_devis, :id_acompte, :date, :montant)"); 
                $stmt2->execute([ 
                    ":id_employe" => $id_employe, 
                    ":numero_client" => $numero_client, 
                    ":id_devis" => $id_devis, 
                    ":id_acompte" => $id_acompte, 
                    ":date" => $date, 
                    ":montant" => $montant 
                ]); 
                $conn->commit(); 
                echo "<p style='color:green;'>✅ Acompte versé avec succès !</p>"; 
            } catch (Exception $e) { 
                $conn->rollBack(); 
                echo "<p style='color:red;'>❌ Erreur lors du versement : " . $e->getMessage() . "</p>"; 
            } 
        } ?> 
        <h2 class="ajout">Verser un acompte</h2> 
        <form class="formulaire" method="POST"> 
            <label>Client </label> 
            <select name="numero_client" required> 
                <option value="">-- Choisir un client --</option> 
                <?php foreach ($clients as $c): ?> 
                    <option value="<?= $c["numero_client"] ?>"> <?= $c["numero_client"] ?> - <?= htmlspecialchars($c["nom_client_"]) ?> </option> 
                <?php endforeach; ?> 
            </select>
            <label>Devis </label>
        <select name="id_devis" required>
            <option value="">-- Choisir un devis --</option>
            <?php foreach ($devis as $d): ?>
                <option value="<?= $d["id_devis"] ?>">Devis #<?= $d["id_devis"] ?> (<?= $d["montant"] ?> FCFA)</option>
            <?php endforeach; ?>
        </select>

        <label>Montant de l'acompte (FCFA)</label>
        <input type="number" step="0.01" name="montant" required>

        <label>Date de versement :</label>
        <input type="date" name="date_versement" required>

        <button type="submit">💵 Valider le versement</button>
        </form>
        <p><a class="btn" href="../index.php">← Retour au menu</a></p>
        <?php include_once("../includes/footer.php"); ?>
    </body>
</html>