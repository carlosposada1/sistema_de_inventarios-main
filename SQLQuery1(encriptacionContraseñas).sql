/****** Script for insert contraseñas from administracion ******/

/*insert into administracion values ('usuario', (SELECT dbo.fun_encriptar('contraseña')));*/

insert into administracion values ('carlos', (SELECT dbo.fun_encriptar('2023')));

select * from administracion;