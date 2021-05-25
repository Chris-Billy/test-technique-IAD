<?php

// Header requis pour l'affichage du résultat sous le format json
header("Content-Type: application/json; charset=UTF-8");

// On inclut nos class pour pouvoir y accéder
require_once('./../../config/Database.php');
require_once('./../../managers/ContactManager.php');
require_once('./../../models/Contact.php');

// On instancie la base de données et on s'y connecte
$database = new Database();
$db = $database->getConnection();

// On instancie notre gestionnaire de contact
$contactManager = new ContactManager($db);

// On instancie un contact
$contact = new Contact();

// On récupère les données envoyées
$datas = json_decode(file_get_contents("php://input"));

// On affecte l'id à notre contact
$contact->hydrate($datas);

// On récupère le contact
$datas = $contactManager->findById($contact);

// On créé un tableau qui contiendra tous le contact récupéré
$result = [];
$result['contact'] = $datas->fetch(PDO::FETCH_ASSOC);

// On affiche nos contacts
echo json_encode($result);

?>