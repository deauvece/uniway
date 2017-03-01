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
    name_user text NOT NULL,
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
    edition_date timestamp with time zone DEFAULT now(),
    status text NOT NULL
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
-- Name: status_feed; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE status_feed (
    id_status text NOT NULL,
    random_string text NOT NULL,
    university text
);


ALTER TABLE public.status_feed OWNER TO deauvece;

--
-- Name: status_feed_id_status_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE status_feed_id_status_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.status_feed_id_status_seq OWNER TO deauvece;

--
-- Name: status_feed_id_status_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: deauvece
--

ALTER SEQUENCE status_feed_id_status_seq OWNED BY status_feed.id_status;


--
-- Name: status_feed_random_string_seq; Type: SEQUENCE; Schema: public; Owner: deauvece
--

CREATE SEQUENCE status_feed_random_string_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.status_feed_random_string_seq OWNER TO deauvece;

--
-- Name: status_feed_random_string_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: deauvece
--

ALTER SEQUENCE status_feed_random_string_seq OWNED BY status_feed.random_string;


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
    model text,
    air_conditioner boolean,
    wifi boolean,
    price numeric,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL,
    image text,
    type text
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
    sex character(1),
    email text NOT NULL,
    password text NOT NULL,
    is_driver boolean DEFAULT false,
    id_u text NOT NULL,
    is_admin boolean DEFAULT false,
    is_verified boolean DEFAULT false,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    profile_image text,
    phone_public boolean DEFAULT false,
    email_public boolean DEFAULT true,
    license_plate_public boolean DEFAULT false,
    status_way text DEFAULT false
);


ALTER TABLE public.users OWNER TO deauvece;

--
-- Name: COLUMN users.status_way; Type: COMMENT; Schema: public; Owner: deauvece
--

COMMENT ON COLUMN users.status_way IS 'false==inactive';


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
-- Name: usr_ways; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE usr_ways (
    id_user text,
    id_way text,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now()
);


ALTER TABLE public.usr_ways OWNER TO deauvece;

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
    comment text,
    id_u text NOT NULL,
    max_spots text
);


ALTER TABLE public.ways OWNER TO deauvece;

--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('comment_id_seq', 16, true);


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY comments (id_comm, body, name_user, creation_date, edition_date, id_way) FROM stdin;
COM2	Hola buenas tardes	Cesar	2017-02-28 11:35:44.74879-05	2017-02-28 11:35:44.74879-05	WAY61
COM3	Hola agus	Daniel 	2017-02-28 11:37:55.607496-05	2017-02-28 11:37:55.607496-05	WAY61
COM4	polvora	Daniel 	2017-02-28 11:39:51.431373-05	2017-02-28 11:39:51.431373-05	WAY61
COM5	hola que mas jajaja	Cesar	2017-02-28 11:40:19.394274-05	2017-02-28 11:40:19.394274-05	WAY61
COM6	uy sano casi me dejan, los odio, la calificacion maximo va  aser de 3 lol	  Sergio Andres 	2017-02-28 11:41:00.695019-05	2017-02-28 11:41:00.695019-05	WAY61
COM7	a hacer* srry	  Sergio Andres 	2017-02-28 11:41:12.669614-05	2017-02-28 11:41:12.669614-05	WAY61
COM8	aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaiiiuuuudaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa	  Sergio Andres 	2017-02-28 11:41:36.922932-05	2017-02-28 11:41:36.922932-05	WAY61
COM9	kyc perro	  Sergio Andres 	2017-02-28 11:44:30.912183-05	2017-02-28 11:44:30.912183-05	WAY61
COM10	a ser *	  Sergio Andres 	2017-02-28 11:47:55.079802-05	2017-02-28 11:47:55.079802-05	WAY61
COM11	jajaja sisas	  Sergio Andres 	2017-02-28 11:48:13.487012-05	2017-02-28 11:48:13.487012-05	WAY61
COM12	aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aa a aaaaaaaaaaaaaa aaa	Cesar	2017-02-28 11:53:17.649169-05	2017-02-28 11:53:17.649169-05	WAY61
COM13	AAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aa  a aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa a a a	Cesar	2017-02-28 11:53:34.779249-05	2017-02-28 11:53:34.779249-05	WAY61
COM14	aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa	Cesar	2017-02-28 11:57:41.760281-05	2017-02-28 11:57:41.760281-05	WAY61
COM15	holaaaaa hola hola hola	Cesar	2017-02-28 14:28:28.521897-05	2017-02-28 14:28:28.521897-05	WAY61
COM16	hola te pido cupo	Daniel 	2017-02-28 19:08:05.026874-05	2017-02-28 19:08:05.026874-05	WAY61
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

