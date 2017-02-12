--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comment_id_seq OWNER TO deauvece;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: comments; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE comments (
    id_comm text DEFAULT ('COM'::text || nextval('comment_id_seq'::regclass)) NOT NULL,
    body text NOT NULL,
    id_user text NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_way text NOT NULL
);


ALTER TABLE public.comments OWNER TO deauvece;

--
-- Name: qualif_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE qualif_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.qualif_id_seq OWNER TO deauvece;

--
-- Name: qualifications; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE qualifications (
    id_qualif text DEFAULT ('QUALIF'::text || nextval('qualif_id_seq'::regclass)) NOT NULL,
    score numeric NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL
);


ALTER TABLE public.qualifications OWNER TO deauvece;

--
-- Name: route_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE route_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.route_id_seq OWNER TO deauvece;

--
-- Name: route_stop; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE route_stop (
    id_route text,
    id_stop text,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now()
);


ALTER TABLE public.route_stop OWNER TO deauvece;

--
-- Name: routes; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE routes (
    id_route text DEFAULT ('R'::text || nextval('route_id_seq'::regclass)) NOT NULL,
    spots integer NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL,
    rand text NOT NULL
);


ALTER TABLE public.routes OWNER TO deauvece;

--
-- Name: stop_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE stop_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.stop_id_seq OWNER TO deauvece;

--
-- Name: stops; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE stops (
    id_stop text DEFAULT ('STOP'::text || nextval('stop_id_seq'::regclass)) NOT NULL,
    name text NOT NULL,
    description text DEFAULT 'No hay descripcion'::text,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now()
);


ALTER TABLE public.stops OWNER TO deauvece;

--
-- Name: transports; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE transports (
    license_plate text NOT NULL,
    model text NOT NULL,
    color text NOT NULL,
    spots text NOT NULL,
    air_conditioner boolean,
    wifi boolean,
    price numeric NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL
);


ALTER TABLE public.transports OWNER TO deauvece;

--
-- Name: university_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE university_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.university_id_seq OWNER TO deauvece;

--
-- Name: universities; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE universities (
    id_u text DEFAULT ('U'::text || nextval('university_id_seq'::regclass)) NOT NULL,
    name text NOT NULL,
    acronym text NOT NULL,
    city text NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now()
);


ALTER TABLE public.universities OWNER TO deauvece;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO deauvece;

--
-- Name: users; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE users (
    id_user text DEFAULT ('USR'::text || nextval('user_id_seq'::regclass)) NOT NULL,
    names text NOT NULL,
    last_names text NOT NULL,
    phone text NOT NULL,
    sex character(1) NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    is_driver boolean DEFAULT false,
    id_u text NOT NULL,
    is_admin boolean DEFAULT false,
    is_verified boolean DEFAULT false,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    profile_image text
);


ALTER TABLE public.users OWNER TO deauvece;

--
-- Name: usr_routes; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE usr_routes (
    id_user text,
    id_route text,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now()
);


ALTER TABLE public.usr_routes OWNER TO deauvece;

--
-- Name: way_id_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE way_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.way_id_seq OWNER TO deauvece;

--
-- Name: ways; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE ways (
    id_way text DEFAULT ('WAY'::text || nextval('way_id_seq'::regclass)) NOT NULL,
    hour text NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL,
    id_route text NOT NULL,
    spots text,
    touniversity text,
    comment text
);


ALTER TABLE public.ways OWNER TO deauvece;

--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('comment_id_seq', 1, true);


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY comments (id_comm, body, id_user, creation_date, edition_date, id_way) FROM stdin;
\.


--
-- Name: qualif_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('qualif_id_seq', 1, false);


--
-- Data for Name: qualifications; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY qualifications (id_qualif, score, creation_date, edition_date, id_user) FROM stdin;
\.


--
-- Name: route_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('route_id_seq', 6, true);


