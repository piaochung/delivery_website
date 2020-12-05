create table comment (
    num int not null auto_increment,
    comment_index int not null,
    business_number char(10) not null,
    business_order_number int not null,
    id char(15) not null,
    review char(100) not null,
    regist_day char(20) not null,
    primary key(num)
);