SELECT pg_catalog.setval('route_id_seq', 15, true);


--
-- Data for Name: route_stop; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY route_stop (id_route, id_stop, creation_date, edition_date, status) FROM stdin;
R9	STOP2	2017-02-14 18:40:56.740844-05	2017-02-14 18:40:56.740844-05	active
R9	STOP1	2017-02-14 18:40:56.978415-05	2017-02-14 18:40:56.978415-05	active
R9	STOP21	2017-02-14 18:40:56.99221-05	2017-02-14 18:40:56.99221-05	active
R9	STOP13	2017-02-14 18:40:57.003284-05	2017-02-14 18:40:57.003284-05	active
R9	STOP5	2017-02-14 18:40:57.013935-05	2017-02-14 18:40:57.013935-05	active
R13	STOP14	2017-02-18 19:12:38.269017-05	2017-02-18 19:12:38.269017-05	active
R13	STOP35	2017-02-18 19:12:38.323062-05	2017-02-18 19:12:38.323062-05	active
R13	STOP16	2017-02-18 19:12:38.334708-05	2017-02-18 19:12:38.334708-05	active
R13	STOP2	2017-02-18 19:12:38.344956-05	2017-02-18 19:12:38.344956-05	active
R12	STOP1	2017-02-15 10:31:11.032034-05	2017-02-15 10:31:11.032034-05	active
R12	STOP5	2017-02-15 10:31:11.041842-05	2017-02-15 10:31:11.041842-05	active
R12	STOP2	2017-02-15 10:31:11.05407-05	2017-02-15 10:31:11.05407-05	active
R8	STOP2	2017-02-14 18:30:34.108692-05	2017-02-14 18:30:34.108692-05	active
R8	STOP1	2017-02-14 18:30:34.120243-05	2017-02-14 18:30:34.120243-05	active
R8	STOP27	2017-02-14 18:30:34.130264-05	2017-02-14 18:30:34.130264-05	active
R8	STOP13	2017-02-14 18:30:34.141305-05	2017-02-14 18:30:34.141305-05	active
R8	STOP5	2017-02-14 18:30:34.153187-05	2017-02-14 18:30:34.153187-05	active
R14	STOP2	2017-02-18 19:14:26.950849-05	2017-02-18 19:14:26.950849-05	active
R14	STOP4	2017-02-18 19:14:26.960611-05	2017-02-18 19:14:26.960611-05	active
R14	STOP3	2017-02-18 19:14:26.971811-05	2017-02-18 19:14:26.971811-05	active
R14	STOP27	2017-02-18 19:14:26.982974-05	2017-02-18 19:14:26.982974-05	active
R14	STOP22	2017-02-18 19:14:26.995557-05	2017-02-18 19:14:26.995557-05	active
R10	STOP2	2017-02-14 20:22:12.61585-05	2017-02-14 20:22:12.61585-05	active
R10	STOP4	2017-02-14 20:22:12.626431-05	2017-02-14 20:22:12.626431-05	active
R10	STOP28	2017-02-14 20:22:12.63666-05	2017-02-14 20:22:12.63666-05	active
R10	STOP32	2017-02-14 20:22:12.649037-05	2017-02-14 20:22:12.649037-05	active
R10	STOP6	2017-02-14 20:22:12.65972-05	2017-02-14 20:22:12.65972-05	active
R15	STOP2	2017-02-19 13:40:55.397598-05	2017-02-19 13:40:55.397598-05	sleep
R15	STOP12	2017-02-19 13:40:55.453156-05	2017-02-19 13:40:55.453156-05	sleep
R15	STOP8	2017-02-19 13:40:55.464064-05	2017-02-19 13:40:55.464064-05	sleep
\.


