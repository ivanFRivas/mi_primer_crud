<!DOCTYPE html>
<html lang="es">
<head>
  <title>Título del documento</title>
  <meta charset="utf8">
</head>
<body>

<header></header>
<?php
// Configuración de la conexión a PostgreSQL
$host = "localhost";
$port = "5432";
$dbname = "mi_primer_crud";
$user = "ivan";
$password = "1234";

try {
    // Establecer conexión
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    
    if (!$conn) {
        die("Error al conectar a PostgreSQL");
    }

    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'] ?? null; // Usamos null si no se proporciona
    $telefono = $_POST['telefono'] ?? null;
    $email = $_POST['email'];

    // Preparar consulta SQL
    $query = "INSERT INTO alumnos (nombre, apellido_p, apellido_m, telefono, email, fecha_registro) 
              VALUES ($1, $2, $3, $4, $5, NOW())";
    
    // Ejecutar consulta con parámetros (más seguro)
    $result = pg_query_params($conn, $query, array($nombre, $apellido_p, $apellido_m, $telefono, $email));

    if ($result) {
        echo "<p>Alumno registrado exitosamente!</p>";
        echo '<a href="formulario.html">Regresar al formulario</a>';
    } else {
        echo "<p>Error al registrar: " . pg_last_error($conn) . "</p>";
    }

    // Cerrar conexión
    pg_close($conn);

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>


<footer></footer>
  
</body>
</html>