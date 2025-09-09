<?php
// Configuración de conexión a Supabase PostgreSQL
$host = "aws-0-us-west-1.pooler.supabase.com";
$db   = "postgres";
$user = "postgres.hicguuzqyivzlfpqxegy";
$pass = "(x+1)(x-1)!"; //tengo que actualizar 
$port = "6543";


try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
    exit;
}
?>
