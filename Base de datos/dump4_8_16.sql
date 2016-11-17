--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

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

--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('comment_id_seq', 1, true);


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
-- Name: qualif_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('qualif_id_seq', 1, false);


--
-- Name: qualifications; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE qualifications (
    id_qualif text DEFAULT ('QUALIF'::text || nextval('qualif_id_seq'::regclass)) NOT NULL,
    score numeric NOT NULL,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL,
    id_driver text NOT NULL
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
-- Name: route_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('route_id_seq', 1, false);


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
    edition_date timestamp with time zone DEFAULT now()
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
-- Name: stop_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('stop_id_seq', 1, false);


--
-- Name: stops; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE stops (
    id_stop text DEFAULT ('STOP'::text || nextval('stop_id_seq'::regclass)) NOT NULL,
    name text NOT NULL,
    description text,
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
-- Name: university_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('university_id_seq', 2, true);


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
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('user_id_seq', 3, true);


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
    edition_date timestamp with time zone DEFAULT now()
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
-- Name: way_id_seq; Type: SEQUENCE SET; Schema: public; Owner: deauvece
--

SELECT pg_catalog.setval('way_id_seq', 1, false);


--
-- Name: ways; Type: TABLE; Schema: public; Owner: deauvece; Tablespace: 
--

CREATE TABLE ways (
    id_way text DEFAULT ('WAY'::text || nextval('way_id_seq'::regclass)) NOT NULL,
    hour time with time zone NOT NULL,
    date date,
    creation_date timestamp with time zone DEFAULT now(),
    edition_date timestamp with time zone DEFAULT now(),
    id_user text NOT NULL,
    id_route text NOT NULL
);


ALTER TABLE public.ways OWNER TO deauvece;

--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY comments (id_comm, body, id_user, creation_date, edition_date, id_way) FROM stdin;
\.


--
-- Data for Name: qualifications; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY qualifications (id_qualif, score, creation_date, edition_date, id_user, id_driver) FROM stdin;
\.


--
-- Data for Name: route_stop; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY route_stop (id_route, id_stop, creation_date, edition_date) FROM stdin;
\.


--
-- Data for Name: routes; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY routes (id_route, spots, creation_date, edition_date) FROM stdin;
\.


--
-- Data for Name: stops; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY stops (id_stop, name, description, creation_date, edition_date) FROM stdin;
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
U1	Universidad Industrial de Santander	UIS	Bucaramanga	2016-10-03 18:43:26.568113-07	2016-10-03 18:43:26.568113-07
U2	Universidad Autónoma de Bucaramanga	UNAB	Bucaramanga	2016-10-03 20:20:30.753478-07	2016-10-03 20:20:30.753478-07
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY users (id_user, names, last_names, phone, sex, email, password, is_driver, id_u, is_admin, is_verified, creation_date, edition_date) FROM stdin;
USR1	Daniel	Vega	3183524053	M	deauvece@gmail.com	deauvece	t	U1	t	t	2016-10-03 18:43:26.568113-07	2016-10-03 18:43:26.568113-07
USR2	Sergio	Martinez	3123858680	M	sermali95@gmail.com	sergio	t	U1	t	f	2016-10-03 18:43:26.568113-07	2016-10-03 18:43:26.568113-07
USR3	Nicolas	Villamizar	3133333333	M	userTest@hotmail.com	userTest	t	U2	f	f	2016-10-03 20:22:19.40048-07	2016-10-03 20:22:19.40048-07
\.


--
-- Data for Name: usr_routes; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY usr_routes (id_user, id_route, creation_date, edition_date) FROM stdin;
\.


--
-- Data for Name: ways; Type: TABLE DATA; Schema: public; Owner: deauvece
--

COPY ways (id_way, hour, date, creation_date, edition_date, id_user, id_route) FROM stdin;
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
-- Name: comments_id_way_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_id_way_fkey FOREIGN KEY (id_way) REFERENCES ways(id_way);


--
-- Name: commets_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT commets_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- Name: qualifications_id_driver_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY qualifications
    ADD CONSTRAINT qualifications_id_driver_fkey FOREIGN KEY (id_driver) REFERENCES users(id_user);


--
-- Name: qualifications_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY qualifications
    ADD CONSTRAINT qualifications_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- Name: route_stop_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY route_stop
    ADD CONSTRAINT route_stop_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route);


--
-- Name: route_stop_id_stop_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY route_stop
    ADD CONSTRAINT route_stop_id_stop_fkey FOREIGN KEY (id_stop) REFERENCES stops(id_stop);


--
-- Name: transports_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY transports
    ADD CONSTRAINT transports_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- Name: users_id_u_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_id_u_fkey FOREIGN KEY (id_u) REFERENCES universities(id_u);


--
-- Name: usr_routes_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY usr_routes
    ADD CONSTRAINT usr_routes_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route);


