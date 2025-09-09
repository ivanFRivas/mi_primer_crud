<?php
header("Content-Type: application/json");

require __DIR__ . "/../db/db.php";

// Cuando el segundo argumento se establece en true,
// json_decode decodifica la cadena JSON como un < ARRAY ASOCISATIVO > de PHP.
//  Para acceder a los datos, se utiliza la sintaxis de corchetes [].
$json_data = file_get_contents('php://input');// Lee el cuerpo de la petición en su formato original

$data = json_decode($json_data, true);// Decodifica la cadena JSON para convertirla en un objeto o array asociativo de PHP
$username = $data["username"] ?? "";
$password = $data["password"] ?? "";

// --------------------Alternativa--------------------------------------------
// Cuando se omite el segundo argumento (o se establece en false),
// json_decode convierte la cadena JSON en un < OBJETO DE PHP > (stdClass).
// Para acceder a los datos, se utiliza la sintaxis de flecha ->.
// Lee el cuerpo de la petición en su formato original
//............$json_data = file_get_contents('php://input');

// Decodifica la cadena JSON para convertirla en un objeto o array asociativo de PHP
//............$data = json_decode($json_data);

// Ahora puedes acceder a los datos
//............$username = $data->username;
//............$password = $data->password;

// Lógica de autenticación...

// ----------------------------------------------------------------

try {
    $stmt = $pdo->prepare("SELECT id, password FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Token muy básico (en producción usar JWT)
        $token = base64_encode(random_bytes(16));
        echo json_encode(["success" => true, "token" => $token, "userId" => $user["id"]]);
    } else {
        echo json_encode(["success" => false, "message" => "Credenciales inválidas"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
