<?php

class Category {
    // DB Stuff

    private $conn;
    private $table = 'categories';

    //Properties
    public $id;
    public $category;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get categories
    public function read() {
        //Create query
        $query = 'SELECT 
                    id,
                    category
                FROM
                    '. $this-> table .' p
                ORDER BY
                    id DESC';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    //Get single category
    public function read_single() {
        //Create query
        $query = 'SELECT 
                    id,
                    category
                FROM
                    '. $this-> table .' 
                WHERE id = ? LIMIT 1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Exit if nothing returned
        if(!isset($row['category'])) return;

        // Set props
        $this->category = $row['category'];
    }

    //create category
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' (category) 
         VALUES
             (:category)';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));

        //Bind data
        $stmt->bindParam(':category', $this->category);
        //Execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId(); //Get ID back from table
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //update category (PUT route)
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . ' 
         SET
             category = :category
         WHERE 
             id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete category
    public function delete() {
        $query = 'DELETE FROM '. $this->table . ' WHERE id=:id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean id
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind id
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}