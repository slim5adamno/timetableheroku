--
-- PostgreSQL database dump
--

-- Dumped from database version 13beta3
-- Dumped by pg_dump version 13beta3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: allot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.allot (
    did integer,
    semester character varying,
    sid integer,
    tid integer,
    cno integer,
    timeslot character varying,
    day character varying
);


ALTER TABLE public.allot OWNER TO postgres;

--
-- Name: classroom; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.classroom (
    cno integer NOT NULL
);


ALTER TABLE public.classroom OWNER TO postgres;

--
-- Name: department; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.department (
    did integer NOT NULL,
    name character varying
);


ALTER TABLE public.department OWNER TO postgres;

--
-- Name: login; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.login (
    username character varying(50),
    password character varying(50)
);


ALTER TABLE public.login OWNER TO postgres;

--
-- Name: subjects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.subjects (
    sid integer NOT NULL,
    sname character varying,
    semester character varying,
    did integer
);


ALTER TABLE public.subjects OWNER TO postgres;

--
-- Name: teacher; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.teacher (
    tid integer NOT NULL,
    name character varying,
    designation character varying,
    contact character varying,
    email character varying,
    did integer
);


ALTER TABLE public.teacher OWNER TO postgres;

--
-- Name: timeslot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.timeslot (
    "time" character varying
);


ALTER TABLE public.timeslot OWNER TO postgres;

--
-- Data for Name: allot; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.allot (did, semester, sid, tid, cno, timeslot, day) FROM stdin;
\.


--
-- Data for Name: classroom; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.classroom (cno) FROM stdin;
\.


--
-- Data for Name: department; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.department (did, name) FROM stdin;
\.


--
-- Data for Name: login; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.login (username, password) FROM stdin;
admin	1221
\.


--
-- Data for Name: subjects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subjects (sid, sname, semester, did) FROM stdin;
\.


--
-- Data for Name: teacher; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.teacher (tid, name, designation, contact, email, did) FROM stdin;
\.


--
-- Data for Name: timeslot; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.timeslot ("time") FROM stdin;
7:30-10:30
11:00-11:50
11:50-12:40
12:40-1:30
1:50-2:40
2:40-5:00
\.


--
-- Name: classroom classroom_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.classroom
    ADD CONSTRAINT classroom_pkey PRIMARY KEY (cno);


--
-- Name: department department_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.department
    ADD CONSTRAINT department_pkey PRIMARY KEY (did);


--
-- Name: subjects subjects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subjects
    ADD CONSTRAINT subjects_pkey PRIMARY KEY (sid);


--
-- Name: teacher teacher_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.teacher
    ADD CONSTRAINT teacher_pkey PRIMARY KEY (tid);


--
-- Name: allot allot_did_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.allot
    ADD CONSTRAINT allot_did_fkey FOREIGN KEY (did) REFERENCES public.department(did);


--
-- Name: allot allot_sid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.allot
    ADD CONSTRAINT allot_sid_fkey FOREIGN KEY (sid) REFERENCES public.subjects(sid);


--
-- Name: allot allot_tid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.allot
    ADD CONSTRAINT allot_tid_fkey FOREIGN KEY (tid) REFERENCES public.teacher(tid);


--
-- Name: subjects subjects_did_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subjects
    ADD CONSTRAINT subjects_did_fkey FOREIGN KEY (did) REFERENCES public.department(did);


--
-- Name: teacher teacher_did_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.teacher
    ADD CONSTRAINT teacher_did_fkey FOREIGN KEY (did) REFERENCES public.department(did);


--
-- PostgreSQL database dump complete
--

