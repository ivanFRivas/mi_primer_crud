<?php
header("Content-Type: application/json");
require __DIR__."/../db/db.php";

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET": // Leer todos
        $stmt = $pdo->query("SELECT * FROM alumnos ORDER BY id");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case "POST": // Crear
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO alumnos (nombre, carrera, semestre) VALUES (?, ?, ?)");
        $stmt->execute([$data["nombre"], $data["carrera"], $data["semestre"]]);
        echo json_encode(["success" => true]);
        break;

    case "DELETE": // Eliminar
        parse_str(file_get_contents("php://input"), $data);
        $id = $data["id"] ?? null;
        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM alumnos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "ID requerido"]);
        }
        break;
}
?>
