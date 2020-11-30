create table business_members (
    num int not null auto_increment,
    business_number char(10) not null,
    pass char(15) not null,
    name char(10) not null,
    email char(80) not null,
    regist_day char(20) not null,
    primary key number(num)
);
