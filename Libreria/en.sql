PGDMP             
        	    y         	   dbEmpresa    13.2    13.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    19963 	   dbEmpresa    DATABASE     o   CREATE DATABASE "dbEmpresa" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.utf8';
    DROP DATABASE "dbEmpresa";
                postgres    false            �            1259    20078    entrada_inventario    TABLE     �   CREATE TABLE public.entrada_inventario (
    id_entrada integer NOT NULL,
    cantidad integer NOT NULL,
    fecha date NOT NULL,
    id_inventario integer NOT NULL,
    id_empleado integer NOT NULL
);
 &   DROP TABLE public.entrada_inventario;
       public         heap    postgres    false            �            1259    20076 !   entrada_inventario_id_entrada_seq    SEQUENCE     �   CREATE SEQUENCE public.entrada_inventario_id_entrada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.entrada_inventario_id_entrada_seq;
       public          postgres    false    215            �           0    0 !   entrada_inventario_id_entrada_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.entrada_inventario_id_entrada_seq OWNED BY public.entrada_inventario.id_entrada;
          public          postgres    false    214            R           2604    20081    entrada_inventario id_entrada    DEFAULT     �   ALTER TABLE ONLY public.entrada_inventario ALTER COLUMN id_entrada SET DEFAULT nextval('public.entrada_inventario_id_entrada_seq'::regclass);
 L   ALTER TABLE public.entrada_inventario ALTER COLUMN id_entrada DROP DEFAULT;
       public          postgres    false    214    215    215            �          0    20078    entrada_inventario 
   TABLE DATA           e   COPY public.entrada_inventario (id_entrada, cantidad, fecha, id_inventario, id_empleado) FROM stdin;
    public          postgres    false    215   �       �           0    0 !   entrada_inventario_id_entrada_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.entrada_inventario_id_entrada_seq', 2, true);
          public          postgres    false    214            T           2606    20083 *   entrada_inventario entrada_inventario_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.entrada_inventario
    ADD CONSTRAINT entrada_inventario_pkey PRIMARY KEY (id_entrada);
 T   ALTER TABLE ONLY public.entrada_inventario DROP CONSTRAINT entrada_inventario_pkey;
       public            postgres    false    215            V           2606    20089 6   entrada_inventario entrada_inventario_id_empleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.entrada_inventario
    ADD CONSTRAINT entrada_inventario_id_empleado_fkey FOREIGN KEY (id_empleado) REFERENCES public.empleados(id_empleado);
 `   ALTER TABLE ONLY public.entrada_inventario DROP CONSTRAINT entrada_inventario_id_empleado_fkey;
       public          postgres    false    215            U           2606    20084 8   entrada_inventario entrada_inventario_id_inventario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.entrada_inventario
    ADD CONSTRAINT entrada_inventario_id_inventario_fkey FOREIGN KEY (id_inventario) REFERENCES public.inventario(id_inventario);
 b   ALTER TABLE ONLY public.entrada_inventario DROP CONSTRAINT entrada_inventario_id_inventario_fkey;
       public          postgres    false    215            �   )   x�3�42�4202�5��50��4�2�4B2
��qqq �5�     