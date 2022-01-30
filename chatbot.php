<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
</head>
<body>
        <div class="container">
            <span class="hd1">Chat Bot</span>
            <br><br><br>
            <div class="chatCont wrapper">
    
                <div class="bot_profile">
                
                    <img src="assets/img/bot1.svg" class="bot_p_img">
                </div>

                <div class="form">
                    <div class="bot-inbox inbox">
                        <div class="msg-header">
                            <p>Hola, un gusto en saludarte.</p>
                        </div>
                    </div>
                </div>

                <div class="typing-field">
                    <div class="input-data">
                        <input id="imputData" type="text" placeholder="Escribe algo aquí.." required>
                        <button id="btn-enviar">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
   

    <script>
  
        //Función para responder al banco de preguntas 
        $(document).ready(function(){
            $("#btn-enviar").on("click", function(){
                $pregunta = $("#imputData").val();
                //Agregar la pregunta al chat
                $preguntaform = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $pregunta +'</p></div></div>';
                $(".form").append($preguntaform);
                //Limpiar el imput al enviar
                $("#imputData").val('');

                if($pregunta == 'Temperatura' ||  
                   $pregunta == 'Cuál es la temperatura de hoy' ||
                   $pregunta == 'A que temperatura estamos'  ||
                   $pregunta == 'Dime el valor de temperatura'
                ){  
                    $pregunta = 'Temperatura';
                    $.ajax({
                    url: 'datos.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                        success: function(resultAjax){

                            //Agregar la respuesta al chat
                            $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ resultAjax +'</p></div></div>';
                            $(".form").append($resultform);
                        // controlar la barra de desplazamiento
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });
                }
                else if ($pregunta == 'Humedad' ||  
                   $pregunta == 'Cuál es el valor de la humedad de hoy' ||
                   $pregunta == 'A que valor de humedad estamos'  ||
                   $pregunta == 'Dime el valor de humedad'
                ){  
                    $pregunta = 'Humedad';
                    $.ajax({
                    url: 'datos.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                        success: function(resultAjax){

                            //Agregar la respuesta al chat
                            $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ resultAjax +'</p></div></div>';
                            $(".form").append($resultform);
                        // controlar la barra de desplazamiento
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });
                }else{
                    $.ajax({
                    url: 'datos.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                        success: function(resultAjax){

                            //Agregar la respuesta al chat
                            $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ resultAjax +'</p></div></div>';
                            $(".form").append($resultform);
                        // controlar la barra de desplazamiento
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });

                }

            }); 
        });
        //Alerta para el caso de la temperatura fuera del rango 
        setInterval(function(){
                $pregunta = 'Temperatura';
                //Inicia el código aja
                $.ajax({
                    url: 'datos.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                    success: function(resultAjax){
                       console.log("resultAjax",resultAjax);
                       if(resultAjax >= "20 °C"){
                           $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ 'Estamos a '+resultAjax+' ¡Protégete del sol!' +'</p></div></div>';
                            $(".form").append($resultform);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                       }else if(resultAjax <= "14 °C"){
                            $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ 'Estamos a '+resultAjax+' ¡Abrígate!' +'</p></div></div>';
                            $(".form").append($resultform);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                       }else{

                       }
                       
                    }
                });

                
        },2000);

        //Alerta para el caso de la humedad fuera del rango 
        setInterval(function(){
                $pregunta = 'Humedad';
                //Inicia el código ajax
                $.ajax({
                    url: 'datos.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                    success: function(resultAjax){
                       console.log("resultAjax",resultAjax);
                       if(resultAjax >= "50 %" && resultAjax <= "60 %"){
                           $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ 'El porcentaje de humedad es '+resultAjax+'!Estás en un ambiente agradable!'+'</p></div></div>';
                            $(".form").append($resultform);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                       }else if(resultAjax <= "20  %"){
                            $resultform = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ 'El porcentaje de humedad es '+resultAjax+'!Estás en un ambiente poco aceptable!' +'</p></div></div>';
                            $(".form").append($resultform);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                       }else{

                       }
                       
                    }
                });
        },4000);

    </script>
    
</body>
</html>