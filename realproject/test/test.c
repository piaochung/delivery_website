//=================================================
// 코드비젼 128, 16MHz
//=================================================
#include  <mega128a.h>
#include  <delay.h>
#include  <stdio.h>
#include  <lcd.h>
//=================================================
#asm
    .equ __lcd_port=0x1B; PORTA
#endasm
#include   <math.h>
//=================================================
//=================================================
#define U_C     unsigned char
#define U_I     unsigned int
//=================================================
//=================================================
// SHT11 H/W, 1:GND, 2:DATA, 3:SHT_SCK, 4:VCC
#define    DATA_OUT       DDRB.0
#define    DATA_IN        PINB.0
#define    SHT_SCK        PORTB.1
//=================================================
#define noACK 0
#define ACK   1
                            //adr  command  r/w
#define STATUS_REG_W 0x06   //000   0011    0
#define STATUS_REG_R 0x07   //000   0011    1
#define MEASURE_TEMP 0x03   //000   0001    1
#define MEASURE_HUMI 0x05   //000   0010    1
#define RESET        0x1e   //000   1111    0
//=================================================
const float C1=-4.0;
const float C2=+0.0405;
const float C3=-0.0000028;
const float T1=+0.01;
const float T2=+0.00008;

U_C     str[30]; //LcdBuf
U_C     TEMP_cksum, HUMI_cksum;
U_I     TEMP_val, HUMI_val;
float   dew_point;
//=================================================
// SHT11
//=================================================
U_C SHT11_ByteWR(U_C value){
  U_C i, error=0;
  for(i=0x80; i>0; i>>=1){
//    DATA_OUT=(value>>(7-i))&1;
    if(i&value)DATA_OUT=0;
    else DATA_OUT=1;
    delay_us(2); SHT_SCK=1; delay_us(6); SHT_SCK=0; delay_us(3);
  }
  DATA_OUT=0; SHT_SCK=1; delay_us(3); error=DATA_IN; delay_us(2); SHT_SCK=0;
  return error;
}

//----//
U_C SHT11_ByteRD(U_C ack){
  U_C i, val=0;
  DATA_OUT=0;
  for(i=0x80; i>0; i>>=1){ SHT_SCK=1; delay_us(3); if(DATA_IN)val|=i; SHT_SCK=0; delay_us(3); }
  DATA_OUT=ack;
  SHT_SCK=1; delay_us(6); SHT_SCK=0; delay_us(3); DATA_OUT=0;
  return val;
}

//-----//
void SHT11_Start(void){
   DATA_OUT=0;
   SHT_SCK=0;  delay_us(3); SHT_SCK=1; delay_us(3);
   DATA_OUT=1; delay_us(3);
   SHT_SCK=0;  delay_us(6); SHT_SCK=1; delay_us(3);
   DATA_OUT=0; delay_us(3);
   SHT_SCK=0;
}

//-----//
void SHT11_Reset(void){ 
  U_C i;
  DATA_OUT=0; SHT_SCK=0;  delay_us(3);
  for(i=0;i<9;i++){ SHT_SCK=1;  delay_us(3); SHT_SCK=0;  delay_us(3); }
  SHT11_Start();
}

//------//
U_C SHT11_HUMI(void){
  U_C error=0;
  long i;
  error+=SHT11_ByteWR(MEASURE_HUMI);
  for(i=0; i<400000; i++){ delay_us(5); if(!DATA_IN)break; } // 2초
  if(DATA_IN)error++;
  HUMI_val=SHT11_ByteRD(ACK);
  HUMI_val<<=8;
  HUMI_val+=SHT11_ByteRD(ACK);
  HUMI_cksum=SHT11_ByteRD(noACK);
  return error;
}

//------//
U_C SHT11_TEMP(void){
  U_C error=0;
  long i;
  SHT11_Start();
  error+=SHT11_ByteWR(MEASURE_TEMP);
  for(i=0; i<400000; i++){ delay_us(5); if(!DATA_IN)break; } // 2초
  if(DATA_IN)error++;
  TEMP_val=SHT11_ByteRD(ACK);
  TEMP_val<<=8;
  TEMP_val+=SHT11_ByteRD(ACK);
  TEMP_cksum=SHT11_ByteRD(noACK);
  return error;
}

//------//
void calc_sth11(void){
  float rh_lin, rh_true, t_C, TEMP_f, HUMI_f, logEx;

  TEMP_f=(float)TEMP_val;
  HUMI_f=(float)HUMI_val;

  t_C=TEMP_f*0.01-40;
  rh_lin=C3*HUMI_f*HUMI_f + C2*HUMI_f + C1;
  rh_true=(t_C-25)*(T1+T2*HUMI_f)+rh_lin;
  if(rh_true>100)rh_true=100;
  if(rh_true<0.1)rh_true=0.1;

  TEMP_val=TEMP_f;
  HUMI_val=HUMI_f;

  logEx=0.66077+7.5*t_C/(237.3+t_C)+(log10(t_C)-2);
  dew_point=(logEx-0.66077)*237.3/(0.66077+7.5-logEx);
}
//=================================================
//             main
//=================================================
void main(void){
  U_C error;

  #asm ("cli")
  DDRB=0x02; //sht11
//
  delay_ms(150);
  lcd_init(16);

  lcd_clear();
  sprintf(str, "SHT11 Test Prog."); lcd_gotoxy(0, 1); lcd_puts(str);
  sprintf(str, "by O.H.Park"); lcd_gotoxy(0, 1); lcd_puts(str);
  delay_ms(2000); // 2초 동안 표시

//SHT11_Reset();
  while(1){
    SHT11_Reset();
    error=0;
    error+=SHT11_HUMI();
    error+=SHT11_TEMP();
    if(error!=0)SHT11_Reset();
    else{ calc_sth11(); }
//
    lcd_clear();
    sprintf(str, "SHT11 Test Prog."); lcd_gotoxy(0, 1); lcd_puts(str);
    sprintf(str,"T=%2d[C] H=%2d[%%]",TEMP_val, HUMI_val);
    lcd_gotoxy(0, 0); lcd_puts(str);
    delay_ms(2000);
  }
}