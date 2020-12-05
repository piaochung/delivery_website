create table business_order (
    num int not null auto_increment,
    id char(15) not null,
    business_number char(10) not null,
    order_number int not null,
    primary key(num)
);