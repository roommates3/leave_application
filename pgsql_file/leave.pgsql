--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: admin; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    updationdate timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.admin OWNER TO dbuser;

--
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.admin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.admin_id_seq OWNER TO dbuser;

--
-- Name: admin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.admin_id_seq OWNED BY public.admin.id;


--
-- Name: department; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.department (
    id integer NOT NULL,
    deptname character varying(100) NOT NULL,
    deptshortname character varying(100) NOT NULL,
    did character varying(10)
);


ALTER TABLE public.department OWNER TO dbuser;

--
-- Name: department_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.department_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.department_id_seq OWNER TO dbuser;

--
-- Name: department_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.department_id_seq OWNED BY public.department.id;


--
-- Name: leavetable; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.leavetable (
    id integer NOT NULL,
    leavetype character varying(110) NOT NULL,
    todate character varying(120) NOT NULL,
    fromdate character varying(120) NOT NULL,
    description character varying(300) NOT NULL,
    postingdate timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    adminremark character varying(300),
    adminremarkdate character varying(120) DEFAULT NULL::character varying,
    status integer NOT NULL,
    isread integer NOT NULL,
    sid integer,
    noofdays character varying(10),
    prefromdate character varying,
    pretodate character varying,
    suffromdate character varying,
    suftodate character varying,
    prenoofdays character varying(10),
    sufnoofdays character varying(10),
    "position" character varying(50),
    classesmissed character varying(50),
    alt_arrangement character varying(50),
    stationleave character varying(5),
    fwdstatus integer
);


ALTER TABLE public.leavetable OWNER TO dbuser;

--
-- Name: leavetable_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.leavetable_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leavetable_id_seq OWNER TO dbuser;

--
-- Name: leavetable_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.leavetable_id_seq OWNED BY public.leavetable.id;


--
-- Name: leavetrack; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.leavetrack (
    id integer NOT NULL,
    cl character varying(500),
    scl character varying(20),
    ml character varying(10),
    sid integer NOT NULL,
    el integer
);


ALTER TABLE public.leavetrack OWNER TO dbuser;

--
-- Name: leavetrack_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.leavetrack_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leavetrack_id_seq OWNER TO dbuser;

--
-- Name: leavetrack_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.leavetrack_id_seq OWNED BY public.leavetrack.id;


--
-- Name: leavetype; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.leavetype (
    id integer NOT NULL,
    leavetype character varying(200) DEFAULT NULL::character varying,
    description character varying(500),
    creationdate timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    totalleaves integer
);


ALTER TABLE public.leavetype OWNER TO dbuser;

--
-- Name: leavetype_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.leavetype_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.leavetype_id_seq OWNER TO dbuser;

--
-- Name: leavetype_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.leavetype_id_seq OWNED BY public.leavetype.id;


--
-- Name: staff; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.staff (
    id integer NOT NULL,
    sid integer NOT NULL,
    name character varying(100) NOT NULL,
    gender character varying(100) NOT NULL,
    permanent_address character varying(200) NOT NULL,
    quarter_no character varying(30) NOT NULL,
    doj character varying(50) NOT NULL,
    designation character varying(200) NOT NULL,
    did character varying(50) NOT NULL,
    gmailid character varying(50) NOT NULL,
    password character varying(100) NOT NULL,
    phoneno character varying(20),
    pin character varying(20)
);


ALTER TABLE public.staff OWNER TO dbuser;

--
-- Name: staff_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.staff_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.staff_id_seq OWNER TO dbuser;

--
-- Name: staff_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.staff_id_seq OWNED BY public.staff.id;


--
-- Name: stationleave; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.stationleave (
    id integer NOT NULL,
    address character varying(500),
    pin character varying(20),
    todate character varying(10),
    daytime character varying(10),
    wef character varying(50),
    phoneno character varying(15)
);


ALTER TABLE public.stationleave OWNER TO dbuser;

--
-- Name: stationleave_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.stationleave_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.stationleave_id_seq OWNER TO dbuser;

--
-- Name: stationleave_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.stationleave_id_seq OWNED BY public.stationleave.id;


--
-- Name: admin id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.admin ALTER COLUMN id SET DEFAULT nextval('public.admin_id_seq'::regclass);


--
-- Name: department id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.department ALTER COLUMN id SET DEFAULT nextval('public.department_id_seq'::regclass);


--
-- Name: leavetable id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.leavetable ALTER COLUMN id SET DEFAULT nextval('public.leavetable_id_seq'::regclass);


--
-- Name: leavetrack id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.leavetrack ALTER COLUMN id SET DEFAULT nextval('public.leavetrack_id_seq'::regclass);


--
-- Name: leavetype id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.leavetype ALTER COLUMN id SET DEFAULT nextval('public.leavetype_id_seq'::regclass);


--
-- Name: staff id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.staff ALTER COLUMN id SET DEFAULT nextval('public.staff_id_seq'::regclass);


