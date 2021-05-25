<?php

// Header requis pour l'affichage du résultat sous le format json
header("Content-Type: application/json; charset=UTF-8");

// On inclut nos class pour pouvoir y accéder
require_once('./../../config/init.php');

// On instancie la base de données et on s'y connecte
$database = new Database();
$db = $database->getConnection();

// On instancie notre gestionnaire de contact
$contactManager = new ContactManager($db);

// On instancie un contact
$contact = new Contact();

// On récupère les données envoyées
$datas = json_decode(file_get_contents("php://input"));

// On vérifie les données reçues
if (!empty($datas->last_name) && !empty($datas->first_name) && !empty($datas->email) && 
    !empty($datas->address) && !empty($datas->phone) && !empty($datas->age)) {
        // On affecte les attributs de notre contact
        $contact->hydrate($datas);
        
        // On créé le contact
        if ($contactManager->create($contact)) {
            $result['message'] = "Le contact a bien été créé";
            echo json_encode($result);
        } else {
            $result['message'] = "Le contact n'a pas pu être créé";
            echo json_encode($result);
        }
} else {
    $result['message'] = "Les informations données ne sont incorrects";
    echo json_encode($result);
}

?>