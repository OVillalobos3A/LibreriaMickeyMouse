PGDMP             
        	    y         	   dbEmpresa    13.2    13.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    19963 	   dbEmpresa    DATABASE     o   CREATE DATABASE "dbEmpresa" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.utf8';
    DROP DATABASE "dbEmpresa";
                postgres    false            �            1259    19976    marca    TABLE     n   CREATE TABLE public.marca (
    id_marca integer NOT NULL,
    nombre_marca character varying(20) NOT NULL
);
    DROP TABLE public.marca;
       public         heap    postgres    false            �            1259    19974    marca_id_marca_seq    SEQUENCE     �   CREATE SEQUENCE public.marca_id_marca_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.marca_id_marca_seq;
       public          postgres    false    203            �           0    0    marca_id_marca_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.marca_id_marca_seq OWNED BY public.marca.id_marca;
          public          postgres    false    202            R           2604    19979    marca id_marca    DEFAULT     p   ALTER TABLE ONLY public.marca ALTER COLUMN id_marca SET DEFAULT nextval('public.marca_id_marca_seq'::regclass);
 =   ALTER TABLE public.marca ALTER COLUMN id_marca DROP DEFAULT;
       public          postgres    false    202    203    203            �          0    19976    marca 
   TABLE DATA           7   COPY public.marca (id_marca, nombre_marca) FROM stdin;
    public          postgres    false    203   �       �           0    0    marca_id_marca_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.marca_id_marca_seq', 2, true);
          public          postgres    false    202            T           2606    19981    marca marca_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.marca
    ADD CONSTRAINT marca_pkey PRIMARY KEY (id_marca);
 :   ALTER TABLE ONLY public.marca DROP CONSTRAINT marca_pkey;
       public            postgres    false    203            V           2606    19983    marca uq_nombre_m 
   CONSTRAINT     T   ALTER TABLE ONLY public.marca
    ADD CONSTRAINT uq_nombre_m UNIQUE (nombre_marca);
 ;   ALTER TABLE ONLY public.marca DROP CONSTRAINT uq_nombre_m;
       public            postgres    false    203            �   %   x�3�H,*�/�2�t��+,�,.IL�/����� ���     