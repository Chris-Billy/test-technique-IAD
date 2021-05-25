<?php

class ContactManager
{
    // Connexion avec la base de données
    private $connection;

    /**
     * Constructeur pour la connexion à la base de données
     * @param $db
     */
    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * Méthode pour récupérer tous les contacts
     */
    public function findAll()
    {
        // On se connecte à la base de donnée et on prépare la requête
        $query = $this->connection->prepare('SELECT * FROM contacts');
        // On éxécute la requête
        $query->execute();

        return $query;
    }

    /**
     * Méhode pour récupérer un seul contact pour son id
     */
    public function findById($contact)
    {
        // On se connecte à la base de donnée et on prépare la requête
        $query = $this->connection->prepare('SELECT * FROM contacts WHERE id = :id');
        // On affecte la valeur à l'id
        $query->bindValue(':id', $contact->id);
        // On éxécute la requête
        $query->execute();

        return $query;
    }

    public function create($contact)
    {
        // On se connecte à la base de donnée et on prépare la requête
        $query = $this->connection->prepare('INSERT INTO contacts (last_name, first_name, email, address, phone, age) VALUES (?, ?, ?, ?, ?, ?)');
        // On exécute la requête avec les valeurs à affecter
        $query->execute([
            $contact->last_name,
            $contact->first_name,
            $contact->email,
            $contact->address,
            $contact->phone,
            $contact->age,
        ]);
    }
}

?>