--
-- Data for Name: routes; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY routes (id_route, spots, creation_date, edition_date, id_user, rand) FROM stdin;
R8	4	2017-02-14 18:30:34.045711-05	2017-02-14 18:30:34.045711-05	USR15	xofdEOqne3a7
R9	4	2017-02-14 18:40:56.577092-05	2017-02-14 18:40:56.577092-05	USR12	WLUFk5cGm8la
R10	4	2017-02-14 20:22:12.573188-05	2017-02-14 20:22:12.573188-05	USR16	XIkRKzvtowwy
R12	2	2017-02-15 10:31:10.989329-05	2017-02-15 10:31:10.989329-05	USR16	VRCYCgTjjjFs
R13	4	2017-02-18 19:12:37.570712-05	2017-02-18 19:12:37.570712-05	USR15	weDyLHWN27jI
R14	4	2017-02-18 19:14:26.903548-05	2017-02-18 19:14:26.903548-05	USR15	L7yr580udeAY
R15	4	2017-02-19 13:40:55.289658-05	2017-02-19 13:40:55.289658-05	USR12	C9wkltGfR5VO
\.


--
-- Data for Name: status_feed; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY status_feed (id_status, random_string, university) FROM stdin;
U2	37W9jvzSoyTv429lwA43	UNAB
U1	pjxGexO0yrHfcLsPs5dl	UIS
\.


--
-- Name: status_feed_id_status_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('status_feed_id_status_seq', 1, false);


--
-- Name: status_feed_random_string_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('status_feed_random_string_seq', 1, false);


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

COPY transports (license_plate, model, air_conditioner, wifi, price, creation_date, edition_date, id_user, image, type) FROM stdin;
CTE124	nissan 123	t	t	2000	2017-02-15 12:08:10.290535-05	2017-02-15 12:08:10.290535-05	USR16	../Imagenes/transportImages/transport_image_USR16.jpeg	Moto
ccc444	nissan 123	t	t	2000	2017-02-15 18:46:39.298514-05	2017-02-15 18:46:39.298514-05	USR15	../Imagenes/transportImages/transport_image_USR15.jpeg	Camioneta
fge123	nissan 123	t	f	2000	2017-02-18 19:21:04.855342-05	2017-02-18 19:21:04.855342-05	USR12	\N	Carro
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

