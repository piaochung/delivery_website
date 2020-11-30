create table customer_members (
    num int not null auto_increment,
    id char(15) not null,
    pass char(15) not null,
    name char(10) not null,
    email char(80) not null,
    regist_day char(20) not null,
    level int,
    point int,
    primary key number(num)
);
