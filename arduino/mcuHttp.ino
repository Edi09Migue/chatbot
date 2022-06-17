
//LIBRERIAS
#include <ESP8266WiFi.h>
#include <DHT.h>

#define DHTTYPE DHT11 // DHT 11

//PINES
#define dht_dpin 0 //D3
DHT dht(dht_dpin, DHTTYPE); 


//DECLARACION VARIABLES GLOBALES DE LECTURA
float Humedad, Temperatura; //humedad y temperatura ambiente DHT11

//VARIABLES DE CONEXION
const char* ssid     = "red";
const char* password = "password";
const char* servidor = "192.168.0.11";
        
void setup() {
  Serial.begin(115200);
  dht.begin();
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Conectado a red WiFi con ip local: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  TemperaturayHumedad();
  String url_1 = "/chatbot/envio-datos-temperatura.php";
  String url_2 = "/chatbot/envio-datos-humedad.php";
    
  //CONVERSION A TIPO DE DATOS APTOS PARA ENVIAR
  String temp = String(Temperatura,2);
  String preguntaTemp = "cual es la temperatura del cuarto";
  
  String hum = String(Humedad,2);
  String preguntaHum = "cual es la humedad del cuarto";
  
  //CONCATENACION DE DATOS A ENVIAR
  String datosTemperatura = "preguntaTemp=" + preguntaTemp + "&respuestaTemp=" + temp;
  String datosHumedad = "preguntaHum=" + preguntaHum + "&respuestaHum=" + hum;
    
  //CONEXION A SERVIDOR LOCAL
  Serial.print("CONECTANDOSE CON:");
  Serial.println(servidor);

  const int httpPort = 80;  //puerto por el que se comunica http
  WiFiClient client;
  if (!client.connect(servidor, httpPort)){  //INSTANCIACION WIFICLIENT
  Serial.println("CONEXIÓN FALLIDA");
  return;
  }
  Serial.print("ENVIANDO SOLICITUD A URL: ");
  Serial.print(url_1);
  Serial.print(",");
  Serial.println(url_2);

//METODO POST PARA EL ENVIO DE SOLICITUD HTTP
  client.print(String("POST ") + url_1 + " HTTP/1.1" + "\r\n" + 
  "Host: " + servidor + "\r\n" +
  "Connection: keep-alive" + "\r\n" +
  "Content-Length: " + datosTemperatura.length() + "\r\n" + 
  "Cache-Control: max-age=0" + "\r\n" + 
  "Origin: http://192.168.1.5" + "\r\n" + 
  "Upgrade-Insecure-Requests: 1" + "\r\n" +
  "Content-Type: application/x-www-form-urlencoded" + "\r\n" + "\r\n" + datosTemperatura);

  client.print(String("POST ") + url_2 + " HTTP/1.1" + "\r\n" + 
  "Host: " + servidor + "\r\n" +
  "Connection: keep-alive" + "\r\n" +
  "Content-Length: " + datosHumedad.length() + "\r\n" + 
  "Cache-Control: max-age=0" + "\r\n" + 
  "Origin: http://192.168.1.5" + "\r\n" + 
  "Upgrade-Insecure-Requests: 1" + "\r\n" +
  "Content-Type: application/x-www-form-urlencoded" + "\r\n" + "\r\n" + datosHumedad);
  
 
  unsigned  long  timeout = millis(); //tiempo de espera de respuesta 
  while (client.available() == 0){
  if (millis() - timeout > 5000) { 
  Serial.println(">>> Client Timeout !"); 
  client.stop();
  return;
    }
  }
  
  //RESPUESTA DEL SERVIDOR
  Serial.println("RESPONDIENDO..");
  while(client.available()){  
  String line= client.readStringUntil('\r');
  Serial.print(line);
  }

  //CIERRE DE CONEXION
  Serial.println();
  Serial.println("CERRANDO CONEXION");
  Serial.println();
  delay(4000); //envio de datos cada 12 seg
}

//FUNCIONES SENSORES
void TemperaturayHumedad () {
    Humedad = dht.readHumidity();              //lectura de humedad DHT11
    Temperatura = dht.readTemperature();       //lectura de temperatura DHT11
    Serial.print("Humedad: ");                //publicacion
    Serial.print(Humedad, 2);                    
    Serial.println(" %HR; ");
    Serial.print("Temperatura Ambiente: ");
    Serial.print(Temperatura, 2);
    Serial.println(" °C");
}


