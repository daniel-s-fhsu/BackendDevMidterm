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
                    authors a on q.author_id = a.id ';
        
        if ($this->author_id != "" || $this->category_id != "") {
            // Conditional where clause only if author_id or category_id are set
            $query = $query . "WHERE ";
            if ($this->author_id != "") $query = $query . "q.author_id = " . $this->author_id . " ";
            if ($this->author_id != "" && $this->category_id != "") $query = $query . " AND ";
            if ($this->category_id != "") $query = $query . "q.category_id = " . $this->category_id . " ";
        }

        $query = $query . 'ORDER BY
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

        if (!isset($row['quote'])) return;

        // Set props
        $this->quote = $row['quote'];
        $this->category_id = $row['category_id'];
        $this->author_id = $row['author_id'];
        $this->category_name = $row['category_name'];
        $this->author_name = $row['author_name'];
    }

    //create quote
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . ' (quote, category_id, author_id) 
         VALUES
             (:quote, :category_id, :author_id)';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));

        //Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':author_id', $this->author_id);
        //Execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId(); //Get ID back from table
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //update quote (PUT route)
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . ' 
         SET
             quote = :quote,
             category_id = :category_id,
             author_id = :author_id
         WHERE 
             id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    //Delete quote
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