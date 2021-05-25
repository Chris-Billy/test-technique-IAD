<?php

class Database
{
    // Connexion à la base de données
    private $host = "127.0.0.1";
    private $db_name = "test_iad";
    private $username = "root";
    private $password = "";
    public $connection;

    // getter pour obtenir la connexion
    public function getConnection() {

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo "Erreur de connexion à la Database : " . $exception->getMessage();
        }

        return $this->connection;
    }
}

?>