<?php

class Author {
    // DB Stuff

    private $conn;
    private $table = 'authors';

    //Properties
    public $id;
    public $author;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get posts
    public function read() {
        //Create query
        $query = 'SELECT 
                    id,
                    author
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

    //Get single post
    public function read_single() {
        //Create query
        $query = 'SELECT 
                    id,
                    author
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

        // Set props
        $this->author = $row['author'];
    }

    // //create post
    // public function create() {
    //     //Create query
    //     $query = 'INSERT INTO ' . $this->table . ' 
    //      SET
    //          title = :title,
    //          body = :body,
    //          author = :author,
    //          category_id = :category_id';

    //     //Prepare statement
    //     $stmt = $this->conn->prepare($query);

    //     //Clean data
    //     $this->title = htmlspecialchars(strip_tags($this->title));
    //     $this->body = htmlspecialchars(strip_tags($this->body));
    //     $this->author = htmlspecialchars(strip_tags($this->author));
    //     $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    //     //Bind data
    //     $stmt->bindParam(':title', $this->title);
    //     $stmt->bindParam(':body', $this->body);
    //     $stmt->bindParam(':author', $this->author);
    //     $stmt->bindParam(':category_id', $this->category_id);

    //     //Execute query
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     // Print error if something goes wrong
    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // //update post
    // public function update() {
    //     //Create query
    //     $query = 'UPDATE ' . $this->table . ' 
    //      SET
    //          title = :title,
    //          body = :body,
    //          author = :author,
    //          category_id = :category_id 
    //      WHERE 
    //          id = :id';

    //     //Prepare statement
    //     $stmt = $this->conn->prepare($query);

    //     //Clean data
    //     $this->title = htmlspecialchars(strip_tags($this->title));
    //     $this->body = htmlspecialchars(strip_tags($this->body));
    //     $this->author = htmlspecialchars(strip_tags($this->author));
    //     $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    //     $this->id = htmlspecialchars(strip_tags($this->id));

    //     //Bind data
    //     $stmt->bindParam(':title', $this->title);
    //     $stmt->bindParam(':body', $this->body);
    //     $stmt->bindParam(':author', $this->author);
    //     $stmt->bindParam(':category_id', $this->category_id);
    //     $stmt->bindParam(':id', $this->id);

    //     //Execute query
    //     if ($stmt->execute()) {
    //         return true;
    //     }

    //     // Print error if something goes wrong
    //     printf("Error: %s.\n", $stmt->error);

    //     return false;
    // }

    // //Delete post
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