--
-- Data for Name: route_stop; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY route_stop (id_route, id_stop, creation_date, edition_date) FROM stdin;
R2	STOP1	2016-10-18 19:06:35.828091-05	2016-10-18 19:06:35.828091-05
R2	STOP14	2016-10-18 19:06:35.883638-05	2016-10-18 19:06:35.883638-05
R2	STOP35	2016-10-18 19:06:35.893701-05	2016-10-18 19:06:35.893701-05
R2	STOP4	2016-10-18 19:06:35.905617-05	2016-10-18 19:06:35.905617-05
R2	STOP2	2016-10-18 19:06:35.91683-05	2016-10-18 19:06:35.91683-05
R3	STOP30	2016-11-14 17:41:03.351663-05	2016-11-14 17:41:03.351663-05
R3	STOP3	2016-11-14 17:41:03.36295-05	2016-11-14 17:41:03.36295-05
R3	STOP14	2016-11-14 17:41:03.3738-05	2016-11-14 17:41:03.3738-05
R3	STOP13	2016-11-14 17:41:03.385035-05	2016-11-14 17:41:03.385035-05
R3	STOP2	2016-11-14 17:41:03.396458-05	2016-11-14 17:41:03.396458-05
R4	STOP31	2017-01-22 20:49:53.833546-05	2017-01-22 20:49:53.833546-05
R4	STOP3	2017-01-22 20:49:53.84438-05	2017-01-22 20:49:53.84438-05
R4	STOP1	2017-01-22 20:49:53.854621-05	2017-01-22 20:49:53.854621-05
R4	STOP14	2017-01-22 20:49:53.866015-05	2017-01-22 20:49:53.866015-05
R4	STOP15	2017-01-22 20:49:53.876828-05	2017-01-22 20:49:53.876828-05
R5	STOP15	2017-01-22 20:56:09.455352-05	2017-01-22 20:56:09.455352-05
R5	STOP5	2017-01-22 20:56:09.466554-05	2017-01-22 20:56:09.466554-05
R5	STOP7	2017-01-22 20:56:09.477689-05	2017-01-22 20:56:09.477689-05
R5	STOP14	2017-01-22 20:56:09.489213-05	2017-01-22 20:56:09.489213-05
R5	STOP2	2017-01-22 20:56:09.500039-05	2017-01-22 20:56:09.500039-05
R6	STOP21	2017-02-09 13:53:34.498365-05	2017-02-09 13:53:34.498365-05
R6	STOP37	2017-02-09 13:53:34.508345-05	2017-02-09 13:53:34.508345-05
R6	STOP12	2017-02-09 13:53:34.520865-05	2017-02-09 13:53:34.520865-05
R6	STOP28	2017-02-09 13:53:34.531839-05	2017-02-09 13:53:34.531839-05
R6	STOP2	2017-02-09 13:53:34.542643-05	2017-02-09 13:53:34.542643-05
\.


--
-- Data for Name: routes; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY routes (id_route, spots, creation_date, edition_date, id_user, rand) FROM stdin;
R2	4	2016-10-18 19:06:35.307153-05	2016-10-18 19:06:35.307153-05	USR12	qywDNxRmVj
R3	4	2016-11-14 17:41:02.723551-05	2016-11-14 17:41:02.723551-05	USR12	bxsmjPzbpZ
R4	2	2017-01-22 20:49:53.568456-05	2017-01-22 20:49:53.568456-05	USR12	XGKYNPXebr
R5	2	2017-01-22 20:56:09.4113-05	2017-01-22 20:56:09.4113-05	USR15	OuiwPErvGP
R6	2	2017-02-09 13:53:34.436121-05	2017-02-09 13:53:34.436121-05	USR16	TfeZoMPyaq
\.


--
-- Name: stop_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('stop_id_seq', 38, true);


