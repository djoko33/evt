<?php
CREATE TABLE public.codification
(
		quad character varying(4) NOT NULL,
		libelle character varying(100),
		categorie character varying(100),
		libelle_court character varying(50),
		CONSTRAINT codification_pkey PRIMARY KEY (quad)
		)
		WITH (
				OIDS=FALSE
				);
		ALTER TABLE public.codification
		OWNER TO postgres;
?>

CREATE TABLE public.importcvt
(
  titre character varying(255),
  reference character varying(20) NOT NULL,
  createur character varying(100),
  date_creation character varying(50),
  date_cvt character varying(50),
  domaine character varying(50),
  sous_domaine character varying(50),
  famille character varying(50),
  pfi character varying(100),
  theme_visite character varying(255),
  nature character varying(50),
  systeme character varying(50),
  mp character varying(255),
  sp character varying(255),
  processus_metier character varying(255),
  section_emetteur character varying(255),
  section_concernee character varying(255),
  decouvert character varying(255),
  type_acteur character varying(255),
  nature_danger character varying(255),
  lieu character varying(255),
  categorie character varying(255),
  tranche character varying(50),
  etat_tranche character varying(255),
  accompagne character varying(255),
  classement character varying(255),
  suivi character varying(255),
  etat_circuit text,
  contenu text,
  ligne_defense character varying(255),
  commentaire text,
  url character varying(255),
  source character varying(255),
  emis_par character varying(255),
  num_visite character varying(50),
  service_concerne character varying(255),
  service_emetteur character varying(255),
  action text,
  CONSTRAINT importcvt_pkey PRIMARY KEY (reference),
  CONSTRAINT importcvt_reference_key UNIQUE (reference)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.importcvt
  OWNER TO postgres;

  
 CREATE TABLE public.cvt
(
  num integer NOT NULL,
  reference character varying(20),
  titre text,
  emetteur character varying(255),
  serv_emet character varying(50),
  sect_emet character varying(50),
  serv_conc character varying(50),
  sect_conc character varying(50),
  texte text,
  "dateCVT" date,
  codes text,
  sp character varying(255),
  "etatCVT" character varying(10),
  nature integer,
  action text,
  CONSTRAINT cvt_pkey PRIMARY KEY (num),
  CONSTRAINT cvt_reference_key UNIQUE (reference)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.cvt
  OWNER TO postgres;
 
CREATE TABLE public.spcvt
(
  reference character varying(20),
  sp character varying(10),
  emetteur character varying(100),
  serv_emet character varying(10),
  serv_conc character varying(10),
  datecvt date,
  nature integer,
  categorie integer,
  pfi integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.spcvt
  OWNER TO postgres;
  
CREATE TABLE public.pci
(
  reference character varying(20),
  datecvt date,
  serv_emet character varying(50),
  emetteur character varying(255),
  class character varying(20)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.pci
  OWNER TO postgres;