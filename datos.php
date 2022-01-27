<?php

// conexión a la base de datos

$conexion = mysqli_connect("localhost", "root", "1234", "chatbot") or die("Database Error");

$conexion->set_charset("utf8");

// Obtener el mensaje(pregunta) a través de ajax del imput('text)
$pregunta = mysqli_real_escape_string($conexion, $_POST['text']);

//Query a la base de datos
$query = "SELECT respuesta FROM datos WHERE pregunta LIKE '%$pregunta%' ORDER BY id DESC LIMIT 0,1"; 
$ejecutar_query = mysqli_query($conexion, $query) or die("Error");
//Condicion si la pregunta coincide con la base de datos sino se muestra otro mensaje 
if(mysqli_num_rows($ejecutar_query) > 0){
    //Guardar la respuesta al ejecutar el query
    $respuesta = mysqli_fetch_assoc($ejecutar_query);
    //Almacenar la respuesta en una variable para enviar al ajax
    $datoAjax = $respuesta['respuesta'];
    echo $datoAjax;
}else{
    echo "¡Lo siento, no puedo entenderte!";
}

?>




