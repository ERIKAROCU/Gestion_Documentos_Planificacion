CREATE DATABASE document_manager;

CREATE DATABASE proyecto_prueba;
use proyecto_prueba;
select*from movies;
-- drop database proyecto_prueba;

USE document_manager;

select*from users;
select*from documents;
select*from files;
select*from oficinas;

describe users;

update users set role = 'admin' where id = 1;

delete from files where id = 4;

SELECT dni, COUNT(*)
FROM users
WHERE dni IS NOT NULL
GROUP BY dni
HAVING COUNT(*) > 1;
