# 🏠 Ndour Family Immo

Un système complet de gestion pour la société **Ndour Family Immo**, développé en **PHP** avec une base de données **PostgreSQL**, permettant de **digitaliser la gestion des clients, projets, terrains, devis, acomptes et employés**.

---

## 🎯 Objectif du projet

Ce projet a été conçu pour **informatiser le processus de commande et de gestion des villas** de l’entreprise Ndour Family Immo.  
Il centralise toutes les informations dans un système unique et simplifie la gestion quotidienne.

---

## 🚀 Fonctionnalités principales

✅ **Gestion des utilisateurs et authentification**
- Connexion sécurisée avec rôles (`admin`, `secretaire`, `commercial`, `technicien`, `conducteur`, `metreur`).
- Système de permissions (certaines pages sont réservées à certains rôles).

✅ **Gestion des clients**
- Ajout, modification, suppression et recherche de clients.

✅ **Gestion des terrains**
- Enregistrement des terrains avec prix, superficie et vendeur.

✅ **Gestion des devis et acomptes**
- Création et gestion des devis.
- Versement des acomptes et suivi automatique.

✅ **Gestion des employés**
- Prise en charge de plusieurs catégories : secrétaire, commercial, technicien, conducteur, métreur.

✅ **Base de données PostgreSQL**
- Stockage sécurisé et structuré de toutes les données.

✅ **Interface claire**
- Navigation intuitive et formulaires simples.

---

## 🛠️ Technologies utilisées

- **Frontend :** HTML5, CSS3  
- **Backend :** PHP 8  
- **Base de données :** PostgreSQL 17  
- **Serveur local :** XAMPP (Apache + PHP)

---

## ⚙️ Installation

1️⃣ **Cloner le projet**
```bash
git clone https://github.com/Moustaphasarr/ndour_immobi.git
```

2️⃣ **Placer le projet dans le serveur local**
- Copier le dossier dans `htdocs` (si tu utilises XAMPP).

3️⃣ **Créer la base de données PostgreSQL**
- Créer une base `ndour_immo`
- Importer le fichier SQL fourni (structure + données).

4️⃣ **Configurer la connexion**
- Modifier le fichier `connexion.php` :
```php
$host = "localhost";
$dbname = "ndour_immo";
$user = "postgres";
$password = "ton_mot_de_passe";
```

5️⃣ **Lancer l’application**
- Ouvrir [http://localhost/ndour_immo](http://localhost/ndour_immo) dans ton navigateur.

---

## 🔑 Comptes par défaut (exemple)

| Rôle       | Nom utilisateur | Mot de passe |
|------------|----------------|--------------|
| Admin      | admin          | admin123     |
| Secrétaire | secretaire1    | pass123      |
| Commercial | commercial1    | pass123      |

---

## 📂 Structure du projet

```
ndour_immo/
│── client/           # Module clients
│── terrain/          # Module terrains
│── devis/            # Module devis
│── acompte/          # Module acomptes
│── employe/          # Gestion des employés
│── includes/         # Header, footer, navigation
│── connexion.php     # Connexion PostgreSQL
│── index.php         # Page d’accueil
│── login.php         # Page de connexion
```

---

## 👨‍💻 Auteur

**Moustapha Sarr**  
📌 Projet développé pour **Ndour Family Immo**

