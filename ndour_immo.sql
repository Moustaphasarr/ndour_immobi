--
-- PostgreSQL database dump
--

-- Dumped from database version 17.0
-- Dumped by pg_dump version 17.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: disponibilite; Type: DOMAIN; Schema: public; Owner: postgres
--

CREATE DOMAIN public.disponibilite AS character(12);


ALTER DOMAIN public.disponibilite OWNER TO postgres;

--
-- Name: domaine; Type: DOMAIN; Schema: public; Owner: postgres
--

CREATE DOMAIN public.domaine AS character(100);


ALTER DOMAIN public.domaine OWNER TO postgres;

--
-- Name: faisabilite; Type: DOMAIN; Schema: public; Owner: postgres
--

CREATE DOMAIN public.faisabilite AS character(14);


ALTER DOMAIN public.faisabilite OWNER TO postgres;

--
-- Name: statut; Type: DOMAIN; Schema: public; Owner: postgres
--

CREATE DOMAIN public.statut AS text;


ALTER DOMAIN public.statut OWNER TO postgres;

--
-- Name: statuts_mission; Type: DOMAIN; Schema: public; Owner: postgres
--

CREATE DOMAIN public.statuts_mission AS character(7);


ALTER DOMAIN public.statuts_mission OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: acompte; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acompte (
    id_acompte integer NOT NULL,
    montant numeric(10,2) NOT NULL
);


ALTER TABLE public.acompte OWNER TO postgres;

--
-- Name: acompte_id_acompte_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acompte_id_acompte_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.acompte_id_acompte_seq OWNER TO postgres;

--
-- Name: acompte_id_acompte_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acompte_id_acompte_seq OWNED BY public.acompte.id_acompte;


--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    numero_client text NOT NULL,
    nom_client_ text NOT NULL,
    prenom_client text NOT NULL,
    adresse text NOT NULL,
    email text NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: commercial_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commercial_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commercial_id_seq OWNER TO postgres;

