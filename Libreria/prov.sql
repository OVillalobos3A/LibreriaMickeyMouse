PGDMP     	        
        	    y         	   dbEmpresa    13.2    13.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    19963 	   dbEmpresa    DATABASE     o   CREATE DATABASE "dbEmpresa" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.utf8';
    DROP DATABASE "dbEmpresa";
                postgres    false            �            1259    19996 	   proveedor    TABLE     �   CREATE TABLE public.proveedor (
    id_proveedor integer NOT NULL,
    nombre character varying(100) NOT NULL,
    correo character varying(40) NOT NULL,
    direccion character varying(200) NOT NULL,
    telefono character varying(9) NOT NULL
);
    DROP TABLE public.proveedor;
       public         heap    postgres    false            �            1259    19994    proveedor_id_proveedor_seq    SEQUENCE     �   CREATE SEQUENCE public.proveedor_id_proveedor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.proveedor_id_proveedor_seq;
       public          postgres    false    207            �           0    0    proveedor_id_proveedor_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.proveedor_id_proveedor_seq OWNED BY public.proveedor.id_proveedor;
          public          postgres    false    206            R           2604    19999    proveedor id_proveedor    DEFAULT     �   ALTER TABLE ONLY public.proveedor ALTER COLUMN id_proveedor SET DEFAULT nextval('public.proveedor_id_proveedor_seq'::regclass);
 E   ALTER TABLE public.proveedor ALTER COLUMN id_proveedor DROP DEFAULT;
       public          postgres    false    206    207    207            �          0    19996 	   proveedor 
   TABLE DATA           V   COPY public.proveedor (id_proveedor, nombre, correo, direccion, telefono) FROM stdin;
    public          postgres    false    207   n       �           0    0    proveedor_id_proveedor_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.proveedor_id_proveedor_seq', 6, true);
          public          postgres    false    206            T           2606    20001    proveedor proveedor_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (id_proveedor);
 B   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT proveedor_pkey;
       public            postgres    false    207            V           2606    20007    proveedor uq_correo_p 
   CONSTRAINT     R   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_correo_p UNIQUE (correo);
 ?   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_correo_p;
       public            postgres    false    207            X           2606    20005    proveedor uq_direccion_p 
   CONSTRAINT     X   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_direccion_p UNIQUE (direccion);
 B   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_direccion_p;
       public            postgres    false    207            Z           2606    20127    proveedor uq_nombre_p 
   CONSTRAINT     R   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_nombre_p UNIQUE (nombre);
 ?   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_nombre_p;
       public            postgres    false    207            \           2606    20009    proveedor uq_telefono_p 
   CONSTRAINT     V   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_telefono_p UNIQUE (telefono);
 A   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_telefono_p;
       public            postgres    false    207            �   �   x�e�M�@�םS���� ;����.ݔI�q����EL��U��K��9mp��^�>"��;���QI����+\k���<��^�Zɣ�((�L%�*wbc�QǾ�X��6�Y��Z(wi�lT��N��Mlat<��0.�}�K/T���4�{�p[��R=ܑ̲��[Gzƫ*ɷy*�k!�	�[     