--
-- Name: usr_routes_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY usr_routes
    ADD CONSTRAINT usr_routes_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


--
-- Name: ways_id_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_id_route_fkey FOREIGN KEY (id_route) REFERENCES routes(id_route);


--
-- Name: ways_id_user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: deauvece
--

ALTER TABLE ONLY ways
    ADD CONSTRAINT ways_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id_user);


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
GRANT ALL ON TABLE comments TO deauvece_uniway;


--
-- Name: qualifications; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE qualifications FROM PUBLIC;
REVOKE ALL ON TABLE qualifications FROM deauvece;
GRANT ALL ON TABLE qualifications TO deauvece;
GRANT ALL ON TABLE qualifications TO deauvece_uniway;


--
-- Name: route_stop; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE route_stop FROM PUBLIC;
REVOKE ALL ON TABLE route_stop FROM deauvece;
GRANT ALL ON TABLE route_stop TO deauvece;
GRANT ALL ON TABLE route_stop TO deauvece_uniway;


--
-- Name: routes; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE routes FROM PUBLIC;
REVOKE ALL ON TABLE routes FROM deauvece;
GRANT ALL ON TABLE routes TO deauvece;
GRANT ALL ON TABLE routes TO deauvece_uniway;


--
-- Name: stops; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE stops FROM PUBLIC;
REVOKE ALL ON TABLE stops FROM deauvece;
GRANT ALL ON TABLE stops TO deauvece;
GRANT ALL ON TABLE stops TO deauvece_uniway;


--
-- Name: transports; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE transports FROM PUBLIC;
REVOKE ALL ON TABLE transports FROM deauvece;
GRANT ALL ON TABLE transports TO deauvece;
GRANT ALL ON TABLE transports TO deauvece_uniway;


--
-- Name: universities; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE universities FROM PUBLIC;
REVOKE ALL ON TABLE universities FROM deauvece;
GRANT ALL ON TABLE universities TO deauvece;
GRANT ALL ON TABLE universities TO deauvece_uniway;


--
-- Name: users; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE users FROM PUBLIC;
REVOKE ALL ON TABLE users FROM deauvece;
GRANT ALL ON TABLE users TO deauvece;
GRANT ALL ON TABLE users TO deauvece_uniway;


--
-- Name: usr_routes; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE usr_routes FROM PUBLIC;
REVOKE ALL ON TABLE usr_routes FROM deauvece;
GRANT ALL ON TABLE usr_routes TO deauvece;
GRANT ALL ON TABLE usr_routes TO deauvece_uniway;


--
-- Name: ways; Type: ACL; Schema: public; Owner: deauvece
--

REVOKE ALL ON TABLE ways FROM PUBLIC;
REVOKE ALL ON TABLE ways FROM deauvece;
GRANT ALL ON TABLE ways TO deauvece;
GRANT ALL ON TABLE ways TO deauvece_uniway;


--
-- PostgreSQL database dump complete
--

