<?php
include 'coneccion.php';

$nombres = $_POST['nombres'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$email = $_POST['email'];
$fono = $_POST['fono'];
$nacionalidad = $_POST['nacionalidad'];
$edad = $_POST['edad'];
$domicilio = $_POST['domicilio'];
$refugiado = $_POST['refugiado'];
$razon = $_POST['razon'];
$esterilizacion = $_POST['esterilizacion'];

// Crear consulta preparada
$query = "INSERT INTO formulario (nombres, apellido_paterno, apellido_materno, email,fono,nacionalidad,edad,domicilio,refugiado,razon,esterilizacion) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$insertar_formulario = mysqli_prepare($coneccion, $query);

// Verificar la preparación de la consulta
if (!$insertar_formulario) {
    die("Error en la preparación de la consulta: " . mysqli_error($coneccion));
}

// Vincular parámetros
mysqli_stmt_bind_param($insertar_formulario, "sssssssssss", $nombres, $apellido_paterno, $apellido_materno, $email, $fono, $nacionalidad, $edad, $domicilio, $refugiado, $razon, $esterilizacion);

// Ejecutar la consulta
$ejecutar = mysqli_stmt_execute($insertar_formulario);

// Verificar la ejecución de la consulta
if (!$ejecutar) {
    die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertar_formulario));
} else {
    echo '<script>
            alert("Hemos recibido tu solicitud. Estamos redirigiéndote al inicio.");
            console.log("Redireccionando al inicio...");
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 5000);
          </script>';
}

// Cerrar la consulta y la conexión
mysqli_stmt_close($insertar_formulario);
mysqli_close($coneccion);
?>
