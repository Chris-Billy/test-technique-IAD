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
}

?>