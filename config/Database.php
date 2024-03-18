<?php
    class Database {
        //DB Params
        private $host;
        private $port;
        private $db_name;
        private $username;
        private $password;
        private $conn;

    public function __construct() {
        $this->host = getenv("DBHOST");
        $this->port = getenv("DBPORT");
        $this->db_name = getenv("DBNAME");
        $this->username = getenv("DBUSERNAME");
        $this->password = getenv("DBPASSWORD");
    }
    

    //DB connect
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('pgsql:host=' . $this->host . ';port='. $this->port . ';dbname=' . $this->db_name, 
            $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    }
