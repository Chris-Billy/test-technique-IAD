<?php

// Header requis pour l'affichage du résultat sous le format json
header("Content-Type: application/json; charset=UTF-8");

// On inclut nos class pour pouvoir y accéder
require_once('./../../config/Database.php');
require_once('./../../managers/ContactManager.php');

// On instancie la base de données et on s'y connecte
$database = new Database();
$db = $database->getConnection();

// On instancie notre gestionnaire de contact
$contactManager = new ContactManager($db);

// On récupère tous les contacts
$datas = $contactManager->findAll();

// On créé un tableau qui contiendra tous les contacts récupérés
$result = [];
$result['contacts'] = $datas->fetchAll(PDO::FETCH_ASSOC);

// On affiche nos contacts
echo json_encode($result);

?>