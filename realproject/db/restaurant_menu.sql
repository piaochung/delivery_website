create table restaurant_menu (
    num int not null auto_increment,
    business_number char(10) not null,
    menu_name char(20) not null,
    menu_price int not null,
    regist_day char(20) not null,
    file_name char(40),
    file_type char(40),
    file_copied char(40),
    primary key(num)
);