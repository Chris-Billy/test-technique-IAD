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

    /**
     * Méthode pour créer un contact
     */
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

    public function update($contact)
    {
        // On se connecte à la base de donnée et on prépare la requête
        $query = $this->connection->prepare('UPDATE contacts SET last_name = :last_name, first_name = :first_name, email = :email, address = :address, phone = :phone, age = :age WHERE id = :id');
        // On affecte les valeurs du contact pour chaque colonne
        $query->bindValue(':id', $contact->id);
        $query->bindValue(':last_name', $contact->last_name);
        $query->bindValue(':first_name', $contact->first_name);
        $query->bindValue(':email', $contact->email);
        $query->bindValue(':address', $contact->address);
        $query->bindValue(':phone', $contact->phone);
        $query->bindValue(':age', $contact->age);
        // On exécute la requête
        $query->execute();
    }
}

?>