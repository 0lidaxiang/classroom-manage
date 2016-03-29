-- 创建数据库
CREATE DATABASE classroomManage_db;

USE classroomManage_db;
CREATE TABLE user(
                id int primary key not null auto_increment,
                userName varchar(50) not null,
                password varchar(50) not null,
                -- 自己输入的课表，用户自己的课表
                courseIds varchar(50)
                );

USE classroomManage_db;
CREATE TABLE course(
                courseId int primary key not null auto_increment,
                courseName varchar(50) not null,
                teacherName varchar(50) ,
                major varchar(50),
                department varchar(50),
                startTime varchar(50) ,
                endTime varchar(50) ,
                --对应的星期几
                weekDay varchar(50) ,
                singleOrBi varchar(50),
                startDate varchar(50) ,
                endDate varchar(50) ,
                classroomId int
                );

USE classroomManage_db;
CREATE TABLE classroom(
                classroomId int primary key not null auto_increment,
                buildingName varchar(50) ,
                floor varchar(50) ,
                roomNumber varchar(50)
                );

