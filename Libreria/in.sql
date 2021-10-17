PGDMP     3        
        	    y         	   dbEmpresa    13.2    13.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    19963 	   dbEmpresa    DATABASE     o   CREATE DATABASE "dbEmpresa" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.utf8';
    DROP DATABASE "dbEmpresa";
                postgres    false            �            1259    20050 
   inventario    TABLE     �  CREATE TABLE public.inventario (
    id_inventario integer NOT NULL,
    nombre character varying(100) NOT NULL,
    precio numeric(5,2) NOT NULL,
    descripcion character varying(500) NOT NULL,
    descuento numeric(4,2) DEFAULT 0.00,
    stock integer,
    autor character varying(100),
    imagen character varying(200),
    id_proveedor integer NOT NULL,
    id_tipo_producto integer NOT NULL,
    id_marca integer NOT NULL
);
    DROP TABLE public.inventario;
       public         heap    postgres    false            �            1259    20048    inventario_id_inventario_seq    SEQUENCE     �   CREATE SEQUENCE public.inventario_id_inventario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.inventario_id_inventario_seq;
       public          postgres    false    213            �           0    0    inventario_id_inventario_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.inventario_id_inventario_seq OWNED BY public.inventario.id_inventario;
          public          postgres    false    212            R           2604    20053    inventario id_inventario    DEFAULT     �   ALTER TABLE ONLY public.inventario ALTER COLUMN id_inventario SET DEFAULT nextval('public.inventario_id_inventario_seq'::regclass);
 G   ALTER TABLE public.inventario ALTER COLUMN id_inventario DROP DEFAULT;
       public          postgres    false    213    212    213            �          0    20050 
   inventario 
   TABLE DATA           �   COPY public.inventario (id_inventario, nombre, precio, descripcion, descuento, stock, autor, imagen, id_proveedor, id_tipo_producto, id_marca) FROM stdin;
    public          postgres    false    213   �       �           0    0    inventario_id_inventario_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.inventario_id_inventario_seq', 9, true);
          public          postgres    false    212            U           2606    20056    inventario inventario_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (id_inventario);
 D   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_pkey;
       public            postgres    false    213            W           2606    20131    inventario uq_imagen_pr 
   CONSTRAINT     T   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT uq_imagen_pr UNIQUE (imagen);
 A   ALTER TABLE ONLY public.inventario DROP CONSTRAINT uq_imagen_pr;
       public            postgres    false    213            Y           2606    20129    inventario uq_nombre_pr 
   CONSTRAINT     T   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT uq_nombre_pr UNIQUE (nombre);
 A   ALTER TABLE ONLY public.inventario DROP CONSTRAINT uq_nombre_pr;
       public            postgres    false    213            \           2606    20067 #   inventario inventario_id_marca_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_marca_fkey FOREIGN KEY (id_marca) REFERENCES public.marca(id_marca);
 M   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_id_marca_fkey;
       public          postgres    false    213            Z           2606    20057 '   inventario inventario_id_proveedor_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_proveedor_fkey FOREIGN KEY (id_proveedor) REFERENCES public.proveedor(id_proveedor);
 Q   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_id_proveedor_fkey;
       public          postgres    false    213            [           2606    20062 +   inventario inventario_id_tipo_producto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_tipo_producto_fkey FOREIGN KEY (id_tipo_producto) REFERENCES public.tipo_producto(id_tipo_producto);
 U   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_id_tipo_producto_fkey;
       public          postgres    false    213            �   �   x�u�An� DןSp��p�M����lp��1����+�+������h^�&����0�c=H��o�gwu�g�K��4�i������@`0��1�[��x�.��@�N�Z�%9�)E��9	��涟�~�������H���+�ݍ����g�٥�"mq����������r�����`:��\��x^�i�%3����Or��ٱ�6lle�m��}ț`�}�!q�     