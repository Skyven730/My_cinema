<?php

class MovieController {

    private  $db;
    private $movie;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->movie = new Movie($this->db);
    }

    public function index() {
        $stmt = $this->movie->read();
        $num = $stmt->rowCount();

        if($num > 0) {
            $movies_arr = [];
            $movies_arr["data"] = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $movie_item = [
                    "id" => $id,
                    "title" => $title,
                    "description" => $description,
                    "duration" => $duration,
                    "relaase_year" => $release_year,
                    "genre" => $genre,
                    "director" => $director
                ];

                array_push($movies_arr["data"], $movie_item);
            }

            http_response_code(200);
            echo json_encode($movies_arr);
        } 
        
        else {
            http_response_code(400);
            echo json_encode(["message" => "A bah dommage pas de film !"]);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if(
            !empty($data->title) &&
            !empty($data->duration) &&
            !empty($data->release_year)
        ) {
            $this->movie->title = $data->title;
            $this->movie->description = $data->description ?? "Description";
            $this->movie->duration = $data->duration;
            $this->movie->release_date = $data->release_year;
            $this->movie->genre = $data->genre ?? "";
            $this->movie->director = $data->director ?? "";

                if($this->movie->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Super, on a le film !"]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Nop, ca ne fonctionne pas !"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Les données sont incomplètes, pense a mettre le titre et l'année"]);
        }
    }
}

?>