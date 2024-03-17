<?php

class Quote {
    // DB Stuff

    private $conn;
    private $table = 'quotes';

    //Properties
    public $id;
    public $quote;
    public $category_id;
    public $author_id;
    public $category_name;
    public $author_name;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get quotes
    public function read() {
        //Create query
        $query = 'SELECT 
                    q.id,
                    q.quote,
                    q.category_id,
                    q.author_id,
                    a.author AS author_name,
                    c.category AS category_name
                FROM
                    '. $this-> table .' q
                LEFT JOIN
                    categories c on q.category_id = c.id
                LEFT JOIN
                    authors a on q.author_id = a.id
                ORDER BY
                    q.id DESC';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    //Get single quote
    public function read_single() {
        //Create query
        $query = 'SELECT 
                    q.id,
                    q.quote,
                    q.category_id,
                    q.author_id,
                    a.author AS author_name,
                    c.category AS category_name
                FROM
                    '. $this-> table .' q
                LEFT JOIN
                    categories c on q.category_id = c.id
                LEFT JOIN
                    authors a on q.author_id = a.id
                WHERE q.id = ? LIMIT 1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set props
        $this->quote = $row['quote'];
        $this->category_id = $row['category_id'];
        $this->author_id = $row['author_id'];
        $this->category_name = $row['category_name'];
        $this->author_name = $row['author_name'];
    }

    // //create category
    // public function create() {
    //     //Create query
    //     $query = 'INSERT INTO ' . $this->table . ' (category) 
    //      VALUES
    //          (:category)';

    //     //Prepare statement
    //     $stmt = $this->conn->prepare($query);

    //     //Clean data
    //     $this->category = htmlspecialchars(strip_tags($this->category));

    //     //Bind data
    //     $stmt->bindParam(':category', $this->category);
    //     //Execute query
    //     if ($stmt->execute()) {
    //         $this->id = $this->conn->lastInsertId(); //Get ID back from table
    //         return true;
    //     }

    //     // Print error if something goes wrong
    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // //update category (PUT route)
    // public function update() {
    //     //Create query
    //     $query = 'UPDATE ' . $this->table . ' 
    //      SET
    //          category = :category
    //      WHERE 
    //          id = :id';

    //     //Prepare statement
    //     $stmt = $this->conn->prepare($query);

    //     //Clean data
    //     $this->category = htmlspecialchars(strip_tags($this->category));
    //     $this->id = htmlspecialchars(strip_tags($this->id));

    //     //Bind data
    //     $stmt->bindParam(':category', $this->category);
    //     $stmt->bindParam(':id', $this->id);

    //     //Execute query
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     // Print error if something goes wrong
    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // //Delete category
    // public function delete() {
    //     $query = 'DELETE FROM '. $this->table . ' WHERE id=:id';

    //     //Prepare statement
    //     $stmt = $this->conn->prepare($query);

    //     //Clean id
    //     $this->id = htmlspecialchars(strip_tags($this->id));

    //     //Bind id
    //     $stmt->bindParam(':id', $this->id);

    //     //Execute query
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     // Print error if something goes wrong
    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }
}