const tabla = document.getElementById("tablaAlumnos");
const form = document.getElementById("alumnoForm");

async function cargarAlumnos() {
  const res = await fetch("../backend/alumnos.php");
  const data = await res.json();
  tabla.innerHTML = "<tr><th>ID</th><th>Nombre</th><th>Carrera</th><th>Semestre</th><th>Acción</th></tr>";
  data.forEach(a => {
    tabla.innerHTML += `
      <tr>
        <td>${a.id}</td>
        <td>${a.nombre}</td>
        <td>${a.carrera}</td>
        <td>${a.semestre}</td>
        <td><button onclick="eliminar(${a.id})">Eliminar</button></td>
      </tr>`;
  });
}

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const nombre = document.getElementById("nombre").value;
  const carrera = document.getElementById("carrera").value;
  const semestre = document.getElementById("semestre").value;

  await fetch("../backend/alumnos.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ nombre, carrera, semestre })
  });

  form.reset();
  cargarAlumnos();
});

async function eliminar(id) {
  await fetch("../backend/alumnos.php", {
    method: "DELETE",
    body: `id=${id}`
  });
  cargarAlumnos();
}

function logout() {
  localStorage.removeItem("token");
  window.location.href = "index.html";
}

cargarAlumnos();