--
-- Data for Name: stops; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY stops (id_stop, name, description, creation_date, edition_date) FROM stdin;
STOP1	CAÑAVERAL	No hay descripcion	2016-10-15 22:27:41.829978-05	2016-10-15 22:27:41.829978-05
STOP2	UIS	No hay descripcion	2016-10-15 22:27:51.17423-05	2016-10-15 22:27:51.17423-05
STOP3	PARALELA	No hay descripcion	2016-10-15 22:27:56.959152-05	2016-10-15 22:27:56.959152-05
STOP4	CRA 27	No hay descripcion	2016-10-15 22:28:08.273559-05	2016-10-15 22:28:08.273559-05
STOP5	CRA 33	No hay descripcion	2016-10-15 22:28:12.831283-05	2016-10-15 22:28:12.831283-05
STOP6	FOSUNAB	No hay descripcion	2016-10-15 22:28:21.824487-05	2016-10-15 22:28:21.824487-05
STOP7	PIEDECUESTA	No hay descripcion	2016-10-15 22:28:27.662047-05	2016-10-15 22:28:27.662047-05
STOP8	FLORIDA	No hay descripcion	2016-10-15 22:28:37.587469-05	2016-10-15 22:28:37.587469-05
STOP9	AUTOPISTA	No hay descripcion	2016-10-15 22:28:44.61465-05	2016-10-15 22:28:44.61465-05
STOP10	SAN ALONSO	No hay descripcion	2016-10-15 22:28:50.39351-05	2016-10-15 22:28:50.39351-05
STOP11	PARQUE SAN PIO	No hay descripcion	2016-10-15 22:28:59.230242-05	2016-10-15 22:28:59.230242-05
STOP12	PARQUE TURBAY		2016-10-15 22:29:07.638417-05	2016-10-15 22:29:07.638417-05
STOP13	TERRAZAS	No hay descripcion	2016-10-15 22:29:21.023342-05	2016-10-15 22:29:21.023342-05
STOP14	PROVENZA	No hay descripcion	2016-10-15 22:29:28.332353-05	2016-10-15 22:29:28.332353-05
STOP15	CACIQUE	No hay descripcion	2016-10-15 22:29:39.402764-05	2016-10-15 22:29:39.402764-05
STOP16	CRA 36	No hay descripcion	2016-10-15 22:29:48.666292-05	2016-10-15 22:29:48.666292-05
STOP17	CABECERA	No hay descripcion	2016-10-15 22:29:55.486195-05	2016-10-15 22:29:55.486195-05
STOP18	NIZA	No hay descripcion	2016-10-15 22:30:00.217846-05	2016-10-15 22:30:00.217846-05
STOP19	FATIMA	No hay descripcion	2016-10-15 22:30:08.029914-05	2016-10-15 22:30:08.029914-05
STOP20	MUTIS		2016-10-15 22:30:11.385744-05	2016-10-15 22:30:11.385744-05
STOP21	REAL DE MINAS	No hay descripcion	2016-10-15 22:30:22.566847-05	2016-10-15 22:30:22.566847-05
STOP22	GIRON	No hay descripcion	2016-10-15 22:31:56.146294-05	2016-10-15 22:31:56.146294-05
STOP23	PAYADOR	No hay descripcion	2016-10-15 22:32:12.679038-05	2016-10-15 22:32:12.679038-05
STOP24	LA FLORESTA	No hay descripcion	2016-10-15 22:32:17.410708-05	2016-10-15 22:32:17.410708-05
STOP25	ANILLO VIAL	No hay descripcion	2016-10-15 22:32:24.893103-05	2016-10-15 22:32:24.893103-05
STOP26	VERSALLES	No hay descripcion	2016-10-15 22:32:34.60009-05	2016-10-15 22:32:34.60009-05
STOP27	LAGOS DEL CACIQUE	No hay descripcion	2016-10-15 22:32:42.225195-05	2016-10-15 22:32:42.225195-05
STOP28	MEGA MALL	No hay descripcion	2016-10-15 22:32:48.700494-05	2016-10-15 22:32:48.700494-05
STOP29	CONUCOS	No hay descripcion	2016-10-15 22:32:52.514857-05	2016-10-15 22:32:52.514857-05
STOP30	PALOMITAS	No hay descripcion	2016-10-15 22:32:58.931741-05	2016-10-15 22:32:58.931741-05
STOP31	SAN AGUSTIN	No hay descripcion	2016-10-15 22:33:07.284851-05	2016-10-15 22:33:07.284851-05
STOP32	ZAPAMANGA	No hay descripcion	2016-10-15 22:33:11.752214-05	2016-10-15 22:33:11.752214-05
STOP33	LA CUMBRE	No hay descripcion	2016-10-15 22:33:19.684044-05	2016-10-15 22:33:19.684044-05
STOP34	LAGOS 3	No hay descripcion	2016-10-15 22:33:25.375465-05	2016-10-15 22:33:25.375465-05
STOP35	DIAMANTE	No hay descripcion	2016-10-15 22:33:41.969042-05	2016-10-15 22:33:41.969042-05
STOP36	CENTRO (DIAGONAL 15)	No hay descripcion	2016-10-15 22:34:39.821959-05	2016-10-15 22:34:39.821959-05
STOP37	LA ISLA	No hay descripcion	2016-10-15 22:34:52.99065-05	2016-10-15 22:34:52.99065-05
STOP38	ACROPOLIS	No hay descripcion	2016-10-15 22:35:05.479084-05	2016-10-15 22:35:05.479084-05
\.


