<?php
class Movie {
    private $conn;
    private $table_name = "movies";

    public $id;
    public $title;
    public $description;
    public $duration;
    public $release_date;
    public $director;
    public $genre;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                      title = :title,
                      description = :description,
                      duration = :duration,
                      release_date = :release_date,
                      director = :director,
                      genre = :genre";

        $stmt = $this->conn->prepare($query);   

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->director = htmlspecialchars(strip_tags($this->director));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":duration", $this->duration);
        $stmt->bindParam(":release_date", $this->release_date);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":director", $this->director);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}