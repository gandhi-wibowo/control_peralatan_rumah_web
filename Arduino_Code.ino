#include <SoftwareSerial.h>
#include <espduino.h>
#include <rest.h>

SoftwareSerial espPort(10, 11);
ESP esp(&espPort, &Serial, 9);
REST rest(&esp);
boolean wifiConnected = false;
const int R1 =2, R2 = 3, R3 = 4, R4 = 5, R5 = 6, R6 = 7, R7 = 8, R8=9;
const int pin = A0;
int loop_count = 0;
char response[266];
char buff[64];
String data;

void wifiCb(void* response){
  uint32_t status;
  RESPONSE res(response);
  if(res.getArgc() == 1) {
    res.popArgs((uint8_t*)&status, 4);
    if(status == STATION_GOT_IP) {
      Serial.println("TERHUBUNG KE WIFI");
      wifiConnected = true;
    } else {
      wifiConnected = false;
    }
  }
}

void setup() {  
  pinMode(R1, OUTPUT);
  pinMode(R2, OUTPUT);
  pinMode(R3, OUTPUT);
  pinMode(R4, OUTPUT);
  pinMode(R5, OUTPUT);
  pinMode(R6, OUTPUT);   
  digitalWrite(R1, HIGH);
  digitalWrite(R2, HIGH);
  digitalWrite(R3, HIGH);
  digitalWrite(R4, HIGH);
  digitalWrite(R5, HIGH);
  digitalWrite(R6, HIGH);

  analogReference(INTERNAL);
  Serial.begin(9600);
  espPort.begin(19200); 
  esp.enable();
  delay(500);
  esp.reset();
  delay(500);
  while(!esp.ready());
  if(!rest.begin("hendra-adi.com")) {
    Serial.println("ARDUINO: Gagal Setup client");
    while(1);
  }
  esp.wifiCb.attach(&wifiCb);
  esp.wifiConnect("HENDRA-ADI","hendra-adi.S.Kom");
}

void loop() {
  loop_start:    
  esp.process();  
  if(wifiConnected) {
    float celcius = (analogRead(pin) / 9.31) ;
    celcius = (celcius - 3.70);   
    sendData(celcius);
    getData(1);
    getData(2);    
    getData(3);
    getData(4);
    getData(5);
    getData(6);      
  }
  
}

void sendData(int dataS){  
  sprintf(buff, "/index.php/Welcome/SendData/%d", dataS);
  rest.get((const char*)buff);
  if(rest.getResponse(response, 266) == HTTP_STATUS_OK){}
  else{}
  delay(500);
}

void getData(int  idS){
    sprintf(buff, "/index.php/Welcome/GetData/%d",idS);
    rest.get((const char*)buff);
    if(rest.getResponse(response, 266) == HTTP_STATUS_OK){
      data = response[0];
      if(idS == 1){
        if(data == "1"){
          digitalWrite(R1,LOW);
        }
        else{        
          digitalWrite(R1,HIGH);
        }        
      }
      
      if(idS == 2){
        if(data == "1"){
          digitalWrite(R2,LOW);
        }
        else{        
          digitalWrite(R2,HIGH);
        }        
      }
      if(idS == 3){
        if(data == "1"){
          digitalWrite(R3,LOW);
        }
        else{       
          digitalWrite(R3,HIGH);
        }        
      } 
      if(idS == 4){
        if(data == "1"){
          digitalWrite(R4,LOW);
        }
        else{       
          digitalWrite(R4,HIGH);
        }        
      } 
      if(idS == 5){
        if(data == "1"){
          digitalWrite(R5,LOW);
        }
        else{         
          digitalWrite(R5,HIGH);
        }        
      } 
      if(idS == 6){
        if(data == "1"){
          digitalWrite(R6,LOW);
        }
        else{         
          digitalWrite(R6,HIGH);
        }        
      }                                      
    } 
    delay(300);  
}