--
-- Data for Name: transports; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY transports (license_plate, model, color, spots, air_conditioner, wifi, price, creation_date, edition_date, id_user) FROM stdin;
\.


--
-- Data for Name: universities; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY universities (id_u, name, acronym, city, creation_date, edition_date) FROM stdin;
U1	Universidad Industrial de Santander	UIS	Bucaramanga	2016-10-03 20:43:26.568113-05	2016-10-03 20:43:26.568113-05
U2	Universidad Autónoma de Bucaramanga	UNAB	Bucaramanga	2016-10-03 22:20:30.753478-05	2016-10-03 22:20:30.753478-05
\.


--
-- Name: university_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('university_id_seq', 2, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('user_id_seq', 16, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY users (id_user, names, last_names, phone, sex, email, password, is_driver, id_u, is_admin, is_verified, creation_date, edition_date, profile_image) FROM stdin;
USR15	Carlos Andres	Marquez	3186687123	M	marquez@gmail.com	$2y$10$AnIzW82TWMGywVN8x5Xl8OVnhO6USPgjRAQhW57y.Q/nZMnLTSupG	f	U1	t	f	2017-01-22 20:53:48.76822-05	2017-01-22 20:53:48.76822-05	../Imagenes/profileImages/upload/profile_USR15.jpeg
USR16	Sergio	Martinez	3183524852	M	sergio@gmail.com	$2y$10$1eneHrySGvCV7EPhf3ML9OxoNnVmJV8aSD3oKqQZ0t0ZwUXUPmVn.	f	U1	t	f	2017-02-09 13:52:09.641601-05	2017-02-09 13:52:09.641601-05	../Imagenes/profileImages/upload/profile_USR16.jpeg
USR12	Daniel	Vega	3183524052	M	deauvece@gmail.com	$2y$10$fvZKIDGDOkyNeqxTtNtjR.V3wr6iO0ESGbHRRG87uw9Srhz/Hh8eW	f	U1	t	f	2016-10-08 21:41:41.015576-05	2016-10-08 21:41:41.015576-05	../Imagenes/profileImages/upload/profile_USR12.jpeg
\.


--
-- Data for Name: usr_routes; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY usr_routes (id_user, id_route, creation_date, edition_date) FROM stdin;
USR12	R2	2016-10-18 19:06:35.772075-05	2016-10-18 19:06:35.772075-05
USR12	R3	2016-11-14 17:41:03.340624-05	2016-11-14 17:41:03.340624-05
USR12	R4	2017-01-22 20:49:53.692299-05	2017-01-22 20:49:53.692299-05
USR15	R5	2017-01-22 20:56:09.444341-05	2017-01-22 20:56:09.444341-05
USR16	R6	2017-02-09 13:53:34.48725-05	2017-02-09 13:53:34.48725-05
\.


--
-- Name: way_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('way_id_seq', 27, true);


--
-- Data for Name: ways; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY ways (id_way, hour, creation_date, edition_date, id_user, id_route, spots, touniversity, comment) FROM stdin;
WAY18		2017-02-09 13:47:16.319547-05	2017-02-09 13:47:16.319547-05	USR12	R2	2	false	Prueba del widget de la hora
WAY19		2017-02-09 13:48:02.712617-05	2017-02-09 13:48:02.712617-05	USR12	R3	4	true	el widget de lahora funciona pero toda cambiarle el atributoa la base de datosssssssssssssssssssssssssssssss
WAY20		2017-02-09 13:49:17.588754-05	2017-02-09 13:49:17.588754-05	USR15	R5	2	false	Salgo por la novena hasta real de minas
WAY21		2017-02-09 13:49:43.881293-05	2017-02-09 13:49:43.881293-05	USR15	R5	3	true	Esta plataforma es la mejor que he visto en mi vida, muy buena
WAY22		2017-02-09 13:50:02.359181-05	2017-02-09 13:50:02.359181-05	USR15	R5	3	false	Solo tengo esta ruta :(
WAY23		2017-02-09 13:50:32.892475-05	2017-02-09 13:50:32.892475-05	USR12	R2	3	false	yo tengo demasiadas rutas para ofrecer, todos los dias 
WAY24		2017-02-09 13:50:52.953973-05	2017-02-09 13:50:52.953973-05	USR12	R2	3	false	Se puede hacer mucho spam, toca controlar esto en la plataforma
WAY25		2017-02-09 13:51:19.16424-05	2017-02-09 13:51:19.16424-05	USR12	R4	2	false	Toca crear mas usuarios
WAY26		2017-02-09 14:06:59.590449-05	2017-02-09 14:06:59.590449-05	USR16	R6	3	false	asdasdasd
WAY27		2017-02-09 14:08:27.536104-05	2017-02-09 14:08:27.536104-05	USR16	R6	3	false	Ultima prueba
\.


--
-- Name: commets_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT commets_pkey PRIMARY KEY (id_comm);


--
-- Name: qualifications_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY qualifications
    ADD CONSTRAINT qualifications_pkey PRIMARY KEY (id_qualif);


--
-- Name: routes_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY routes
    ADD CONSTRAINT routes_pkey PRIMARY KEY (id_route);


--
-- Name: stops_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY stops
    ADD CONSTRAINT stops_pkey PRIMARY KEY (id_stop);


--
-- Name: transports_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY transports
    ADD CONSTRAINT transports_pkey PRIMARY KEY (license_plate);


--
-- Name: universities_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY universities
    ADD CONSTRAINT universities_pkey PRIMARY KEY (id_u);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- Name: ways_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_pkey PRIMARY KEY (id_way);


--
-- Name: comments_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: comments_id_way_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_id_way_fkey FOREIGN KEY (id_way) REFERENCES ways(id_way) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: qualifications_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY qualifications
    ADD CONSTRAINT qualifications_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: route_stop_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY route_stop
    ADD CONSTRAINT route_stop_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: route_stop_id_stop_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY route_stop
    ADD CONSTRAINT route_stop_id_stop_fkey FOREIGN KEY (id_stop) REFERENCES stops(id_stop) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: routes_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY routes
    ADD CONSTRAINT routes_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: transports_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY transports
    ADD CONSTRAINT transports_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_id_u_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_id_u_fkey FOREIGN KEY (id_u) REFERENCES universities(id_u) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usr_routes_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY usr_routes
    ADD CONSTRAINT usr_routes_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usr_routes_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY usr_routes
    ADD CONSTRAINT usr_routes_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ways_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ways_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: comments; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE comments FROM PUBLIC;
REVOKE ALL ON TABLE comments FROM deauvece;
GRANT ALL ON TABLE comments TO deauvece;


--
-- Name: qualifications; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE qualifications FROM PUBLIC;
REVOKE ALL ON TABLE qualifications FROM deauvece;
GRANT ALL ON TABLE qualifications TO deauvece;


--
-- Name: route_stop; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE route_stop FROM PUBLIC;
REVOKE ALL ON TABLE route_stop FROM deauvece;
GRANT ALL ON TABLE route_stop TO deauvece;


--
-- Name: routes; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE routes FROM PUBLIC;
REVOKE ALL ON TABLE routes FROM deauvece;
GRANT ALL ON TABLE routes TO deauvece;


--
-- Name: stops; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE stops FROM PUBLIC;
REVOKE ALL ON TABLE stops FROM deauvece;
GRANT ALL ON TABLE stops TO deauvece;


--
-- Name: transports; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE transports FROM PUBLIC;
REVOKE ALL ON TABLE transports FROM deauvece;
GRANT ALL ON TABLE transports TO deauvece;


--
-- Name: universities; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE universities FROM PUBLIC;
REVOKE ALL ON TABLE universities FROM deauvece;
GRANT ALL ON TABLE universities TO deauvece;


--
-- Name: users; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE users FROM PUBLIC;
REVOKE ALL ON TABLE users FROM deauvece;
GRANT ALL ON TABLE users TO deauvece;


--
-- Name: usr_routes; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE usr_routes FROM PUBLIC;
REVOKE ALL ON TABLE usr_routes FROM deauvece;
GRANT ALL ON TABLE usr_routes TO deauvece;


--
-- Name: ways; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE ways FROM PUBLIC;
REVOKE ALL ON TABLE ways FROM deauvece;
GRANT ALL ON TABLE ways TO deauvece;


--
-- PostgreSQL database dump complete
--

