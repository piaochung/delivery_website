create table orders (
    num int not null auto_increment,
    order_number int,
    id char(15) not null,
    business_number char(10) not null,
    menu_name char(20) not null,
    menu_count int,
    menu_price int,
    regist_day char(20) not null,
    primary key number(num)
);