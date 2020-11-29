create table restaurant (
   num int not null auto_increment,
   business_number char(10) not null,
   motto char(40) not null,
   regist_day char(20) not null,
   order_number int not null,
   file_name char(40),
   file_type char(40),
   file_copied char(40),
   primary key(num)
);

