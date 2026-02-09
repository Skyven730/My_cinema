<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

spl_autoload_register(function ($class) {
    if (file_exists(__DIR__ . '/config/' . $class . 'php')) {
        require_once __DIR__ . '/config/' . $class . '.php';
    }

    else if (file_exists(__DIR__ . '/models/' . $class . '.php')) {
        require_once __DIR__ . '/models/' . $class . '.php';
    } 

    else if (file_exists(__DIR__ . '/controllers/' . $class . '.php')) {
        require_once __DIR__ . '/controllers/' . $class . '.php';
    }
});

$route = isset($_GET['route']) ? $_GET['route'] : '';

switch ($route) {
    case 'movies':
        echo json_encode(["message" => "Ici, on affichera la liste des films."]);
        break;
    case 'rooms':
        echo json_encode(["message" => "Ici, on gérera les salles."]);
        break;
    case 'screenings':
        echo json_encode(["message" => "Ici, on gérera les séances."]);
        break;
    default:
        echo json_encode(["message" => "Bienvenue sur l'API My Cinema ! Tout fonctionne."]) . "\n" . "\n";
        break;
}

echo json_encode(["message" => "test"]) . "\n" . "\n";

echo json_encode(["message" => "I like a candy"]) . "\n" . "\n";
?>