SELECT pg_catalog.setval('user_id_seq', 18, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY users (id_user, names, last_names, phone, sex, email, password, is_driver, id_u, is_admin, is_verified, creation_date, edition_date, profile_image, phone_public, email_public, license_plate_public, status_way) FROM stdin;
USR17	Lizeth Paola	Parra B	3189875648	F	lizethparra@gmail.com	$2y$10$I0tq4.cYwq1Zx33KDlCgHeJliIUzX7UQyvyXlT9sJviNDgW1apSK.	f	U2	t	f	2017-02-16 17:50:41.331999-05	2017-02-16 17:50:41.331999-05	../Imagenes/profileImages/upload/perfil.png	f	t	f	false
USR16	  Sergio Andres 	Martinez Lizarazo	3183224822	M	sergio@gmail.com	$2y$10$1eneHrySGvCV7EPhf3ML9OxoNnVmJV8aSD3oKqQZ0t0ZwUXUPmVn.	t	U1	t	f	2017-02-09 13:52:09.641601-05	2017-02-09 13:52:09.641601-05	../Imagenes/profileImages/upload/profile_USR16.jpeg	f	t	f	true
USR12	Daniel 	Vega	3183524052	M	deauvece@gmail.com	$2y$10$fvZKIDGDOkyNeqxTtNtjR.V3wr6iO0ESGbHRRG87uw9Srhz/Hh8eW	t	U1	t	f	2016-10-08 21:41:41.015576-05	2016-10-08 21:41:41.015576-05	../Imagenes/profileImages/upload/profile_USR12.jpeg	f	f	f	true
USR15	Carlos Andres    	Marquez Rodrigez	3186687123	M	marquez@gmail.com	$2y$10$AnIzW82TWMGywVN8x5Xl8OVnhO6USPgjRAQhW57y.Q/nZMnLTSupG	t	U1	t	f	2017-01-22 20:53:48.76822-05	2017-01-22 20:53:48.76822-05	../Imagenes/profileImages/upload/profile_USR15.jpeg	f	f	f	true
USR18	Cesar	Herrera	3189475842	\N	cesar@gmail.com	$2y$10$/vf0BK.ZdoP2cuNrsmzsk.b9hSIm.VbSUOk1VaiGWxaU0h1J3L.hC	f	U1	t	f	2017-02-27 23:00:47.186732-05	2017-02-27 23:00:47.186732-05	../Imagenes/profileImages/upload/perfil.png	f	t	f	true
\.


--
-- Data for Name: usr_routes; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY usr_routes (id_user, id_route, creation_date, edition_date) FROM stdin;
USR15	R8	2017-02-14 18:30:34.097068-05	2017-02-14 18:30:34.097068-05
USR12	R9	2017-02-14 18:40:56.627143-05	2017-02-14 18:40:56.627143-05
USR16	R10	2017-02-14 20:22:12.603445-05	2017-02-14 20:22:12.603445-05
USR16	R12	2017-02-15 10:31:11.020891-05	2017-02-15 10:31:11.020891-05
USR15	R13	2017-02-18 19:12:38.256658-05	2017-02-18 19:12:38.256658-05
USR15	R14	2017-02-18 19:14:26.938798-05	2017-02-18 19:14:26.938798-05
USR12	R15	2017-02-19 13:40:55.342198-05	2017-02-19 13:40:55.342198-05
\.


--
-- Data for Name: usr_ways; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY usr_ways (id_user, id_way, creation_date, edition_date) FROM stdin;
USR12	WAY61	2017-02-26 11:33:12.777079-05	2017-02-26 11:33:12.777079-05
USR15	WAY62	2017-02-28 10:34:40.675088-05	2017-02-28 10:34:40.675088-05
USR18	WAY61	2017-02-28 10:36:20.730941-05	2017-02-28 10:36:20.730941-05
\.


--
-- Name: way_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('way_id_seq', 63, true);


--
-- Data for Name: ways; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY ways (id_way, hour, creation_date, edition_date, id_user, id_route, spots, touniversity, comment, id_u, max_spots) FROM stdin;
WAY62	12:21 AM	2017-02-28 10:34:40.485911-05	2017-02-28 10:34:40.485911-05	USR15	R13	4	true	Hola, prieba numero 3 lol lml	U1	4
WAY61	6:04 AM	2017-02-26 11:33:12.721091-05	2017-02-26 11:33:12.721091-05	USR12	R9	2	false	haoplalfa prueba numero dos	U1	4
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
-- Name: status_feed_pkey; Type: CONSTRAINT; Schema: public; Owner: deauvece; Tablespace: 
--

ALTER TABLE ONLY status_feed
    ADD CONSTRAINT status_feed_pkey PRIMARY KEY (id_status);


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
-- Name: usr_ways_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY usr_ways
    ADD CONSTRAINT usr_ways_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usr_ways_id_way_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY usr_ways
    ADD CONSTRAINT usr_ways_id_way_fkey FOREIGN KEY (id_way) REFERENCES ways(id_way) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ways_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ways_id_u_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_id_u_fkey FOREIGN KEY (id_u) REFERENCES universities(id_u) ON UPDATE CASCADE ON DELETE CASCADE;


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

