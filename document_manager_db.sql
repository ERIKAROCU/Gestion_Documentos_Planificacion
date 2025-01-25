CREATE DATABASE document_manager;

USE document_manager;

select*from users;
select*from documents;
select*from files;

update users set role = "admin" where id = 1;

delete from files where id = 4;