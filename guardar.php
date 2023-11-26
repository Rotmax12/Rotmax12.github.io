<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $mensaje = $_POST["mensaje"];

    // Conexión a la base de datos (ajusta según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "contacto";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO contacto (nombre, correo, telefono, mensaje) VALUES ('$nombre', '$correo', '$telefono', '$mensaje')";

        if ($conn->query($sql) === TRUE) {
        // Enviar correo electrónico
        $to = "robert.arevalod@gmail.com";
        $subject = "Nuevo mensaje de contacto";
        $message = "Nombre: $nombre\nCorreo: $correo\nTeléfono: $telefono\nMensaje: $mensaje";

        // Puedes personalizar las cabeceras según tus necesidades
        $headers = "From: webmaster@example.com";

        // Envía el correo
        mail($to, $subject, $message, $headers);

        header("Location: datos.html");
        exit; // Asegura que el script se detenga después de enviar el encabezado de redirección
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Acceso no autorizado";
}
?>
