<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">Chatbot</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hola, ¿Cómo puedo ayudarte?</p>
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
                
                //Inicia el código ajax
                $.ajax({
                    url: 'data.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                    success: function(resultAjax){
                        //Agregar la respuesta al chat
                        $resultform = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ resultAjax +'</p></div></div>';
                        $(".form").append($resultform);
                       // controlar la barra de desplazamiento
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            }); 
        });
        //Alerta para el caso de la temperatura fuera del rango 
        setInterval(function(){
                $pregunta = '¿Cuál es la temperatura del cuarto?';
                //Inicia el código ajax
                $.ajax({
                    url: 'data.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                    success: function(resultAjax){
                       console.log("resultAjax",resultAjax);
                       if(resultAjax >= 25){
                           $resultform = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ 'Alerta temperatura fuera del rango' +'</p></div></div>';
                            $(".form").append($resultform);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                       }
                       
                    }
                });
        },4000);

        //Alerta para el caso de la humedad fuera del rango 
        setInterval(function(){
                $pregunta = '¿Cuál es la humedad del cuarto?';
                //Inicia el código ajax
                $.ajax({
                    url: 'data.php',
                    type: 'POST',
                    data: 'text='+$pregunta,
                    success: function(resultAjax){
                       console.log("resultAjax",resultAjax);
                       if(resultAjax >= 10){
                           $resultform = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ 'Alerta humedad fuera del rango' +'</p></div></div>';
                            $(".form").append($resultform);
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                       }
                       
                    }
                });
        },4000);

    </script>
    
</body>
</html>