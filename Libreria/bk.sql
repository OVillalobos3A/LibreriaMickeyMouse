PGDMP     $    %            	    y            mickey    13.2    13.2 �    n           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            o           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            p           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            q           1262    20519    mickey    DATABASE     j   CREATE DATABASE mickey WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.utf8';
    DROP DATABASE mickey;
                postgres    false            �            1259    20730    accesos    TABLE     �   CREATE TABLE public.accesos (
    id_acceso integer NOT NULL,
    id_tipo_usuario integer NOT NULL,
    id_pagina integer NOT NULL,
    id_permiso integer NOT NULL
);
    DROP TABLE public.accesos;
       public         heap    postgres    false            �            1259    20728    accesos_id_acceso_seq    SEQUENCE     �   CREATE SEQUENCE public.accesos_id_acceso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.accesos_id_acceso_seq;
       public          postgres    false    227            r           0    0    accesos_id_acceso_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.accesos_id_acceso_seq OWNED BY public.accesos.id_acceso;
          public          postgres    false    226            �            1259    20666    detalle_compra    TABLE     �   CREATE TABLE public.detalle_compra (
    id_detalle integer NOT NULL,
    cantidad integer,
    precio numeric(5,2) NOT NULL,
    id_inventario integer NOT NULL,
    id_factura integer NOT NULL
);
 "   DROP TABLE public.detalle_compra;
       public         heap    postgres    false            �            1259    20664    detalle_compra_id_detalle_seq    SEQUENCE     �   CREATE SEQUENCE public.detalle_compra_id_detalle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.detalle_compra_id_detalle_seq;
       public          postgres    false    219            s           0    0    detalle_compra_id_detalle_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.detalle_compra_id_detalle_seq OWNED BY public.detalle_compra.id_detalle;
          public          postgres    false    218            �            1259    20568 	   empleados    TABLE     �  CREATE TABLE public.empleados (
    id_empleado integer NOT NULL,
    imagen character varying(100),
    nombre character varying(25) NOT NULL,
    apellido character varying(25) NOT NULL,
    correo character varying(40) NOT NULL,
    telefono character varying(9) NOT NULL,
    fecha_nac date NOT NULL,
    genero character(1) NOT NULL,
    dui character varying(10) NOT NULL,
    codigo_recu character varying(5),
    estado character varying(10) DEFAULT 'activo'::character varying NOT NULL
);
    DROP TABLE public.empleados;
       public         heap    postgres    false            �            1259    20566    empleados_id_empleado_seq    SEQUENCE     �   CREATE SEQUENCE public.empleados_id_empleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.empleados_id_empleado_seq;
       public          postgres    false    209            t           0    0    empleados_id_empleado_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.empleados_id_empleado_seq OWNED BY public.empleados.id_empleado;
          public          postgres    false    208            �            1259    20634    entrada_inventario    TABLE     �   CREATE TABLE public.entrada_inventario (
    id_entrada integer NOT NULL,
    cantidad integer NOT NULL,
    fecha date NOT NULL,
    id_inventario integer NOT NULL,
    id_empleado integer NOT NULL
);
 &   DROP TABLE public.entrada_inventario;
       public         heap    postgres    false            �            1259    20632 !   entrada_inventario_id_entrada_seq    SEQUENCE     �   CREATE SEQUENCE public.entrada_inventario_id_entrada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.entrada_inventario_id_entrada_seq;
       public          postgres    false    215            u           0    0 !   entrada_inventario_id_entrada_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.entrada_inventario_id_entrada_seq OWNED BY public.entrada_inventario.id_entrada;
          public          postgres    false    214            �            1259    20652    factura    TABLE       CREATE TABLE public.factura (
    id_factura integer NOT NULL,
    impuestos numeric(5,2),
    nombre_cliente character varying(50),
    fecha date NOT NULL,
    estado character varying(25) DEFAULT 'Pendiente'::character varying NOT NULL,
    id_usuario integer NOT NULL
);
    DROP TABLE public.factura;
       public         heap    postgres    false            �            1259    20650    factura_id_factura_seq    SEQUENCE     �   CREATE SEQUENCE public.factura_id_factura_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.factura_id_factura_seq;
       public          postgres    false    217            v           0    0    factura_id_factura_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.factura_id_factura_seq OWNED BY public.factura.id_factura;
          public          postgres    false    216            �            1259    20686    historial_usuarios    TABLE     �   CREATE TABLE public.historial_usuarios (
    id_historial integer NOT NULL,
    fecha_hora character varying(80) NOT NULL,
    plataforma character varying(60) NOT NULL,
    id_usuario integer NOT NULL
);
 &   DROP TABLE public.historial_usuarios;
       public         heap    postgres    false            �            1259    20684 #   historial_usuarios_id_historial_seq    SEQUENCE     �   CREATE SEQUENCE public.historial_usuarios_id_historial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.historial_usuarios_id_historial_seq;
       public          postgres    false    221            w           0    0 #   historial_usuarios_id_historial_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public.historial_usuarios_id_historial_seq OWNED BY public.historial_usuarios.id_historial;
          public          postgres    false    220            �            1259    20606 
   inventario    TABLE     �  CREATE TABLE public.inventario (
    id_inventario integer NOT NULL,
    nombre character varying(20) NOT NULL,
    precio numeric(5,2) NOT NULL,
    descripcion character varying(50) NOT NULL,
    descuento numeric(4,2) DEFAULT 0.00,
    stock integer,
    autor character varying(50),
    imagen character varying(100),
    id_proveedor integer NOT NULL,
    id_tipo_producto integer NOT NULL,
    id_marca integer NOT NULL
);
    DROP TABLE public.inventario;
       public         heap    postgres    false            �            1259    20604    inventario_id_inventario_seq    SEQUENCE     �   CREATE SEQUENCE public.inventario_id_inventario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.inventario_id_inventario_seq;
       public          postgres    false    213            x           0    0    inventario_id_inventario_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.inventario_id_inventario_seq OWNED BY public.inventario.id_inventario;
          public          postgres    false    212            �            1259    20532    marca    TABLE     n   CREATE TABLE public.marca (
    id_marca integer NOT NULL,
    nombre_marca character varying(20) NOT NULL
);
    DROP TABLE public.marca;
       public         heap    postgres    false            �            1259    20530    marca_id_marca_seq    SEQUENCE     �   CREATE SEQUENCE public.marca_id_marca_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.marca_id_marca_seq;
       public          postgres    false    203            y           0    0    marca_id_marca_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.marca_id_marca_seq OWNED BY public.marca.id_marca;
          public          postgres    false    202            �            1259    20709    paginas    TABLE     �   CREATE TABLE public.paginas (
    id_pagina integer NOT NULL,
    nombre character varying(100) NOT NULL,
    link character varying(100) NOT NULL
);
    DROP TABLE public.paginas;
       public         heap    postgres    false            �            1259    20707    paginas_id_pagina_seq    SEQUENCE     �   CREATE SEQUENCE public.paginas_id_pagina_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.paginas_id_pagina_seq;
       public          postgres    false    223            z           0    0    paginas_id_pagina_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.paginas_id_pagina_seq OWNED BY public.paginas.id_pagina;
          public          postgres    false    222            �            1259    20719    permisos    TABLE     o   CREATE TABLE public.permisos (
    id_permiso integer NOT NULL,
    permiso character varying(200) NOT NULL
);
    DROP TABLE public.permisos;
       public         heap    postgres    false            �            1259    20717    permisos_id_permiso_seq    SEQUENCE     �   CREATE SEQUENCE public.permisos_id_permiso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.permisos_id_permiso_seq;
       public          postgres    false    225            {           0    0    permisos_id_permiso_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.permisos_id_permiso_seq OWNED BY public.permisos.id_permiso;
          public          postgres    false    224            �            1259    20552 	   proveedor    TABLE     �   CREATE TABLE public.proveedor (
    id_proveedor integer NOT NULL,
    nombre character varying(20) NOT NULL,
    correo character varying(40) NOT NULL,
    direccion character varying(200) NOT NULL,
    telefono character varying(9) NOT NULL
);
    DROP TABLE public.proveedor;
       public         heap    postgres    false            �            1259    20550    proveedor_id_proveedor_seq    SEQUENCE     �   CREATE SEQUENCE public.proveedor_id_proveedor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.proveedor_id_proveedor_seq;
       public          postgres    false    207            |           0    0    proveedor_id_proveedor_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.proveedor_id_proveedor_seq OWNED BY public.proveedor.id_proveedor;
          public          postgres    false    206            �            1259    20542    tipo_producto    TABLE     �   CREATE TABLE public.tipo_producto (
    id_tipo_producto integer NOT NULL,
    tipo_producto character varying(20) NOT NULL,
    descripcion character varying(50) NOT NULL
);
 !   DROP TABLE public.tipo_producto;
       public         heap    postgres    false            �            1259    20540 "   tipo_producto_id_tipo_producto_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_producto_id_tipo_producto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tipo_producto_id_tipo_producto_seq;
       public          postgres    false    205            }           0    0 "   tipo_producto_id_tipo_producto_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tipo_producto_id_tipo_producto_seq OWNED BY public.tipo_producto.id_tipo_producto;
          public          postgres    false    204            �            1259    20522    tipo_usuario    TABLE     |   CREATE TABLE public.tipo_usuario (
    id_tipo_usuario integer NOT NULL,
    tipo_usuario character varying(15) NOT NULL
);
     DROP TABLE public.tipo_usuario;
       public         heap    postgres    false            �            1259    20520     tipo_usuario_id_tipo_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_usuario_id_tipo_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.tipo_usuario_id_tipo_usuario_seq;
       public          postgres    false    201            ~           0    0     tipo_usuario_id_tipo_usuario_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.tipo_usuario_id_tipo_usuario_seq OWNED BY public.tipo_usuario.id_tipo_usuario;
          public          postgres    false    200            �            1259    20583    usuarios    TABLE     �  CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    usuario character varying(10) NOT NULL,
    "contraseña" character varying(200) NOT NULL,
    primer_uso integer,
    id_empleado integer NOT NULL,
    id_tipo_usuario integer NOT NULL,
    estado character varying(10) DEFAULT 'activo'::character varying NOT NULL,
    last_date date,
    autenticacion boolean DEFAULT false,
    codigo_autn character varying(5),
    intentos integer DEFAULT 0
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �            1259    20581    usuarios_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.usuarios_id_usuario_seq;
       public          postgres    false    211                       0    0    usuarios_id_usuario_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;
          public          postgres    false    210            �           2604    20733    accesos id_acceso    DEFAULT     v   ALTER TABLE ONLY public.accesos ALTER COLUMN id_acceso SET DEFAULT nextval('public.accesos_id_acceso_seq'::regclass);
 @   ALTER TABLE public.accesos ALTER COLUMN id_acceso DROP DEFAULT;
       public          postgres    false    227    226    227                       2604    20669    detalle_compra id_detalle    DEFAULT     �   ALTER TABLE ONLY public.detalle_compra ALTER COLUMN id_detalle SET DEFAULT nextval('public.detalle_compra_id_detalle_seq'::regclass);
 H   ALTER TABLE public.detalle_compra ALTER COLUMN id_detalle DROP DEFAULT;
       public          postgres    false    218    219    219            t           2604    20571    empleados id_empleado    DEFAULT     ~   ALTER TABLE ONLY public.empleados ALTER COLUMN id_empleado SET DEFAULT nextval('public.empleados_id_empleado_seq'::regclass);
 D   ALTER TABLE public.empleados ALTER COLUMN id_empleado DROP DEFAULT;
       public          postgres    false    209    208    209            |           2604    20637    entrada_inventario id_entrada    DEFAULT     �   ALTER TABLE ONLY public.entrada_inventario ALTER COLUMN id_entrada SET DEFAULT nextval('public.entrada_inventario_id_entrada_seq'::regclass);
 L   ALTER TABLE public.entrada_inventario ALTER COLUMN id_entrada DROP DEFAULT;
       public          postgres    false    214    215    215            }           2604    20655    factura id_factura    DEFAULT     x   ALTER TABLE ONLY public.factura ALTER COLUMN id_factura SET DEFAULT nextval('public.factura_id_factura_seq'::regclass);
 A   ALTER TABLE public.factura ALTER COLUMN id_factura DROP DEFAULT;
       public          postgres    false    216    217    217            �           2604    20689    historial_usuarios id_historial    DEFAULT     �   ALTER TABLE ONLY public.historial_usuarios ALTER COLUMN id_historial SET DEFAULT nextval('public.historial_usuarios_id_historial_seq'::regclass);
 N   ALTER TABLE public.historial_usuarios ALTER COLUMN id_historial DROP DEFAULT;
       public          postgres    false    220    221    221            z           2604    20609    inventario id_inventario    DEFAULT     �   ALTER TABLE ONLY public.inventario ALTER COLUMN id_inventario SET DEFAULT nextval('public.inventario_id_inventario_seq'::regclass);
 G   ALTER TABLE public.inventario ALTER COLUMN id_inventario DROP DEFAULT;
       public          postgres    false    213    212    213            q           2604    20535    marca id_marca    DEFAULT     p   ALTER TABLE ONLY public.marca ALTER COLUMN id_marca SET DEFAULT nextval('public.marca_id_marca_seq'::regclass);
 =   ALTER TABLE public.marca ALTER COLUMN id_marca DROP DEFAULT;
       public          postgres    false    202    203    203            �           2604    20712    paginas id_pagina    DEFAULT     v   ALTER TABLE ONLY public.paginas ALTER COLUMN id_pagina SET DEFAULT nextval('public.paginas_id_pagina_seq'::regclass);
 @   ALTER TABLE public.paginas ALTER COLUMN id_pagina DROP DEFAULT;
       public          postgres    false    223    222    223            �           2604    20722    permisos id_permiso    DEFAULT     z   ALTER TABLE ONLY public.permisos ALTER COLUMN id_permiso SET DEFAULT nextval('public.permisos_id_permiso_seq'::regclass);
 B   ALTER TABLE public.permisos ALTER COLUMN id_permiso DROP DEFAULT;
       public          postgres    false    225    224    225            s           2604    20555    proveedor id_proveedor    DEFAULT     �   ALTER TABLE ONLY public.proveedor ALTER COLUMN id_proveedor SET DEFAULT nextval('public.proveedor_id_proveedor_seq'::regclass);
 E   ALTER TABLE public.proveedor ALTER COLUMN id_proveedor DROP DEFAULT;
       public          postgres    false    207    206    207            r           2604    20545    tipo_producto id_tipo_producto    DEFAULT     �   ALTER TABLE ONLY public.tipo_producto ALTER COLUMN id_tipo_producto SET DEFAULT nextval('public.tipo_producto_id_tipo_producto_seq'::regclass);
 M   ALTER TABLE public.tipo_producto ALTER COLUMN id_tipo_producto DROP DEFAULT;
       public          postgres    false    204    205    205            p           2604    20525    tipo_usuario id_tipo_usuario    DEFAULT     �   ALTER TABLE ONLY public.tipo_usuario ALTER COLUMN id_tipo_usuario SET DEFAULT nextval('public.tipo_usuario_id_tipo_usuario_seq'::regclass);
 K   ALTER TABLE public.tipo_usuario ALTER COLUMN id_tipo_usuario DROP DEFAULT;
       public          postgres    false    200    201    201            v           2604    20586    usuarios id_usuario    DEFAULT     z   ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);
 B   ALTER TABLE public.usuarios ALTER COLUMN id_usuario DROP DEFAULT;
       public          postgres    false    211    210    211            k          0    20730    accesos 
   TABLE DATA           T   COPY public.accesos (id_acceso, id_tipo_usuario, id_pagina, id_permiso) FROM stdin;
    public          postgres    false    227   ��       c          0    20666    detalle_compra 
   TABLE DATA           a   COPY public.detalle_compra (id_detalle, cantidad, precio, id_inventario, id_factura) FROM stdin;
    public          postgres    false    219   8�       Y          0    20568 	   empleados 
   TABLE DATA           �   COPY public.empleados (id_empleado, imagen, nombre, apellido, correo, telefono, fecha_nac, genero, dui, codigo_recu, estado) FROM stdin;
    public          postgres    false    209   U�       _          0    20634    entrada_inventario 
   TABLE DATA           e   COPY public.entrada_inventario (id_entrada, cantidad, fecha, id_inventario, id_empleado) FROM stdin;
    public          postgres    false    215   �       a          0    20652    factura 
   TABLE DATA           c   COPY public.factura (id_factura, impuestos, nombre_cliente, fecha, estado, id_usuario) FROM stdin;
    public          postgres    false    217    �       e          0    20686    historial_usuarios 
   TABLE DATA           ^   COPY public.historial_usuarios (id_historial, fecha_hora, plataforma, id_usuario) FROM stdin;
    public          postgres    false    221   Y�       ]          0    20606 
   inventario 
   TABLE DATA           �   COPY public.inventario (id_inventario, nombre, precio, descripcion, descuento, stock, autor, imagen, id_proveedor, id_tipo_producto, id_marca) FROM stdin;
    public          postgres    false    213   ��       S          0    20532    marca 
   TABLE DATA           7   COPY public.marca (id_marca, nombre_marca) FROM stdin;
    public          postgres    false    203   ��       g          0    20709    paginas 
   TABLE DATA           :   COPY public.paginas (id_pagina, nombre, link) FROM stdin;
    public          postgres    false    223   ֥       i          0    20719    permisos 
   TABLE DATA           7   COPY public.permisos (id_permiso, permiso) FROM stdin;
    public          postgres    false    225   g�       W          0    20552 	   proveedor 
   TABLE DATA           V   COPY public.proveedor (id_proveedor, nombre, correo, direccion, telefono) FROM stdin;
    public          postgres    false    207   ��       U          0    20542    tipo_producto 
   TABLE DATA           U   COPY public.tipo_producto (id_tipo_producto, tipo_producto, descripcion) FROM stdin;
    public          postgres    false    205   Ԧ       Q          0    20522    tipo_usuario 
   TABLE DATA           E   COPY public.tipo_usuario (id_tipo_usuario, tipo_usuario) FROM stdin;
    public          postgres    false    201   �       [          0    20583    usuarios 
   TABLE DATA           �   COPY public.usuarios (id_usuario, usuario, "contraseña", primer_uso, id_empleado, id_tipo_usuario, estado, last_date, autenticacion, codigo_autn, intentos) FROM stdin;
    public          postgres    false    211   <�       �           0    0    accesos_id_acceso_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.accesos_id_acceso_seq', 6, true);
          public          postgres    false    226            �           0    0    detalle_compra_id_detalle_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.detalle_compra_id_detalle_seq', 1, false);
          public          postgres    false    218            �           0    0    empleados_id_empleado_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.empleados_id_empleado_seq', 10, true);
          public          postgres    false    208            �           0    0 !   entrada_inventario_id_entrada_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.entrada_inventario_id_entrada_seq', 1, false);
          public          postgres    false    214            �           0    0    factura_id_factura_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.factura_id_factura_seq', 1, true);
          public          postgres    false    216            �           0    0 #   historial_usuarios_id_historial_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.historial_usuarios_id_historial_seq', 1, true);
          public          postgres    false    220            �           0    0    inventario_id_inventario_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.inventario_id_inventario_seq', 1, false);
          public          postgres    false    212            �           0    0    marca_id_marca_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.marca_id_marca_seq', 1, false);
          public          postgres    false    202            �           0    0    paginas_id_pagina_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.paginas_id_pagina_seq', 8, true);
          public          postgres    false    222            �           0    0    permisos_id_permiso_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.permisos_id_permiso_seq', 3, true);
          public          postgres    false    224            �           0    0    proveedor_id_proveedor_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.proveedor_id_proveedor_seq', 1, false);
          public          postgres    false    206            �           0    0 "   tipo_producto_id_tipo_producto_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tipo_producto_id_tipo_producto_seq', 1, false);
          public          postgres    false    204            �           0    0     tipo_usuario_id_tipo_usuario_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tipo_usuario_id_tipo_usuario_seq', 1, false);
          public          postgres    false    200            �           0    0    usuarios_id_usuario_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 9, true);
          public          postgres    false    210            �           2606    20735    accesos accesos_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.accesos
    ADD CONSTRAINT accesos_pkey PRIMARY KEY (id_acceso);
 >   ALTER TABLE ONLY public.accesos DROP CONSTRAINT accesos_pkey;
       public            postgres    false    227            �           2606    20671 "   detalle_compra detalle_compra_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.detalle_compra
    ADD CONSTRAINT detalle_compra_pkey PRIMARY KEY (id_detalle);
 L   ALTER TABLE ONLY public.detalle_compra DROP CONSTRAINT detalle_compra_pkey;
       public            postgres    false    219            �           2606    20574    empleados empleados_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.empleados
    ADD CONSTRAINT empleados_pkey PRIMARY KEY (id_empleado);
 B   ALTER TABLE ONLY public.empleados DROP CONSTRAINT empleados_pkey;
       public            postgres    false    209            �           2606    20639 *   entrada_inventario entrada_inventario_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.entrada_inventario
    ADD CONSTRAINT entrada_inventario_pkey PRIMARY KEY (id_entrada);
 T   ALTER TABLE ONLY public.entrada_inventario DROP CONSTRAINT entrada_inventario_pkey;
       public            postgres    false    215            �           2606    20658    factura factura_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.factura
    ADD CONSTRAINT factura_pkey PRIMARY KEY (id_factura);
 >   ALTER TABLE ONLY public.factura DROP CONSTRAINT factura_pkey;
       public            postgres    false    217            �           2606    20691 *   historial_usuarios historial_usuarios_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public.historial_usuarios
    ADD CONSTRAINT historial_usuarios_pkey PRIMARY KEY (id_historial);
 T   ALTER TABLE ONLY public.historial_usuarios DROP CONSTRAINT historial_usuarios_pkey;
       public            postgres    false    221            �           2606    20612    inventario inventario_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (id_inventario);
 D   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_pkey;
       public            postgres    false    213            �           2606    20716 
   paginas lk 
   CONSTRAINT     E   ALTER TABLE ONLY public.paginas
    ADD CONSTRAINT lk UNIQUE (link);
 4   ALTER TABLE ONLY public.paginas DROP CONSTRAINT lk;
       public            postgres    false    223            �           2606    20537    marca marca_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.marca
    ADD CONSTRAINT marca_pkey PRIMARY KEY (id_marca);
 :   ALTER TABLE ONLY public.marca DROP CONSTRAINT marca_pkey;
       public            postgres    false    203            �           2606    20714    paginas paginas_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.paginas
    ADD CONSTRAINT paginas_pkey PRIMARY KEY (id_pagina);
 >   ALTER TABLE ONLY public.paginas DROP CONSTRAINT paginas_pkey;
       public            postgres    false    223            �           2606    20724    permisos permisos_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.permisos
    ADD CONSTRAINT permisos_pkey PRIMARY KEY (id_permiso);
 @   ALTER TABLE ONLY public.permisos DROP CONSTRAINT permisos_pkey;
       public            postgres    false    225            �           2606    20726    permisos pr 
   CONSTRAINT     I   ALTER TABLE ONLY public.permisos
    ADD CONSTRAINT pr UNIQUE (permiso);
 5   ALTER TABLE ONLY public.permisos DROP CONSTRAINT pr;
       public            postgres    false    225            �           2606    20557    proveedor proveedor_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (id_proveedor);
 B   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT proveedor_pkey;
       public            postgres    false    207            �           2606    20547     tipo_producto tipo_producto_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.tipo_producto
    ADD CONSTRAINT tipo_producto_pkey PRIMARY KEY (id_tipo_producto);
 J   ALTER TABLE ONLY public.tipo_producto DROP CONSTRAINT tipo_producto_pkey;
       public            postgres    false    205            �           2606    20527    tipo_usuario tipo_usuario_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.tipo_usuario
    ADD CONSTRAINT tipo_usuario_pkey PRIMARY KEY (id_tipo_usuario);
 H   ALTER TABLE ONLY public.tipo_usuario DROP CONSTRAINT tipo_usuario_pkey;
       public            postgres    false    201            �           2606    20576    empleados uq_correo_e 
   CONSTRAINT     R   ALTER TABLE ONLY public.empleados
    ADD CONSTRAINT uq_correo_e UNIQUE (correo);
 ?   ALTER TABLE ONLY public.empleados DROP CONSTRAINT uq_correo_e;
       public            postgres    false    209            �           2606    20563    proveedor uq_correo_p 
   CONSTRAINT     R   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_correo_p UNIQUE (correo);
 ?   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_correo_p;
       public            postgres    false    207            �           2606    20561    proveedor uq_direccion_p 
   CONSTRAINT     X   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_direccion_p UNIQUE (direccion);
 B   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_direccion_p;
       public            postgres    false    207            �           2606    20580    empleados uq_dui_e 
   CONSTRAINT     L   ALTER TABLE ONLY public.empleados
    ADD CONSTRAINT uq_dui_e UNIQUE (dui);
 <   ALTER TABLE ONLY public.empleados DROP CONSTRAINT uq_dui_e;
       public            postgres    false    209            �           2606    20603    usuarios uq_empleado_u 
   CONSTRAINT     X   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT uq_empleado_u UNIQUE (id_empleado);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT uq_empleado_u;
       public            postgres    false    211            �           2606    20631    inventario uq_imagen_pr 
   CONSTRAINT     T   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT uq_imagen_pr UNIQUE (imagen);
 A   ALTER TABLE ONLY public.inventario DROP CONSTRAINT uq_imagen_pr;
       public            postgres    false    213            �           2606    20539    marca uq_nombre_m 
   CONSTRAINT     T   ALTER TABLE ONLY public.marca
    ADD CONSTRAINT uq_nombre_m UNIQUE (nombre_marca);
 ;   ALTER TABLE ONLY public.marca DROP CONSTRAINT uq_nombre_m;
       public            postgres    false    203            �           2606    20559    proveedor uq_nombre_p 
   CONSTRAINT     R   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_nombre_p UNIQUE (nombre);
 ?   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_nombre_p;
       public            postgres    false    207            �           2606    20629    inventario uq_nombre_pr 
   CONSTRAINT     T   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT uq_nombre_pr UNIQUE (nombre);
 A   ALTER TABLE ONLY public.inventario DROP CONSTRAINT uq_nombre_pr;
       public            postgres    false    213            �           2606    20578    empleados uq_telefono_e 
   CONSTRAINT     V   ALTER TABLE ONLY public.empleados
    ADD CONSTRAINT uq_telefono_e UNIQUE (telefono);
 A   ALTER TABLE ONLY public.empleados DROP CONSTRAINT uq_telefono_e;
       public            postgres    false    209            �           2606    20565    proveedor uq_telefono_p 
   CONSTRAINT     V   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT uq_telefono_p UNIQUE (telefono);
 A   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT uq_telefono_p;
       public            postgres    false    207            �           2606    20549    tipo_producto uq_tipo_p 
   CONSTRAINT     [   ALTER TABLE ONLY public.tipo_producto
    ADD CONSTRAINT uq_tipo_p UNIQUE (tipo_producto);
 A   ALTER TABLE ONLY public.tipo_producto DROP CONSTRAINT uq_tipo_p;
       public            postgres    false    205            �           2606    20529    tipo_usuario uq_tipo_u 
   CONSTRAINT     Y   ALTER TABLE ONLY public.tipo_usuario
    ADD CONSTRAINT uq_tipo_u UNIQUE (tipo_usuario);
 @   ALTER TABLE ONLY public.tipo_usuario DROP CONSTRAINT uq_tipo_u;
       public            postgres    false    201            �           2606    20601    usuarios uq_usuario_u 
   CONSTRAINT     S   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT uq_usuario_u UNIQUE (usuario);
 ?   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT uq_usuario_u;
       public            postgres    false    211            �           2606    20589    usuarios usuarios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    211            �           2606    20677 -   detalle_compra detalle_compra_id_factura_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detalle_compra
    ADD CONSTRAINT detalle_compra_id_factura_fkey FOREIGN KEY (id_factura) REFERENCES public.factura(id_factura);
 W   ALTER TABLE ONLY public.detalle_compra DROP CONSTRAINT detalle_compra_id_factura_fkey;
       public          postgres    false    217    219    2993            �           2606    20672 0   detalle_compra detalle_compra_id_inventario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detalle_compra
    ADD CONSTRAINT detalle_compra_id_inventario_fkey FOREIGN KEY (id_inventario) REFERENCES public.inventario(id_inventario);
 Z   ALTER TABLE ONLY public.detalle_compra DROP CONSTRAINT detalle_compra_id_inventario_fkey;
       public          postgres    false    2985    219    213            �           2606    20645 6   entrada_inventario entrada_inventario_id_empleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.entrada_inventario
    ADD CONSTRAINT entrada_inventario_id_empleado_fkey FOREIGN KEY (id_empleado) REFERENCES public.empleados(id_empleado);
 `   ALTER TABLE ONLY public.entrada_inventario DROP CONSTRAINT entrada_inventario_id_empleado_fkey;
       public          postgres    false    2971    209    215            �           2606    20640 8   entrada_inventario entrada_inventario_id_inventario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.entrada_inventario
    ADD CONSTRAINT entrada_inventario_id_inventario_fkey FOREIGN KEY (id_inventario) REFERENCES public.inventario(id_inventario);
 b   ALTER TABLE ONLY public.entrada_inventario DROP CONSTRAINT entrada_inventario_id_inventario_fkey;
       public          postgres    false    215    2985    213            �           2606    20659    factura factura_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.factura
    ADD CONSTRAINT factura_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario);
 I   ALTER TABLE ONLY public.factura DROP CONSTRAINT factura_id_usuario_fkey;
       public          postgres    false    217    2983    211            �           2606    20736    accesos fkpg    FK CONSTRAINT     v   ALTER TABLE ONLY public.accesos
    ADD CONSTRAINT fkpg FOREIGN KEY (id_pagina) REFERENCES public.paginas(id_pagina);
 6   ALTER TABLE ONLY public.accesos DROP CONSTRAINT fkpg;
       public          postgres    false    3001    227    223            �           2606    20746    accesos fkpr    FK CONSTRAINT     y   ALTER TABLE ONLY public.accesos
    ADD CONSTRAINT fkpr FOREIGN KEY (id_permiso) REFERENCES public.permisos(id_permiso);
 6   ALTER TABLE ONLY public.accesos DROP CONSTRAINT fkpr;
       public          postgres    false    3003    227    225            �           2606    20741    accesos fkus    FK CONSTRAINT     �   ALTER TABLE ONLY public.accesos
    ADD CONSTRAINT fkus FOREIGN KEY (id_tipo_usuario) REFERENCES public.tipo_usuario(id_tipo_usuario);
 6   ALTER TABLE ONLY public.accesos DROP CONSTRAINT fkus;
       public          postgres    false    201    2949    227            �           2606    20692 5   historial_usuarios historial_usuarios_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historial_usuarios
    ADD CONSTRAINT historial_usuarios_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario);
 _   ALTER TABLE ONLY public.historial_usuarios DROP CONSTRAINT historial_usuarios_id_usuario_fkey;
       public          postgres    false    211    2983    221            �           2606    20623 #   inventario inventario_id_marca_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_marca_fkey FOREIGN KEY (id_marca) REFERENCES public.marca(id_marca);
 M   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_id_marca_fkey;
       public          postgres    false    203    2953    213            �           2606    20613 '   inventario inventario_id_proveedor_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_proveedor_fkey FOREIGN KEY (id_proveedor) REFERENCES public.proveedor(id_proveedor);
 Q   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_id_proveedor_fkey;
       public          postgres    false    213    2961    207            �           2606    20618 +   inventario inventario_id_tipo_producto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_tipo_producto_fkey FOREIGN KEY (id_tipo_producto) REFERENCES public.tipo_producto(id_tipo_producto);
 U   ALTER TABLE ONLY public.inventario DROP CONSTRAINT inventario_id_tipo_producto_fkey;
       public          postgres    false    2957    205    213            �           2606    20590 "   usuarios usuarios_id_empleado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_id_empleado_fkey FOREIGN KEY (id_empleado) REFERENCES public.empleados(id_empleado);
 L   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_id_empleado_fkey;
       public          postgres    false    2971    209    211            �           2606    20595 &   usuarios usuarios_id_tipo_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_id_tipo_usuario_fkey FOREIGN KEY (id_tipo_usuario) REFERENCES public.tipo_usuario(id_tipo_usuario);
 P   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_id_tipo_usuario_fkey;
       public          postgres    false    211    201    2949            k   *   x�3�4�4�4�2�F@�DiS i�i�e���+F��� {�]      c      x������ � �      Y   �   x�Mͻ�  ���/����lL�tp�B L)����7�`��HZo��d����_i�S�X��2�P�˱�R�2B�Ø]��/$ŵjZP��K�h�H�,q�z��ga?]�7mM$���XӲ&7���M����!o?��K���^�;}��7�7�      _      x������ � �      a   )   x�3��!##C]C]3΀Լ��Լ�TNs�=... �^      e   3   x�3�44�50�5202T00�21�24R(����K�//V04�4����� �e	G      ]      x������ � �      S      x������ � �      g   �   x�=�K
�0D��������M��FԂ�HN��Z�]��f��=�IH����)�zL0HZ�}V�Ɩ��yb�I��,9�K�U,�?�U�`�f.�-IMYrE������wι/��DB      i   @   x�3��IM-�2S:
��E��E
�
��)�i�ɉE\Ɯ!�)��
9@\�Z��Y�_����� Px      W      x������ � �      U      x������ � �      Q   ;   x�3���/�2�tL����,.)JL�/�2�tO-J�+I�2�NM.J-I,�L����� ���      [   �   x�=͹�@@����0"Z�����	����^-���K��6���2��fX�(Ҳ������̋�C���na{�TuK$���/�AN,,�@0h��.J�p�&�K�9�ʟ~���3�E��N�m:�89�@�>mP^1s��T\�~����/��p�)QV����$Io5B:     