drop database if exists ecom;
create database ecom;
use ecom;

create table Categories(
    `cat_id` varchar(50) PRIMARY KEY,
    `name` varchar(50) not null
);
create table Products(
    `prod_id` INT(11) PRIMARY KEY,
    `sku` INT(11) ,
    `cat_id` varchar(50) not NULL,
    `name`  varchar(200) not NULL,
    `salePrice` FLOAT(11,2),
    `digital`   BOOL,
    `shippingCost`  FLOAT(11,2),
    `description`   varchar(200),
    `customerReviewCount`   INT(11),
     FOREIGN KEY(`cat_id`) References Categories(`cat_id`)


);
create table Images(
    `prod_id` INT(11) not null,
    `href` text not null,
    FOREIGN KEY(`prod_id`) References Products(`prod_id`)

);

create table config( 
    `id` int PRIMARY KEY,
    `api_key` varchar(30) 
);