<?php
$conexion = mysqli_connect("localhost", "root", "1234", "chatbot");
$conexion->set_charset("utf8");
if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL" . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$preguntaHum = $_POST ['preguntaHum'];
$respuestaHum = $_POST ['respuestaHum'];
$respuestaHumUnidad = $respuestaHum." %";

$sql ="INSERT INTO `datos` (`id`, `pregunta`, `respuesta`) VALUES (NULL, '$preguntaHum', '$respuestaHumUnidad')";

$resultado = mysqli_query($conexion,$sql) or die ('error en el query');
mysqli_close($conexion);

echo "Datos ingresados correctamente";
?>