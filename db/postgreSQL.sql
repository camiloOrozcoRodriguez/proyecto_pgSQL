-- Database: crud_pgSQL

-- DROP DATABASE IF EXISTS "crud_pgSQL";

CREATE DATABASE "crud_pgSQL"
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Spain.1252'
    LC_CTYPE = 'Spanish_Spain.1252'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;


    -- Table: public.tbl_usuarios

-- DROP TABLE IF EXISTS public.tbl_usuarios;

CREATE TABLE IF NOT EXISTS public.tbl_usuarios
(
    id integer NOT NULL DEFAULT nextval('tbl_usuarios_id_seq'::regclass),
    nombres character varying(20) COLLATE pg_catalog."default",
    apellidos character varying(20) COLLATE pg_catalog."default",
    correo character varying(50) COLLATE pg_catalog."default",
    num_celular bigint,
    CONSTRAINT tbl_usuarios_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.tbl_usuarios
    OWNER to postgres;