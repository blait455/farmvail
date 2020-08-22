Quick guide on how to setup up MYSQL or MariaDB on Kali Linux. This video is also a good troubleshoot guide for persons having difficulty with MariaDB.  This video illustrates how to make a simple databases, add entries and export to a .csv file.

Commands

sudo /etc/init.d/mysql stop - Stop the MySQL Server

sudo mysqld --skip-grant-tables & - Start the mysqld configuration

mysql -u root mysql - Login to MySQL as root

UPDATE user SET Password=PASSWORD('password') WHERE User='root'; FLUSH PRIVILEGES; exit; - Replace YOURNEWPASSWORD with your new password!


exit


sudo /etc/init.d/mysql restart - restart mysql server

mysql -u root -p - login to my sql

SHOW DATABASES; - list all databases

CREATE DATABASE my_clients; - creates a database named my_clients

DROP DATABASE my_clients; - deletes the databases named my_clients

USE my_clients; - selectes my_clients database

SHOW TABLES; - lists all tables in the database

CREATE TABLE client_info(First_name varchar(12), Last_name varchar(12), Address varchar (24), Email varchar (32), Phone varchar (14)); - creates a table named client_info and inserts column with headers

INSERT INTO client_info value("John", "Doe", "6, Leopold Road, London, NW10 9LP", "07922555000");

SELECT * FROM my_clients; - lists all entries in a table named my_clients

DELETE FROM my_clients; - deletes all content in a table


exit


mysql -u root -p -e 'select * from my_clients.client_info' | sed  's/\t/,/g'  output.csv - outputs entries in a table to a .csv file


use an angle bracket for the last command Youtube not allowing me to put angle bracket in description. See video for better understanding.