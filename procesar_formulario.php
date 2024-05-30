<!-- procesar_formulario.php -->
<?php
$servername = "servidorproyecto.mysql.database.azure.com";
$username = "adminProyecto";
$password = "Edgar270901##$";
$dbname = "dbproyecto2";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa<br>";
}

// Verificar que el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Aquí puedes añadir el código para procesar y almacenar los datos del formulario
    echo "Nombre: $nombre<br>";
    echo "Email: $email<br>";
}
    if (isset($_POST['nombre']) && isset($_POST['email'])) {
        // Escapar y sanitizar datos del formulario
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $email = $conn->real_escape_string($_POST['email']);

        echo "Datos recibidos: Nombre = $nombre, Email = $email<br>";

        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Nuevo registro creado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Datos del formulario no recibidos.";
    }
} else {
    echo "Método de solicitud no es POST.";
}

$conn->close();
?>
<br><br>
<a href="index.html" class="button">Regresar</a>
