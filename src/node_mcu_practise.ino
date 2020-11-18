//****************************************
// Written by Ogidan Hope
// This code enables you to send your ultrasonic sensor and dht sensor readings to a web server
//**************************************


#include <SPI.h>
#include <ESP8266WiFi.h>     //Include Esp library
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <Adafruit_Sensor.h>



const char *ssid = "Hope";  //ENTER YOUR WIFI SETTINGS
const char *password = "hopeabcdef";

String server = "http://192.168.43.218/Esp_send_web/Php/insert.php";

//declaration of dht sensor variables
#include "DHT.h"
#define DHTPIN D3   // Digital pin connected to the DHT sensor
#define DHTTYPE DHT11   // DHT 11

DHT dht(DHTPIN, DHTTYPE);


String link;
String tempValue;

const int trigPin = D4;
const int echoPin = D5;
float distance;
float duration;

float humid_value;



void Temperaturereading(){
  delay(2000);
  // Read temperature as Celsius (the default)
  tempValue = dht.readTemperature();
  humid_value = dht.readHumidity();
  Serial.print(F("%  Temperature: "));
  Serial.println(tempValue);
  Serial.print(F("%  Humidity: "));
  Serial.println(humid_value );
  }

void Datalogger(){
   HTTPClient http;
   String getData =  "?temperature=" + tempValue +  "&humidity=" + humid_value;
   
   link = server + getData;  // THE IP ADDRESS IS that of the web server, and also use the webs URL
      Serial.println(link);
      http.begin(link);
   int httpCode = http.GET();
   delay(10); 
   String payload = http.getString();
   Serial.println(httpCode); 
    Serial.println(payload);  
  }



  



















void setup() {
  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  SPI.begin();      // Initiate  SPI bus
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");

  Serial.print("Connecting to ");
  Serial.print(ssid);
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");



 
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.println("Connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }

//temp sensor
Serial.println(F("DHTxx test!"));

dht.begin();
}

void loop() { // run over and over
  
  Temperaturereading();
  Datalogger();
  delay(5000);
  
}


