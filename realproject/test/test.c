#include <mega128a.h> 
#include <delay.h>
#include <stdio.h>
//
#define AM2302 PIND.2
//
unsigned int  half_usec,Temp,Humi;
unsigned char data[5],Temp_sign;
//
//
//[lcd]       [AVR PORTA]
//RS (pin4) -----  bit 0
//RD (pin 5) ----- bit 1
//EN (pin 6) ----- bit 2
//사용안함         bit 3
//[lcd]       [AVR PortA]
//DB4 (pin 11) --- bit 4
//DB5 (pin 12) --- bit 5
//DB6 (pin 13) --- bit 6
//DB7 (pin 14) --- bit 7
//
#define lcd_RS  PORTA.0
#define lcd_E   PORTA.2
#define lcd_Out PORTA   // PORTA.4~7 4bits
//
void lcdData(char d){
    lcd_RS=1;
    lcd_Out=(d&0xF0)|1; lcd_E=1; delay_us(1); lcd_E=0; delay_us(1);
    lcd_Out=(d<<4)|1;   lcd_E=1; delay_us(1); lcd_E=0; delay_us(40);
}
//
void lcdCmd(char c){
    lcd_RS=0;
    lcd_Out=c&0xF0; lcd_E=1; delay_us(1); lcd_E=0; delay_us(1);
    lcd_Out=c<<4;   lcd_E=1; delay_us(1); lcd_E=0; delay_us(40);
}
//
void lcd_init(void){
    delay_ms(50);  
    lcdCmd(0x28); lcdCmd(0x28); lcdCmd(0x28);
    lcdCmd(0x0C); lcdCmd(0x06); lcdCmd(0x01); delay_ms(2);
}
//
void lcd_gotoxy(char x, char y){
    if     (y==0)lcdCmd(0x80+x);
    else if(y==1)lcdCmd(0xC0+x);
    else if(y==2)lcdCmd(0x94+x);
    else if(y==3)lcdCmd(0xD4+x);
}
//
void lcd_puts(char *str){ while(*str)lcdData(*str++); }
//
void lcd_putsf(char flash *str){ while(*str)lcdData(*str++); }
//
void AM2302_rd(void){
    unsigned char i,k;
    for(i=0;i<8;i++)data[i]=0; // 변수 초기화
    //host start signal 
    DDRD.2=1; delay_ms(1); DDRD.2=0; // 데이터 요구
    for(k=0;k<5;k++){
        for(i=0;i<8;i++){
            data[k]|=0x80>>i; // high구간 48us이상이면 1
        }
    }
    //Parity(check sum)check
    i=data[0]+data[1]+data[2]+data[3];
    //data copy
    Humi=(unsigned int)data[0]*256+data[1];
    Temp=(unsigned int)data[2]*256+data[3];
    //Temp 영하 체크
    if(Temp&0x8000){ Temp_sign=1; Temp&=0x7FFF; } // 영하 
    else             Temp_sign=0;                 // 영상
    return;
AM2302_Error:;
    Humi=Temp=0; Temp_sign=0;   
}
//        
void main(void){
    unsigned char str[50];
    DDRA=0xFF; DDRC=0x47;   //Lcd PORT 
    PORTA.6=1;              //lcd back light on, K128LCD 사용자만
    lcd_init();
    lcd_gotoxy(0,0); lcd_putsf("AM2302 test");
    lcd_gotoxy(0,1); lcd_putsf("Humi & Temp");
    while(1){
        delay_ms(500);             // AM2302 데이터 요구 주기
        AM2302_rd();
        //lcd display
        sprintf(str,"Humi=%d.%d%%  ",Humi/10,Humi%10); 
        lcd_gotoxy(0,0); lcd_puts(str); 
        //
        if(Temp_sign)sprintf(str,"Temp=-%d.%d\xdfC  ",Temp/10,Temp%10); 
        else         sprintf(str,"Temp=%d.%d\xdfC  ",Temp/10,Temp%10);
        lcd_gotoxy(0,1); lcd_puts(str);
    }
}