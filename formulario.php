<!DOCTYPE html>
<html lang="es">
<head>
  <title>Registro de Alumnos</title>
  <meta charset="utf-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }
    form {
      background: #f4f4f4;
      padding: 20px;
      border-radius: 5px;
    }
    label {
      display: block;
      margin-top: 10px;
    }
    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    button {
      background: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background: #45a049;
    }
  </style>
</head>
<body>

<header>
  <h1>Registro de Alumnos</h1>
</header>

<main>
  <form action="procesar.php" method="post">
    <label for="nombre">Nombre:</label>
    <input name="nombre" id="nombre" type="text" required>

    <label for="apellido_p">Apellido Paterno:</label>
    <input name="apellido_p" id="apellido_p" type="text" required>

    <label for="apellido_m">Apellido Materno:</label>
    <input name="apellido_m" id="apellido_m" type="text">

    <label for="telefono">Teléfono:</label>
    <input name="telefono" id="telefono" type="tel" pattern="[0-9]{10}">

    <label for="email">Correo electrónico:</label>
    <input name="email" id="email" type="email" required>

    <button type="submit">Registrar</button>
  </form>
</main>



<footer>
  <p>Sistema de Registro de Alumnos © 2025</p>
</footer>

</body>
</html>
