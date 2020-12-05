create table business_comment (
    num int not null auto_increment,
    id char(10) not null,
    business_number(10) not null,
    comment_index int not null,
    primary key(num);
);