--
-- Name: commercial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commercial (
    id_employe integer DEFAULT nextval('public.commercial_id_seq'::regclass) NOT NULL,
    nom_employe character(100) NOT NULL,
    prenom character(150) NOT NULL,
    domaine public.domaine NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.commercial OWNER TO postgres;

--
-- Name: conducteur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.conducteur_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.conducteur_id_seq OWNER TO postgres;

--
-- Name: conducteur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conducteur (
    id_employe integer DEFAULT nextval('public.conducteur_id_seq'::regclass) NOT NULL,
    nom_employe character(100) NOT NULL,
    prenom character(150) NOT NULL,
    domaine public.domaine NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.conducteur OWNER TO postgres;

--
-- Name: devis_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.devis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.devis_id_seq OWNER TO postgres;

--
-- Name: devis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.devis (
    id_devis integer DEFAULT nextval('public.devis_id_seq'::regclass) NOT NULL,
    id_projet integer NOT NULL,
    numero_client text NOT NULL,
    montant numeric(10,2) NOT NULL,
    statut public.statut NOT NULL,
    date_emission date NOT NULL,
    date_de_signature date
);


ALTER TABLE public.devis OWNER TO postgres;

--
-- Name: formulaire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.formulaire_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.formulaire_id_seq OWNER TO postgres;

--
-- Name: formulaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.formulaire (
    id_formulaire integer DEFAULT nextval('public.formulaire_id_seq'::regclass) NOT NULL,
    numero_client text NOT NULL,
    id_employe integer NOT NULL,
    budget numeric(10,2) NOT NULL,
    superficie numeric(10,2) NOT NULL,
    nombre_de_piece integer NOT NULL,
    date_remise date NOT NULL
);


ALTER TABLE public.formulaire OWNER TO postgres;

--
-- Name: metreur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.metreur_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.metreur_id_seq OWNER TO postgres;

--
-- Name: metreur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.metreur (
    id_employe integer DEFAULT nextval('public.metreur_id_seq'::regclass) NOT NULL,
    nom_employe character(100) NOT NULL,
    prenom character(150) NOT NULL,
    domaine public.domaine NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.metreur OWNER TO postgres;

--
-- Name: projet_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.projet_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.projet_id_seq OWNER TO postgres;

--
-- Name: projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projet (
    id_projet integer DEFAULT nextval('public.projet_id_seq'::regclass) NOT NULL,
    id_employe integer NOT NULL,
    com_id_employe integer NOT NULL,
    con_id_employe integer NOT NULL,
    met_id_employe integer NOT NULL,
    tec_id_employe integer NOT NULL,
    id_formulaire integer NOT NULL,
    statut public.statut NOT NULL,
    montant_estime double precision NOT NULL,
    avis_de_faisabilite public.faisabilite NOT NULL,
    duree_estimer date NOT NULL,
    id_terrain integer NOT NULL,
    date_de_lancement date NOT NULL
);


ALTER TABLE public.projet OWNER TO postgres;

--
-- Name: recoit_mission; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recoit_mission (
    id_projet integer NOT NULL,
    id_sous_traitant integer NOT NULL,
    statut_mission public.statuts_mission NOT NULL,
    date date NOT NULL,
    description_du_mission character(200) NOT NULL
);


ALTER TABLE public.recoit_mission OWNER TO postgres;

--
-- Name: secretaire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.secretaire_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.secretaire_id_seq OWNER TO postgres;

--
-- Name: secretaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.secretaire (
    id_employe integer DEFAULT nextval('public.secretaire_id_seq'::regclass) NOT NULL,
    nom_employe character(100) NOT NULL,
    prenom character(150) NOT NULL,
    domaine public.domaine NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.secretaire OWNER TO postgres;

--
-- Name: sous_traitant_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sous_traitant_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sous_traitant_id_seq OWNER TO postgres;

--
-- Name: sous_traitant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sous_traitant (
    id_sous_traitant integer DEFAULT nextval('public.sous_traitant_id_seq'::regclass) NOT NULL,
    nom text NOT NULL,
    domaine public.domaine NOT NULL,
    disponibilite public.disponibilite NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.sous_traitant OWNER TO postgres;

--
-- Name: technicien_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.technicien_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.technicien_id_seq OWNER TO postgres;

--
-- Name: technicien; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.technicien (
    id_employe integer DEFAULT nextval('public.technicien_id_seq'::regclass) NOT NULL,
    nom_employe character(100) NOT NULL,
    prenom character(150) NOT NULL,
    domaine public.domaine NOT NULL,
    telephone character(15) NOT NULL
);


ALTER TABLE public.technicien OWNER TO postgres;

--
-- Name: terrain_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.terrain_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.terrain_id_seq OWNER TO postgres;

--
-- Name: terrain; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.terrain (
    id_terrain integer DEFAULT nextval('public.terrain_id_seq'::regclass) NOT NULL,
    id_vendeur integer NOT NULL,
    localisation character(200) NOT NULL,
    prix numeric(8,2) NOT NULL,
    superficie2 numeric(10,2) NOT NULL
);


ALTER TABLE public.terrain OWNER TO postgres;

--
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilisateur (
    id integer NOT NULL,
    nom_utilisateur text NOT NULL,
    mot_de_passe text NOT NULL,
    role text NOT NULL,
    id_employe integer,
    CONSTRAINT utilisateur_role_check CHECK ((role = ANY (ARRAY['admin'::text, 'secretaire'::text, 'commercial'::text, 'technicien'::text, 'conducteur'::text, 'metreur'::text])))
);


ALTER TABLE public.utilisateur OWNER TO postgres;

--
-- Name: utilisateur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utilisateur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.utilisateur_id_seq OWNER TO postgres;

--
-- Name: utilisateur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utilisateur_id_seq OWNED BY public.utilisateur.id;


--
-- Name: vendeur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendeur_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vendeur_id_seq OWNER TO postgres;

--
-- Name: vendeur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendeur (
    id_vendeur integer DEFAULT nextval('public.vendeur_id_seq'::regclass) NOT NULL,
    nom text NOT NULL,
    contact bigint NOT NULL
);


ALTER TABLE public.vendeur OWNER TO postgres;

--
-- Name: verser; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.verser (
    id_employe integer NOT NULL,
    numero_client text NOT NULL,
    id_devis integer NOT NULL,
    id_acompte integer NOT NULL,
    date_de_versement date NOT NULL,
    montant numeric(10,2) NOT NULL
);


ALTER TABLE public.verser OWNER TO postgres;

--
-- Name: acompte id_acompte; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acompte ALTER COLUMN id_acompte SET DEFAULT nextval('public.acompte_id_acompte_seq'::regclass);


--
-- Name: utilisateur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id SET DEFAULT nextval('public.utilisateur_id_seq'::regclass);


--
-- Data for Name: acompte; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.acompte (id_acompte, montant) FROM stdin;
1	700000.00
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client (numero_client, nom_client_, prenom_client, adresse, email, telephone) FROM stdin;
CL001	DIOP	Moussa	Dakar	moussa@example.com	778889900      
CLI234	Badiane	Seny	Dakar-Diamaguene	Badiane@gmail.com	76 455 123     
CLI54	Bintou	Diop	MBao	Bintou@gmail.com	76 354 869     
CLI589	Mbeingue	Modou	Liberté 6	Modou@gmail.com	76 546 76 34   
\.


--
-- Data for Name: commercial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commercial (id_employe, nom_employe, prenom, domaine, telephone) FROM stdin;
1	SOW                                                                                                 	Fatou                                                                                                                                                 	Vente                                                                                               	771112233      
2	Ndiaye                                                                                              	Youssou                                                                                                                                               	commercial                                                                                          	78 253 65 32   
3	Diop                                                                                                	Moussa                                                                                                                                                	commercial                                                                                          	75 243 46 38   
\.


--
-- Data for Name: conducteur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.conducteur (id_employe, nom_employe, prenom, domaine, telephone) FROM stdin;
1	Ndao                                                                                                	Fatima zahra                                                                                                                                          	conducteur                                                                                          	76 535 98 74   
2	wade                                                                                                	Modou                                                                                                                                                 	conducteur                                                                                          	76 384 26 45   
\.


--
-- Data for Name: devis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.devis (id_devis, id_projet, numero_client, montant, statut, date_emission, date_de_signature) FROM stdin;
1	1	CLI234	700000.00	EN COUR	2025-07-23	2025-07-23
\.


--
-- Data for Name: formulaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.formulaire (id_formulaire, numero_client, id_employe, budget, superficie, nombre_de_piece, date_remise) FROM stdin;
1	CL001	1	20000000.00	250.00	4	2025-07-15
2	CLI234	2	300000.00	200.00	4	2025-07-21
\.


--
-- Data for Name: metreur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.metreur (id_employe, nom_employe, prenom, domaine, telephone) FROM stdin;
1	Sarr                                                                                                	Abdou                                                                                                                                                 	metreur                                                                                             	77 384 36 90   
2	sy                                                                                                  	Fallou                                                                                                                                                	metreur                                                                                             	76 453 09 76   
3	sy                                                                                                  	Fallou                                                                                                                                                	metreur                                                                                             	76 453 09 76   
\.


--
-- Data for Name: projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projet (id_projet, id_employe, com_id_employe, con_id_employe, met_id_employe, tec_id_employe, id_formulaire, statut, montant_estime, avis_de_faisabilite, duree_estimer, id_terrain, date_de_lancement) FROM stdin;
1	2	2	2	2	1	2	EN COUR	900000	Faisable      	2025-08-23	2	2025-07-23
2	2	1	1	2	2	2	EN COUR	90000	Faisable      	2025-10-10	2	2025-07-23
\.


--
-- Data for Name: recoit_mission; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.recoit_mission (id_projet, id_sous_traitant, statut_mission, date, description_du_mission) FROM stdin;
2	1	en cour	2025-07-24	il faudra mettre les ..                                                                                                                                                                                 
\.


--
-- Data for Name: secretaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.secretaire (id_employe, nom_employe, prenom, domaine, telephone) FROM stdin;
1	Sarr                                                                                                	Sokhna                                                                                                                                                	secretaire                                                                                          	77 022 98 64   
2	Ndiaye                                                                                              	Ahmed                                                                                                                                                 	secretaire                                                                                          	75 893 53 09   
\.


--
-- Data for Name: sous_traitant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sous_traitant (id_sous_traitant, nom, domaine, disponibilite, telephone) FROM stdin;
1	Rokhaya Diouf	electricite                                                                                         	disponible  	77 564 76 34   
2	Omar	maçonnerie                                                                                          	occupe      	78 353 26 65   
\.


--
-- Data for Name: technicien; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.technicien (id_employe, nom_employe, prenom, domaine, telephone) FROM stdin;
1	Diop                                                                                                	Khadim                                                                                                                                                	technicien                                                                                          	77 364 27 37   
2	Seck                                                                                                	Khel                                                                                                                                                  	technicien                                                                                          	78 464 38 67   
\.


--
-- Data for Name: terrain; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.terrain (id_terrain, id_vendeur, localisation, prix, superficie2) FROM stdin;
1	1	Face mbao                                                                                                                                                                                               	300000.00	200.00
2	1	Gualéle                                                                                                                                                                                                 	700000.00	1000.00
\.


--
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utilisateur (id, nom_utilisateur, mot_de_passe, role, id_employe) FROM stdin;
1	Ndour	$2y$10$wKzkX5weE/UZMR8q9QTZlO1OWQHUiEjfwnmpEqtq1Ju4If/KP47W6	admin	\N
3	Sokhna Sarr	$2y$10$jKXrIhtLHMSDTr8V.HQ.aedvThCAd7ByzGf.oN.VILsqY/832uzW2	secretaire	1
4	Youssou Ndiaye	$2y$10$zkj1VWrBoduPRdf9TQSfPe6cRG.jzZu6put7E9PQvalFvFLEJYUXK	commercial	2
5	Modou wade	$2y$10$bGOTafjG5gGj6xA38D3JROr.N00SemcMCSz9czSoVQo4k3X07snyi	conducteur	2
6	Bamba diop	$2y$10$NJE2T/2Y2XKvImEdbNSWWeEtdKSkB1H5uLHEvAkYUKI9p45vIHoc2	metreur	4
\.


--
-- Data for Name: vendeur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendeur (id_vendeur, nom, contact) FROM stdin;
1	Mbery Diagne	763647654
2	Moussa cissé	763639028
\.


--
-- Data for Name: verser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.verser (id_employe, numero_client, id_devis, id_acompte, date_de_versement, montant) FROM stdin;
1	CL001	1	1	2025-07-23	700000.00
\.


--
-- Name: acompte_id_acompte_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acompte_id_acompte_seq', 2, true);


--
-- Name: commercial_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commercial_id_seq', 3, true);


--
-- Name: conducteur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.conducteur_id_seq', 2, true);


--
-- Name: devis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.devis_id_seq', 1, true);


--
-- Name: formulaire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.formulaire_id_seq', 2, true);


--
-- Name: metreur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.metreur_id_seq', 3, true);


--
-- Name: projet_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projet_id_seq', 2, true);


--
-- Name: secretaire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.secretaire_id_seq', 2, true);


--
-- Name: sous_traitant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sous_traitant_id_seq', 2, true);


--
-- Name: technicien_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.technicien_id_seq', 2, true);


--
-- Name: terrain_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.terrain_id_seq', 2, true);


--
-- Name: utilisateur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utilisateur_id_seq', 6, true);


--
-- Name: vendeur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendeur_id_seq', 2, true);


--
-- Name: acompte pk_acompte; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acompte
    ADD CONSTRAINT pk_acompte PRIMARY KEY (id_acompte);


--
-- Name: client pk_client; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT pk_client PRIMARY KEY (numero_client);


--
-- Name: commercial pk_commercial; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commercial
    ADD CONSTRAINT pk_commercial PRIMARY KEY (id_employe);


--
-- Name: conducteur pk_conducteur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conducteur
    ADD CONSTRAINT pk_conducteur PRIMARY KEY (id_employe);


--
-- Name: devis pk_devis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devis
    ADD CONSTRAINT pk_devis PRIMARY KEY (id_devis);


--
-- Name: formulaire pk_formulaire; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulaire
    ADD CONSTRAINT pk_formulaire PRIMARY KEY (id_formulaire);


--
-- Name: metreur pk_metreur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metreur
    ADD CONSTRAINT pk_metreur PRIMARY KEY (id_employe);


--
-- Name: projet pk_projet; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT pk_projet PRIMARY KEY (id_projet);


--
-- Name: recoit_mission pk_recoit_mission; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recoit_mission
    ADD CONSTRAINT pk_recoit_mission PRIMARY KEY (id_projet, id_sous_traitant);


--
-- Name: secretaire pk_secretaire; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretaire
    ADD CONSTRAINT pk_secretaire PRIMARY KEY (id_employe);


--
-- Name: sous_traitant pk_sous_traitant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sous_traitant
    ADD CONSTRAINT pk_sous_traitant PRIMARY KEY (id_sous_traitant);


--
-- Name: technicien pk_technicien; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.technicien
    ADD CONSTRAINT pk_technicien PRIMARY KEY (id_employe);


--
-- Name: terrain pk_terrain; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terrain
    ADD CONSTRAINT pk_terrain PRIMARY KEY (id_terrain);


--
-- Name: vendeur pk_vendeur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendeur
    ADD CONSTRAINT pk_vendeur PRIMARY KEY (id_vendeur);


--
-- Name: verser pk_verser; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verser
    ADD CONSTRAINT pk_verser PRIMARY KEY (id_employe, numero_client, id_devis);


--
-- Name: utilisateur utilisateur_nom_utilisateur_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_nom_utilisateur_key UNIQUE (nom_utilisateur);


--
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id);


--
-- Name: devis fk_devis_produit_projet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devis
    ADD CONSTRAINT fk_devis_produit_projet FOREIGN KEY (id_projet) REFERENCES public.projet(id_projet) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: devis fk_devis_signe_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devis
    ADD CONSTRAINT fk_devis_signe_client FOREIGN KEY (numero_client) REFERENCES public.client(numero_client) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: formulaire fk_formulai_remet_commerci; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulaire
    ADD CONSTRAINT fk_formulai_remet_commerci FOREIGN KEY (id_employe) REFERENCES public.commercial(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: formulaire fk_formulai_soumettre_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulaire
    ADD CONSTRAINT fk_formulai_soumettre_client FOREIGN KEY (numero_client) REFERENCES public.client(numero_client) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_concerne_formulai; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_concerne_formulai FOREIGN KEY (id_formulaire) REFERENCES public.formulaire(id_formulaire) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_declanche_secretai; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_declanche_secretai FOREIGN KEY (id_employe) REFERENCES public.secretaire(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_estime__c_metreur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_estime__c_metreur FOREIGN KEY (met_id_employe) REFERENCES public.metreur(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_estime__d_conducte; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_estime__d_conducte FOREIGN KEY (con_id_employe) REFERENCES public.conducteur(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_etabli_commerci; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_etabli_commerci FOREIGN KEY (com_id_employe) REFERENCES public.commercial(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_evalue_technici; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_evalue_technici FOREIGN KEY (tec_id_employe) REFERENCES public.technicien(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: projet fk_projet_relation__terrain; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projet
    ADD CONSTRAINT fk_projet_relation__terrain FOREIGN KEY (id_terrain) REFERENCES public.terrain(id_terrain) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: recoit_mission fk_recoit_m_recoit_mi_projet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recoit_mission
    ADD CONSTRAINT fk_recoit_m_recoit_mi_projet FOREIGN KEY (id_projet) REFERENCES public.projet(id_projet) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: recoit_mission fk_recoit_m_recoit_mi_sous_tra; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recoit_mission
    ADD CONSTRAINT fk_recoit_m_recoit_mi_sous_tra FOREIGN KEY (id_sous_traitant) REFERENCES public.sous_traitant(id_sous_traitant) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: terrain fk_terrain_propose_vendeur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terrain
    ADD CONSTRAINT fk_terrain_propose_vendeur FOREIGN KEY (id_vendeur) REFERENCES public.vendeur(id_vendeur) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: verser fk_verser_verser2_client; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verser
    ADD CONSTRAINT fk_verser_verser2_client FOREIGN KEY (numero_client) REFERENCES public.client(numero_client) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: verser fk_verser_verser3_acompte; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verser
    ADD CONSTRAINT fk_verser_verser3_acompte FOREIGN KEY (id_acompte) REFERENCES public.acompte(id_acompte) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: verser fk_verser_verser5_devis; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verser
    ADD CONSTRAINT fk_verser_verser5_devis FOREIGN KEY (id_devis) REFERENCES public.devis(id_devis) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: verser fk_verser_verser_secretai; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verser
    ADD CONSTRAINT fk_verser_verser_secretai FOREIGN KEY (id_employe) REFERENCES public.secretaire(id_employe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