--
-- Name: stationleave id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.stationleave ALTER COLUMN id SET DEFAULT nextval('public.stationleave_id_seq'::regclass);


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.admin (id, username, password, updationdate) FROM stdin;
1	admin	5c428d8875d2948607f3e3fe134d71b4	2019-03-05 14:28:22.511983+05:30
\.


--
-- Data for Name: department; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.department (id, deptname, deptshortname, did) FROM stdin;
1	Computer Science & Engineering	CSE	1
2	Electronics & Communication Engineering	ECE	2
3	Humanities and Social Sciences	HSS	3
\.


--
-- Data for Name: leavetable; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.leavetable (id, leavetype, todate, fromdate, description, postingdate, adminremark, adminremarkdate, status, isread, sid, noofdays, prefromdate, pretodate, suffromdate, suftodate, prenoofdays, sufnoofdays, "position", classesmissed, alt_arrangement, stationleave, fwdstatus) FROM stdin;
5	Casual Leave	21 March, 2019	30 March, 2019	aszdhfjgkhjmnb	2019-03-16 20:17:56.936626+05:30	done	2019-03-16 20:19:26 	1	1	102	9	NULL	NULL	NULL	NULL	NULL	NULL	No	6	No	No	2
2	Maternity Leave	13 March, 2019	30 March, 2019	hjdbdes	2019-03-16 10:12:42.437268+05:30	qwert	2019-03-16 20:01:11 	2	1	102	17	NULL	NULL	NULL	NULL	NULL	NULL	No	7	No	No	3
3	Casual Leave	21 March, 2019	29 March, 2019	fever	2019-03-16 13:48:27.826551+05:30	\N	\N	0	1	104	8	NULL	NULL	NULL	NULL	NULL	NULL	No	5	No	No	0
4	Casual Leave	13 March, 2019	18 March, 2019	fire in house	2019-03-16 19:15:37.183286+05:30	no	2019-03-16 20:42:27 	2	1	102	5	13 March, 2019	15 March, 2019	NULL	NULL	2	NULL	No	3	No	No	3
1	Casual Leave	12 March, 2019	20 March, 2019	Sick	2019-03-11 22:45:36.557611+05:30	Done	2019-03-16 7:09:00 	1	1	101	8	NULL	NULL	NULL	NULL	NULL	NULL	No	5	No	No	2
\.


--
-- Data for Name: leavetrack; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.leavetrack (id, cl, scl, ml, sid, el) FROM stdin;
1	1	0	0	101	0
3	0	0	0	103	0
2	1	0	0	102	0
5	0	0	0	104	0
\.


--
-- Data for Name: leavetype; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.leavetype (id, leavetype, description, creationdate, totalleaves) FROM stdin;
1	Casual Leave	Government rules provide 12 days casual leave. Casual leave can not be carried over. Casual leave cannot be taken if the length of absence (including preﬁxed/sufﬁxed days) exceeds ﬁve days, for absence exceeding ﬁve days and for availing LTC, one must take earned leave.	2019-03-06 11:49:48.848926+05:30	12
2	Maternity Leave	something	2019-03-16 09:42:35.492339+05:30	60
\.


--
-- Data for Name: staff; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.staff (id, sid, name, gender, permanent_address, quarter_no, doj, designation, did, gmailid, password, phoneno, pin) FROM stdin;
2	102	Rohit	Male	Assam	A2	22 March, 2019	HOD	2	rohit.kesarwani9898@gmail.com	db3441c4cfd5e19d9198619098ff7772	789456132	795001
3	103	Raj	Male	Guwahati	A3	3 March, 2019	Director	3	r.raj@iiitmanipur.ac.in	7b6e71728536b88f3411b5592a5218b0	987654123	795002
5	104	Shrish	Male	Mirzapur	A5	22 March, 2019	Technical staff	3	shrishkumar@gmail.com	804b8e0c04f439071c89311de45dad50	789945245	854965
1	101	Hritik	Male	Uttar	A1	14 March, 2019	HOD	1	kumarhritik38@gmail.com	2e092e0be446e1eb97fc8fc6c59a66e8	789456123	785462
\.


--
-- Data for Name: stationleave; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.stationleave (id, address, pin, todate, daytime, wef, phoneno) FROM stdin;
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.admin_id_seq', 1, false);


--
-- Name: department_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.department_id_seq', 3, true);


--
-- Name: leavetable_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.leavetable_id_seq', 5, true);


--
-- Name: leavetrack_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.leavetrack_id_seq', 5, true);


--
-- Name: leavetype_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.leavetype_id_seq', 2, true);


--
-- Name: staff_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.staff_id_seq', 8, true);


--
-- Name: stationleave_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.stationleave_id_seq', 1, false);


--
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- Name: department department_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.department
    ADD CONSTRAINT department_pkey PRIMARY KEY (id);


--
-- Name: leavetable leavetable_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.leavetable
    ADD CONSTRAINT leavetable_pkey PRIMARY KEY (id);


--
-- Name: leavetype leavetype_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.leavetype
    ADD CONSTRAINT leavetype_pkey PRIMARY KEY (id);


--
-- Name: staff staff_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.staff
    ADD CONSTRAINT staff_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

