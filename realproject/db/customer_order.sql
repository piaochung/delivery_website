create table customer_order (
    num int not null auto_increment,
    business_number char(10) not null,
    id char(15) not null,
    order_number int not null,
    primary key(num)
);