--
-- PostgreSQL database dump
--

-- Dumped from database version 10.5
-- Dumped by pg_dump version 10.5

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
-- Name: acoes_corretivas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acoes_corretivas (
    id bigint NOT NULL,
    nome character varying(255),
    descricao character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    ativo integer,
    tempo character varying(10)
);


ALTER TABLE public.acoes_corretivas OWNER TO postgres;

--
-- Name: acoes_corretivas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acoes_corretivas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acoes_corretivas_id_seq OWNER TO postgres;

--
-- Name: acoes_corretivas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acoes_corretivas_id_seq OWNED BY public.acoes_corretivas.id;


--
-- Name: acoes_naoconformidades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acoes_naoconformidades (
    id bigint NOT NULL,
    id_acoescorretivas integer,
    id_naoconformidade integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.acoes_naoconformidades OWNER TO postgres;

--
-- Name: acoes_naoconformidades_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acoes_naoconformidades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acoes_naoconformidades_id_seq OWNER TO postgres;

--
-- Name: acoes_naoconformidades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acoes_naoconformidades_id_seq OWNED BY public.acoes_naoconformidades.id;


--
-- Name: auditorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditorias (
    id bigint NOT NULL,
    id_processos integer,
    id_users integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    id_setors bigint
);


ALTER TABLE public.auditorias OWNER TO postgres;

--
-- Name: auditoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auditoria_id_seq OWNER TO postgres;

--
-- Name: auditoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoria_id_seq OWNED BY public.auditorias.id;


--
-- Name: autorizacaos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.autorizacaos (
    id bigint NOT NULL,
    id_papels integer,
    id_setors integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.autorizacaos OWNER TO postgres;

--
-- Name: autorizacao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.autorizacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.autorizacao_id_seq OWNER TO postgres;

--
-- Name: autorizacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.autorizacao_id_seq OWNED BY public.autorizacaos.id;


--
-- Name: cidades; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.cidades (
    id integer NOT NULL,
    nome character varying(120) NOT NULL,
    id_estado integer NOT NULL
);


ALTER TABLE public.cidades OWNER TO sysdba;

--
-- Name: cidades_id_seq; Type: SEQUENCE; Schema: public; Owner: sysdba
--

CREATE SEQUENCE public.cidades_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cidades_id_seq OWNER TO sysdba;

--
-- Name: cidades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sysdba
--

ALTER SEQUENCE public.cidades_id_seq OWNED BY public.cidades.id;


--
-- Name: empresas; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.empresas (
    id integer NOT NULL,
    razao_social character varying(255) NOT NULL,
    fantasia character varying(255),
    cnpj numeric(14,0) NOT NULL,
    inscricao_estadual numeric(10,0),
    cep numeric(8,0),
    endereco character varying(255),
    numero integer,
    bairro character varying(255),
    municipio integer,
    uf integer,
    segmento character varying(50),
    dominio character varying(255),
    db_database character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    ativo integer NOT NULL
);


ALTER TABLE public.empresas OWNER TO sysdba;

--
-- Name: empresas_id_seq; Type: SEQUENCE; Schema: public; Owner: sysdba
--

CREATE SEQUENCE public.empresas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.empresas_id_seq OWNER TO sysdba;

--
-- Name: empresas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sysdba
--

ALTER SEQUENCE public.empresas_id_seq OWNED BY public.empresas.id;


--
-- Name: estados; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.estados (
    id integer NOT NULL,
    nome character varying(75) NOT NULL,
    uf character varying(5) NOT NULL,
    id_pais integer
);


ALTER TABLE public.estados OWNER TO sysdba;

--
-- Name: estados_id_seq; Type: SEQUENCE; Schema: public; Owner: sysdba
--

CREATE SEQUENCE public.estados_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estados_id_seq OWNER TO sysdba;

--
-- Name: estados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sysdba
--

ALTER SEQUENCE public.estados_id_seq OWNED BY public.estados.id;


--
-- Name: fichas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fichas (
    id bigint NOT NULL,
    id_itens integer,
    id_auditorias integer,
    conforme integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    reaudita integer
);


ALTER TABLE public.fichas OWNER TO postgres;

--
-- Name: itens_temperaturas_id_seq; Type: SEQUENCE; Schema: public; Owner: sysdba
--

CREATE SEQUENCE public.itens_temperaturas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.itens_temperaturas_id_seq OWNER TO sysdba;

--
-- Name: fichas_temperaturas; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.fichas_temperaturas (
    id bigint DEFAULT nextval('public.itens_temperaturas_id_seq'::regclass) NOT NULL,
    temperatura_painel real,
    temperatura_aferida real,
    reaudita integer,
    conforme integer,
    id_itens integer NOT NULL,
    id_auditorias integer NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.fichas_temperaturas OWNER TO sysdba;

--
-- Name: funcionarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.funcionarios (
    id bigint NOT NULL,
    nome character varying(255),
    ativo integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    cpf character varying(50)
);


ALTER TABLE public.funcionarios OWNER TO postgres;

--
-- Name: funcionarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.funcionarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.funcionarios_id_seq OWNER TO postgres;

--
-- Name: funcionarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.funcionarios_id_seq OWNED BY public.funcionarios.id;


--
-- Name: itens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.itens (
    ativo integer,
    id bigint NOT NULL,
    nome character varying(255),
    processos_setor_id integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.itens OWNER TO postgres;

--
-- Name: itens_auditoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.itens_auditoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.itens_auditoria_id_seq OWNER TO postgres;

--
-- Name: itens_auditoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.itens_auditoria_id_seq OWNED BY public.fichas.id;


--
-- Name: itens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.itens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.itens_id_seq OWNER TO postgres;

--
-- Name: itens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.itens_id_seq OWNED BY public.itens.id;


--
-- Name: itens_temperaturas; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.itens_temperaturas (
    id bigint DEFAULT nextval('public.itens_temperaturas_id_seq'::regclass) NOT NULL,
    nome character varying NOT NULL,
    temperatura_minima real,
    temperatura_maxima real,
    processo_setor_id integer NOT NULL,
    ativo integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.itens_temperaturas OWNER TO sysdba;

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: naos_conformidades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.naos_conformidades (
    id bigint NOT NULL,
    descricao character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    ativo integer,
    nome character varying(255)
);


ALTER TABLE public.naos_conformidades OWNER TO postgres;

--
-- Name: naos_conformidades_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.naos_conformidades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.naos_conformidades_id_seq OWNER TO postgres;

--
-- Name: naos_conformidades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.naos_conformidades_id_seq OWNED BY public.naos_conformidades.id;


--
-- Name: naosconformidades_itens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.naosconformidades_itens (
    id_naoconformidades integer,
    id bigint NOT NULL,
    id_fichas integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    id_acaocorretivaitens integer,
    id_funcionarios integer,
    observacoes character varying(255),
    "statusC" integer,
    "statusNC" integer,
    prazo character varying(10),
    id_fichas_temperatura integer
);


ALTER TABLE public.naosconformidades_itens OWNER TO postgres;

--
-- Name: naos_conformidades_itens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.naos_conformidades_itens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.naos_conformidades_itens_id_seq OWNER TO postgres;

--
-- Name: naos_conformidades_itens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.naos_conformidades_itens_id_seq OWNED BY public.naosconformidades_itens.id;


--
-- Name: nc_itens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nc_itens (
    id_itens integer,
    id_ncitens integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    id bigint NOT NULL
);


ALTER TABLE public.nc_itens OWNER TO postgres;

--
-- Name: nc_itens_temps_id_seq; Type: SEQUENCE; Schema: public; Owner: sysdba
--

CREATE SEQUENCE public.nc_itens_temps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nc_itens_temps_id_seq OWNER TO sysdba;

--
-- Name: nc_itens_temps; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.nc_itens_temps (
    id bigint DEFAULT nextval('public.nc_itens_temps_id_seq'::regclass) NOT NULL,
    id_itens_temperatura bigint,
    id_ncitens bigint,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.nc_itens_temps OWNER TO sysdba;

--
-- Name: ncitens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ncitens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ncitens_id_seq OWNER TO postgres;

--
-- Name: ncitens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ncitens_id_seq OWNED BY public.nc_itens.id;


--
-- Name: oauth_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_access_tokens (
    id character varying(100) NOT NULL,
    user_id integer,
    client_id integer NOT NULL,
    name character varying(255),
    scopes text,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_access_tokens OWNER TO postgres;

--
-- Name: oauth_auth_codes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_auth_codes (
    id character varying(100) NOT NULL,
    user_id integer NOT NULL,
    client_id integer NOT NULL,
    scopes text,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_auth_codes OWNER TO postgres;

--
-- Name: oauth_clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_clients (
    id integer NOT NULL,
    user_id integer,
    name character varying(255) NOT NULL,
    secret character varying(100) NOT NULL,
    redirect text NOT NULL,
    personal_access_client boolean NOT NULL,
    password_client boolean NOT NULL,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_clients OWNER TO postgres;

--
-- Name: oauth_clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.oauth_clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.oauth_clients_id_seq OWNER TO postgres;

--
-- Name: oauth_clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.oauth_clients_id_seq OWNED BY public.oauth_clients.id;


--
-- Name: oauth_personal_access_clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_personal_access_clients (
    id integer NOT NULL,
    client_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_personal_access_clients OWNER TO postgres;

--
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.oauth_personal_access_clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.oauth_personal_access_clients_id_seq OWNER TO postgres;

--
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.oauth_personal_access_clients_id_seq OWNED BY public.oauth_personal_access_clients.id;


--
-- Name: oauth_refresh_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oauth_refresh_tokens (
    id character varying(100) NOT NULL,
    access_token_id character varying(100) NOT NULL,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);


ALTER TABLE public.oauth_refresh_tokens OWNER TO postgres;

--
-- Name: paises; Type: TABLE; Schema: public; Owner: sysdba
--

CREATE TABLE public.paises (
    id integer NOT NULL,
    nome character varying(60) NOT NULL,
    sigla character varying(10) NOT NULL
);


ALTER TABLE public.paises OWNER TO sysdba;

--
-- Name: paises_id_seq; Type: SEQUENCE; Schema: public; Owner: sysdba
--

CREATE SEQUENCE public.paises_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paises_id_seq OWNER TO sysdba;

--
-- Name: paises_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sysdba
--

ALTER SEQUENCE public.paises_id_seq OWNED BY public.paises.id;


--
-- Name: papels; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.papels (
    id bigint NOT NULL,
    nome character varying(255),
    ativo integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.papels OWNER TO postgres;

--
-- Name: papel_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.papel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.papel_id_seq OWNER TO postgres;

--
-- Name: papel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.papel_id_seq OWNED BY public.papels.id;


--
-- Name: papels_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.papels_users (
    id bigint NOT NULL,
    id_users integer,
    id_papels integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.papels_users OWNER TO postgres;

--
-- Name: papels_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.papels_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.papels_users_id_seq OWNER TO postgres;

--
-- Name: papels_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.papels_users_id_seq OWNED BY public.papels_users.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: permissoes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissoes (
    id bigint NOT NULL,
    descricao character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.permissoes OWNER TO postgres;

--
-- Name: permissoes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissoes_id_seq OWNER TO postgres;

--
-- Name: permissoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissoes_id_seq OWNED BY public.permissoes.id;


--
-- Name: permissoes_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissoes_users (
    id bigint NOT NULL,
    id_users integer,
    id_permissoes integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.permissoes_users OWNER TO postgres;

--
-- Name: permissoes_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissoes_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissoes_users_id_seq OWNER TO postgres;

--
-- Name: permissoes_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissoes_users_id_seq OWNED BY public.permissoes_users.id;


--
-- Name: processos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.processos (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    documento character varying(255) NOT NULL,
    ativo integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.processos OWNER TO postgres;

--
-- Name: processos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.processos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.processos_id_seq OWNER TO postgres;

--
-- Name: processos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.processos_id_seq OWNED BY public.processos.id;


--
-- Name: processos_setors; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.processos_setors (
    id integer NOT NULL,
    processos_id integer NOT NULL,
    setors_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.processos_setors OWNER TO postgres;

--
-- Name: processos_setor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.processos_setor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.processos_setor_id_seq OWNER TO postgres;

--
-- Name: processos_setor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.processos_setor_id_seq OWNED BY public.processos_setors.id;


--
-- Name: setors; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.setors (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    ativo integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.setors OWNER TO postgres;

--
-- Name: setors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.setors_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.setors_id_seq OWNER TO postgres;

--
-- Name: setors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.setors_id_seq OWNED BY public.setors.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    telefone character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    ultimoacesso timestamp without time zone,
    ativo integer
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: acoes_corretivas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acoes_corretivas ALTER COLUMN id SET DEFAULT nextval('public.acoes_corretivas_id_seq'::regclass);


--
-- Name: acoes_naoconformidades id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acoes_naoconformidades ALTER COLUMN id SET DEFAULT nextval('public.acoes_naoconformidades_id_seq'::regclass);


--
-- Name: auditorias id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditorias ALTER COLUMN id SET DEFAULT nextval('public.auditoria_id_seq'::regclass);


--
-- Name: autorizacaos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.autorizacaos ALTER COLUMN id SET DEFAULT nextval('public.autorizacao_id_seq'::regclass);


--
-- Name: cidades id; Type: DEFAULT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.cidades ALTER COLUMN id SET DEFAULT nextval('public.cidades_id_seq'::regclass);


--
-- Name: empresas id; Type: DEFAULT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.empresas ALTER COLUMN id SET DEFAULT nextval('public.empresas_id_seq'::regclass);


--
-- Name: estados id; Type: DEFAULT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.estados ALTER COLUMN id SET DEFAULT nextval('public.estados_id_seq'::regclass);


--
-- Name: fichas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas ALTER COLUMN id SET DEFAULT nextval('public.itens_auditoria_id_seq'::regclass);


--
-- Name: funcionarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionarios ALTER COLUMN id SET DEFAULT nextval('public.funcionarios_id_seq'::regclass);


--
-- Name: itens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens ALTER COLUMN id SET DEFAULT nextval('public.itens_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: naos_conformidades id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naos_conformidades ALTER COLUMN id SET DEFAULT nextval('public.naos_conformidades_id_seq'::regclass);


--
-- Name: naosconformidades_itens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens ALTER COLUMN id SET DEFAULT nextval('public.naos_conformidades_itens_id_seq'::regclass);


--
-- Name: nc_itens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nc_itens ALTER COLUMN id SET DEFAULT nextval('public.ncitens_id_seq'::regclass);


--
-- Name: oauth_clients id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_clients_id_seq'::regclass);


--
-- Name: oauth_personal_access_clients id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_personal_access_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_personal_access_clients_id_seq'::regclass);


--
-- Name: paises id; Type: DEFAULT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.paises ALTER COLUMN id SET DEFAULT nextval('public.paises_id_seq'::regclass);


--
-- Name: papels id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.papels ALTER COLUMN id SET DEFAULT nextval('public.papel_id_seq'::regclass);


--
-- Name: papels_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.papels_users ALTER COLUMN id SET DEFAULT nextval('public.papels_users_id_seq'::regclass);


--
-- Name: permissoes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissoes ALTER COLUMN id SET DEFAULT nextval('public.permissoes_id_seq'::regclass);


--
-- Name: permissoes_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissoes_users ALTER COLUMN id SET DEFAULT nextval('public.permissoes_users_id_seq'::regclass);


--
-- Name: processos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.processos ALTER COLUMN id SET DEFAULT nextval('public.processos_id_seq'::regclass);


--
-- Name: processos_setors id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.processos_setors ALTER COLUMN id SET DEFAULT nextval('public.processos_setor_id_seq'::regclass);


--
-- Name: setors id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.setors ALTER COLUMN id SET DEFAULT nextval('public.setors_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: acoes_corretivas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.acoes_corretivas (id, nome, descricao, created_at, updated_at, ativo, tempo) FROM stdin;
143	Ação Corretiva 1	Ação Corretiva 1	2019-06-25 14:55:09	2019-06-25 16:13:07	1	12:30:00
144	Ação Corretiva 2	Ação Corretiva 2	2019-06-25 16:17:05	2019-06-25 16:17:19	1	11:11:00
145	Ação Corretiva 3	Ação Corretiva 3	2019-06-25 16:18:34	2019-06-25 16:18:34	1	12:34:00
146	Ação Corretiva 4	Ação Corretiva 4	2019-06-26 14:51:19	2019-06-26 14:51:36	1	05:00:00
148	Ação Corretiva 5	Ação Corretiva 5	2019-06-28 14:46:37	2019-06-28 14:46:37	1	12:12:00
151	Ação Corretiva 1	2 dias	2019-06-28 14:50:20	2019-06-28 14:50:20	1	48:00:00
153	2	2	2019-06-28 14:51:48	2019-06-28 14:51:48	1	48:00:00
154	3	3	2019-06-28 14:52:16	2019-06-28 14:52:16	1	72:00:00
155	4	4	2019-06-28 14:53:31	2019-06-28 14:53:31	1	96:00:00
156	5	5	2019-06-28 14:54:35	2019-06-28 14:54:35	1	48:00:00
157	6	6	2019-06-28 14:56:39	2019-06-28 14:56:39	1	144:00:00
158	7	7	2019-06-28 14:56:52	2019-06-28 14:56:52	1	168:00:00
149	2 dias	2 dias	2019-06-28 14:48:50	2019-06-28 15:46:39	0	:00
160	9	9	2019-07-02 10:23:06	2019-07-02 10:38:23	1	22:22:00
150	2 dias2	2 dias2	2019-06-28 14:49:53	2019-06-28 15:59:20	1	23:22:00
147	Ação Corretiva teste	Ação Corretiva teste	2019-06-27 14:55:59	2019-06-28 16:01:27	1	11:11:00
163	12	12	2019-07-02 10:42:36	2019-07-02 10:42:36	1	12:12:00
152	1	1	2019-06-28 14:51:08	2019-06-28 16:02:36	1	72:00:00
159	8	8	2019-07-02 10:11:34	2019-07-02 10:11:34	1	08:59:00
161	10	10	2019-07-02 10:30:16	2019-07-02 10:30:16	1	10:00:00
162	11	11	2019-07-02 10:39:56	2019-07-02 10:42:51	1	11:11:00
164	13	13	2019-07-02 10:43:43	2019-07-02 10:43:43	1	13:33:00
165	14	14	2019-07-02 10:45:10	2019-07-02 10:45:19	1	14:14:00
166	15	15	2019-07-02 10:45:39	2019-07-02 10:45:39	1	15:51:00
167	16	16	2019-07-02 10:53:35	2019-07-02 10:53:35	1	384:00:00
168	17	17	2019-07-02 10:54:57	2019-07-02 10:54:57	1	17:07:00
169	18	18	2019-07-02 10:55:41	2019-07-02 10:55:41	1	18:08:00
170	19	19	2019-07-02 10:55:53	2019-07-02 10:55:53	1	19:59:00
171	20	20	2019-07-02 13:46:35	2019-07-02 13:46:35	1	12:12:00
172	21	21	2019-07-03 16:16:43	2019-07-03 16:16:43	1	21:11:00
173	22	22	2019-07-03 16:17:27	2019-07-03 16:17:27	1	22:22:00
\.


--
-- Data for Name: acoes_naoconformidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.acoes_naoconformidades (id, id_acoescorretivas, id_naoconformidade, created_at, updated_at) FROM stdin;
664	144	60	2019-06-26 14:45:19	2019-06-26 14:45:19
665	143	61	2019-06-26 14:45:31	2019-06-26 14:45:31
666	144	61	2019-06-26 14:45:31	2019-06-26 14:45:31
667	145	61	2019-06-26 14:45:31	2019-06-26 14:45:31
668	143	59	2019-06-28 16:39:35	2019-06-28 16:39:35
669	152	59	2019-06-28 16:39:35	2019-06-28 16:39:35
670	159	62	2019-07-02 10:12:29	2019-07-02 10:12:29
671	158	62	2019-07-02 10:12:29	2019-07-02 10:12:29
672	157	62	2019-07-02 10:12:29	2019-07-02 10:12:29
673	156	62	2019-07-02 10:12:29	2019-07-02 10:12:29
674	155	62	2019-07-02 10:12:29	2019-07-02 10:12:29
675	154	62	2019-07-02 10:12:29	2019-07-02 10:12:29
676	153	62	2019-07-02 10:12:29	2019-07-02 10:12:29
677	152	62	2019-07-02 10:12:29	2019-07-02 10:12:29
678	151	62	2019-07-02 10:12:29	2019-07-02 10:12:29
679	150	62	2019-07-02 10:12:29	2019-07-02 10:12:29
680	148	62	2019-07-02 10:12:29	2019-07-02 10:12:29
681	147	62	2019-07-02 10:12:29	2019-07-02 10:12:29
682	146	62	2019-07-02 10:12:29	2019-07-02 10:12:29
683	145	62	2019-07-02 10:12:29	2019-07-02 10:12:29
684	144	62	2019-07-02 10:12:29	2019-07-02 10:12:29
685	143	62	2019-07-02 10:12:29	2019-07-02 10:12:29
686	171	63	2019-07-03 14:49:35	2019-07-03 14:49:35
687	170	63	2019-07-03 14:49:35	2019-07-03 14:49:35
688	169	63	2019-07-03 14:49:35	2019-07-03 14:49:35
689	168	63	2019-07-03 14:49:35	2019-07-03 14:49:35
690	167	63	2019-07-03 14:49:35	2019-07-03 14:49:35
691	166	63	2019-07-03 14:49:35	2019-07-03 14:49:35
692	165	63	2019-07-03 14:49:35	2019-07-03 14:49:35
693	164	63	2019-07-03 14:49:35	2019-07-03 14:49:35
694	163	63	2019-07-03 14:49:35	2019-07-03 14:49:35
695	162	63	2019-07-03 14:49:35	2019-07-03 14:49:35
696	161	63	2019-07-03 14:49:35	2019-07-03 14:49:35
697	160	63	2019-07-03 14:49:35	2019-07-03 14:49:35
698	159	63	2019-07-03 14:49:35	2019-07-03 14:49:35
699	158	63	2019-07-03 14:49:35	2019-07-03 14:49:35
700	157	63	2019-07-03 14:49:35	2019-07-03 14:49:35
701	156	63	2019-07-03 14:49:35	2019-07-03 14:49:35
702	155	63	2019-07-03 14:49:35	2019-07-03 14:49:35
703	154	63	2019-07-03 14:49:35	2019-07-03 14:49:35
704	153	63	2019-07-03 14:49:35	2019-07-03 14:49:35
705	152	63	2019-07-03 14:49:35	2019-07-03 14:49:35
706	151	63	2019-07-03 14:49:35	2019-07-03 14:49:35
707	150	63	2019-07-03 14:49:35	2019-07-03 14:49:35
708	148	63	2019-07-03 14:49:35	2019-07-03 14:49:35
709	147	63	2019-07-03 14:49:35	2019-07-03 14:49:35
710	146	63	2019-07-03 14:49:35	2019-07-03 14:49:35
711	145	63	2019-07-03 14:49:35	2019-07-03 14:49:35
712	144	63	2019-07-03 14:49:35	2019-07-03 14:49:35
713	143	63	2019-07-03 14:49:35	2019-07-03 14:49:35
714	171	64	2019-07-03 15:06:16	2019-07-03 15:06:16
715	170	64	2019-07-03 15:06:16	2019-07-03 15:06:16
716	169	64	2019-07-03 15:06:16	2019-07-03 15:06:16
717	168	64	2019-07-03 15:06:16	2019-07-03 15:06:16
718	167	64	2019-07-03 15:06:16	2019-07-03 15:06:16
719	166	64	2019-07-03 15:06:16	2019-07-03 15:06:16
720	165	64	2019-07-03 15:06:16	2019-07-03 15:06:16
721	164	64	2019-07-03 15:06:16	2019-07-03 15:06:16
722	163	64	2019-07-03 15:06:16	2019-07-03 15:06:16
723	162	64	2019-07-03 15:06:16	2019-07-03 15:06:16
724	161	64	2019-07-03 15:06:16	2019-07-03 15:06:16
725	160	64	2019-07-03 15:06:16	2019-07-03 15:06:16
726	159	64	2019-07-03 15:06:16	2019-07-03 15:06:16
727	158	64	2019-07-03 15:06:16	2019-07-03 15:06:16
728	157	64	2019-07-03 15:06:16	2019-07-03 15:06:16
729	156	64	2019-07-03 15:06:16	2019-07-03 15:06:16
730	155	64	2019-07-03 15:06:16	2019-07-03 15:06:16
731	154	64	2019-07-03 15:06:16	2019-07-03 15:06:16
732	153	64	2019-07-03 15:06:16	2019-07-03 15:06:16
733	152	64	2019-07-03 15:06:16	2019-07-03 15:06:16
734	151	64	2019-07-03 15:06:16	2019-07-03 15:06:16
735	150	64	2019-07-03 15:06:16	2019-07-03 15:06:16
736	148	64	2019-07-03 15:06:16	2019-07-03 15:06:16
737	147	64	2019-07-03 15:06:16	2019-07-03 15:06:16
738	146	64	2019-07-03 15:06:16	2019-07-03 15:06:16
739	145	64	2019-07-03 15:06:16	2019-07-03 15:06:16
740	144	64	2019-07-03 15:06:16	2019-07-03 15:06:16
741	143	64	2019-07-03 15:06:16	2019-07-03 15:06:16
742	171	65	2019-07-03 15:20:00	2019-07-03 15:20:00
743	170	65	2019-07-03 15:20:00	2019-07-03 15:20:00
746	173	68	2019-07-03 16:22:31	2019-07-03 16:22:31
747	172	68	2019-07-03 16:22:31	2019-07-03 16:22:31
748	144	68	2019-07-03 16:22:31	2019-07-03 16:22:31
749	143	68	2019-07-03 16:22:31	2019-07-03 16:22:31
\.


--
-- Data for Name: auditorias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditorias (id, id_processos, id_users, created_at, updated_at, id_setors) FROM stdin;
404	171	36	2019-08-05 14:44:01	2019-08-05 14:44:01	170
405	172	36	2019-08-05 15:13:10	2019-08-05 15:13:10	172
406	172	36	2019-08-05 15:43:27	2019-08-05 15:43:27	172
407	172	36	2019-08-05 15:43:32	2019-08-05 15:43:32	172
408	171	36	2019-08-05 15:43:37	2019-08-05 15:43:37	170
409	172	36	2019-08-05 15:44:02	2019-08-05 15:44:02	172
410	172	36	2019-08-05 15:44:10	2019-08-05 15:44:10	172
411	172	36	2019-08-05 15:44:27	2019-08-05 15:44:27	172
412	172	36	2019-08-05 15:44:34	2019-08-05 15:44:34	172
413	172	36	2019-08-05 15:44:38	2019-08-05 15:44:38	172
414	171	36	2019-08-05 15:44:43	2019-08-05 15:44:43	170
415	172	36	2019-08-05 15:44:55	2019-08-05 15:44:55	172
416	171	36	2019-08-05 15:45:08	2019-08-05 15:45:08	170
417	172	36	2019-08-05 15:55:37	2019-08-05 15:55:37	172
418	171	36	2019-08-05 15:55:42	2019-08-05 15:55:42	170
419	172	36	2019-08-05 15:55:47	2019-08-05 15:55:47	172
420	172	36	2019-08-05 15:55:51	2019-08-05 15:55:51	172
421	172	36	2019-08-05 15:55:56	2019-08-05 15:55:56	172
422	172	36	2019-08-05 15:56:00	2019-08-05 15:56:00	172
423	172	36	2019-08-05 17:13:33	2019-08-05 17:13:33	172
424	171	36	2019-08-05 17:26:54	2019-08-05 17:26:54	170
425	171	149	2019-08-07 11:52:10	2019-08-07 11:52:10	170
\.


--
-- Data for Name: autorizacaos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.autorizacaos (id, id_papels, id_setors, created_at, updated_at) FROM stdin;
734	66	170	2019-07-02 10:58:55	2019-07-02 10:58:55
735	67	170	2019-07-02 11:01:53	2019-07-02 11:01:53
736	68	170	2019-07-02 12:11:22	2019-07-02 12:11:22
738	64	170	2019-08-07 11:52:01	2019-08-07 11:52:01
\.


--
-- Data for Name: cidades; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.cidades (id, nome, id_estado) FROM stdin;
1	Afonso Cláudio	8
2	Água Doce do Norte	8
3	Águia Branca	8
4	Alegre	8
5	Alfredo Chaves	8
6	Alto Rio Novo	8
7	Anchieta	8
8	Apiacá	8
9	Aracruz	8
10	Atilio Vivacqua	8
11	Baixo Guandu	8
12	Barra de São Francisco	8
13	Boa Esperança	8
14	Bom Jesus do Norte	8
15	Brejetuba	8
16	Cachoeiro de Itapemirim	8
17	Cariacica	8
18	Castelo	8
19	Colatina	8
20	Conceição da Barra	8
21	Conceição do Castelo	8
22	Divino de São Lourenço	8
23	Domingos Martins	8
24	Dores do Rio Preto	8
25	Ecoporanga	8
26	Fundão	8
27	Governador Lindenberg	8
28	Guaçuí	8
29	Guarapari	8
30	Ibatiba	8
31	Ibiraçu	8
32	Ibitirama	8
33	Iconha	8
34	Irupi	8
35	Itaguaçu	8
36	Itapemirim	8
37	Itarana	8
38	Iúna	8
39	Jaguaré	8
40	Jerônimo Monteiro	8
41	João Neiva	8
42	Laranja da Terra	8
43	Linhares	8
44	Mantenópolis	8
45	Marataízes	8
46	Marechal Floriano	8
47	Marilândia	8
48	Mimoso do Sul	8
49	Montanha	8
50	Mucurici	8
51	Muniz Freire	8
52	Muqui	8
53	Nova Venécia	8
54	Pancas	8
55	Pedro Canário	8
56	Pinheiros	8
57	Piúma	8
58	Ponto Belo	8
59	Presidente Kennedy	8
60	Rio Bananal	8
61	Rio Novo do Sul	8
62	Santa Leopoldina	8
63	Santa Maria de Jetibá	8
64	Santa Teresa	8
65	São Domingos do Norte	8
66	São Gabriel da Palha	8
67	São José do Calçado	8
68	São Mateus	8
69	São Roque do Canaã	8
70	Serra	8
71	Sooretama	8
72	Vargem Alta	8
73	Venda Nova do Imigrante	8
74	Viana	8
75	Vila Pavão	8
76	Vila Valério	8
77	Vila Velha	8
78	Vitória	8
79	Acrelândia	1
80	Assis Brasil	1
81	Brasiléia	1
82	Bujari	1
83	Capixaba	1
84	Cruzeiro do Sul	1
85	Epitaciolândia	1
86	Feijó	1
87	Jordão	1
88	Mâncio Lima	1
89	Manoel Urbano	1
90	Marechal Thaumaturgo	1
91	Plácido de Castro	1
92	Porto Acre	1
93	Porto Walter	1
94	Rio Branco	1
95	Rodrigues Alves	1
96	Santa Rosa do Purus	1
97	Sena Madureira	1
98	Senador Guiomard	1
99	Tarauacá	1
100	Xapuri	1
101	Água Branca	2
102	Anadia	2
103	Arapiraca	2
104	Atalaia	2
105	Barra de Santo Antônio	2
106	Barra de São Miguel	2
107	Batalha	2
108	Belém	2
109	Belo Monte	2
110	Boca da Mata	2
111	Branquinha	2
112	Cacimbinhas	2
113	Cajueiro	2
114	Campestre	2
115	Campo Alegre	2
116	Campo Grande	2
117	Canapi	2
118	Capela	2
119	Carneiros	2
120	Chã Preta	2
121	Coité do Nóia	2
122	Colônia Leopoldina	2
123	Coqueiro Seco	2
124	Coruripe	2
125	Craíbas	2
126	Delmiro Gouveia	2
127	Dois Riachos	2
128	Estrela de Alagoas	2
129	Feira Grande	2
130	Feliz Deserto	2
131	Flexeiras	2
132	Girau do Ponciano	2
133	Ibateguara	2
134	Igaci	2
135	Igreja Nova	2
136	Inhapi	2
137	Jacaré dos Homens	2
138	Jacuípe	2
139	Japaratinga	2
140	Jaramataia	2
141	Jequiá da Praia	2
142	Joaquim Gomes	2
143	Jundiá	2
144	Junqueiro	2
145	Lagoa da Canoa	2
146	Limoeiro de Anadia	2
147	Maceió	2
148	Major Isidoro	2
149	Mar Vermelho	2
150	Maragogi	2
151	Maravilha	2
152	Marechal Deodoro	2
153	Maribondo	2
154	Mata Grande	2
155	Matriz de Camaragibe	2
156	Messias	2
157	Minador do Negrão	2
158	Monteirópolis	2
159	Murici	2
160	Novo Lino	2
161	Olho dÁgua das Flores	2
162	Olho dÁgua do Casado	2
163	Olho dÁgua Grande	2
164	Olivença	2
165	Ouro Branco	2
166	Palestina	2
167	Palmeira dos Índios	2
168	Pão de Açúcar	2
169	Pariconha	2
170	Paripueira	2
171	Passo de Camaragibe	2
172	Paulo Jacinto	2
173	Penedo	2
174	Piaçabuçu	2
175	Pilar	2
176	Pindoba	2
177	Piranhas	2
178	Poço das Trincheiras	2
179	Porto Calvo	2
180	Porto de Pedras	2
181	Porto Real do Colégio	2
182	Quebrangulo	2
183	Rio Largo	2
184	Roteiro	2
185	Santa Luzia do Norte	2
186	Santana do Ipanema	2
187	Santana do Mundaú	2
188	São Brás	2
189	São José da Laje	2
190	São José da Tapera	2
191	São Luís do Quitunde	2
192	São Miguel dos Campos	2
193	São Miguel dos Milagres	2
194	São Sebastião	2
195	Satuba	2
196	Senador Rui Palmeira	2
197	Tanque dArca	2
198	Taquarana	2
199	Teotônio Vilela	2
200	Traipu	2
201	União dos Palmares	2
202	Viçosa	2
203	Amapá	4
204	Calçoene	4
205	Cutias	4
206	Ferreira Gomes	4
207	Itaubal	4
208	Laranjal do Jari	4
209	Macapá	4
210	Mazagão	4
211	Oiapoque	4
212	Pedra Branca do Amaparí	4
213	Porto Grande	4
214	Pracuúba	4
215	Santana	4
216	Serra do Navio	4
217	Tartarugalzinho	4
218	Vitória do Jari	4
219	Alvarães	3
220	Amaturá	3
221	Anamã	3
222	Anori	3
223	Apuí	3
224	Atalaia do Norte	3
225	Autazes	3
226	Barcelos	3
227	Barreirinha	3
228	Benjamin Constant	3
229	Beruri	3
230	Boa Vista do Ramos	3
231	Boca do Acre	3
232	Borba	3
233	Caapiranga	3
234	Canutama	3
235	Carauari	3
236	Careiro	3
237	Careiro da Várzea	3
238	Coari	3
239	Codajás	3
240	Eirunepé	3
241	Envira	3
242	Fonte Boa	3
243	Guajará	3
244	Humaitá	3
245	Ipixuna	3
246	Iranduba	3
247	Itacoatiara	3
248	Itamarati	3
249	Itapiranga	3
250	Japurá	3
251	Juruá	3
252	Jutaí	3
253	Lábrea	3
254	Manacapuru	3
255	Manaquiri	3
256	Manaus	3
257	Manicoré	3
258	Maraã	3
259	Maués	3
260	Nhamundá	3
261	Nova Olinda do Norte	3
262	Novo Airão	3
263	Novo Aripuanã	3
264	Parintins	3
265	Pauini	3
266	Presidente Figueiredo	3
267	Rio Preto da Eva	3
268	Santa Isabel do Rio Negro	3
269	Santo Antônio do Içá	3
270	São Gabriel da Cachoeira	3
271	São Paulo de Olivença	3
272	São Sebastião do Uatumã	3
273	Silves	3
274	Tabatinga	3
275	Tapauá	3
276	Tefé	3
277	Tonantins	3
278	Uarini	3
279	Urucará	3
280	Urucurituba	3
281	Abaíra	5
282	Abaré	5
283	Acajutiba	5
284	Adustina	5
285	Água Fria	5
286	Aiquara	5
287	Alagoinhas	5
288	Alcobaça	5
289	Almadina	5
290	Amargosa	5
291	Amélia Rodrigues	5
292	América Dourada	5
293	Anagé	5
294	Andaraí	5
295	Andorinha	5
296	Angical	5
297	Anguera	5
298	Antas	5
299	Antônio Cardoso	5
300	Antônio Gonçalves	5
301	Aporá	5
302	Apuarema	5
303	Araças	5
304	Aracatu	5
305	Araci	5
306	Aramari	5
307	Arataca	5
308	Aratuípe	5
309	Aurelino Leal	5
310	Baianópolis	5
311	Baixa Grande	5
312	Banzaê	5
313	Barra	5
314	Barra da Estiva	5
315	Barra do Choça	5
316	Barra do Mendes	5
317	Barra do Rocha	5
318	Barreiras	5
319	Barro Alto	5
320	Barro Preto (antigo Gov. Lomanto Jr.)	5
321	Barrocas	5
322	Belmonte	5
323	Belo Campo	5
324	Biritinga	5
325	Boa Nova	5
326	Boa Vista do Tupim	5
327	Bom Jesus da Lapa	5
328	Bom Jesus da Serra	5
329	Boninal	5
330	Bonito	5
331	Boquira	5
332	Botuporã	5
333	Brejões	5
334	Brejolândia	5
335	Brotas de Macaúbas	5
336	Brumado	5
337	Buerarema	5
338	Buritirama	5
339	Caatiba	5
340	Cabaceiras do Paraguaçu	5
341	Cachoeira	5
342	Caculé	5
343	Caém	5
344	Caetanos	5
345	Caetité	5
346	Cafarnaum	5
347	Cairu	5
348	Caldeirão Grande	5
349	Camacan	5
350	Camaçari	5
351	Camamu	5
352	Campo Alegre de Lourdes	5
353	Campo Formoso	5
354	Canápolis	5
355	Canarana	5
356	Canavieiras	5
357	Candeal	5
358	Candeias	5
359	Candiba	5
360	Cândido Sales	5
361	Cansanção	5
362	Canudos	5
363	Capela do Alto Alegre	5
364	Capim Grosso	5
365	Caraíbas	5
366	Caravelas	5
367	Cardeal da Silva	5
368	Carinhanha	5
369	Casa Nova	5
370	Castro Alves	5
371	Catolândia	5
372	Catu	5
373	Caturama	5
374	Central	5
375	Chorrochó	5
376	Cícero Dantas	5
377	Cipó	5
378	Coaraci	5
379	Cocos	5
380	Conceição da Feira	5
381	Conceição do Almeida	5
382	Conceição do Coité	5
383	Conceição do Jacuípe	5
384	Conde	5
385	Condeúba	5
386	Contendas do Sincorá	5
387	Coração de Maria	5
388	Cordeiros	5
389	Coribe	5
390	Coronel João Sá	5
391	Correntina	5
392	Cotegipe	5
393	Cravolândia	5
394	Crisópolis	5
395	Cristópolis	5
396	Cruz das Almas	5
397	Curaçá	5
398	Dário Meira	5
399	Dias dÁvila	5
400	Dom Basílio	5
401	Dom Macedo Costa	5
402	Elísio Medrado	5
403	Encruzilhada	5
404	Entre Rios	5
405	Érico Cardoso	5
406	Esplanada	5
407	Euclides da Cunha	5
408	Eunápolis	5
409	Fátima	5
410	Feira da Mata	5
411	Feira de Santana	5
412	Filadélfia	5
413	Firmino Alves	5
414	Floresta Azul	5
415	Formosa do Rio Preto	5
416	Gandu	5
417	Gavião	5
418	Gentio do Ouro	5
419	Glória	5
420	Gongogi	5
421	Governador Mangabeira	5
422	Guajeru	5
423	Guanambi	5
424	Guaratinga	5
425	Heliópolis	5
426	Iaçu	5
427	Ibiassucê	5
428	Ibicaraí	5
429	Ibicoara	5
430	Ibicuí	5
431	Ibipeba	5
432	Ibipitanga	5
433	Ibiquera	5
434	Ibirapitanga	5
435	Ibirapuã	5
436	Ibirataia	5
437	Ibitiara	5
438	Ibititá	5
439	Ibotirama	5
440	Ichu	5
441	Igaporã	5
442	Igrapiúna	5
443	Iguaí	5
444	Ilhéus	5
445	Inhambupe	5
446	Ipecaetá	5
447	Ipiaú	5
448	Ipirá	5
449	Ipupiara	5
450	Irajuba	5
451	Iramaia	5
452	Iraquara	5
453	Irará	5
454	Irecê	5
455	Itabela	5
456	Itaberaba	5
457	Itabuna	5
458	Itacaré	5
459	Itaeté	5
460	Itagi	5
461	Itagibá	5
462	Itagimirim	5
463	Itaguaçu da Bahia	5
464	Itaju do Colônia	5
465	Itajuípe	5
466	Itamaraju	5
467	Itamari	5
468	Itambé	5
469	Itanagra	5
470	Itanhém	5
471	Itaparica	5
472	Itapé	5
473	Itapebi	5
474	Itapetinga	5
475	Itapicuru	5
476	Itapitanga	5
477	Itaquara	5
478	Itarantim	5
479	Itatim	5
480	Itiruçu	5
481	Itiúba	5
482	Itororó	5
483	Ituaçu	5
484	Ituberá	5
485	Iuiú	5
486	Jaborandi	5
487	Jacaraci	5
488	Jacobina	5
489	Jaguaquara	5
490	Jaguarari	5
491	Jaguaripe	5
492	Jandaíra	5
493	Jequié	5
494	Jeremoabo	5
495	Jiquiriçá	5
496	Jitaúna	5
497	João Dourado	5
498	Juazeiro	5
499	Jucuruçu	5
500	Jussara	5
501	Jussari	5
502	Jussiape	5
503	Lafaiete Coutinho	5
504	Lagoa Real	5
505	Laje	5
506	Lajedão	5
507	Lajedinho	5
508	Lajedo do Tabocal	5
509	Lamarão	5
510	Lapão	5
511	Lauro de Freitas	5
512	Lençóis	5
513	Licínio de Almeida	5
514	Livramento de Nossa Senhora	5
515	Luís Eduardo Magalhães	5
516	Macajuba	5
517	Macarani	5
518	Macaúbas	5
519	Macururé	5
520	Madre de Deus	5
521	Maetinga	5
522	Maiquinique	5
523	Mairi	5
524	Malhada	5
525	Malhada de Pedras	5
526	Manoel Vitorino	5
527	Mansidão	5
528	Maracás	5
529	Maragogipe	5
530	Maraú	5
531	Marcionílio Souza	5
532	Mascote	5
533	Mata de São João	5
534	Matina	5
535	Medeiros Neto	5
536	Miguel Calmon	5
537	Milagres	5
538	Mirangaba	5
539	Mirante	5
540	Monte Santo	5
541	Morpará	5
542	Morro do Chapéu	5
543	Mortugaba	5
544	Mucugê	5
545	Mucuri	5
546	Mulungu do Morro	5
547	Mundo Novo	5
548	Muniz Ferreira	5
549	Muquém de São Francisco	5
550	Muritiba	5
551	Mutuípe	5
552	Nazaré	5
553	Nilo Peçanha	5
554	Nordestina	5
555	Nova Canaã	5
556	Nova Fátima	5
557	Nova Ibiá	5
558	Nova Itarana	5
559	Nova Redenção	5
560	Nova Soure	5
561	Nova Viçosa	5
562	Novo Horizonte	5
563	Novo Triunfo	5
564	Olindina	5
565	Oliveira dos Brejinhos	5
566	Ouriçangas	5
567	Ourolândia	5
568	Palmas de Monte Alto	5
569	Palmeiras	5
570	Paramirim	5
571	Paratinga	5
572	Paripiranga	5
573	Pau Brasil	5
574	Paulo Afonso	5
575	Pé de Serra	5
576	Pedrão	5
577	Pedro Alexandre	5
578	Piatã	5
579	Pilão Arcado	5
580	Pindaí	5
581	Pindobaçu	5
582	Pintadas	5
583	Piraí do Norte	5
584	Piripá	5
585	Piritiba	5
586	Planaltino	5
587	Planalto	5
588	Poções	5
589	Pojuca	5
590	Ponto Novo	5
591	Porto Seguro	5
592	Potiraguá	5
593	Prado	5
594	Presidente Dutra	5
595	Presidente Jânio Quadros	5
596	Presidente Tancredo Neves	5
597	Queimadas	5
598	Quijingue	5
599	Quixabeira	5
600	Rafael Jambeiro	5
601	Remanso	5
602	Retirolândia	5
603	Riachão das Neves	5
604	Riachão do Jacuípe	5
605	Riacho de Santana	5
606	Ribeira do Amparo	5
607	Ribeira do Pombal	5
608	Ribeirão do Largo	5
609	Rio de Contas	5
610	Rio do Antônio	5
611	Rio do Pires	5
612	Rio Real	5
613	Rodelas	5
614	Ruy Barbosa	5
615	Salinas da Margarida	5
616	Salvador	5
617	Santa Bárbara	5
618	Santa Brígida	5
619	Santa Cruz Cabrália	5
620	Santa Cruz da Vitória	5
621	Santa Inês	5
622	Santa Luzia	5
623	Santa Maria da Vitória	5
624	Santa Rita de Cássia	5
625	Santa Teresinha	5
626	Santaluz	5
627	Santana	5
628	Santanópolis	5
629	Santo Amaro	5
630	Santo Antônio de Jesus	5
631	Santo Estêvão	5
632	São Desidério	5
633	São Domingos	5
634	São Felipe	5
635	São Félix	5
636	São Félix do Coribe	5
637	São Francisco do Conde	5
638	São Gabriel	5
639	São Gonçalo dos Campos	5
640	São José da Vitória	5
641	São José do Jacuípe	5
642	São Miguel das Matas	5
643	São Sebastião do Passé	5
644	Sapeaçu	5
645	Sátiro Dias	5
646	Saubara	5
647	Saúde	5
648	Seabra	5
649	Sebastião Laranjeiras	5
650	Senhor do Bonfim	5
651	Sento Sé	5
652	Serra do Ramalho	5
653	Serra Dourada	5
654	Serra Preta	5
655	Serrinha	5
656	Serrolândia	5
657	Simões Filho	5
658	Sítio do Mato	5
659	Sítio do Quinto	5
660	Sobradinho	5
661	Souto Soares	5
662	Tabocas do Brejo Velho	5
663	Tanhaçu	5
664	Tanque Novo	5
665	Tanquinho	5
666	Taperoá	5
667	Tapiramutá	5
668	Teixeira de Freitas	5
669	Teodoro Sampaio	5
670	Teofilândia	5
671	Teolândia	5
672	Terra Nova	5
673	Tremedal	5
674	Tucano	5
675	Uauá	5
676	Ubaíra	5
677	Ubaitaba	5
678	Ubatã	5
679	Uibaí	5
680	Umburanas	5
681	Una	5
682	Urandi	5
683	Uruçuca	5
684	Utinga	5
685	Valença	5
686	Valente	5
687	Várzea da Roça	5
688	Várzea do Poço	5
689	Várzea Nova	5
690	Varzedo	5
691	Vera Cruz	5
692	Vereda	5
693	Vitória da Conquista	5
694	Wagner	5
695	Wanderley	5
696	Wenceslau Guimarães	5
697	Xique-Xique	5
698	Abaiara	6
699	Acarape	6
700	Acaraú	6
701	Acopiara	6
702	Aiuaba	6
703	Alcântaras	6
704	Altaneira	6
705	Alto Santo	6
706	Amontada	6
707	Antonina do Norte	6
708	Apuiarés	6
709	Aquiraz	6
710	Aracati	6
711	Aracoiaba	6
712	Ararendá	6
713	Araripe	6
714	Aratuba	6
715	Arneiroz	6
716	Assaré	6
717	Aurora	6
718	Baixio	6
719	Banabuiú	6
720	Barbalha	6
721	Barreira	6
722	Barro	6
723	Barroquinha	6
724	Baturité	6
725	Beberibe	6
726	Bela Cruz	6
727	Boa Viagem	6
728	Brejo Santo	6
729	Camocim	6
730	Campos Sales	6
731	Canindé	6
732	Capistrano	6
733	Caridade	6
734	Cariré	6
735	Caririaçu	6
736	Cariús	6
737	Carnaubal	6
738	Cascavel	6
739	Catarina	6
740	Catunda	6
741	Caucaia	6
742	Cedro	6
743	Chaval	6
744	Choró	6
745	Chorozinho	6
746	Coreaú	6
747	Crateús	6
748	Crato	6
749	Croatá	6
750	Cruz	6
751	Deputado Irapuan Pinheiro	6
752	Ererê	6
753	Eusébio	6
754	Farias Brito	6
755	Forquilha	6
756	Fortaleza	6
757	Fortim	6
758	Frecheirinha	6
759	General Sampaio	6
760	Graça	6
761	Granja	6
762	Granjeiro	6
763	Groaíras	6
764	Guaiúba	6
765	Guaraciaba do Norte	6
766	Guaramiranga	6
767	Hidrolândia	6
768	Horizonte	6
769	Ibaretama	6
770	Ibiapina	6
771	Ibicuitinga	6
772	Icapuí	6
773	Icó	6
774	Iguatu	6
775	Independência	6
776	Ipaporanga	6
777	Ipaumirim	6
778	Ipu	6
779	Ipueiras	6
780	Iracema	6
781	Irauçuba	6
782	Itaiçaba	6
783	Itaitinga	6
784	Itapagé	6
785	Itapipoca	6
786	Itapiúna	6
787	Itarema	6
788	Itatira	6
789	Jaguaretama	6
790	Jaguaribara	6
791	Jaguaribe	6
792	Jaguaruana	6
793	Jardim	6
794	Jati	6
795	Jijoca de Jericoacoara	6
796	Juazeiro do Norte	6
797	Jucás	6
798	Lavras da Mangabeira	6
799	Limoeiro do Norte	6
800	Madalena	6
801	Maracanaú	6
802	Maranguape	6
803	Marco	6
804	Martinópole	6
805	Massapê	6
806	Mauriti	6
807	Meruoca	6
808	Milagres	6
809	Milhã	6
810	Miraíma	6
811	Missão Velha	6
812	Mombaça	6
813	Monsenhor Tabosa	6
814	Morada Nova	6
815	Moraújo	6
816	Morrinhos	6
817	Mucambo	6
818	Mulungu	6
819	Nova Olinda	6
820	Nova Russas	6
821	Novo Oriente	6
822	Ocara	6
823	Orós	6
824	Pacajus	6
825	Pacatuba	6
826	Pacoti	6
827	Pacujá	6
828	Palhano	6
829	Palmácia	6
830	Paracuru	6
831	Paraipaba	6
832	Parambu	6
833	Paramoti	6
834	Pedra Branca	6
835	Penaforte	6
836	Pentecoste	6
837	Pereiro	6
838	Pindoretama	6
839	Piquet Carneiro	6
840	Pires Ferreira	6
841	Poranga	6
842	Porteiras	6
843	Potengi	6
844	Potiretama	6
845	Quiterianópolis	6
846	Quixadá	6
847	Quixelô	6
848	Quixeramobim	6
849	Quixeré	6
850	Redenção	6
851	Reriutaba	6
852	Russas	6
853	Saboeiro	6
854	Salitre	6
855	Santa Quitéria	6
856	Santana do Acaraú	6
857	Santana do Cariri	6
858	São Benedito	6
859	São Gonçalo do Amarante	6
860	São João do Jaguaribe	6
861	São Luís do Curu	6
862	Senador Pompeu	6
863	Senador Sá	6
864	Sobral	6
865	Solonópole	6
866	Tabuleiro do Norte	6
867	Tamboril	6
868	Tarrafas	6
869	Tauá	6
870	Tejuçuoca	6
871	Tianguá	6
872	Trairi	6
873	Tururu	6
874	Ubajara	6
875	Umari	6
876	Umirim	6
877	Uruburetama	6
878	Uruoca	6
879	Varjota	6
880	Várzea Alegre	6
881	Viçosa do Ceará	6
882	Brasília	7
883	Abadia de Goiás	9
884	Abadiânia	9
885	Acreúna	9
886	Adelândia	9
887	Água Fria de Goiás	9
888	Água Limpa	9
889	Águas Lindas de Goiás	9
890	Alexânia	9
891	Aloândia	9
892	Alto Horizonte	9
893	Alto Paraíso de Goiás	9
894	Alvorada do Norte	9
895	Amaralina	9
896	Americano do Brasil	9
897	Amorinópolis	9
898	Anápolis	9
899	Anhanguera	9
900	Anicuns	9
901	Aparecida de Goiânia	9
902	Aparecida do Rio Doce	9
903	Aporé	9
904	Araçu	9
905	Aragarças	9
906	Aragoiânia	9
907	Araguapaz	9
908	Arenópolis	9
909	Aruanã	9
910	Aurilândia	9
911	Avelinópolis	9
912	Baliza	9
913	Barro Alto	9
914	Bela Vista de Goiás	9
915	Bom Jardim de Goiás	9
916	Bom Jesus de Goiás	9
917	Bonfinópolis	9
918	Bonópolis	9
919	Brazabrantes	9
920	Britânia	9
921	Buriti Alegre	9
922	Buriti de Goiás	9
923	Buritinópolis	9
924	Cabeceiras	9
925	Cachoeira Alta	9
926	Cachoeira de Goiás	9
927	Cachoeira Dourada	9
928	Caçu	9
929	Caiapônia	9
930	Caldas Novas	9
931	Caldazinha	9
932	Campestre de Goiás	9
933	Campinaçu	9
934	Campinorte	9
935	Campo Alegre de Goiás	9
936	Campo Limpo de Goiás	9
937	Campos Belos	9
938	Campos Verdes	9
939	Carmo do Rio Verde	9
940	Castelândia	9
941	Catalão	9
942	Caturaí	9
943	Cavalcante	9
944	Ceres	9
945	Cezarina	9
946	Chapadão do Céu	9
947	Cidade Ocidental	9
948	Cocalzinho de Goiás	9
949	Colinas do Sul	9
950	Córrego do Ouro	9
951	Corumbá de Goiás	9
952	Corumbaíba	9
953	Cristalina	9
954	Cristianópolis	9
955	Crixás	9
956	Cromínia	9
957	Cumari	9
958	Damianópolis	9
959	Damolândia	9
960	Davinópolis	9
961	Diorama	9
962	Divinópolis de Goiás	9
963	Doverlândia	9
964	Edealina	9
965	Edéia	9
966	Estrela do Norte	9
967	Faina	9
968	Fazenda Nova	9
969	Firminópolis	9
970	Flores de Goiás	9
971	Formosa	9
972	Formoso	9
973	Gameleira de Goiás	9
974	Goianápolis	9
975	Goiandira	9
976	Goianésia	9
977	Goiânia	9
978	Goianira	9
979	Goiás	9
980	Goiatuba	9
981	Gouvelândia	9
982	Guapó	9
983	Guaraíta	9
984	Guarani de Goiás	9
985	Guarinos	9
986	Heitoraí	9
987	Hidrolândia	9
988	Hidrolina	9
989	Iaciara	9
990	Inaciolândia	9
991	Indiara	9
992	Inhumas	9
993	Ipameri	9
994	Ipiranga de Goiás	9
995	Iporá	9
996	Israelândia	9
997	Itaberaí	9
998	Itaguari	9
999	Itaguaru	9
1000	Itajá	9
1001	Itapaci	9
1002	Itapirapuã	9
1003	Itapuranga	9
1004	Itarumã	9
1005	Itauçu	9
1006	Itumbiara	9
1007	Ivolândia	9
1008	Jandaia	9
1009	Jaraguá	9
1010	Jataí	9
1011	Jaupaci	9
1012	Jesúpolis	9
1013	Joviânia	9
1014	Jussara	9
1015	Lagoa Santa	9
1016	Leopoldo de Bulhões	9
1017	Luziânia	9
1018	Mairipotaba	9
1019	Mambaí	9
1020	Mara Rosa	9
1021	Marzagão	9
1022	Matrinchã	9
1023	Maurilândia	9
1024	Mimoso de Goiás	9
1025	Minaçu	9
1026	Mineiros	9
1027	Moiporá	9
1028	Monte Alegre de Goiás	9
1029	Montes Claros de Goiás	9
1030	Montividiu	9
1031	Montividiu do Norte	9
1032	Morrinhos	9
1033	Morro Agudo de Goiás	9
1034	Mossâmedes	9
1035	Mozarlândia	9
1036	Mundo Novo	9
1037	Mutunópolis	9
1038	Nazário	9
1039	Nerópolis	9
1040	Niquelândia	9
1041	Nova América	9
1042	Nova Aurora	9
1043	Nova Crixás	9
1044	Nova Glória	9
1045	Nova Iguaçu de Goiás	9
1046	Nova Roma	9
1047	Nova Veneza	9
1048	Novo Brasil	9
1049	Novo Gama	9
1050	Novo Planalto	9
1051	Orizona	9
1052	Ouro Verde de Goiás	9
1053	Ouvidor	9
1054	Padre Bernardo	9
1055	Palestina de Goiás	9
1056	Palmeiras de Goiás	9
1057	Palmelo	9
1058	Palminópolis	9
1059	Panamá	9
1060	Paranaiguara	9
1061	Paraúna	9
1062	Perolândia	9
1063	Petrolina de Goiás	9
1064	Pilar de Goiás	9
1065	Piracanjuba	9
1066	Piranhas	9
1067	Pirenópolis	9
1068	Pires do Rio	9
1069	Planaltina	9
1070	Pontalina	9
1071	Porangatu	9
1072	Porteirão	9
1073	Portelândia	9
1074	Posse	9
1075	Professor Jamil	9
1076	Quirinópolis	9
1077	Rialma	9
1078	Rianápolis	9
1079	Rio Quente	9
1080	Rio Verde	9
1081	Rubiataba	9
1082	Sanclerlândia	9
1083	Santa Bárbara de Goiás	9
1084	Santa Cruz de Goiás	9
1085	Santa Fé de Goiás	9
1086	Santa Helena de Goiás	9
1087	Santa Isabel	9
1088	Santa Rita do Araguaia	9
1089	Santa Rita do Novo Destino	9
1090	Santa Rosa de Goiás	9
1091	Santa Tereza de Goiás	9
1092	Santa Terezinha de Goiás	9
1093	Santo Antônio da Barra	9
1094	Santo Antônio de Goiás	9
1095	Santo Antônio do Descoberto	9
1096	São Domingos	9
1097	São Francisco de Goiás	9
1098	São João dAliança	9
1099	São João da Paraúna	9
1100	São Luís de Montes Belos	9
1101	São Luíz do Norte	9
1102	São Miguel do Araguaia	9
1103	São Miguel do Passa Quatro	9
1104	São Patrício	9
1105	São Simão	9
1106	Senador Canedo	9
1107	Serranópolis	9
1108	Silvânia	9
1109	Simolândia	9
1110	Sítio dAbadia	9
1111	Taquaral de Goiás	9
1112	Teresina de Goiás	9
1113	Terezópolis de Goiás	9
1114	Três Ranchos	9
1115	Trindade	9
1116	Trombas	9
1117	Turvânia	9
1118	Turvelândia	9
1119	Uirapuru	9
1120	Uruaçu	9
1121	Uruana	9
1122	Urutaí	9
1123	Valparaíso de Goiás	9
1124	Varjão	9
1125	Vianópolis	9
1126	Vicentinópolis	9
1127	Vila Boa	9
1128	Vila Propício	9
1129	Açailândia	10
1130	Afonso Cunha	10
1131	Água Doce do Maranhão	10
1132	Alcântara	10
1133	Aldeias Altas	10
1134	Altamira do Maranhão	10
1135	Alto Alegre do Maranhão	10
1136	Alto Alegre do Pindaré	10
1137	Alto Parnaíba	10
1138	Amapá do Maranhão	10
1139	Amarante do Maranhão	10
1140	Anajatuba	10
1141	Anapurus	10
1142	Apicum-Açu	10
1143	Araguanã	10
1144	Araioses	10
1145	Arame	10
1146	Arari	10
1147	Axixá	10
1148	Bacabal	10
1149	Bacabeira	10
1150	Bacuri	10
1151	Bacurituba	10
1152	Balsas	10
1153	Barão de Grajaú	10
1154	Barra do Corda	10
1155	Barreirinhas	10
1156	Bela Vista do Maranhão	10
1157	Belágua	10
1158	Benedito Leite	10
1159	Bequimão	10
1160	Bernardo do Mearim	10
1161	Boa Vista do Gurupi	10
1162	Bom Jardim	10
1163	Bom Jesus das Selvas	10
1164	Bom Lugar	10
1165	Brejo	10
1166	Brejo de Areia	10
1167	Buriti	10
1168	Buriti Bravo	10
1169	Buriticupu	10
1170	Buritirana	10
1171	Cachoeira Grande	10
1172	Cajapió	10
1173	Cajari	10
1174	Campestre do Maranhão	10
1175	Cândido Mendes	10
1176	Cantanhede	10
1177	Capinzal do Norte	10
1178	Carolina	10
1179	Carutapera	10
1180	Caxias	10
1181	Cedral	10
1182	Central do Maranhão	10
1183	Centro do Guilherme	10
1184	Centro Novo do Maranhão	10
1185	Chapadinha	10
1186	Cidelândia	10
1187	Codó	10
1188	Coelho Neto	10
1189	Colinas	10
1190	Conceição do Lago-Açu	10
1191	Coroatá	10
1192	Cururupu	10
1193	Davinópolis	10
1194	Dom Pedro	10
1195	Duque Bacelar	10
1196	Esperantinópolis	10
1197	Estreito	10
1198	Feira Nova do Maranhão	10
1199	Fernando Falcão	10
1200	Formosa da Serra Negra	10
1201	Fortaleza dos Nogueiras	10
1202	Fortuna	10
1203	Godofredo Viana	10
1204	Gonçalves Dias	10
1205	Governador Archer	10
1206	Governador Edison Lobão	10
1207	Governador Eugênio Barros	10
1208	Governador Luiz Rocha	10
1209	Governador Newton Bello	10
1210	Governador Nunes Freire	10
1211	Graça Aranha	10
1212	Grajaú	10
1213	Guimarães	10
1214	Humberto de Campos	10
1215	Icatu	10
1216	Igarapé do Meio	10
1217	Igarapé Grande	10
1218	Imperatriz	10
1219	Itaipava do Grajaú	10
1220	Itapecuru Mirim	10
1221	Itinga do Maranhão	10
1222	Jatobá	10
1223	Jenipapo dos Vieiras	10
1224	João Lisboa	10
1225	Joselândia	10
1226	Junco do Maranhão	10
1227	Lago da Pedra	10
1228	Lago do Junco	10
1229	Lago dos Rodrigues	10
1230	Lago Verde	10
1231	Lagoa do Mato	10
1232	Lagoa Grande do Maranhão	10
1233	Lajeado Novo	10
1234	Lima Campos	10
1235	Loreto	10
1236	Luís Domingues	10
1237	Magalhães de Almeida	10
1238	Maracaçumé	10
1239	Marajá do Sena	10
1240	Maranhãozinho	10
1241	Mata Roma	10
1242	Matinha	10
1243	Matões	10
1244	Matões do Norte	10
1245	Milagres do Maranhão	10
1246	Mirador	10
1247	Miranda do Norte	10
1248	Mirinzal	10
1249	Monção	10
1250	Montes Altos	10
1251	Morros	10
1252	Nina Rodrigues	10
1253	Nova Colinas	10
1254	Nova Iorque	10
1255	Nova Olinda do Maranhão	10
1256	Olho dÁgua das Cunhãs	10
1257	Olinda Nova do Maranhão	10
1258	Paço do Lumiar	10
1259	Palmeirândia	10
1260	Paraibano	10
1261	Parnarama	10
1262	Passagem Franca	10
1263	Pastos Bons	10
1264	Paulino Neves	10
1265	Paulo Ramos	10
1266	Pedreiras	10
1267	Pedro do Rosário	10
1268	Penalva	10
1269	Peri Mirim	10
1270	Peritoró	10
1271	Pindaré-Mirim	10
1272	Pinheiro	10
1273	Pio XII	10
1274	Pirapemas	10
1275	Poção de Pedras	10
1276	Porto Franco	10
1277	Porto Rico do Maranhão	10
1278	Presidente Dutra	10
1279	Presidente Juscelino	10
1280	Presidente Médici	10
1281	Presidente Sarney	10
1282	Presidente Vargas	10
1283	Primeira Cruz	10
1284	Raposa	10
1285	Riachão	10
1286	Ribamar Fiquene	10
1287	Rosário	10
1288	Sambaíba	10
1289	Santa Filomena do Maranhão	10
1290	Santa Helena	10
1291	Santa Inês	10
1292	Santa Luzia	10
1293	Santa Luzia do Paruá	10
1294	Santa Quitéria do Maranhão	10
1295	Santa Rita	10
1296	Santana do Maranhão	10
1297	Santo Amaro do Maranhão	10
1298	Santo Antônio dos Lopes	10
1299	São Benedito do Rio Preto	10
1300	São Bento	10
1301	São Bernardo	10
1302	São Domingos do Azeitão	10
1303	São Domingos do Maranhão	10
1304	São Félix de Balsas	10
1305	São Francisco do Brejão	10
1306	São Francisco do Maranhão	10
1307	São João Batista	10
1308	São João do Carú	10
1309	São João do Paraíso	10
1310	São João do Soter	10
1311	São João dos Patos	10
1312	São José de Ribamar	10
1313	São José dos Basílios	10
1314	São Luís	10
1315	São Luís Gonzaga do Maranhão	10
1316	São Mateus do Maranhão	10
1317	São Pedro da Água Branca	10
1318	São Pedro dos Crentes	10
1319	São Raimundo das Mangabeiras	10
1320	São Raimundo do Doca Bezerra	10
1321	São Roberto	10
1322	São Vicente Ferrer	10
1323	Satubinha	10
1324	Senador Alexandre Costa	10
1325	Senador La Rocque	10
1326	Serrano do Maranhão	10
1327	Sítio Novo	10
1328	Sucupira do Norte	10
1329	Sucupira do Riachão	10
1330	Tasso Fragoso	10
1331	Timbiras	10
1332	Timon	10
1333	Trizidela do Vale	10
1334	Tufilândia	10
1335	Tuntum	10
1336	Turiaçu	10
1337	Turilândia	10
1338	Tutóia	10
1339	Urbano Santos	10
1340	Vargem Grande	10
1341	Viana	10
1342	Vila Nova dos Martírios	10
1343	Vitória do Mearim	10
1344	Vitorino Freire	10
1345	Zé Doca	10
1346	Acorizal	13
1347	Água Boa	13
1348	Alta Floresta	13
1349	Alto Araguaia	13
1350	Alto Boa Vista	13
1351	Alto Garças	13
1352	Alto Paraguai	13
1353	Alto Taquari	13
1354	Apiacás	13
1355	Araguaiana	13
1356	Araguainha	13
1357	Araputanga	13
1358	Arenápolis	13
1359	Aripuanã	13
1360	Barão de Melgaço	13
1361	Barra do Bugres	13
1362	Barra do Garças	13
1363	Bom Jesus do Araguaia	13
1364	Brasnorte	13
1365	Cáceres	13
1366	Campinápolis	13
1367	Campo Novo do Parecis	13
1368	Campo Verde	13
1369	Campos de Júlio	13
1370	Canabrava do Norte	13
1371	Canarana	13
1372	Carlinda	13
1373	Castanheira	13
1374	Chapada dos Guimarães	13
1375	Cláudia	13
1376	Cocalinho	13
1377	Colíder	13
1378	Colniza	13
1379	Comodoro	13
1380	Confresa	13
1381	Conquista dOeste	13
1382	Cotriguaçu	13
1383	Cuiabá	13
1384	Curvelândia	13
1385	Curvelândia	13
1386	Denise	13
1387	Diamantino	13
1388	Dom Aquino	13
1389	Feliz Natal	13
1390	Figueirópolis dOeste	13
1391	Gaúcha do Norte	13
1392	General Carneiro	13
1393	Glória dOeste	13
1394	Guarantã do Norte	13
1395	Guiratinga	13
1396	Indiavaí	13
1397	Ipiranga do Norte	13
1398	Itanhangá	13
1399	Itaúba	13
1400	Itiquira	13
1401	Jaciara	13
1402	Jangada	13
1403	Jauru	13
1404	Juara	13
1405	Juína	13
1406	Juruena	13
1407	Juscimeira	13
1408	Lambari dOeste	13
1409	Lucas do Rio Verde	13
1410	Luciára	13
1411	Marcelândia	13
1412	Matupá	13
1413	Mirassol dOeste	13
1414	Nobres	13
1415	Nortelândia	13
1416	Nossa Senhora do Livramento	13
1417	Nova Bandeirantes	13
1418	Nova Brasilândia	13
1419	Nova Canaã do Norte	13
1420	Nova Guarita	13
1421	Nova Lacerda	13
1422	Nova Marilândia	13
1423	Nova Maringá	13
1424	Nova Monte verde	13
1425	Nova Mutum	13
1426	Nova Olímpia	13
1427	Nova Santa Helena	13
1428	Nova Ubiratã	13
1429	Nova Xavantina	13
1430	Novo Horizonte do Norte	13
1431	Novo Mundo	13
1432	Novo Santo Antônio	13
1433	Novo São Joaquim	13
1434	Paranaíta	13
1435	Paranatinga	13
1436	Pedra Preta	13
1437	Peixoto de Azevedo	13
1438	Planalto da Serra	13
1439	Poconé	13
1440	Pontal do Araguaia	13
1441	Ponte Branca	13
1442	Pontes e Lacerda	13
1443	Porto Alegre do Norte	13
1444	Porto dos Gaúchos	13
1445	Porto Esperidião	13
1446	Porto Estrela	13
1447	Poxoréo	13
1448	Primavera do Leste	13
1449	Querência	13
1450	Reserva do Cabaçal	13
1451	Ribeirão Cascalheira	13
1452	Ribeirãozinho	13
1453	Rio Branco	13
1454	Rondolândia	13
1455	Rondonópolis	13
1456	Rosário Oeste	13
1457	Salto do Céu	13
1458	Santa Carmem	13
1459	Santa Cruz do Xingu	13
1460	Santa Rita do Trivelato	13
1461	Santa Terezinha	13
1462	Santo Afonso	13
1463	Santo Antônio do Leste	13
1464	Santo Antônio do Leverger	13
1465	São Félix do Araguaia	13
1466	São José do Povo	13
1467	São José do Rio Claro	13
1468	São José do Xingu	13
1469	São José dos Quatro Marcos	13
1470	São Pedro da Cipa	13
1471	Sapezal	13
1472	Serra Nova Dourada	13
1473	Sinop	13
1474	Sorriso	13
1475	Tabaporã	13
1476	Tangará da Serra	13
1477	Tapurah	13
1478	Terra Nova do Norte	13
1479	Tesouro	13
1480	Torixoréu	13
1481	União do Sul	13
1482	Vale de São Domingos	13
1483	Várzea Grande	13
1484	Vera	13
1485	Vila Bela da Santíssima Trindade	13
1486	Vila Rica	13
1487	Água Clara	12
1488	Alcinópolis	12
1489	Amambaí	12
1490	Anastácio	12
1491	Anaurilândia	12
1492	Angélica	12
1493	Antônio João	12
1494	Aparecida do Taboado	12
1495	Aquidauana	12
1496	Aral Moreira	12
1497	Bandeirantes	12
1498	Bataguassu	12
1499	Bataiporã	12
1500	Bela Vista	12
1501	Bodoquena	12
1502	Bonito	12
1503	Brasilândia	12
1504	Caarapó	12
1505	Camapuã	12
1506	Campo Grande	12
1507	Caracol	12
1508	Cassilândia	12
1509	Chapadão do Sul	12
1510	Corguinho	12
1511	Coronel Sapucaia	12
1512	Corumbá	12
1513	Costa Rica	12
1514	Coxim	12
1515	Deodápolis	12
1516	Dois Irmãos do Buriti	12
1517	Douradina	12
1518	Dourados	12
1519	Eldorado	12
1520	Fátima do Sul	12
1521	Figueirão	12
1522	Glória de Dourados	12
1523	Guia Lopes da Laguna	12
1524	Iguatemi	12
1525	Inocência	12
1526	Itaporã	12
1527	Itaquiraí	12
1528	Ivinhema	12
1529	Japorã	12
1530	Jaraguari	12
1531	Jardim	12
1532	Jateí	12
1533	Juti	12
1534	Ladário	12
1535	Laguna Carapã	12
1536	Maracaju	12
1537	Miranda	12
1538	Mundo Novo	12
1539	Naviraí	12
1540	Nioaque	12
1541	Nova Alvorada do Sul	12
1542	Nova Andradina	12
1543	Novo Horizonte do Sul	12
1544	Paranaíba	12
1545	Paranhos	12
1546	Pedro Gomes	12
1547	Ponta Porã	12
1548	Porto Murtinho	12
1549	Ribas do Rio Pardo	12
1550	Rio Brilhante	12
1551	Rio Negro	12
1552	Rio Verde de Mato Grosso	12
1553	Rochedo	12
1554	Santa Rita do Pardo	12
1555	São Gabriel do Oeste	12
1556	Selvíria	12
1557	Sete Quedas	12
1558	Sidrolândia	12
1559	Sonora	12
1560	Tacuru	12
1561	Taquarussu	12
1562	Terenos	12
1563	Três Lagoas	12
1564	Vicentina	12
1565	Abadia dos Dourados	11
1566	Abaeté	11
1567	Abre Campo	11
1568	Acaiaca	11
1569	Açucena	11
1570	Água Boa	11
1571	Água Comprida	11
1572	Aguanil	11
1573	Águas Formosas	11
1574	Águas Vermelhas	11
1575	Aimorés	11
1576	Aiuruoca	11
1577	Alagoa	11
1578	Albertina	11
1579	Além Paraíba	11
1580	Alfenas	11
1581	Alfredo Vasconcelos	11
1582	Almenara	11
1583	Alpercata	11
1584	Alpinópolis	11
1585	Alterosa	11
1586	Alto Caparaó	11
1587	Alto Jequitibá	11
1588	Alto Rio Doce	11
1589	Alvarenga	11
1590	Alvinópolis	11
1591	Alvorada de Minas	11
1592	Amparo do Serra	11
1593	Andradas	11
1594	Andrelândia	11
1595	Angelândia	11
1596	Antônio Carlos	11
1597	Antônio Dias	11
1598	Antônio Prado de Minas	11
1599	Araçaí	11
1600	Aracitaba	11
1601	Araçuaí	11
1602	Araguari	11
1603	Arantina	11
1604	Araponga	11
1605	Araporã	11
1606	Arapuá	11
1607	Araújos	11
1608	Araxá	11
1609	Arceburgo	11
1610	Arcos	11
1611	Areado	11
1612	Argirita	11
1613	Aricanduva	11
1614	Arinos	11
1615	Astolfo Dutra	11
1616	Ataléia	11
1617	Augusto de Lima	11
1618	Baependi	11
1619	Baldim	11
1620	Bambuí	11
1621	Bandeira	11
1622	Bandeira do Sul	11
1623	Barão de Cocais	11
1624	Barão de Monte Alto	11
1625	Barbacena	11
1626	Barra Longa	11
1627	Barroso	11
1628	Bela Vista de Minas	11
1629	Belmiro Braga	11
1630	Belo Horizonte	11
1631	Belo Oriente	11
1632	Belo Vale	11
1633	Berilo	11
1634	Berizal	11
1635	Bertópolis	11
1636	Betim	11
1637	Bias Fortes	11
1638	Bicas	11
1639	Biquinhas	11
1640	Boa Esperança	11
1641	Bocaina de Minas	11
1642	Bocaiúva	11
1643	Bom Despacho	11
1644	Bom Jardim de Minas	11
1645	Bom Jesus da Penha	11
1646	Bom Jesus do Amparo	11
1647	Bom Jesus do Galho	11
1648	Bom Repouso	11
1649	Bom Sucesso	11
1650	Bonfim	11
1651	Bonfinópolis de Minas	11
1652	Bonito de Minas	11
1653	Borda da Mata	11
1654	Botelhos	11
1655	Botumirim	11
1656	Brás Pires	11
1657	Brasilândia de Minas	11
1658	Brasília de Minas	11
1659	Brasópolis	11
1660	Braúnas	11
1661	Brumadinho	11
1662	Bueno Brandão	11
1663	Buenópolis	11
1664	Bugre	11
1665	Buritis	11
1666	Buritizeiro	11
1667	Cabeceira Grande	11
1668	Cabo Verde	11
1669	Cachoeira da Prata	11
1670	Cachoeira de Minas	11
1671	Cachoeira de Pajeú	11
1672	Cachoeira Dourada	11
1673	Caetanópolis	11
1674	Caeté	11
1675	Caiana	11
1676	Cajuri	11
1677	Caldas	11
1678	Camacho	11
1679	Camanducaia	11
1680	Cambuí	11
1681	Cambuquira	11
1682	Campanário	11
1683	Campanha	11
1684	Campestre	11
1685	Campina Verde	11
1686	Campo Azul	11
1687	Campo Belo	11
1688	Campo do Meio	11
1689	Campo Florido	11
1690	Campos Altos	11
1691	Campos Gerais	11
1692	Cana Verde	11
1693	Canaã	11
1694	Canápolis	11
1695	Candeias	11
1696	Cantagalo	11
1697	Caparaó	11
1698	Capela Nova	11
1699	Capelinha	11
1700	Capetinga	11
1701	Capim Branco	11
1702	Capinópolis	11
1703	Capitão Andrade	11
1704	Capitão Enéas	11
1705	Capitólio	11
1706	Caputira	11
1707	Caraí	11
1708	Caranaíba	11
1709	Carandaí	11
1710	Carangola	11
1711	Caratinga	11
1712	Carbonita	11
1713	Careaçu	11
1714	Carlos Chagas	11
1715	Carmésia	11
1716	Carmo da Cachoeira	11
1717	Carmo da Mata	11
1718	Carmo de Minas	11
1719	Carmo do Cajuru	11
1720	Carmo do Paranaíba	11
1721	Carmo do Rio Claro	11
1722	Carmópolis de Minas	11
1723	Carneirinho	11
1724	Carrancas	11
1725	Carvalhópolis	11
1726	Carvalhos	11
1727	Casa Grande	11
1728	Cascalho Rico	11
1729	Cássia	11
1730	Cataguases	11
1731	Catas Altas	11
1732	Catas Altas da Noruega	11
1733	Catuji	11
1734	Catuti	11
1735	Caxambu	11
1736	Cedro do Abaeté	11
1737	Central de Minas	11
1738	Centralina	11
1739	Chácara	11
1740	Chalé	11
1741	Chapada do Norte	11
1742	Chapada Gaúcha	11
1743	Chiador	11
1744	Cipotânea	11
1745	Claraval	11
1746	Claro dos Poções	11
1747	Cláudio	11
1748	Coimbra	11
1749	Coluna	11
1750	Comendador Gomes	11
1751	Comercinho	11
1752	Conceição da Aparecida	11
1753	Conceição da Barra de Minas	11
1754	Conceição das Alagoas	11
1755	Conceição das Pedras	11
1756	Conceição de Ipanema	11
1757	Conceição do Mato Dentro	11
1758	Conceição do Pará	11
1759	Conceição do Rio Verde	11
1760	Conceição dos Ouros	11
1761	Cônego Marinho	11
1762	Confins	11
1763	Congonhal	11
1764	Congonhas	11
1765	Congonhas do Norte	11
1766	Conquista	11
1767	Conselheiro Lafaiete	11
1768	Conselheiro Pena	11
1769	Consolação	11
1770	Contagem	11
1771	Coqueiral	11
1772	Coração de Jesus	11
1773	Cordisburgo	11
1774	Cordislândia	11
1775	Corinto	11
1776	Coroaci	11
1777	Coromandel	11
1778	Coronel Fabriciano	11
1779	Coronel Murta	11
1780	Coronel Pacheco	11
1781	Coronel Xavier Chaves	11
1782	Córrego Danta	11
1783	Córrego do Bom Jesus	11
1784	Córrego Fundo	11
1785	Córrego Novo	11
1786	Couto de Magalhães de Minas	11
1787	Crisólita	11
1788	Cristais	11
1789	Cristália	11
1790	Cristiano Otoni	11
1791	Cristina	11
1792	Crucilândia	11
1793	Cruzeiro da Fortaleza	11
1794	Cruzília	11
1795	Cuparaque	11
1796	Curral de Dentro	11
1797	Curvelo	11
1798	Datas	11
1799	Delfim Moreira	11
1800	Delfinópolis	11
1801	Delta	11
1802	Descoberto	11
1803	Desterro de Entre Rios	11
1804	Desterro do Melo	11
1805	Diamantina	11
1806	Diogo de Vasconcelos	11
1807	Dionísio	11
1808	Divinésia	11
1809	Divino	11
1810	Divino das Laranjeiras	11
1811	Divinolândia de Minas	11
1812	Divinópolis	11
1813	Divisa Alegre	11
1814	Divisa Nova	11
1815	Divisópolis	11
1816	Dom Bosco	11
1817	Dom Cavati	11
1818	Dom Joaquim	11
1819	Dom Silvério	11
1820	Dom Viçoso	11
1821	Dona Eusébia	11
1822	Dores de Campos	11
1823	Dores de Guanhães	11
1824	Dores do Indaiá	11
1825	Dores do Turvo	11
1826	Doresópolis	11
1827	Douradoquara	11
1828	Durandé	11
1829	Elói Mendes	11
1830	Engenheiro Caldas	11
1831	Engenheiro Navarro	11
1832	Entre Folhas	11
1833	Entre Rios de Minas	11
1834	Ervália	11
1835	Esmeraldas	11
1836	Espera Feliz	11
1837	Espinosa	11
1838	Espírito Santo do Dourado	11
1839	Estiva	11
1840	Estrela Dalva	11
1841	Estrela do Indaiá	11
1842	Estrela do Sul	11
1843	Eugenópolis	11
1844	Ewbank da Câmara	11
1845	Extrema	11
1846	Fama	11
1847	Faria Lemos	11
1848	Felício dos Santos	11
1849	Felisburgo	11
1850	Felixlândia	11
1851	Fernandes Tourinho	11
1852	Ferros	11
1853	Fervedouro	11
1854	Florestal	11
1855	Formiga	11
1856	Formoso	11
1857	Fortaleza de Minas	11
1858	Fortuna de Minas	11
1859	Francisco Badaró	11
1860	Francisco Dumont	11
1861	Francisco Sá	11
1862	Franciscópolis	11
1863	Frei Gaspar	11
1864	Frei Inocêncio	11
1865	Frei Lagonegro	11
1866	Fronteira	11
1867	Fronteira dos Vales	11
1868	Fruta de Leite	11
1869	Frutal	11
1870	Funilândia	11
1871	Galiléia	11
1872	Gameleiras	11
1873	Glaucilândia	11
1874	Goiabeira	11
1875	Goianá	11
1876	Gonçalves	11
1877	Gonzaga	11
1878	Gouveia	11
1879	Governador Valadares	11
1880	Grão Mogol	11
1881	Grupiara	11
1882	Guanhães	11
1883	Guapé	11
1884	Guaraciaba	11
1885	Guaraciama	11
1886	Guaranésia	11
1887	Guarani	11
1888	Guarará	11
1889	Guarda-Mor	11
1890	Guaxupé	11
1891	Guidoval	11
1892	Guimarânia	11
1893	Guiricema	11
1894	Gurinhatã	11
1895	Heliodora	11
1896	Iapu	11
1897	Ibertioga	11
1898	Ibiá	11
1899	Ibiaí	11
1900	Ibiracatu	11
1901	Ibiraci	11
1902	Ibirité	11
1903	Ibitiúra de Minas	11
1904	Ibituruna	11
1905	Icaraí de Minas	11
1906	Igarapé	11
1907	Igaratinga	11
1908	Iguatama	11
1909	Ijaci	11
1910	Ilicínea	11
1911	Imbé de Minas	11
1912	Inconfidentes	11
1913	Indaiabira	11
1914	Indianópolis	11
1915	Ingaí	11
1916	Inhapim	11
1917	Inhaúma	11
1918	Inimutaba	11
1919	Ipaba	11
1920	Ipanema	11
1921	Ipatinga	11
1922	Ipiaçu	11
1923	Ipuiúna	11
1924	Iraí de Minas	11
1925	Itabira	11
1926	Itabirinha de Mantena	11
1927	Itabirito	11
1928	Itacambira	11
1929	Itacarambi	11
1930	Itaguara	11
1931	Itaipé	11
1932	Itajubá	11
1933	Itamarandiba	11
1934	Itamarati de Minas	11
1935	Itambacuri	11
1936	Itambé do Mato Dentro	11
1937	Itamogi	11
1938	Itamonte	11
1939	Itanhandu	11
1940	Itanhomi	11
1941	Itaobim	11
1942	Itapagipe	11
1943	Itapecerica	11
1944	Itapeva	11
1945	Itatiaiuçu	11
1946	Itaú de Minas	11
1947	Itaúna	11
1948	Itaverava	11
1949	Itinga	11
1950	Itueta	11
1951	Ituiutaba	11
1952	Itumirim	11
1953	Iturama	11
1954	Itutinga	11
1955	Jaboticatubas	11
1956	Jacinto	11
1957	Jacuí	11
1958	Jacutinga	11
1959	Jaguaraçu	11
1960	Jaíba	11
1961	Jampruca	11
1962	Janaúba	11
1963	Januária	11
1964	Japaraíba	11
1965	Japonvar	11
1966	Jeceaba	11
1967	Jenipapo de Minas	11
1968	Jequeri	11
1969	Jequitaí	11
1970	Jequitibá	11
1971	Jequitinhonha	11
1972	Jesuânia	11
1973	Joaíma	11
1974	Joanésia	11
1975	João Monlevade	11
1976	João Pinheiro	11
1977	Joaquim Felício	11
1978	Jordânia	11
1979	José Gonçalves de Minas	11
1980	José Raydan	11
1981	Josenópolis	11
1982	Juatuba	11
1983	Juiz de Fora	11
1984	Juramento	11
1985	Juruaia	11
1986	Juvenília	11
1987	Ladainha	11
1988	Lagamar	11
1989	Lagoa da Prata	11
1990	Lagoa dos Patos	11
1991	Lagoa Dourada	11
1992	Lagoa Formosa	11
1993	Lagoa Grande	11
1994	Lagoa Santa	11
1995	Lajinha	11
1996	Lambari	11
1997	Lamim	11
1998	Laranjal	11
1999	Lassance	11
2000	Lavras	11
2001	Leandro Ferreira	11
2002	Leme do Prado	11
2003	Leopoldina	11
2004	Liberdade	11
2005	Lima Duarte	11
2006	Limeira do Oeste	11
2007	Lontra	11
2008	Luisburgo	11
2009	Luislândia	11
2010	Luminárias	11
2011	Luz	11
2012	Machacalis	11
2013	Machado	11
2014	Madre de Deus de Minas	11
2015	Malacacheta	11
2016	Mamonas	11
2017	Manga	11
2018	Manhuaçu	11
2019	Manhumirim	11
2020	Mantena	11
2021	Mar de Espanha	11
2022	Maravilhas	11
2023	Maria da Fé	11
2024	Mariana	11
2025	Marilac	11
2026	Mário Campos	11
2027	Maripá de Minas	11
2028	Marliéria	11
2029	Marmelópolis	11
2030	Martinho Campos	11
2031	Martins Soares	11
2032	Mata Verde	11
2033	Materlândia	11
2034	Mateus Leme	11
2035	Mathias Lobato	11
2036	Matias Barbosa	11
2037	Matias Cardoso	11
2038	Matipó	11
2039	Mato Verde	11
2040	Matozinhos	11
2041	Matutina	11
2042	Medeiros	11
2043	Medina	11
2044	Mendes Pimentel	11
2045	Mercês	11
2046	Mesquita	11
2047	Minas Novas	11
2048	Minduri	11
2049	Mirabela	11
2050	Miradouro	11
2051	Miraí	11
2052	Miravânia	11
2053	Moeda	11
2054	Moema	11
2055	Monjolos	11
2056	Monsenhor Paulo	11
2057	Montalvânia	11
2058	Monte Alegre de Minas	11
2059	Monte Azul	11
2060	Monte Belo	11
2061	Monte Carmelo	11
2062	Monte Formoso	11
2063	Monte Santo de Minas	11
2064	Monte Sião	11
2065	Montes Claros	11
2066	Montezuma	11
2067	Morada Nova de Minas	11
2068	Morro da Garça	11
2069	Morro do Pilar	11
2070	Munhoz	11
2071	Muriaé	11
2072	Mutum	11
2073	Muzambinho	11
2074	Nacip Raydan	11
2075	Nanuque	11
2076	Naque	11
2077	Natalândia	11
2078	Natércia	11
2079	Nazareno	11
2080	Nepomuceno	11
2081	Ninheira	11
2082	Nova Belém	11
2083	Nova Era	11
2084	Nova Lima	11
2085	Nova Módica	11
2086	Nova Ponte	11
2087	Nova Porteirinha	11
2088	Nova Resende	11
2089	Nova Serrana	11
2090	Nova União	11
2091	Novo Cruzeiro	11
2092	Novo Oriente de Minas	11
2093	Novorizonte	11
2094	Olaria	11
2095	Olhos-dÁgua	11
2096	Olímpio Noronha	11
2097	Oliveira	11
2098	Oliveira Fortes	11
2099	Onça de Pitangui	11
2100	Oratórios	11
2101	Orizânia	11
2102	Ouro Branco	11
2103	Ouro Fino	11
2104	Ouro Preto	11
2105	Ouro Verde de Minas	11
2106	Padre Carvalho	11
2107	Padre Paraíso	11
2108	Pai Pedro	11
2109	Paineiras	11
2110	Pains	11
2111	Paiva	11
2112	Palma	11
2113	Palmópolis	11
2114	Papagaios	11
2115	Pará de Minas	11
2116	Paracatu	11
2117	Paraguaçu	11
2118	Paraisópolis	11
2119	Paraopeba	11
2120	Passa Quatro	11
2121	Passa Tempo	11
2122	Passabém	11
2123	Passa-Vinte	11
2124	Passos	11
2125	Patis	11
2126	Patos de Minas	11
2127	Patrocínio	11
2128	Patrocínio do Muriaé	11
2129	Paula Cândido	11
2130	Paulistas	11
2131	Pavão	11
2132	Peçanha	11
2133	Pedra Azul	11
2134	Pedra Bonita	11
2135	Pedra do Anta	11
2136	Pedra do Indaiá	11
2137	Pedra Dourada	11
2138	Pedralva	11
2139	Pedras de Maria da Cruz	11
2140	Pedrinópolis	11
2141	Pedro Leopoldo	11
2142	Pedro Teixeira	11
2143	Pequeri	11
2144	Pequi	11
2145	Perdigão	11
2146	Perdizes	11
2147	Perdões	11
2148	Periquito	11
2149	Pescador	11
2150	Piau	11
2151	Piedade de Caratinga	11
2152	Piedade de Ponte Nova	11
2153	Piedade do Rio Grande	11
2154	Piedade dos Gerais	11
2155	Pimenta	11
2156	Pingo-dÁgua	11
2157	Pintópolis	11
2158	Piracema	11
2159	Pirajuba	11
2160	Piranga	11
2161	Piranguçu	11
2162	Piranguinho	11
2163	Pirapetinga	11
2164	Pirapora	11
2165	Piraúba	11
2166	Pitangui	11
2167	Piumhi	11
2168	Planura	11
2169	Poço Fundo	11
2170	Poços de Caldas	11
2171	Pocrane	11
2172	Pompéu	11
2173	Ponte Nova	11
2174	Ponto Chique	11
2175	Ponto dos Volantes	11
2176	Porteirinha	11
2177	Porto Firme	11
2178	Poté	11
2179	Pouso Alegre	11
2180	Pouso Alto	11
2181	Prados	11
2182	Prata	11
2183	Pratápolis	11
2184	Pratinha	11
2185	Presidente Bernardes	11
2186	Presidente Juscelino	11
2187	Presidente Kubitschek	11
2188	Presidente Olegário	11
2189	Prudente de Morais	11
2190	Quartel Geral	11
2191	Queluzito	11
2192	Raposos	11
2193	Raul Soares	11
2194	Recreio	11
2195	Reduto	11
2196	Resende Costa	11
2197	Resplendor	11
2198	Ressaquinha	11
2199	Riachinho	11
2200	Riacho dos Machados	11
2201	Ribeirão das Neves	11
2202	Ribeirão Vermelho	11
2203	Rio Acima	11
2204	Rio Casca	11
2205	Rio do Prado	11
2206	Rio Doce	11
2207	Rio Espera	11
2208	Rio Manso	11
2209	Rio Novo	11
2210	Rio Paranaíba	11
2211	Rio Pardo de Minas	11
2212	Rio Piracicaba	11
2213	Rio Pomba	11
2214	Rio Preto	11
2215	Rio Vermelho	11
2216	Ritápolis	11
2217	Rochedo de Minas	11
2218	Rodeiro	11
2219	Romaria	11
2220	Rosário da Limeira	11
2221	Rubelita	11
2222	Rubim	11
2223	Sabará	11
2224	Sabinópolis	11
2225	Sacramento	11
2226	Salinas	11
2227	Salto da Divisa	11
2228	Santa Bárbara	11
2229	Santa Bárbara do Leste	11
2230	Santa Bárbara do Monte Verde	11
2231	Santa Bárbara do Tugúrio	11
2232	Santa Cruz de Minas	11
2233	Santa Cruz de Salinas	11
2234	Santa Cruz do Escalvado	11
2235	Santa Efigênia de Minas	11
2236	Santa Fé de Minas	11
2237	Santa Helena de Minas	11
2238	Santa Juliana	11
2239	Santa Luzia	11
2240	Santa Margarida	11
2241	Santa Maria de Itabira	11
2242	Santa Maria do Salto	11
2243	Santa Maria do Suaçuí	11
2244	Santa Rita de Caldas	11
2245	Santa Rita de Ibitipoca	11
2246	Santa Rita de Jacutinga	11
2247	Santa Rita de Minas	11
2248	Santa Rita do Itueto	11
2249	Santa Rita do Sapucaí	11
2250	Santa Rosa da Serra	11
2251	Santa Vitória	11
2252	Santana da Vargem	11
2253	Santana de Cataguases	11
2254	Santana de Pirapama	11
2255	Santana do Deserto	11
2256	Santana do Garambéu	11
2257	Santana do Jacaré	11
2258	Santana do Manhuaçu	11
2259	Santana do Paraíso	11
2260	Santana do Riacho	11
2261	Santana dos Montes	11
2262	Santo Antônio do Amparo	11
2263	Santo Antônio do Aventureiro	11
2264	Santo Antônio do Grama	11
2265	Santo Antônio do Itambé	11
2266	Santo Antônio do Jacinto	11
2267	Santo Antônio do Monte	11
2268	Santo Antônio do Retiro	11
2269	Santo Antônio do Rio Abaixo	11
2270	Santo Hipólito	11
2271	Santos Dumont	11
2272	São Bento Abade	11
2273	São Brás do Suaçuí	11
2274	São Domingos das Dores	11
2275	São Domingos do Prata	11
2276	São Félix de Minas	11
2277	São Francisco	11
2278	São Francisco de Paula	11
2279	São Francisco de Sales	11
2280	São Francisco do Glória	11
2281	São Geraldo	11
2282	São Geraldo da Piedade	11
2283	São Geraldo do Baixio	11
2284	São Gonçalo do Abaeté	11
2285	São Gonçalo do Pará	11
2286	São Gonçalo do Rio Abaixo	11
2287	São Gonçalo do Rio Preto	11
2288	São Gonçalo do Sapucaí	11
2289	São Gotardo	11
2290	São João Batista do Glória	11
2291	São João da Lagoa	11
2292	São João da Mata	11
2293	São João da Ponte	11
2294	São João das Missões	11
2295	São João del Rei	11
2296	São João do Manhuaçu	11
2297	São João do Manteninha	11
2298	São João do Oriente	11
2299	São João do Pacuí	11
2300	São João do Paraíso	11
2301	São João Evangelista	11
2302	São João Nepomuceno	11
2303	São Joaquim de Bicas	11
2304	São José da Barra	11
2305	São José da Lapa	11
2306	São José da Safira	11
2307	São José da Varginha	11
2308	São José do Alegre	11
2309	São José do Divino	11
2310	São José do Goiabal	11
2311	São José do Jacuri	11
2312	São José do Mantimento	11
2313	São Lourenço	11
2314	São Miguel do Anta	11
2315	São Pedro da União	11
2316	São Pedro do Suaçuí	11
2317	São Pedro dos Ferros	11
2318	São Romão	11
2319	São Roque de Minas	11
2320	São Sebastião da Bela Vista	11
2321	São Sebastião da Vargem Alegre	11
2322	São Sebastião do Anta	11
2323	São Sebastião do Maranhão	11
2324	São Sebastião do Oeste	11
2325	São Sebastião do Paraíso	11
2326	São Sebastião do Rio Preto	11
2327	São Sebastião do Rio Verde	11
2328	São Thomé das Letras	11
2329	São Tiago	11
2330	São Tomás de Aquino	11
2331	São Vicente de Minas	11
2332	Sapucaí-Mirim	11
2333	Sardoá	11
2334	Sarzedo	11
2335	Sem-Peixe	11
2336	Senador Amaral	11
2337	Senador Cortes	11
2338	Senador Firmino	11
2339	Senador José Bento	11
2340	Senador Modestino Gonçalves	11
2341	Senhora de Oliveira	11
2342	Senhora do Porto	11
2343	Senhora dos Remédios	11
2344	Sericita	11
2345	Seritinga	11
2346	Serra Azul de Minas	11
2347	Serra da Saudade	11
2348	Serra do Salitre	11
2349	Serra dos Aimorés	11
2350	Serrania	11
2351	Serranópolis de Minas	11
2352	Serranos	11
2353	Serro	11
2354	Sete Lagoas	11
2355	Setubinha	11
2356	Silveirânia	11
2357	Silvianópolis	11
2358	Simão Pereira	11
2359	Simonésia	11
2360	Sobrália	11
2361	Soledade de Minas	11
2362	Tabuleiro	11
2363	Taiobeiras	11
2364	Taparuba	11
2365	Tapira	11
2366	Tapiraí	11
2367	Taquaraçu de Minas	11
2368	Tarumirim	11
2369	Teixeiras	11
2370	Teófilo Otoni	11
2371	Timóteo	11
2372	Tiradentes	11
2373	Tiros	11
2374	Tocantins	11
2375	Tocos do Moji	11
2376	Toledo	11
2377	Tombos	11
2378	Três Corações	11
2379	Três Marias	11
2380	Três Pontas	11
2381	Tumiritinga	11
2382	Tupaciguara	11
2383	Turmalina	11
2384	Turvolândia	11
2385	Ubá	11
2386	Ubaí	11
2387	Ubaporanga	11
2388	Uberaba	11
2389	Uberlândia	11
2390	Umburatiba	11
2391	Unaí	11
2392	União de Minas	11
2393	Uruana de Minas	11
2394	Urucânia	11
2395	Urucuia	11
2396	Vargem Alegre	11
2397	Vargem Bonita	11
2398	Vargem Grande do Rio Pardo	11
2399	Varginha	11
2400	Varjão de Minas	11
2401	Várzea da Palma	11
2402	Varzelândia	11
2403	Vazante	11
2404	Verdelândia	11
2405	Veredinha	11
2406	Veríssimo	11
2407	Vermelho Novo	11
2408	Vespasiano	11
2409	Viçosa	11
2410	Vieiras	11
2411	Virgem da Lapa	11
2412	Virgínia	11
2413	Virginópolis	11
2414	Virgolândia	11
2415	Visconde do Rio Branco	11
2416	Volta Grande	11
2417	Wenceslau Braz	11
2418	Abaetetuba	14
2419	Abel Figueiredo	14
2420	Acará	14
2421	Afuá	14
2422	Água Azul do Norte	14
2423	Alenquer	14
2424	Almeirim	14
2425	Altamira	14
2426	Anajás	14
2427	Ananindeua	14
2428	Anapu	14
2429	Augusto Corrêa	14
2430	Aurora do Pará	14
2431	Aveiro	14
2432	Bagre	14
2433	Baião	14
2434	Bannach	14
2435	Barcarena	14
2436	Belém	14
2437	Belterra	14
2438	Benevides	14
2439	Bom Jesus do Tocantins	14
2440	Bonito	14
2441	Bragança	14
2442	Brasil Novo	14
2443	Brejo Grande do Araguaia	14
2444	Breu Branco	14
2445	Breves	14
2446	Bujaru	14
2447	Cachoeira do Arari	14
2448	Cachoeira do Piriá	14
2449	Cametá	14
2450	Canaã dos Carajás	14
2451	Capanema	14
2452	Capitão Poço	14
2453	Castanhal	14
2454	Chaves	14
2455	Colares	14
2456	Conceição do Araguaia	14
2457	Concórdia do Pará	14
2458	Cumaru do Norte	14
2459	Curionópolis	14
2460	Curralinho	14
2461	Curuá	14
2462	Curuçá	14
2463	Dom Eliseu	14
2464	Eldorado dos Carajás	14
2465	Faro	14
2466	Floresta do Araguaia	14
2467	Garrafão do Norte	14
2468	Goianésia do Pará	14
2469	Gurupá	14
2470	Igarapé-Açu	14
2471	Igarapé-Miri	14
2472	Inhangapi	14
2473	Ipixuna do Pará	14
2474	Irituia	14
2475	Itaituba	14
2476	Itupiranga	14
2477	Jacareacanga	14
2478	Jacundá	14
2479	Juruti	14
2480	Limoeiro do Ajuru	14
2481	Mãe do Rio	14
2482	Magalhães Barata	14
2483	Marabá	14
2484	Maracanã	14
2485	Marapanim	14
2486	Marituba	14
2487	Medicilândia	14
2488	Melgaço	14
2489	Mocajuba	14
2490	Moju	14
2491	Monte Alegre	14
2492	Muaná	14
2493	Nova Esperança do Piriá	14
2494	Nova Ipixuna	14
2495	Nova Timboteua	14
2496	Novo Progresso	14
2497	Novo Repartimento	14
2498	Óbidos	14
2499	Oeiras do Pará	14
2500	Oriximiná	14
2501	Ourém	14
2502	Ourilândia do Norte	14
2503	Pacajá	14
2504	Palestina do Pará	14
2505	Paragominas	14
2506	Parauapebas	14
2507	Pau dArco	14
2508	Peixe-Boi	14
2509	Piçarra	14
2510	Placas	14
2511	Ponta de Pedras	14
2512	Portel	14
2513	Porto de Moz	14
2514	Prainha	14
2515	Primavera	14
2516	Quatipuru	14
2517	Redenção	14
2518	Rio Maria	14
2519	Rondon do Pará	14
2520	Rurópolis	14
2521	Salinópolis	14
2522	Salvaterra	14
2523	Santa Bárbara do Pará	14
2524	Santa Cruz do Arari	14
2525	Santa Isabel do Pará	14
2526	Santa Luzia do Pará	14
2527	Santa Maria das Barreiras	14
2528	Santa Maria do Pará	14
2529	Santana do Araguaia	14
2530	Santarém	14
2531	Santarém Novo	14
2532	Santo Antônio do Tauá	14
2533	São Caetano de Odivelas	14
2534	São Domingos do Araguaia	14
2535	São Domingos do Capim	14
2536	São Félix do Xingu	14
2537	São Francisco do Pará	14
2538	São Geraldo do Araguaia	14
2539	São João da Ponta	14
2540	São João de Pirabas	14
2541	São João do Araguaia	14
2542	São Miguel do Guamá	14
2543	São Sebastião da Boa Vista	14
2544	Sapucaia	14
2545	Senador José Porfírio	14
2546	Soure	14
2547	Tailândia	14
2548	Terra Alta	14
2549	Terra Santa	14
2550	Tomé-Açu	14
2551	Tracuateua	14
2552	Trairão	14
2553	Tucumã	14
2554	Tucuruí	14
2555	Ulianópolis	14
2556	Uruará	14
2557	Vigia	14
2558	Viseu	14
2559	Vitória do Xingu	14
2560	Xinguara	14
2561	Água Branca	15
2562	Aguiar	15
2563	Alagoa Grande	15
2564	Alagoa Nova	15
2565	Alagoinha	15
2566	Alcantil	15
2567	Algodão de Jandaíra	15
2568	Alhandra	15
2569	Amparo	15
2570	Aparecida	15
2571	Araçagi	15
2572	Arara	15
2573	Araruna	15
2574	Areia	15
2575	Areia de Baraúnas	15
2576	Areial	15
2577	Aroeiras	15
2578	Assunção	15
2579	Baía da Traição	15
2580	Bananeiras	15
2581	Baraúna	15
2582	Barra de Santa Rosa	15
2583	Barra de Santana	15
2584	Barra de São Miguel	15
2585	Bayeux	15
2586	Belém	15
2587	Belém do Brejo do Cruz	15
2588	Bernardino Batista	15
2589	Boa Ventura	15
2590	Boa Vista	15
2591	Bom Jesus	15
2592	Bom Sucesso	15
2593	Bonito de Santa Fé	15
2594	Boqueirão	15
2595	Borborema	15
2596	Brejo do Cruz	15
2597	Brejo dos Santos	15
2598	Caaporã	15
2599	Cabaceiras	15
2600	Cabedelo	15
2601	Cachoeira dos Índios	15
2602	Cacimba de Areia	15
2603	Cacimba de Dentro	15
2604	Cacimbas	15
2605	Caiçara	15
2606	Cajazeiras	15
2607	Cajazeirinhas	15
2608	Caldas Brandão	15
2609	Camalaú	15
2610	Campina Grande	15
2611	Campo de Santana	15
2612	Capim	15
2613	Caraúbas	15
2614	Carrapateira	15
2615	Casserengue	15
2616	Catingueira	15
2617	Catolé do Rocha	15
2618	Caturité	15
2619	Conceição	15
2620	Condado	15
2621	Conde	15
2622	Congo	15
2623	Coremas	15
2624	Coxixola	15
2625	Cruz do Espírito Santo	15
2626	Cubati	15
2627	Cuité	15
2628	Cuité de Mamanguape	15
2629	Cuitegi	15
2630	Curral de Cima	15
2631	Curral Velho	15
2632	Damião	15
2633	Desterro	15
2634	Diamante	15
2635	Dona Inês	15
2636	Duas Estradas	15
2637	Emas	15
2638	Esperança	15
2639	Fagundes	15
2640	Frei Martinho	15
2641	Gado Bravo	15
2642	Guarabira	15
2643	Gurinhém	15
2644	Gurjão	15
2645	Ibiara	15
2646	Igaracy	15
2647	Imaculada	15
2648	Ingá	15
2649	Itabaiana	15
2650	Itaporanga	15
2651	Itapororoca	15
2652	Itatuba	15
2653	Jacaraú	15
2654	Jericó	15
2655	João Pessoa	15
2656	Juarez Távora	15
2657	Juazeirinho	15
2658	Junco do Seridó	15
2659	Juripiranga	15
2660	Juru	15
2661	Lagoa	15
2662	Lagoa de Dentro	15
2663	Lagoa Seca	15
2664	Lastro	15
2665	Livramento	15
2666	Logradouro	15
2667	Lucena	15
2668	Mãe dÁgua	15
2669	Malta	15
2670	Mamanguape	15
2671	Manaíra	15
2672	Marcação	15
2673	Mari	15
2674	Marizópolis	15
2675	Massaranduba	15
2676	Mataraca	15
2677	Matinhas	15
2678	Mato Grosso	15
2679	Maturéia	15
2680	Mogeiro	15
2681	Montadas	15
2682	Monte Horebe	15
2683	Monteiro	15
2684	Mulungu	15
2685	Natuba	15
2686	Nazarezinho	15
2687	Nova Floresta	15
2688	Nova Olinda	15
2689	Nova Palmeira	15
2690	Olho dÁgua	15
2691	Olivedos	15
2692	Ouro Velho	15
2693	Parari	15
2694	Passagem	15
2695	Patos	15
2696	Paulista	15
2697	Pedra Branca	15
2698	Pedra Lavrada	15
2699	Pedras de Fogo	15
2700	Pedro Régis	15
2701	Piancó	15
2702	Picuí	15
2703	Pilar	15
2704	Pilões	15
2705	Pilõezinhos	15
2706	Pirpirituba	15
2707	Pitimbu	15
2708	Pocinhos	15
2709	Poço Dantas	15
2710	Poço de José de Moura	15
2711	Pombal	15
2712	Prata	15
2713	Princesa Isabel	15
2714	Puxinanã	15
2715	Queimadas	15
2716	Quixabá	15
2717	Remígio	15
2718	Riachão	15
2719	Riachão do Bacamarte	15
2720	Riachão do Poço	15
2721	Riacho de Santo Antônio	15
2722	Riacho dos Cavalos	15
2723	Rio Tinto	15
2724	Salgadinho	15
2725	Salgado de São Félix	15
2726	Santa Cecília	15
2727	Santa Cruz	15
2728	Santa Helena	15
2729	Santa Inês	15
2730	Santa Luzia	15
2731	Santa Rita	15
2732	Santa Teresinha	15
2733	Santana de Mangueira	15
2734	Santana dos Garrotes	15
2735	Santarém	15
2736	Santo André	15
2737	São Bentinho	15
2738	São Bento	15
2739	São Domingos de Pombal	15
2740	São Domingos do Cariri	15
2741	São Francisco	15
2742	São João do Cariri	15
2743	São João do Rio do Peixe	15
2744	São João do Tigre	15
2745	São José da Lagoa Tapada	15
2746	São José de Caiana	15
2747	São José de Espinharas	15
2748	São José de Piranhas	15
2749	São José de Princesa	15
2750	São José do Bonfim	15
2751	São José do Brejo do Cruz	15
2752	São José do Sabugi	15
2753	São José dos Cordeiros	15
2754	São José dos Ramos	15
2755	São Mamede	15
2756	São Miguel de Taipu	15
2757	São Sebastião de Lagoa de Roça	15
2758	São Sebastião do Umbuzeiro	15
2759	Sapé	15
2760	Seridó	15
2761	Serra Branca	15
2762	Serra da Raiz	15
2763	Serra Grande	15
2764	Serra Redonda	15
2765	Serraria	15
2766	Sertãozinho	15
2767	Sobrado	15
2768	Solânea	15
2769	Soledade	15
2770	Sossêgo	15
2771	Sousa	15
2772	Sumé	15
2773	Taperoá	15
2774	Tavares	15
2775	Teixeira	15
2776	Tenório	15
2777	Triunfo	15
2778	Uiraúna	15
2779	Umbuzeiro	15
2780	Várzea	15
2781	Vieirópolis	15
2782	Vista Serrana	15
2783	Zabelê	15
2784	Abatiá	18
2785	Adrianópolis	18
2786	Agudos do Sul	18
2787	Almirante Tamandaré	18
2788	Altamira do Paraná	18
2789	Alto Paraíso	18
2790	Alto Paraná	18
2791	Alto Piquiri	18
2792	Altônia	18
2793	Alvorada do Sul	18
2794	Amaporã	18
2795	Ampére	18
2796	Anahy	18
2797	Andirá	18
2798	Ângulo	18
2799	Antonina	18
2800	Antônio Olinto	18
2801	Apucarana	18
2802	Arapongas	18
2803	Arapoti	18
2804	Arapuã	18
2805	Araruna	18
2806	Araucária	18
2807	Ariranha do Ivaí	18
2808	Assaí	18
2809	Assis Chateaubriand	18
2810	Astorga	18
2811	Atalaia	18
2812	Balsa Nova	18
2813	Bandeirantes	18
2814	Barbosa Ferraz	18
2815	Barra do Jacaré	18
2816	Barracão	18
2817	Bela Vista da Caroba	18
2818	Bela Vista do Paraíso	18
2819	Bituruna	18
2820	Boa Esperança	18
2821	Boa Esperança do Iguaçu	18
2822	Boa Ventura de São Roque	18
2823	Boa Vista da Aparecida	18
2824	Bocaiúva do Sul	18
2825	Bom Jesus do Sul	18
2826	Bom Sucesso	18
2827	Bom Sucesso do Sul	18
2828	Borrazópolis	18
2829	Braganey	18
2830	Brasilândia do Sul	18
2831	Cafeara	18
2832	Cafelândia	18
2833	Cafezal do Sul	18
2834	Califórnia	18
2835	Cambará	18
2836	Cambé	18
2837	Cambira	18
2838	Campina da Lagoa	18
2839	Campina do Simão	18
2840	Campina Grande do Sul	18
2841	Campo Bonito	18
2842	Campo do Tenente	18
2843	Campo Largo	18
2844	Campo Magro	18
2845	Campo Mourão	18
2846	Cândido de Abreu	18
2847	Candói	18
2848	Cantagalo	18
2849	Capanema	18
2850	Capitão Leônidas Marques	18
2851	Carambeí	18
2852	Carlópolis	18
2853	Cascavel	18
2854	Castro	18
2855	Catanduvas	18
2856	Centenário do Sul	18
2857	Cerro Azul	18
2858	Céu Azul	18
2859	Chopinzinho	18
2860	Cianorte	18
2861	Cidade Gaúcha	18
2862	Clevelândia	18
2863	Colombo	18
2864	Colorado	18
2865	Congonhinhas	18
2866	Conselheiro Mairinck	18
2867	Contenda	18
2868	Corbélia	18
2869	Cornélio Procópio	18
2870	Coronel Domingos Soares	18
2871	Coronel Vivida	18
2872	Corumbataí do Sul	18
2873	Cruz Machado	18
2874	Cruzeiro do Iguaçu	18
2875	Cruzeiro do Oeste	18
2876	Cruzeiro do Sul	18
2877	Cruzmaltina	18
2878	Curitiba	18
2879	Curiúva	18
2880	Diamante dOeste	18
2881	Diamante do Norte	18
2882	Diamante do Sul	18
2883	Dois Vizinhos	18
2884	Douradina	18
2885	Doutor Camargo	18
2886	Doutor Ulysses	18
2887	Enéas Marques	18
2888	Engenheiro Beltrão	18
2889	Entre Rios do Oeste	18
2890	Esperança Nova	18
2891	Espigão Alto do Iguaçu	18
2892	Farol	18
2893	Faxinal	18
2894	Fazenda Rio Grande	18
2895	Fênix	18
2896	Fernandes Pinheiro	18
2897	Figueira	18
2898	Flor da Serra do Sul	18
2899	Floraí	18
2900	Floresta	18
2901	Florestópolis	18
2902	Flórida	18
2903	Formosa do Oeste	18
2904	Foz do Iguaçu	18
2905	Foz do Jordão	18
2906	Francisco Alves	18
2907	Francisco Beltrão	18
2908	General Carneiro	18
2909	Godoy Moreira	18
2910	Goioerê	18
2911	Goioxim	18
2912	Grandes Rios	18
2913	Guaíra	18
2914	Guairaçá	18
2915	Guamiranga	18
2916	Guapirama	18
2917	Guaporema	18
2918	Guaraci	18
2919	Guaraniaçu	18
2920	Guarapuava	18
2921	Guaraqueçaba	18
2922	Guaratuba	18
2923	Honório Serpa	18
2924	Ibaiti	18
2925	Ibema	18
2926	Ibiporã	18
2927	Icaraíma	18
2928	Iguaraçu	18
2929	Iguatu	18
2930	Imbaú	18
2931	Imbituva	18
2932	Inácio Martins	18
2933	Inajá	18
2934	Indianópolis	18
2935	Ipiranga	18
2936	Iporã	18
2937	Iracema do Oeste	18
2938	Irati	18
2939	Iretama	18
2940	Itaguajé	18
2941	Itaipulândia	18
2942	Itambaracá	18
2943	Itambé	18
2944	Itapejara dOeste	18
2945	Itaperuçu	18
2946	Itaúna do Sul	18
2947	Ivaí	18
2948	Ivaiporã	18
2949	Ivaté	18
2950	Ivatuba	18
2951	Jaboti	18
2952	Jacarezinho	18
2953	Jaguapitã	18
2954	Jaguariaíva	18
2955	Jandaia do Sul	18
2956	Janiópolis	18
2957	Japira	18
2958	Japurá	18
2959	Jardim Alegre	18
2960	Jardim Olinda	18
2961	Jataizinho	18
2962	Jesuítas	18
2963	Joaquim Távora	18
2964	Jundiaí do Sul	18
2965	Juranda	18
2966	Jussara	18
2967	Kaloré	18
2968	Lapa	18
2969	Laranjal	18
2970	Laranjeiras do Sul	18
2971	Leópolis	18
2972	Lidianópolis	18
2973	Lindoeste	18
2974	Loanda	18
2975	Lobato	18
2976	Londrina	18
2977	Luiziana	18
2978	Lunardelli	18
2979	Lupionópolis	18
2980	Mallet	18
2981	Mamborê	18
2982	Mandaguaçu	18
2983	Mandaguari	18
2984	Mandirituba	18
2985	Manfrinópolis	18
2986	Mangueirinha	18
2987	Manoel Ribas	18
2988	Marechal Cândido Rondon	18
2989	Maria Helena	18
2990	Marialva	18
2991	Marilândia do Sul	18
2992	Marilena	18
2993	Mariluz	18
2994	Maringá	18
2995	Mariópolis	18
2996	Maripá	18
2997	Marmeleiro	18
2998	Marquinho	18
2999	Marumbi	18
3000	Matelândia	18
3001	Matinhos	18
3002	Mato Rico	18
3003	Mauá da Serra	18
3004	Medianeira	18
3005	Mercedes	18
3006	Mirador	18
3007	Miraselva	18
3008	Missal	18
3009	Moreira Sales	18
3010	Morretes	18
3011	Munhoz de Melo	18
3012	Nossa Senhora das Graças	18
3013	Nova Aliança do Ivaí	18
3014	Nova América da Colina	18
3015	Nova Aurora	18
3016	Nova Cantu	18
3017	Nova Esperança	18
3018	Nova Esperança do Sudoeste	18
3019	Nova Fátima	18
3020	Nova Laranjeiras	18
3021	Nova Londrina	18
3022	Nova Olímpia	18
3023	Nova Prata do Iguaçu	18
3024	Nova Santa Bárbara	18
3025	Nova Santa Rosa	18
3026	Nova Tebas	18
3027	Novo Itacolomi	18
3028	Ortigueira	18
3029	Ourizona	18
3030	Ouro Verde do Oeste	18
3031	Paiçandu	18
3032	Palmas	18
3033	Palmeira	18
3034	Palmital	18
3035	Palotina	18
3036	Paraíso do Norte	18
3037	Paranacity	18
3038	Paranaguá	18
3039	Paranapoema	18
3040	Paranavaí	18
3041	Pato Bragado	18
3042	Pato Branco	18
3043	Paula Freitas	18
3044	Paulo Frontin	18
3045	Peabiru	18
3046	Perobal	18
3047	Pérola	18
3048	Pérola dOeste	18
3049	Piên	18
3050	Pinhais	18
3051	Pinhal de São Bento	18
3052	Pinhalão	18
3053	Pinhão	18
3054	Piraí do Sul	18
3055	Piraquara	18
3056	Pitanga	18
3057	Pitangueiras	18
3058	Planaltina do Paraná	18
3059	Planalto	18
3060	Ponta Grossa	18
3061	Pontal do Paraná	18
3062	Porecatu	18
3063	Porto Amazonas	18
3064	Porto Barreiro	18
3065	Porto Rico	18
3066	Porto Vitória	18
3067	Prado Ferreira	18
3068	Pranchita	18
3069	Presidente Castelo Branco	18
3070	Primeiro de Maio	18
3071	Prudentópolis	18
3072	Quarto Centenário	18
3073	Quatiguá	18
3074	Quatro Barras	18
3075	Quatro Pontes	18
3076	Quedas do Iguaçu	18
3077	Querência do Norte	18
3078	Quinta do Sol	18
3079	Quitandinha	18
3080	Ramilândia	18
3081	Rancho Alegre	18
3082	Rancho Alegre dOeste	18
3083	Realeza	18
3084	Rebouças	18
3085	Renascença	18
3086	Reserva	18
3087	Reserva do Iguaçu	18
3088	Ribeirão Claro	18
3089	Ribeirão do Pinhal	18
3090	Rio Azul	18
3091	Rio Bom	18
3092	Rio Bonito do Iguaçu	18
3093	Rio Branco do Ivaí	18
3094	Rio Branco do Sul	18
3095	Rio Negro	18
3096	Rolândia	18
3097	Roncador	18
3098	Rondon	18
3099	Rosário do Ivaí	18
3100	Sabáudia	18
3101	Salgado Filho	18
3102	Salto do Itararé	18
3103	Salto do Lontra	18
3104	Santa Amélia	18
3105	Santa Cecília do Pavão	18
3106	Santa Cruz de Monte Castelo	18
3107	Santa Fé	18
3108	Santa Helena	18
3109	Santa Inês	18
3110	Santa Isabel do Ivaí	18
3111	Santa Izabel do Oeste	18
3112	Santa Lúcia	18
3113	Santa Maria do Oeste	18
3114	Santa Mariana	18
3115	Santa Mônica	18
3116	Santa Tereza do Oeste	18
3117	Santa Terezinha de Itaipu	18
3118	Santana do Itararé	18
3119	Santo Antônio da Platina	18
3120	Santo Antônio do Caiuá	18
3121	Santo Antônio do Paraíso	18
3122	Santo Antônio do Sudoeste	18
3123	Santo Inácio	18
3124	São Carlos do Ivaí	18
3125	São Jerônimo da Serra	18
3126	São João	18
3127	São João do Caiuá	18
3128	São João do Ivaí	18
3129	São João do Triunfo	18
3130	São Jorge dOeste	18
3131	São Jorge do Ivaí	18
3132	São Jorge do Patrocínio	18
3133	São José da Boa Vista	18
3134	São José das Palmeiras	18
3135	São José dos Pinhais	18
3136	São Manoel do Paraná	18
3137	São Mateus do Sul	18
3138	São Miguel do Iguaçu	18
3139	São Pedro do Iguaçu	18
3140	São Pedro do Ivaí	18
3141	São Pedro do Paraná	18
3142	São Sebastião da Amoreira	18
3143	São Tomé	18
3144	Sapopema	18
3145	Sarandi	18
3146	Saudade do Iguaçu	18
3147	Sengés	18
3148	Serranópolis do Iguaçu	18
3149	Sertaneja	18
3150	Sertanópolis	18
3151	Siqueira Campos	18
3152	Sulina	18
3153	Tamarana	18
3154	Tamboara	18
3155	Tapejara	18
3156	Tapira	18
3157	Teixeira Soares	18
3158	Telêmaco Borba	18
3159	Terra Boa	18
3160	Terra Rica	18
3161	Terra Roxa	18
3162	Tibagi	18
3163	Tijucas do Sul	18
3164	Toledo	18
3165	Tomazina	18
3166	Três Barras do Paraná	18
3167	Tunas do Paraná	18
3168	Tuneiras do Oeste	18
3169	Tupãssi	18
3170	Turvo	18
3171	Ubiratã	18
3172	Umuarama	18
3173	União da Vitória	18
3174	Uniflor	18
3175	Uraí	18
3176	Ventania	18
3177	Vera Cruz do Oeste	18
3178	Verê	18
3179	Virmond	18
3180	Vitorino	18
3181	Wenceslau Braz	18
3182	Xambrê	18
3183	Abreu e Lima	16
3184	Afogados da Ingazeira	16
3185	Afrânio	16
3186	Agrestina	16
3187	Água Preta	16
3188	Águas Belas	16
3189	Alagoinha	16
3190	Aliança	16
3191	Altinho	16
3192	Amaraji	16
3193	Angelim	16
3194	Araçoiaba	16
3195	Araripina	16
3196	Arcoverde	16
3197	Barra de Guabiraba	16
3198	Barreiros	16
3199	Belém de Maria	16
3200	Belém de São Francisco	16
3201	Belo Jardim	16
3202	Betânia	16
3203	Bezerros	16
3204	Bodocó	16
3205	Bom Conselho	16
3206	Bom Jardim	16
3207	Bonito	16
3208	Brejão	16
3209	Brejinho	16
3210	Brejo da Madre de Deus	16
3211	Buenos Aires	16
3212	Buíque	16
3213	Cabo de Santo Agostinho	16
3214	Cabrobó	16
3215	Cachoeirinha	16
3216	Caetés	16
3217	Calçado	16
3218	Calumbi	16
3219	Camaragibe	16
3220	Camocim de São Félix	16
3221	Camutanga	16
3222	Canhotinho	16
3223	Capoeiras	16
3224	Carnaíba	16
3225	Carnaubeira da Penha	16
3226	Carpina	16
3227	Caruaru	16
3228	Casinhas	16
3229	Catende	16
3230	Cedro	16
3231	Chã de Alegria	16
3232	Chã Grande	16
3233	Condado	16
3234	Correntes	16
3235	Cortês	16
3236	Cumaru	16
3237	Cupira	16
3238	Custódia	16
3239	Dormentes	16
3240	Escada	16
3241	Exu	16
3242	Feira Nova	16
3243	Fernando de Noronha	16
3244	Ferreiros	16
3245	Flores	16
3246	Floresta	16
3247	Frei Miguelinho	16
3248	Gameleira	16
3249	Garanhuns	16
3250	Glória do Goitá	16
3251	Goiana	16
3252	Granito	16
3253	Gravatá	16
3254	Iati	16
3255	Ibimirim	16
3256	Ibirajuba	16
3257	Igarassu	16
3258	Iguaraci	16
3259	Ilha de Itamaracá	16
3260	Inajá	16
3261	Ingazeira	16
3262	Ipojuca	16
3263	Ipubi	16
3264	Itacuruba	16
3265	Itaíba	16
3266	Itambé	16
3267	Itapetim	16
3268	Itapissuma	16
3269	Itaquitinga	16
3270	Jaboatão dos Guararapes	16
3271	Jaqueira	16
3272	Jataúba	16
3273	Jatobá	16
3274	João Alfredo	16
3275	Joaquim Nabuco	16
3276	Jucati	16
3277	Jupi	16
3278	Jurema	16
3279	Lagoa do Carro	16
3280	Lagoa do Itaenga	16
3281	Lagoa do Ouro	16
3282	Lagoa dos Gatos	16
3283	Lagoa Grande	16
3284	Lajedo	16
3285	Limoeiro	16
3286	Macaparana	16
3287	Machados	16
3288	Manari	16
3289	Maraial	16
3290	Mirandiba	16
3291	Moreilândia	16
3292	Moreno	16
3293	Nazaré da Mata	16
3294	Olinda	16
3295	Orobó	16
3296	Orocó	16
3297	Ouricuri	16
3298	Palmares	16
3299	Palmeirina	16
3300	Panelas	16
3301	Paranatama	16
3302	Parnamirim	16
3303	Passira	16
3304	Paudalho	16
3305	Paulista	16
3306	Pedra	16
3307	Pesqueira	16
3308	Petrolândia	16
3309	Petrolina	16
3310	Poção	16
3311	Pombos	16
3312	Primavera	16
3313	Quipapá	16
3314	Quixaba	16
3315	Recife	16
3316	Riacho das Almas	16
3317	Ribeirão	16
3318	Rio Formoso	16
3319	Sairé	16
3320	Salgadinho	16
3321	Salgueiro	16
3322	Saloá	16
3323	Sanharó	16
3324	Santa Cruz	16
3325	Santa Cruz da Baixa Verde	16
3326	Santa Cruz do Capibaribe	16
3327	Santa Filomena	16
3328	Santa Maria da Boa Vista	16
3329	Santa Maria do Cambucá	16
3330	Santa Terezinha	16
3331	São Benedito do Sul	16
3332	São Bento do Una	16
3333	São Caitano	16
3334	São João	16
3335	São Joaquim do Monte	16
3336	São José da Coroa Grande	16
3337	São José do Belmonte	16
3338	São José do Egito	16
3339	São Lourenço da Mata	16
3340	São Vicente Ferrer	16
3341	Serra Talhada	16
3342	Serrita	16
3343	Sertânia	16
3344	Sirinhaém	16
3345	Solidão	16
3346	Surubim	16
3347	Tabira	16
3348	Tacaimbó	16
3349	Tacaratu	16
3350	Tamandaré	16
3351	Taquaritinga do Norte	16
3352	Terezinha	16
3353	Terra Nova	16
3354	Timbaúba	16
3355	Toritama	16
3356	Tracunhaém	16
3357	Trindade	16
3358	Triunfo	16
3359	Tupanatinga	16
3360	Tuparetama	16
3361	Venturosa	16
3362	Verdejante	16
3363	Vertente do Lério	16
3364	Vertentes	16
3365	Vicência	16
3366	Vitória de Santo Antão	16
3367	Xexéu	16
3368	Acauã	17
3369	Agricolândia	17
3370	Água Branca	17
3371	Alagoinha do Piauí	17
3372	Alegrete do Piauí	17
3373	Alto Longá	17
3374	Altos	17
3375	Alvorada do Gurguéia	17
3376	Amarante	17
3377	Angical do Piauí	17
3378	Anísio de Abreu	17
3379	Antônio Almeida	17
3380	Aroazes	17
3381	Aroeiras do Itaim	17
3382	Arraial	17
3383	Assunção do Piauí	17
3384	Avelino Lopes	17
3385	Baixa Grande do Ribeiro	17
3386	Barra dAlcântara	17
3387	Barras	17
3388	Barreiras do Piauí	17
3389	Barro Duro	17
3390	Batalha	17
3391	Bela Vista do Piauí	17
3392	Belém do Piauí	17
3393	Beneditinos	17
3394	Bertolínia	17
3395	Betânia do Piauí	17
3396	Boa Hora	17
3397	Bocaina	17
3398	Bom Jesus	17
3399	Bom Princípio do Piauí	17
3400	Bonfim do Piauí	17
3401	Boqueirão do Piauí	17
3402	Brasileira	17
3403	Brejo do Piauí	17
3404	Buriti dos Lopes	17
3405	Buriti dos Montes	17
3406	Cabeceiras do Piauí	17
3407	Cajazeiras do Piauí	17
3408	Cajueiro da Praia	17
3409	Caldeirão Grande do Piauí	17
3410	Campinas do Piauí	17
3411	Campo Alegre do Fidalgo	17
3412	Campo Grande do Piauí	17
3413	Campo Largo do Piauí	17
3414	Campo Maior	17
3415	Canavieira	17
3416	Canto do Buriti	17
3417	Capitão de Campos	17
3418	Capitão Gervásio Oliveira	17
3419	Caracol	17
3420	Caraúbas do Piauí	17
3421	Caridade do Piauí	17
3422	Castelo do Piauí	17
3423	Caxingó	17
3424	Cocal	17
3425	Cocal de Telha	17
3426	Cocal dos Alves	17
3427	Coivaras	17
3428	Colônia do Gurguéia	17
3429	Colônia do Piauí	17
3430	Conceição do Canindé	17
3431	Coronel José Dias	17
3432	Corrente	17
3433	Cristalândia do Piauí	17
3434	Cristino Castro	17
3435	Curimatá	17
3436	Currais	17
3437	Curral Novo do Piauí	17
3438	Curralinhos	17
3439	Demerval Lobão	17
3440	Dirceu Arcoverde	17
3441	Dom Expedito Lopes	17
3442	Dom Inocêncio	17
3443	Domingos Mourão	17
3444	Elesbão Veloso	17
3445	Eliseu Martins	17
3446	Esperantina	17
3447	Fartura do Piauí	17
3448	Flores do Piauí	17
3449	Floresta do Piauí	17
3450	Floriano	17
3451	Francinópolis	17
3452	Francisco Ayres	17
3453	Francisco Macedo	17
3454	Francisco Santos	17
3455	Fronteiras	17
3456	Geminiano	17
3457	Gilbués	17
3458	Guadalupe	17
3459	Guaribas	17
3460	Hugo Napoleão	17
3461	Ilha Grande	17
3462	Inhuma	17
3463	Ipiranga do Piauí	17
3464	Isaías Coelho	17
3465	Itainópolis	17
3466	Itaueira	17
3467	Jacobina do Piauí	17
3468	Jaicós	17
3469	Jardim do Mulato	17
3470	Jatobá do Piauí	17
3471	Jerumenha	17
3472	João Costa	17
3473	Joaquim Pires	17
3474	Joca Marques	17
3475	José de Freitas	17
3476	Juazeiro do Piauí	17
3477	Júlio Borges	17
3478	Jurema	17
3479	Lagoa Alegre	17
3480	Lagoa de São Francisco	17
3481	Lagoa do Barro do Piauí	17
3482	Lagoa do Piauí	17
3483	Lagoa do Sítio	17
3484	Lagoinha do Piauí	17
3485	Landri Sales	17
3486	Luís Correia	17
3487	Luzilândia	17
3488	Madeiro	17
3489	Manoel Emídio	17
3490	Marcolândia	17
3491	Marcos Parente	17
3492	Massapê do Piauí	17
3493	Matias Olímpio	17
3494	Miguel Alves	17
3495	Miguel Leão	17
3496	Milton Brandão	17
3497	Monsenhor Gil	17
3498	Monsenhor Hipólito	17
3499	Monte Alegre do Piauí	17
3500	Morro Cabeça no Tempo	17
3501	Morro do Chapéu do Piauí	17
3502	Murici dos Portelas	17
3503	Nazaré do Piauí	17
3504	Nossa Senhora de Nazaré	17
3505	Nossa Senhora dos Remédios	17
3506	Nova Santa Rita	17
3507	Novo Oriente do Piauí	17
3508	Novo Santo Antônio	17
3509	Oeiras	17
3510	Olho dÁgua do Piauí	17
3511	Padre Marcos	17
3512	Paes Landim	17
3513	Pajeú do Piauí	17
3514	Palmeira do Piauí	17
3515	Palmeirais	17
3516	Paquetá	17
3517	Parnaguá	17
3518	Parnaíba	17
3519	Passagem Franca do Piauí	17
3520	Patos do Piauí	17
3521	Pau dArco do Piauí	17
3522	Paulistana	17
3523	Pavussu	17
3524	Pedro II	17
3525	Pedro Laurentino	17
3526	Picos	17
3527	Pimenteiras	17
3528	Pio IX	17
3529	Piracuruca	17
3530	Piripiri	17
3531	Porto	17
3532	Porto Alegre do Piauí	17
3533	Prata do Piauí	17
3534	Queimada Nova	17
3535	Redenção do Gurguéia	17
3536	Regeneração	17
3537	Riacho Frio	17
3538	Ribeira do Piauí	17
3539	Ribeiro Gonçalves	17
3540	Rio Grande do Piauí	17
3541	Santa Cruz do Piauí	17
3542	Santa Cruz dos Milagres	17
3543	Santa Filomena	17
3544	Santa Luz	17
3545	Santa Rosa do Piauí	17
3546	Santana do Piauí	17
3547	Santo Antônio de Lisboa	17
3548	Santo Antônio dos Milagres	17
3549	Santo Inácio do Piauí	17
3550	São Braz do Piauí	17
3551	São Félix do Piauí	17
3552	São Francisco de Assis do Piauí	17
3553	São Francisco do Piauí	17
3554	São Gonçalo do Gurguéia	17
3555	São Gonçalo do Piauí	17
3556	São João da Canabrava	17
3557	São João da Fronteira	17
3558	São João da Serra	17
3559	São João da Varjota	17
3560	São João do Arraial	17
3561	São João do Piauí	17
3562	São José do Divino	17
3563	São José do Peixe	17
3564	São José do Piauí	17
3565	São Julião	17
3566	São Lourenço do Piauí	17
3567	São Luis do Piauí	17
3568	São Miguel da Baixa Grande	17
3569	São Miguel do Fidalgo	17
3570	São Miguel do Tapuio	17
3571	São Pedro do Piauí	17
3572	São Raimundo Nonato	17
3573	Sebastião Barros	17
3574	Sebastião Leal	17
3575	Sigefredo Pacheco	17
3576	Simões	17
3577	Simplício Mendes	17
3578	Socorro do Piauí	17
3579	Sussuapara	17
3580	Tamboril do Piauí	17
3581	Tanque do Piauí	17
3582	Teresina	17
3583	União	17
3584	Uruçuí	17
3585	Valença do Piauí	17
3586	Várzea Branca	17
3587	Várzea Grande	17
3588	Vera Mendes	17
3589	Vila Nova do Piauí	17
3590	Wall Ferraz	17
3591	Angra dos Reis	19
3592	Aperibé	19
3593	Araruama	19
3594	Areal	19
3595	Armação dos Búzios	19
3596	Arraial do Cabo	19
3597	Barra do Piraí	19
3598	Barra Mansa	19
3599	Belford Roxo	19
3600	Bom Jardim	19
3601	Bom Jesus do Itabapoana	19
3602	Cabo Frio	19
3603	Cachoeiras de Macacu	19
3604	Cambuci	19
3605	Campos dos Goytacazes	19
3606	Cantagalo	19
3607	Carapebus	19
3608	Cardoso Moreira	19
3609	Carmo	19
3610	Casimiro de Abreu	19
3611	Comendador Levy Gasparian	19
3612	Conceição de Macabu	19
3613	Cordeiro	19
3614	Duas Barras	19
3615	Duque de Caxias	19
3616	Engenheiro Paulo de Frontin	19
3617	Guapimirim	19
3618	Iguaba Grande	19
3619	Itaboraí	19
3620	Itaguaí	19
3621	Italva	19
3622	Itaocara	19
3623	Itaperuna	19
3624	Itatiaia	19
3625	Japeri	19
3626	Laje do Muriaé	19
3627	Macaé	19
3628	Macuco	19
3629	Magé	19
3630	Mangaratiba	19
3631	Maricá	19
3632	Mendes	19
3633	Mesquita	19
3634	Miguel Pereira	19
3635	Miracema	19
3636	Natividade	19
3637	Nilópolis	19
3638	Niterói	19
3639	Nova Friburgo	19
3640	Nova Iguaçu	19
3641	Paracambi	19
3642	Paraíba do Sul	19
3643	Parati	19
3644	Paty do Alferes	19
3645	Petrópolis	19
3646	Pinheiral	19
3647	Piraí	19
3648	Porciúncula	19
3649	Porto Real	19
3650	Quatis	19
3651	Queimados	19
3652	Quissamã	19
3653	Resende	19
3654	Rio Bonito	19
3655	Rio Claro	19
3656	Rio das Flores	19
3657	Rio das Ostras	19
3658	Rio de Janeiro	19
3659	Santa Maria Madalena	19
3660	Santo Antônio de Pádua	19
3661	São Fidélis	19
3662	São Francisco de Itabapoana	19
3663	São Gonçalo	19
3664	São João da Barra	19
3665	São João de Meriti	19
3666	São José de Ubá	19
3667	São José do Vale do Rio Pret	19
3668	São Pedro da Aldeia	19
3669	São Sebastião do Alto	19
3670	Sapucaia	19
3671	Saquarema	19
3672	Seropédica	19
3673	Silva Jardim	19
3674	Sumidouro	19
3675	Tanguá	19
3676	Teresópolis	19
3677	Trajano de Morais	19
3678	Três Rios	19
3679	Valença	19
3680	Varre-Sai	19
3681	Vassouras	19
3682	Volta Redonda	19
3683	Acari	20
3684	Açu	20
3685	Afonso Bezerra	20
3686	Água Nova	20
3687	Alexandria	20
3688	Almino Afonso	20
3689	Alto do Rodrigues	20
3690	Angicos	20
3691	Antônio Martins	20
3692	Apodi	20
3693	Areia Branca	20
3694	Arês	20
3695	Augusto Severo	20
3696	Baía Formosa	20
3697	Baraúna	20
3698	Barcelona	20
3699	Bento Fernandes	20
3700	Bodó	20
3701	Bom Jesus	20
3702	Brejinho	20
3703	Caiçara do Norte	20
3704	Caiçara do Rio do Vento	20
3705	Caicó	20
3706	Campo Redondo	20
3707	Canguaretama	20
3708	Caraúbas	20
3709	Carnaúba dos Dantas	20
3710	Carnaubais	20
3711	Ceará-Mirim	20
3712	Cerro Corá	20
3713	Coronel Ezequiel	20
3714	Coronel João Pessoa	20
3715	Cruzeta	20
3716	Currais Novos	20
3717	Doutor Severiano	20
3718	Encanto	20
3719	Equador	20
3720	Espírito Santo	20
3721	Extremoz	20
3722	Felipe Guerra	20
3723	Fernando Pedroza	20
3724	Florânia	20
3725	Francisco Dantas	20
3726	Frutuoso Gomes	20
3727	Galinhos	20
3728	Goianinha	20
3729	Governador Dix-Sept Rosado	20
3730	Grossos	20
3731	Guamaré	20
3732	Ielmo Marinho	20
3733	Ipanguaçu	20
3734	Ipueira	20
3735	Itajá	20
3736	Itaú	20
3737	Jaçanã	20
3738	Jandaíra	20
3739	Janduís	20
3740	Januário Cicco	20
3741	Japi	20
3742	Jardim de Angicos	20
3743	Jardim de Piranhas	20
3744	Jardim do Seridó	20
3745	João Câmara	20
3746	João Dias	20
3747	José da Penha	20
3748	Jucurutu	20
3749	Jundiá	20
3750	Lagoa dAnta	20
3751	Lagoa de Pedras	20
3752	Lagoa de Velhos	20
3753	Lagoa Nova	20
3754	Lagoa Salgada	20
3755	Lajes	20
3756	Lajes Pintadas	20
3757	Lucrécia	20
3758	Luís Gomes	20
3759	Macaíba	20
3760	Macau	20
3761	Major Sales	20
3762	Marcelino Vieira	20
3763	Martins	20
3764	Maxaranguape	20
3765	Messias Targino	20
3766	Montanhas	20
3767	Monte Alegre	20
3768	Monte das Gameleiras	20
3769	Mossoró	20
3770	Natal	20
3771	Nísia Floresta	20
3772	Nova Cruz	20
3773	Olho-dÁgua do Borges	20
3774	Ouro Branco	20
3775	Paraná	20
3776	Paraú	20
3777	Parazinho	20
3778	Parelhas	20
3779	Parnamirim	20
3780	Passa e Fica	20
3781	Passagem	20
3782	Patu	20
3783	Pau dos Ferros	20
3784	Pedra Grande	20
3785	Pedra Preta	20
3786	Pedro Avelino	20
3787	Pedro Velho	20
3788	Pendências	20
3789	Pilões	20
3790	Poço Branco	20
3791	Portalegre	20
3792	Porto do Mangue	20
3793	Presidente Juscelino	20
3794	Pureza	20
3795	Rafael Fernandes	20
3796	Rafael Godeiro	20
3797	Riacho da Cruz	20
3798	Riacho de Santana	20
3799	Riachuelo	20
3800	Rio do Fogo	20
3801	Rodolfo Fernandes	20
3802	Ruy Barbosa	20
3803	Santa Cruz	20
3804	Santa Maria	20
3805	Santana do Matos	20
3806	Santana do Seridó	20
3807	Santo Antônio	20
3808	São Bento do Norte	20
3809	São Bento do Trairí	20
3810	São Fernando	20
3811	São Francisco do Oeste	20
3812	São Gonçalo do Amarante	20
3813	São João do Sabugi	20
3814	São José de Mipibu	20
3815	São José do Campestre	20
3816	São José do Seridó	20
3817	São Miguel	20
3818	São Miguel do Gostoso	20
3819	São Paulo do Potengi	20
3820	São Pedro	20
3821	São Rafael	20
3822	São Tomé	20
3823	São Vicente	20
3824	Senador Elói de Souza	20
3825	Senador Georgino Avelino	20
3826	Serra de São Bento	20
3827	Serra do Mel	20
3828	Serra Negra do Norte	20
3829	Serrinha	20
3830	Serrinha dos Pintos	20
3831	Severiano Melo	20
3832	Sítio Novo	20
3833	Taboleiro Grande	20
3834	Taipu	20
3835	Tangará	20
3836	Tenente Ananias	20
3837	Tenente Laurentino Cruz	20
3838	Tibau	20
3839	Tibau do Sul	20
3840	Timbaúba dos Batistas	20
3841	Touros	20
3842	Triunfo Potiguar	20
3843	Umarizal	20
3844	Upanema	20
3845	Várzea	20
3846	Venha-Ver	20
3847	Vera Cruz	20
3848	Viçosa	20
3849	Vila Flor	20
3850	Aceguá	23
3851	Água Santa	23
3852	Agudo	23
3853	Ajuricaba	23
3854	Alecrim	23
3855	Alegrete	23
3856	Alegria	23
3857	Almirante Tamandaré do Sul	23
3858	Alpestre	23
3859	Alto Alegre	23
3860	Alto Feliz	23
3861	Alvorada	23
3862	Amaral Ferrador	23
3863	Ametista do Sul	23
3864	André da Rocha	23
3865	Anta Gorda	23
3866	Antônio Prado	23
3867	Arambaré	23
3868	Araricá	23
3869	Aratiba	23
3870	Arroio do Meio	23
3871	Arroio do Padre	23
3872	Arroio do Sal	23
3873	Arroio do Tigre	23
3874	Arroio dos Ratos	23
3875	Arroio Grande	23
3876	Arvorezinha	23
3877	Augusto Pestana	23
3878	Áurea	23
3879	Bagé	23
3880	Balneário Pinhal	23
3881	Barão	23
3882	Barão de Cotegipe	23
3883	Barão do Triunfo	23
3884	Barra do Guarita	23
3885	Barra do Quaraí	23
3886	Barra do Ribeiro	23
3887	Barra do Rio Azul	23
3888	Barra Funda	23
3889	Barracão	23
3890	Barros Cassal	23
3891	Benjamin Constant do Sul	23
3892	Bento Gonçalves	23
3893	Boa Vista das Missões	23
3894	Boa Vista do Buricá	23
3895	Boa Vista do Cadeado	23
3896	Boa Vista do Incra	23
3897	Boa Vista do Sul	23
3898	Bom Jesus	23
3899	Bom Princípio	23
3900	Bom Progresso	23
3901	Bom Retiro do Sul	23
3902	Boqueirão do Leão	23
3903	Bossoroca	23
3904	Bozano	23
3905	Braga	23
3906	Brochier	23
3907	Butiá	23
3908	Caçapava do Sul	23
3909	Cacequi	23
3910	Cachoeira do Sul	23
3911	Cachoeirinha	23
3912	Cacique Doble	23
3913	Caibaté	23
3914	Caiçara	23
3915	Camaquã	23
3916	Camargo	23
3917	Cambará do Sul	23
3918	Campestre da Serra	23
3919	Campina das Missões	23
3920	Campinas do Sul	23
3921	Campo Bom	23
3922	Campo Novo	23
3923	Campos Borges	23
3924	Candelária	23
3925	Cândido Godói	23
3926	Candiota	23
3927	Canela	23
3928	Canguçu	23
3929	Canoas	23
3930	Canudos do Vale	23
3931	Capão Bonito do Sul	23
3932	Capão da Canoa	23
3933	Capão do Cipó	23
3934	Capão do Leão	23
3935	Capela de Santana	23
3936	Capitão	23
3937	Capivari do Sul	23
3938	Caraá	23
3939	Carazinho	23
3940	Carlos Barbosa	23
3941	Carlos Gomes	23
3942	Casca	23
3943	Caseiros	23
3944	Catuípe	23
3945	Caxias do Sul	23
3946	Centenário	23
3947	Cerrito	23
3948	Cerro Branco	23
3949	Cerro Grande	23
3950	Cerro Grande do Sul	23
3951	Cerro Largo	23
3952	Chapada	23
3953	Charqueadas	23
3954	Charrua	23
3955	Chiapeta	23
3956	Chuí	23
3957	Chuvisca	23
3958	Cidreira	23
3959	Ciríaco	23
3960	Colinas	23
3961	Colorado	23
3962	Condor	23
3963	Constantina	23
3964	Coqueiro Baixo	23
3965	Coqueiros do Sul	23
3966	Coronel Barros	23
3967	Coronel Bicaco	23
3968	Coronel Pilar	23
3969	Cotiporã	23
3970	Coxilha	23
3971	Crissiumal	23
3972	Cristal	23
3973	Cristal do Sul	23
3974	Cruz Alta	23
3975	Cruzaltense	23
3976	Cruzeiro do Sul	23
3977	David Canabarro	23
3978	Derrubadas	23
3979	Dezesseis de Novembro	23
3980	Dilermando de Aguiar	23
3981	Dois Irmãos	23
3982	Dois Irmãos das Missões	23
3983	Dois Lajeados	23
3984	Dom Feliciano	23
3985	Dom Pedrito	23
3986	Dom Pedro de Alcântara	23
3987	Dona Francisca	23
3988	Doutor Maurício Cardoso	23
3989	Doutor Ricardo	23
3990	Eldorado do Sul	23
3991	Encantado	23
3992	Encruzilhada do Sul	23
3993	Engenho Velho	23
3994	Entre Rios do Sul	23
3995	Entre-Ijuís	23
3996	Erebango	23
3997	Erechim	23
3998	Ernestina	23
3999	Erval Grande	23
4000	Erval Seco	23
4001	Esmeralda	23
4002	Esperança do Sul	23
4003	Espumoso	23
4004	Estação	23
4005	Estância Velha	23
4006	Esteio	23
4007	Estrela	23
4008	Estrela Velha	23
4009	Eugênio de Castro	23
4010	Fagundes Varela	23
4011	Farroupilha	23
4012	Faxinal do Soturno	23
4013	Faxinalzinho	23
4014	Fazenda Vilanova	23
4015	Feliz	23
4016	Flores da Cunha	23
4017	Floriano Peixoto	23
4018	Fontoura Xavier	23
4019	Formigueiro	23
4020	Forquetinha	23
4021	Fortaleza dos Valos	23
4022	Frederico Westphalen	23
4023	Garibaldi	23
4024	Garruchos	23
4025	Gaurama	23
4026	General Câmara	23
4027	Gentil	23
4028	Getúlio Vargas	23
4029	Giruá	23
4030	Glorinha	23
4031	Gramado	23
4032	Gramado dos Loureiros	23
4033	Gramado Xavier	23
4034	Gravataí	23
4035	Guabiju	23
4036	Guaíba	23
4037	Guaporé	23
4038	Guarani das Missões	23
4039	Harmonia	23
4040	Herval	23
4041	Herveiras	23
4042	Horizontina	23
4043	Hulha Negra	23
4044	Humaitá	23
4045	Ibarama	23
4046	Ibiaçá	23
4047	Ibiraiaras	23
4048	Ibirapuitã	23
4049	Ibirubá	23
4050	Igrejinha	23
4051	Ijuí	23
4052	Ilópolis	23
4053	Imbé	23
4054	Imigrante	23
4055	Independência	23
4056	Inhacorá	23
4057	Ipê	23
4058	Ipiranga do Sul	23
4059	Iraí	23
4060	Itaara	23
4061	Itacurubi	23
4062	Itapuca	23
4063	Itaqui	23
4064	Itati	23
4065	Itatiba do Sul	23
4066	Ivorá	23
4067	Ivoti	23
4068	Jaboticaba	23
4069	Jacuizinho	23
4070	Jacutinga	23
4071	Jaguarão	23
4072	Jaguari	23
4073	Jaquirana	23
4074	Jari	23
4075	Jóia	23
4076	Júlio de Castilhos	23
4077	Lagoa Bonita do Sul	23
4078	Lagoa dos Três Cantos	23
4079	Lagoa Vermelha	23
4080	Lagoão	23
4081	Lajeado	23
4082	Lajeado do Bugre	23
4083	Lavras do Sul	23
4084	Liberato Salzano	23
4085	Lindolfo Collor	23
4086	Linha Nova	23
4087	Maçambara	23
4088	Machadinho	23
4089	Mampituba	23
4090	Manoel Viana	23
4091	Maquiné	23
4092	Maratá	23
4093	Marau	23
4094	Marcelino Ramos	23
4095	Mariana Pimentel	23
4096	Mariano Moro	23
4097	Marques de Souza	23
4098	Mata	23
4099	Mato Castelhano	23
4100	Mato Leitão	23
4101	Mato Queimado	23
4102	Maximiliano de Almeida	23
4103	Minas do Leão	23
4104	Miraguaí	23
4105	Montauri	23
4106	Monte Alegre dos Campos	23
4107	Monte Belo do Sul	23
4108	Montenegro	23
4109	Mormaço	23
4110	Morrinhos do Sul	23
4111	Morro Redondo	23
4112	Morro Reuter	23
4113	Mostardas	23
4114	Muçum	23
4115	Muitos Capões	23
4116	Muliterno	23
4117	Não-Me-Toque	23
4118	Nicolau Vergueiro	23
4119	Nonoai	23
4120	Nova Alvorada	23
4121	Nova Araçá	23
4122	Nova Bassano	23
4123	Nova Boa Vista	23
4124	Nova Bréscia	23
4125	Nova Candelária	23
4126	Nova Esperança do Sul	23
4127	Nova Hartz	23
4128	Nova Pádua	23
4129	Nova Palma	23
4130	Nova Petrópolis	23
4131	Nova Prata	23
4132	Nova Ramada	23
4133	Nova Roma do Sul	23
4134	Nova Santa Rita	23
4135	Novo Barreiro	23
4136	Novo Cabrais	23
4137	Novo Hamburgo	23
4138	Novo Machado	23
4139	Novo Tiradentes	23
4140	Novo Xingu	23
4141	Osório	23
4142	Paim Filho	23
4143	Palmares do Sul	23
4144	Palmeira das Missões	23
4145	Palmitinho	23
4146	Panambi	23
4147	Pantano Grande	23
4148	Paraí	23
4149	Paraíso do Sul	23
4150	Pareci Novo	23
4151	Parobé	23
4152	Passa Sete	23
4153	Passo do Sobrado	23
4154	Passo Fundo	23
4155	Paulo Bento	23
4156	Paverama	23
4157	Pedras Altas	23
4158	Pedro Osório	23
4159	Pejuçara	23
4160	Pelotas	23
4161	Picada Café	23
4162	Pinhal	23
4163	Pinhal da Serra	23
4164	Pinhal Grande	23
4165	Pinheirinho do Vale	23
4166	Pinheiro Machado	23
4167	Pirapó	23
4168	Piratini	23
4169	Planalto	23
4170	Poço das Antas	23
4171	Pontão	23
4172	Ponte Preta	23
4173	Portão	23
4174	Porto Alegre	23
4175	Porto Lucena	23
4176	Porto Mauá	23
4177	Porto Vera Cruz	23
4178	Porto Xavier	23
4179	Pouso Novo	23
4180	Presidente Lucena	23
4181	Progresso	23
4182	Protásio Alves	23
4183	Putinga	23
4184	Quaraí	23
4185	Quatro Irmãos	23
4186	Quevedos	23
4187	Quinze de Novembro	23
4188	Redentora	23
4189	Relvado	23
4190	Restinga Seca	23
4191	Rio dos Índios	23
4192	Rio Grande	23
4193	Rio Pardo	23
4194	Riozinho	23
4195	Roca Sales	23
4196	Rodeio Bonito	23
4197	Rolador	23
4198	Rolante	23
4199	Ronda Alta	23
4200	Rondinha	23
4201	Roque Gonzales	23
4202	Rosário do Sul	23
4203	Sagrada Família	23
4204	Saldanha Marinho	23
4205	Salto do Jacuí	23
4206	Salvador das Missões	23
4207	Salvador do Sul	23
4208	Sananduva	23
4209	Santa Bárbara do Sul	23
4210	Santa Cecília do Sul	23
4211	Santa Clara do Sul	23
4212	Santa Cruz do Sul	23
4213	Santa Margarida do Sul	23
4214	Santa Maria	23
4215	Santa Maria do Herval	23
4216	Santa Rosa	23
4217	Santa Tereza	23
4218	Santa Vitória do Palmar	23
4219	Santana da Boa Vista	23
4220	Santana do Livramento	23
4221	Santiago	23
4222	Santo Ângelo	23
4223	Santo Antônio da Patrulha	23
4224	Santo Antônio das Missões	23
4225	Santo Antônio do Palma	23
4226	Santo Antônio do Planalto	23
4227	Santo Augusto	23
4228	Santo Cristo	23
4229	Santo Expedito do Sul	23
4230	São Borja	23
4231	São Domingos do Sul	23
4232	São Francisco de Assis	23
4233	São Francisco de Paula	23
4234	São Gabriel	23
4235	São Jerônimo	23
4236	São João da Urtiga	23
4237	São João do Polêsine	23
4238	São Jorge	23
4239	São José das Missões	23
4240	São José do Herval	23
4241	São José do Hortêncio	23
4242	São José do Inhacorá	23
4243	São José do Norte	23
4244	São José do Ouro	23
4245	São José do Sul	23
4246	São José dos Ausentes	23
4247	São Leopoldo	23
4248	São Lourenço do Sul	23
4249	São Luiz Gonzaga	23
4250	São Marcos	23
4251	São Martinho	23
4252	São Martinho da Serra	23
4253	São Miguel das Missões	23
4254	São Nicolau	23
4255	São Paulo das Missões	23
4256	São Pedro da Serra	23
4257	São Pedro das Missões	23
4258	São Pedro do Butiá	23
4259	São Pedro do Sul	23
4260	São Sebastião do Caí	23
4261	São Sepé	23
4262	São Valentim	23
4263	São Valentim do Sul	23
4264	São Valério do Sul	23
4265	São Vendelino	23
4266	São Vicente do Sul	23
4267	Sapiranga	23
4268	Sapucaia do Sul	23
4269	Sarandi	23
4270	Seberi	23
4271	Sede Nova	23
4272	Segredo	23
4273	Selbach	23
4274	Senador Salgado Filho	23
4275	Sentinela do Sul	23
4276	Serafina Corrêa	23
4277	Sério	23
4278	Sertão	23
4279	Sertão Santana	23
4280	Sete de Setembro	23
4281	Severiano de Almeida	23
4282	Silveira Martins	23
4283	Sinimbu	23
4284	Sobradinho	23
4285	Soledade	23
4286	Tabaí	23
4287	Tapejara	23
4288	Tapera	23
4289	Tapes	23
4290	Taquara	23
4291	Taquari	23
4292	Taquaruçu do Sul	23
4293	Tavares	23
4294	Tenente Portela	23
4295	Terra de Areia	23
4296	Teutônia	23
4297	Tio Hugo	23
4298	Tiradentes do Sul	23
4299	Toropi	23
4300	Torres	23
4301	Tramandaí	23
4302	Travesseiro	23
4303	Três Arroios	23
4304	Três Cachoeiras	23
4305	Três Coroas	23
4306	Três de Maio	23
4307	Três Forquilhas	23
4308	Três Palmeiras	23
4309	Três Passos	23
4310	Trindade do Sul	23
4311	Triunfo	23
4312	Tucunduva	23
4313	Tunas	23
4314	Tupanci do Sul	23
4315	Tupanciretã	23
4316	Tupandi	23
4317	Tuparendi	23
4318	Turuçu	23
4319	Ubiretama	23
4320	União da Serra	23
4321	Unistalda	23
4322	Uruguaiana	23
4323	Vacaria	23
4324	Vale do Sol	23
4325	Vale Real	23
4326	Vale Verde	23
4327	Vanini	23
4328	Venâncio Aires	23
4329	Vera Cruz	23
4330	Veranópolis	23
4331	Vespasiano Correa	23
4332	Viadutos	23
4333	Viamão	23
4334	Vicente Dutra	23
4335	Victor Graeff	23
4336	Vila Flores	23
4337	Vila Lângaro	23
4338	Vila Maria	23
4339	Vila Nova do Sul	23
4340	Vista Alegre	23
4341	Vista Alegre do Prata	23
4342	Vista Gaúcha	23
4343	Vitória das Missões	23
4344	Westfália	23
4345	Xangri-lá	23
4346	Alta Floresta dOeste	21
4347	Alto Alegre dos Parecis	21
4348	Alto Paraíso	21
4349	Alvorada dOeste	21
4350	Ariquemes	21
4351	Buritis	21
4352	Cabixi	21
4353	Cacaulândia	21
4354	Cacoal	21
4355	Campo Novo de Rondônia	21
4356	Candeias do Jamari	21
4357	Castanheiras	21
4358	Cerejeiras	21
4359	Chupinguaia	21
4360	Colorado do Oeste	21
4361	Corumbiara	21
4362	Costa Marques	21
4363	Cujubim	21
4364	Espigão dOeste	21
4365	Governador Jorge Teixeira	21
4366	Guajará-Mirim	21
4367	Itapuã do Oeste	21
4368	Jaru	21
4369	Ji-Paraná	21
4370	Machadinho dOeste	21
4371	Ministro Andreazza	21
4372	Mirante da Serra	21
4373	Monte Negro	21
4374	Nova Brasilândia dOeste	21
4375	Nova Mamoré	21
4376	Nova União	21
4377	Novo Horizonte do Oeste	21
4378	Ouro Preto do Oeste	21
4379	Parecis	21
4380	Pimenta Bueno	21
4381	Pimenteiras do Oeste	21
4382	Porto Velho	21
4383	Presidente Médici	21
4384	Primavera de Rondônia	21
4385	Rio Crespo	21
4386	Rolim de Moura	21
4387	Santa Luzia dOeste	21
4388	São Felipe dOeste	21
4389	São Francisco do Guaporé	21
4390	São Miguel do Guaporé	21
4391	Seringueiras	21
4392	Teixeirópolis	21
4393	Theobroma	21
4394	Urupá	21
4395	Vale do Anari	21
4396	Vale do Paraíso	21
4397	Vilhena	21
4398	Alto Alegre	22
4399	Amajari	22
4400	Boa Vista	22
4401	Bonfim	22
4402	Cantá	22
4403	Caracaraí	22
4404	Caroebe	22
4405	Iracema	22
4406	Mucajaí	22
4407	Normandia	22
4408	Pacaraima	22
4409	Rorainópolis	22
4410	São João da Baliza	22
4411	São Luiz	22
4412	Uiramutã	22
4413	Abdon Batista	24
4414	Abelardo Luz	24
4415	Agrolândia	24
4416	Agronômica	24
4417	Água Doce	24
4418	Águas de Chapecó	24
4419	Águas Frias	24
4420	Águas Mornas	24
4421	Alfredo Wagner	24
4422	Alto Bela Vista	24
4423	Anchieta	24
4424	Angelina	24
4425	Anita Garibaldi	24
4426	Anitápolis	24
4427	Antônio Carlos	24
4428	Apiúna	24
4429	Arabutã	24
4430	Araquari	24
4431	Araranguá	24
4432	Armazém	24
4433	Arroio Trinta	24
4434	Arvoredo	24
4435	Ascurra	24
4436	Atalanta	24
4437	Aurora	24
4438	Balneário Arroio do Silva	24
4439	Balneário Barra do Sul	24
4440	Balneário Camboriú	24
4441	Balneário Gaivota	24
4442	Bandeirante	24
4443	Barra Bonita	24
4444	Barra Velha	24
4445	Bela Vista do Toldo	24
4446	Belmonte	24
4447	Benedito Novo	24
4448	Biguaçu	24
4449	Blumenau	24
4450	Bocaina do Sul	24
4451	Bom Jardim da Serra	24
4452	Bom Jesus	24
4453	Bom Jesus do Oeste	24
4454	Bom Retiro	24
4455	Bombinhas	24
4456	Botuverá	24
4457	Braço do Norte	24
4458	Braço do Trombudo	24
4459	Brunópolis	24
4460	Brusque	24
4461	Caçador	24
4462	Caibi	24
4463	Calmon	24
4464	Camboriú	24
4465	Campo Alegre	24
4466	Campo Belo do Sul	24
4467	Campo Erê	24
4468	Campos Novos	24
4469	Canelinha	24
4470	Canoinhas	24
4471	Capão Alto	24
4472	Capinzal	24
4473	Capivari de Baixo	24
4474	Catanduvas	24
4475	Caxambu do Sul	24
4476	Celso Ramos	24
4477	Cerro Negro	24
4478	Chapadão do Lageado	24
4479	Chapecó	24
4480	Cocal do Sul	24
4481	Concórdia	24
4482	Cordilheira Alta	24
4483	Coronel Freitas	24
4484	Coronel Martins	24
4485	Correia Pinto	24
4486	Corupá	24
4487	Criciúma	24
4488	Cunha Porã	24
4489	Cunhataí	24
4490	Curitibanos	24
4491	Descanso	24
4492	Dionísio Cerqueira	24
4493	Dona Emma	24
4494	Doutor Pedrinho	24
4495	Entre Rios	24
4496	Ermo	24
4497	Erval Velho	24
4498	Faxinal dos Guedes	24
4499	Flor do Sertão	24
4500	Florianópolis	24
4501	Formosa do Sul	24
4502	Forquilhinha	24
4503	Fraiburgo	24
4504	Frei Rogério	24
4505	Galvão	24
4506	Garopaba	24
4507	Garuva	24
4508	Gaspar	24
4509	Governador Celso Ramos	24
4510	Grão Pará	24
4511	Gravatal	24
4512	Guabiruba	24
4513	Guaraciaba	24
4514	Guaramirim	24
4515	Guarujá do Sul	24
4516	Guatambú	24
4517	Herval dOeste	24
4518	Ibiam	24
4519	Ibicaré	24
4520	Ibirama	24
4521	Içara	24
4522	Ilhota	24
4523	Imaruí	24
4524	Imbituba	24
4525	Imbuia	24
4526	Indaial	24
4527	Iomerê	24
4528	Ipira	24
4529	Iporã do Oeste	24
4530	Ipuaçu	24
4531	Ipumirim	24
4532	Iraceminha	24
4533	Irani	24
4534	Irati	24
4535	Irineópolis	24
4536	Itá	24
4537	Itaiópolis	24
4538	Itajaí	24
4539	Itapema	24
4540	Itapiranga	24
4541	Itapoá	24
4542	Ituporanga	24
4543	Jaborá	24
4544	Jacinto Machado	24
4545	Jaguaruna	24
4546	Jaraguá do Sul	24
4547	Jardinópolis	24
4548	Joaçaba	24
4549	Joinville	24
4550	José Boiteux	24
4551	Jupiá	24
4552	Lacerdópolis	24
4553	Lages	24
4554	Laguna	24
4555	Lajeado Grande	24
4556	Laurentino	24
4557	Lauro Muller	24
4558	Lebon Régis	24
4559	Leoberto Leal	24
4560	Lindóia do Sul	24
4561	Lontras	24
4562	Luiz Alves	24
4563	Luzerna	24
4564	Macieira	24
4565	Mafra	24
4566	Major Gercino	24
4567	Major Vieira	24
4568	Maracajá	24
4569	Maravilha	24
4570	Marema	24
4571	Massaranduba	24
4572	Matos Costa	24
4573	Meleiro	24
4574	Mirim Doce	24
4575	Modelo	24
4576	Mondaí	24
4577	Monte Carlo	24
4578	Monte Castelo	24
4579	Morro da Fumaça	24
4580	Morro Grande	24
4581	Navegantes	24
4582	Nova Erechim	24
4583	Nova Itaberaba	24
4584	Nova Trento	24
4585	Nova Veneza	24
4586	Novo Horizonte	24
4587	Orleans	24
4588	Otacílio Costa	24
4589	Ouro	24
4590	Ouro Verde	24
4591	Paial	24
4592	Painel	24
4593	Palhoça	24
4594	Palma Sola	24
4595	Palmeira	24
4596	Palmitos	24
4597	Papanduva	24
4598	Paraíso	24
4599	Passo de Torres	24
4600	Passos Maia	24
4601	Paulo Lopes	24
4602	Pedras Grandes	24
4603	Penha	24
4604	Peritiba	24
4605	Petrolândia	24
4606	Piçarras	24
4607	Pinhalzinho	24
4608	Pinheiro Preto	24
4609	Piratuba	24
4610	Planalto Alegre	24
4611	Pomerode	24
4612	Ponte Alta	24
4613	Ponte Alta do Norte	24
4614	Ponte Serrada	24
4615	Porto Belo	24
4616	Porto União	24
4617	Pouso Redondo	24
4618	Praia Grande	24
4619	Presidente Castelo Branco	24
4620	Presidente Getúlio	24
4621	Presidente Nereu	24
4622	Princesa	24
4623	Quilombo	24
4624	Rancho Queimado	24
4625	Rio das Antas	24
4626	Rio do Campo	24
4627	Rio do Oeste	24
4628	Rio do Sul	24
4629	Rio dos Cedros	24
4630	Rio Fortuna	24
4631	Rio Negrinho	24
4632	Rio Rufino	24
4633	Riqueza	24
4634	Rodeio	24
4635	Romelândia	24
4636	Salete	24
4637	Saltinho	24
4638	Salto Veloso	24
4639	Sangão	24
4640	Santa Cecília	24
4641	Santa Helena	24
4642	Santa Rosa de Lima	24
4643	Santa Rosa do Sul	24
4644	Santa Terezinha	24
4645	Santa Terezinha do Progresso	24
4646	Santiago do Sul	24
4647	Santo Amaro da Imperatriz	24
4648	São Bento do Sul	24
4649	São Bernardino	24
4650	São Bonifácio	24
4651	São Carlos	24
4652	São Cristovão do Sul	24
4653	São Domingos	24
4654	São Francisco do Sul	24
4655	São João Batista	24
4656	São João do Itaperiú	24
4657	São João do Oeste	24
4658	São João do Sul	24
4659	São Joaquim	24
4660	São José	24
4661	São José do Cedro	24
4662	São José do Cerrito	24
4663	São Lourenço do Oeste	24
4664	São Ludgero	24
4665	São Martinho	24
4666	São Miguel da Boa Vista	24
4667	São Miguel do Oeste	24
4668	São Pedro de Alcântara	24
4669	Saudades	24
4670	Schroeder	24
4671	Seara	24
4672	Serra Alta	24
4673	Siderópolis	24
4674	Sombrio	24
4675	Sul Brasil	24
4676	Taió	24
4677	Tangará	24
4678	Tigrinhos	24
4679	Tijucas	24
4680	Timbé do Sul	24
4681	Timbó	24
4682	Timbó Grande	24
4683	Três Barras	24
4684	Treviso	24
4685	Treze de Maio	24
4686	Treze Tílias	24
4687	Trombudo Central	24
4688	Tubarão	24
4689	Tunápolis	24
4690	Turvo	24
4691	União do Oeste	24
4692	Urubici	24
4693	Urupema	24
4694	Urussanga	24
4695	Vargeão	24
4696	Vargem	24
4697	Vargem Bonita	24
4698	Vidal Ramos	24
4699	Videira	24
4700	Vitor Meireles	24
4701	Witmarsum	24
4702	Xanxerê	24
4703	Xavantina	24
4704	Xaxim	24
4705	Zortéa	24
4706	Adamantina	26
4707	Adolfo	26
4708	Aguaí	26
4709	Águas da Prata	26
4710	Águas de Lindóia	26
4711	Águas de Santa Bárbara	26
4712	Águas de São Pedro	26
4713	Agudos	26
4714	Alambari	26
4715	Alfredo Marcondes	26
4716	Altair	26
4717	Altinópolis	26
4718	Alto Alegre	26
4719	Alumínio	26
4720	Álvares Florence	26
4721	Álvares Machado	26
4722	Álvaro de Carvalho	26
4723	Alvinlândia	26
4724	Americana	26
4725	Américo Brasiliense	26
4726	Américo de Campos	26
4727	Amparo	26
4728	Analândia	26
4729	Andradina	26
4730	Angatuba	26
4731	Anhembi	26
4732	Anhumas	26
4733	Aparecida	26
4734	Aparecida dOeste	26
4735	Apiaí	26
4736	Araçariguama	26
4737	Araçatuba	26
4738	Araçoiaba da Serra	26
4739	Aramina	26
4740	Arandu	26
4741	Arapeí	26
4742	Araraquara	26
4743	Araras	26
4744	Arco-Íris	26
4745	Arealva	26
4746	Areias	26
4747	Areiópolis	26
4748	Ariranha	26
4749	Artur Nogueira	26
4750	Arujá	26
4751	Aspásia	26
4752	Assis	26
4753	Atibaia	26
4754	Auriflama	26
4755	Avaí	26
4756	Avanhandava	26
4757	Avaré	26
4758	Bady Bassitt	26
4759	Balbinos	26
4760	Bálsamo	26
4761	Bananal	26
4762	Barão de Antonina	26
4763	Barbosa	26
4764	Bariri	26
4765	Barra Bonita	26
4766	Barra do Chapéu	26
4767	Barra do Turvo	26
4768	Barretos	26
4769	Barrinha	26
4770	Barueri	26
4771	Bastos	26
4772	Batatais	26
4773	Bauru	26
4774	Bebedouro	26
4775	Bento de Abreu	26
4776	Bernardino de Campos	26
4777	Bertioga	26
4778	Bilac	26
4779	Birigui	26
4780	Biritiba-Mirim	26
4781	Boa Esperança do Sul	26
4782	Bocaina	26
4783	Bofete	26
4784	Boituva	26
4785	Bom Jesus dos Perdões	26
4786	Bom Sucesso de Itararé	26
4787	Borá	26
4788	Boracéia	26
4789	Borborema	26
4790	Borebi	26
4791	Botucatu	26
4792	Bragança Paulista	26
4793	Braúna	26
4794	Brejo Alegre	26
4795	Brodowski	26
4796	Brotas	26
4797	Buri	26
4798	Buritama	26
4799	Buritizal	26
4800	Cabrália Paulista	26
4801	Cabreúva	26
4802	Caçapava	26
4803	Cachoeira Paulista	26
4804	Caconde	26
4805	Cafelândia	26
4806	Caiabu	26
4807	Caieiras	26
4808	Caiuá	26
4809	Cajamar	26
4810	Cajati	26
4811	Cajobi	26
4812	Cajuru	26
4813	Campina do Monte Alegre	26
4814	Campinas	26
4815	Campo Limpo Paulista	26
4816	Campos do Jordão	26
4817	Campos Novos Paulista	26
4818	Cananéia	26
4819	Canas	26
4820	Cândido Mota	26
4821	Cândido Rodrigues	26
4822	Canitar	26
4823	Capão Bonito	26
4824	Capela do Alto	26
4825	Capivari	26
4826	Caraguatatuba	26
4827	Carapicuíba	26
4828	Cardoso	26
4829	Casa Branca	26
4830	Cássia dos Coqueiros	26
4831	Castilho	26
4832	Catanduva	26
4833	Catiguá	26
4834	Cedral	26
4835	Cerqueira César	26
4836	Cerquilho	26
4837	Cesário Lange	26
4838	Charqueada	26
4839	Chavantes	26
4840	Clementina	26
4841	Colina	26
4842	Colômbia	26
4843	Conchal	26
4844	Conchas	26
4845	Cordeirópolis	26
4846	Coroados	26
4847	Coronel Macedo	26
4848	Corumbataí	26
4849	Cosmópolis	26
4850	Cosmorama	26
4851	Cotia	26
4852	Cravinhos	26
4853	Cristais Paulista	26
4854	Cruzália	26
4855	Cruzeiro	26
4856	Cubatão	26
4857	Cunha	26
4858	Descalvado	26
4859	Diadema	26
4860	Dirce Reis	26
4861	Divinolândia	26
4862	Dobrada	26
4863	Dois Córregos	26
4864	Dolcinópolis	26
4865	Dourado	26
4866	Dracena	26
4867	Duartina	26
4868	Dumont	26
4869	Echaporã	26
4870	Eldorado	26
4871	Elias Fausto	26
4872	Elisiário	26
4873	Embaúba	26
4874	Embu	26
4875	Embu-Guaçu	26
4876	Emilianópolis	26
4877	Engenheiro Coelho	26
4878	Espírito Santo do Pinhal	26
4879	Espírito Santo do Turvo	26
4880	Estiva Gerbi	26
4881	Estrela dOeste	26
4882	Estrela do Norte	26
4883	Euclides da Cunha Paulista	26
4884	Fartura	26
4885	Fernando Prestes	26
4886	Fernandópolis	26
4887	Fernão	26
4888	Ferraz de Vasconcelos	26
4889	Flora Rica	26
4890	Floreal	26
4891	Flórida Paulista	26
4892	Florínia	26
4893	Franca	26
4894	Francisco Morato	26
4895	Franco da Rocha	26
4896	Gabriel Monteiro	26
4897	Gália	26
4898	Garça	26
4899	Gastão Vidigal	26
4900	Gavião Peixoto	26
4901	General Salgado	26
4902	Getulina	26
4903	Glicério	26
4904	Guaiçara	26
4905	Guaimbê	26
4906	Guaíra	26
4907	Guapiaçu	26
4908	Guapiara	26
4909	Guará	26
4910	Guaraçaí	26
4911	Guaraci	26
4912	Guarani dOeste	26
4913	Guarantã	26
4914	Guararapes	26
4915	Guararema	26
4916	Guaratinguetá	26
4917	Guareí	26
4918	Guariba	26
4919	Guarujá	26
4920	Guarulhos	26
4921	Guatapará	26
4922	Guzolândia	26
4923	Herculândia	26
4924	Holambra	26
4925	Hortolândia	26
4926	Iacanga	26
4927	Iacri	26
4928	Iaras	26
4929	Ibaté	26
4930	Ibirá	26
4931	Ibirarema	26
4932	Ibitinga	26
4933	Ibiúna	26
4934	Icém	26
4935	Iepê	26
4936	Igaraçu do Tietê	26
4937	Igarapava	26
4938	Igaratá	26
4939	Iguape	26
4940	Ilha Comprida	26
4941	Ilha Solteira	26
4942	Ilhabela	26
4943	Indaiatuba	26
4944	Indiana	26
4945	Indiaporã	26
4946	Inúbia Paulista	26
4947	Ipaussu	26
4948	Iperó	26
4949	Ipeúna	26
4950	Ipiguá	26
4951	Iporanga	26
4952	Ipuã	26
4953	Iracemápolis	26
4954	Irapuã	26
4955	Irapuru	26
4956	Itaberá	26
4957	Itaí	26
4958	Itajobi	26
4959	Itaju	26
4960	Itanhaém	26
4961	Itaóca	26
4962	Itapecerica da Serra	26
4963	Itapetininga	26
4964	Itapeva	26
4965	Itapevi	26
4966	Itapira	26
4967	Itapirapuã Paulista	26
4968	Itápolis	26
4969	Itaporanga	26
4970	Itapuí	26
4971	Itapura	26
4972	Itaquaquecetuba	26
4973	Itararé	26
4974	Itariri	26
4975	Itatiba	26
4976	Itatinga	26
4977	Itirapina	26
4978	Itirapuã	26
4979	Itobi	26
4980	Itu	26
4981	Itupeva	26
4982	Ituverava	26
4983	Jaborandi	26
4984	Jaboticabal	26
4985	Jacareí	26
4986	Jaci	26
4987	Jacupiranga	26
4988	Jaguariúna	26
4989	Jales	26
4990	Jambeiro	26
4991	Jandira	26
4992	Jardinópolis	26
4993	Jarinu	26
4994	Jaú	26
4995	Jeriquara	26
4996	Joanópolis	26
4997	João Ramalho	26
4998	José Bonifácio	26
4999	Júlio Mesquita	26
5000	Jumirim	26
5001	Jundiaí	26
5002	Junqueirópolis	26
5003	Juquiá	26
5004	Juquitiba	26
5005	Lagoinha	26
5006	Laranjal Paulista	26
5007	Lavínia	26
5008	Lavrinhas	26
5009	Leme	26
5010	Lençóis Paulista	26
5011	Limeira	26
5012	Lindóia	26
5013	Lins	26
5014	Lorena	26
5015	Lourdes	26
5016	Louveira	26
5017	Lucélia	26
5018	Lucianópolis	26
5019	Luís Antônio	26
5020	Luiziânia	26
5021	Lupércio	26
5022	Lutécia	26
5023	Macatuba	26
5024	Macaubal	26
5025	Macedônia	26
5026	Magda	26
5027	Mairinque	26
5028	Mairiporã	26
5029	Manduri	26
5030	Marabá Paulista	26
5031	Maracaí	26
5032	Marapoama	26
5033	Mariápolis	26
5034	Marília	26
5035	Marinópolis	26
5036	Martinópolis	26
5037	Matão	26
5038	Mauá	26
5039	Mendonça	26
5040	Meridiano	26
5041	Mesópolis	26
5042	Miguelópolis	26
5043	Mineiros do Tietê	26
5044	Mira Estrela	26
5045	Miracatu	26
5046	Mirandópolis	26
5047	Mirante do Paranapanema	26
5048	Mirassol	26
5049	Mirassolândia	26
5050	Mococa	26
5051	Mogi das Cruzes	26
5052	Mogi Guaçu	26
5053	Moji Mirim	26
5054	Mombuca	26
5055	Monções	26
5056	Mongaguá	26
5057	Monte Alegre do Sul	26
5058	Monte Alto	26
5059	Monte Aprazível	26
5060	Monte Azul Paulista	26
5061	Monte Castelo	26
5062	Monte Mor	26
5063	Monteiro Lobato	26
5064	Morro Agudo	26
5065	Morungaba	26
5066	Motuca	26
5067	Murutinga do Sul	26
5068	Nantes	26
5069	Narandiba	26
5070	Natividade da Serra	26
5071	Nazaré Paulista	26
5072	Neves Paulista	26
5073	Nhandeara	26
5074	Nipoã	26
5075	Nova Aliança	26
5076	Nova Campina	26
5077	Nova Canaã Paulista	26
5078	Nova Castilho	26
5079	Nova Europa	26
5080	Nova Granada	26
5081	Nova Guataporanga	26
5082	Nova Independência	26
5083	Nova Luzitânia	26
5084	Nova Odessa	26
5085	Novais	26
5086	Novo Horizonte	26
5087	Nuporanga	26
5088	Ocauçu	26
5089	Óleo	26
5090	Olímpia	26
5091	Onda Verde	26
5092	Oriente	26
5093	Orindiúva	26
5094	Orlândia	26
5095	Osasco	26
5096	Oscar Bressane	26
5097	Osvaldo Cruz	26
5098	Ourinhos	26
5099	Ouro Verde	26
5100	Ouroeste	26
5101	Pacaembu	26
5102	Palestina	26
5103	Palmares Paulista	26
5104	Palmeira dOeste	26
5105	Palmital	26
5106	Panorama	26
5107	Paraguaçu Paulista	26
5108	Paraibuna	26
5109	Paraíso	26
5110	Paranapanema	26
5111	Paranapuã	26
5112	Parapuã	26
5113	Pardinho	26
5114	Pariquera-Açu	26
5115	Parisi	26
5116	Patrocínio Paulista	26
5117	Paulicéia	26
5118	Paulínia	26
5119	Paulistânia	26
5120	Paulo de Faria	26
5121	Pederneiras	26
5122	Pedra Bela	26
5123	Pedranópolis	26
5124	Pedregulho	26
5125	Pedreira	26
5126	Pedrinhas Paulista	26
5127	Pedro de Toledo	26
5128	Penápolis	26
5129	Pereira Barreto	26
5130	Pereiras	26
5131	Peruíbe	26
5132	Piacatu	26
5133	Piedade	26
5134	Pilar do Sul	26
5135	Pindamonhangaba	26
5136	Pindorama	26
5137	Pinhalzinho	26
5138	Piquerobi	26
5139	Piquete	26
5140	Piracaia	26
5141	Piracicaba	26
5142	Piraju	26
5143	Pirajuí	26
5144	Pirangi	26
5145	Pirapora do Bom Jesus	26
5146	Pirapozinho	26
5147	Pirassununga	26
5148	Piratininga	26
5149	Pitangueiras	26
5150	Planalto	26
5151	Platina	26
5152	Poá	26
5153	Poloni	26
5154	Pompéia	26
5155	Pongaí	26
5156	Pontal	26
5157	Pontalinda	26
5158	Pontes Gestal	26
5159	Populina	26
5160	Porangaba	26
5161	Porto Feliz	26
5162	Porto Ferreira	26
5163	Potim	26
5164	Potirendaba	26
5165	Pracinha	26
5166	Pradópolis	26
5167	Praia Grande	26
5168	Pratânia	26
5169	Presidente Alves	26
5170	Presidente Bernardes	26
5171	Presidente Epitácio	26
5172	Presidente Prudente	26
5173	Presidente Venceslau	26
5174	Promissão	26
5175	Quadra	26
5176	Quatá	26
5177	Queiroz	26
5178	Queluz	26
5179	Quintana	26
5180	Rafard	26
5181	Rancharia	26
5182	Redenção da Serra	26
5183	Regente Feijó	26
5184	Reginópolis	26
5185	Registro	26
5186	Restinga	26
5187	Ribeira	26
5188	Ribeirão Bonito	26
5189	Ribeirão Branco	26
5190	Ribeirão Corrente	26
5191	Ribeirão do Sul	26
5192	Ribeirão dos Índios	26
5193	Ribeirão Grande	26
5194	Ribeirão Pires	26
5195	Ribeirão Preto	26
5196	Rifaina	26
5197	Rincão	26
5198	Rinópolis	26
5199	Rio Claro	26
5200	Rio das Pedras	26
5201	Rio Grande da Serra	26
5202	Riolândia	26
5203	Riversul	26
5204	Rosana	26
5205	Roseira	26
5206	Rubiácea	26
5207	Rubinéia	26
5208	Sabino	26
5209	Sagres	26
5210	Sales	26
5211	Sales Oliveira	26
5212	Salesópolis	26
5213	Salmourão	26
5214	Saltinho	26
5215	Salto	26
5216	Salto de Pirapora	26
5217	Salto Grande	26
5218	Sandovalina	26
5219	Santa Adélia	26
5220	Santa Albertina	26
5221	Santa Bárbara dOeste	26
5222	Santa Branca	26
5223	Santa Clara dOeste	26
5224	Santa Cruz da Conceição	26
5225	Santa Cruz da Esperança	26
5226	Santa Cruz das Palmeiras	26
5227	Santa Cruz do Rio Pardo	26
5228	Santa Ernestina	26
5229	Santa Fé do Sul	26
5230	Santa Gertrudes	26
5231	Santa Isabel	26
5232	Santa Lúcia	26
5233	Santa Maria da Serra	26
5234	Santa Mercedes	26
5235	Santa Rita dOeste	26
5236	Santa Rita do Passa Quatro	26
5237	Santa Rosa de Viterbo	26
5238	Santa Salete	26
5239	Santana da Ponte Pensa	26
5240	Santana de Parnaíba	26
5241	Santo Anastácio	26
5242	Santo André	26
5243	Santo Antônio da Alegria	26
5244	Santo Antônio de Posse	26
5245	Santo Antônio do Aracanguá	26
5246	Santo Antônio do Jardim	26
5247	Santo Antônio do Pinhal	26
5248	Santo Expedito	26
5249	Santópolis do Aguapeí	26
5250	Santos	26
5251	São Bento do Sapucaí	26
5252	São Bernardo do Campo	26
5253	São Caetano do Sul	26
5254	São Carlos	26
5255	São Francisco	26
5256	São João da Boa Vista	26
5257	São João das Duas Pontes	26
5258	São João de Iracema	26
5259	São João do Pau dAlho	26
5260	São Joaquim da Barra	26
5261	São José da Bela Vista	26
5262	São José do Barreiro	26
5263	São José do Rio Pardo	26
5264	São José do Rio Preto	26
5265	São José dos Campos	26
5266	São Lourenço da Serra	26
5267	São Luís do Paraitinga	26
5268	São Manuel	26
5269	São Miguel Arcanjo	26
5270	São Paulo	26
5271	São Pedro	26
5272	São Pedro do Turvo	26
5273	São Roque	26
5274	São Sebastião	26
5275	São Sebastião da Grama	26
5276	São Simão	26
5277	São Vicente	26
5278	Sarapuí	26
5279	Sarutaiá	26
5280	Sebastianópolis do Sul	26
5281	Serra Azul	26
5282	Serra Negra	26
5283	Serrana	26
5284	Sertãozinho	26
5285	Sete Barras	26
5286	Severínia	26
5287	Silveiras	26
5288	Socorro	26
5289	Sorocaba	26
5290	Sud Mennucci	26
5291	Sumaré	26
5292	Suzanápolis	26
5293	Suzano	26
5294	Tabapuã	26
5295	Tabatinga	26
5296	Taboão da Serra	26
5297	Taciba	26
5298	Taguaí	26
5299	Taiaçu	26
5300	Taiúva	26
5301	Tambaú	26
5302	Tanabi	26
5303	Tapiraí	26
5304	Tapiratiba	26
5305	Taquaral	26
5306	Taquaritinga	26
5307	Taquarituba	26
5308	Taquarivaí	26
5309	Tarabai	26
5310	Tarumã	26
5311	Tatuí	26
5312	Taubaté	26
5313	Tejupá	26
5314	Teodoro Sampaio	26
5315	Terra Roxa	26
5316	Tietê	26
5317	Timburi	26
5318	Torre de Pedra	26
5319	Torrinha	26
5320	Trabiju	26
5321	Tremembé	26
5322	Três Fronteiras	26
5323	Tuiuti	26
5324	Tupã	26
5325	Tupi Paulista	26
5326	Turiúba	26
5327	Turmalina	26
5328	Ubarana	26
5329	Ubatuba	26
5330	Ubirajara	26
5331	Uchoa	26
5332	União Paulista	26
5333	Urânia	26
5334	Uru	26
5335	Urupês	26
5336	Valentim Gentil	26
5337	Valinhos	26
5338	Valparaíso	26
5339	Vargem	26
5340	Vargem Grande do Sul	26
5341	Vargem Grande Paulista	26
5342	Várzea Paulista	26
5343	Vera Cruz	26
5344	Vinhedo	26
5345	Viradouro	26
5346	Vista Alegre do Alto	26
5347	Vitória Brasil	26
5348	Votorantim	26
5349	Votuporanga	26
5350	Zacarias	26
5351	Amparo de São Francisco	25
5352	Aquidabã	25
5353	Aracaju	25
5354	Arauá	25
5355	Areia Branca	25
5356	Barra dos Coqueiros	25
5357	Boquim	25
5358	Brejo Grande	25
5359	Campo do Brito	25
5360	Canhoba	25
5361	Canindé de São Francisco	25
5362	Capela	25
5363	Carira	25
5364	Carmópolis	25
5365	Cedro de São João	25
5366	Cristinápolis	25
5367	Cumbe	25
5368	Divina Pastora	25
5369	Estância	25
5370	Feira Nova	25
5371	Frei Paulo	25
5372	Gararu	25
5373	General Maynard	25
5374	Gracho Cardoso	25
5375	Ilha das Flores	25
5376	Indiaroba	25
5377	Itabaiana	25
5378	Itabaianinha	25
5379	Itabi	25
5380	Itaporanga dAjuda	25
5381	Japaratuba	25
5382	Japoatã	25
5383	Lagarto	25
5384	Laranjeiras	25
5385	Macambira	25
5386	Malhada dos Bois	25
5387	Malhador	25
5388	Maruim	25
5389	Moita Bonita	25
5390	Monte Alegre de Sergipe	25
5391	Muribeca	25
5392	Neópolis	25
5393	Nossa Senhora Aparecida	25
5394	Nossa Senhora da Glória	25
5395	Nossa Senhora das Dores	25
5396	Nossa Senhora de Lourdes	25
5397	Nossa Senhora do Socorro	25
5398	Pacatuba	25
5399	Pedra Mole	25
5400	Pedrinhas	25
5401	Pinhão	25
5402	Pirambu	25
5403	Poço Redondo	25
5404	Poço Verde	25
5405	Porto da Folha	25
5406	Propriá	25
5407	Riachão do Dantas	25
5408	Riachuelo	25
5409	Ribeirópolis	25
5410	Rosário do Catete	25
5411	Salgado	25
5412	Santa Luzia do Itanhy	25
5413	Santa Rosa de Lima	25
5414	Santana do São Francisco	25
5415	Santo Amaro das Brotas	25
5416	São Cristóvão	25
5417	São Domingos	25
5418	São Francisco	25
5419	São Miguel do Aleixo	25
5420	Simão Dias	25
5421	Siriri	25
5422	Telha	25
5423	Tobias Barreto	25
5424	Tomar do Geru	25
5425	Umbaúba	25
5426	Abreulândia	27
5427	Aguiarnópolis	27
5428	Aliança do Tocantins	27
5429	Almas	27
5430	Alvorada	27
5431	Ananás	27
5432	Angico	27
5433	Aparecida do Rio Negro	27
5434	Aragominas	27
5435	Araguacema	27
5436	Araguaçu	27
5437	Araguaína	27
5438	Araguanã	27
5439	Araguatins	27
5440	Arapoema	27
5441	Arraias	27
5442	Augustinópolis	27
5443	Aurora do Tocantins	27
5444	Axixá do Tocantins	27
5445	Babaçulândia	27
5446	Bandeirantes do Tocantins	27
5447	Barra do Ouro	27
5448	Barrolândia	27
5449	Bernardo Sayão	27
5450	Bom Jesus do Tocantins	27
5451	Brasilândia do Tocantins	27
5452	Brejinho de Nazaré	27
5453	Buriti do Tocantins	27
5454	Cachoeirinha	27
5455	Campos Lindos	27
5456	Cariri do Tocantins	27
5457	Carmolândia	27
5458	Carrasco Bonito	27
5459	Caseara	27
5460	Centenário	27
5461	Chapada da Natividade	27
5462	Chapada de Areia	27
5463	Colinas do Tocantins	27
5464	Colméia	27
5465	Combinado	27
5466	Conceição do Tocantins	27
5467	Couto de Magalhães	27
5468	Cristalândia	27
5469	Crixás do Tocantins	27
5470	Darcinópolis	27
5471	Dianópolis	27
5472	Divinópolis do Tocantins	27
5473	Dois Irmãos do Tocantins	27
5474	Dueré	27
5475	Esperantina	27
5476	Fátima	27
5477	Figueirópolis	27
5478	Filadélfia	27
5479	Formoso do Araguaia	27
5480	Fortaleza do Tabocão	27
5481	Goianorte	27
5482	Goiatins	27
5483	Guaraí	27
5484	Gurupi	27
5485	Ipueiras	27
5486	Itacajá	27
5487	Itaguatins	27
5488	Itapiratins	27
5489	Itaporã do Tocantins	27
5490	Jaú do Tocantins	27
5491	Juarina	27
5492	Lagoa da Confusão	27
5493	Lagoa do Tocantins	27
5494	Lajeado	27
5495	Lavandeira	27
5496	Lizarda	27
5497	Luzinópolis	27
5498	Marianópolis do Tocantins	27
5499	Mateiros	27
5500	Maurilândia do Tocantins	27
5501	Miracema do Tocantins	27
5502	Miranorte	27
5503	Monte do Carmo	27
5504	Monte Santo do Tocantins	27
5505	Muricilândia	27
5506	Natividade	27
5507	Nazaré	27
5508	Nova Olinda	27
5509	Nova Rosalândia	27
5510	Novo Acordo	27
5511	Novo Alegre	27
5512	Novo Jardim	27
5513	Oliveira de Fátima	27
5514	Palmas	27
5515	Palmeirante	27
5516	Palmeiras do Tocantins	27
5517	Palmeirópolis	27
5518	Paraíso do Tocantins	27
5519	Paranã	27
5520	Pau dArco	27
5521	Pedro Afonso	27
5522	Peixe	27
5523	Pequizeiro	27
5524	Pindorama do Tocantins	27
5525	Piraquê	27
5526	Pium	27
5527	Ponte Alta do Bom Jesus	27
5528	Ponte Alta do Tocantins	27
5529	Porto Alegre do Tocantins	27
5530	Porto Nacional	27
5531	Praia Norte	27
5532	Presidente Kennedy	27
5533	Pugmil	27
5534	Recursolândia	27
5535	Riachinho	27
5536	Rio da Conceição	27
5537	Rio dos Bois	27
5538	Rio Sono	27
5539	Sampaio	27
5540	Sandolândia	27
5541	Santa Fé do Araguaia	27
5542	Santa Maria do Tocantins	27
5543	Santa Rita do Tocantins	27
5544	Santa Rosa do Tocantins	27
5545	Santa Tereza do Tocantins	27
5546	Santa Terezinha do Tocantins	27
5547	São Bento do Tocantins	27
5548	São Félix do Tocantins	27
5549	São Miguel do Tocantins	27
5550	São Salvador do Tocantins	27
5551	São Sebastião do Tocantins	27
5552	São Valério da Natividade	27
5553	Silvanópolis	27
5554	Sítio Novo do Tocantins	27
5555	Sucupira	27
5556	Taguatinga	27
5557	Taipas do Tocantins	27
5558	Talismã	27
5559	Tocantínia	27
5560	Tocantinópolis	27
5561	Tupirama	27
5562	Tupiratins	27
5563	Wanderlândia	27
5564	Xambioá	27
\.


--
-- Data for Name: empresas; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.empresas (id, razao_social, fantasia, cnpj, inscricao_estadual, cep, endereco, numero, bairro, municipio, uf, segmento, dominio, db_database, created_at, updated_at, ativo) FROM stdin;
1	siosi	siosi	12345678912345	1112223334	89816156	rua x	1	seminario	1	1	aves	siosi.d2wdigital.com.br	siosiTestes	\N	\N	1
50	empresona	empresa	11122233344455	1111155555	11223344	rua x	1	seminario	1	1	Aves	empresona.d2wdigital.com.br	empresona	2019-08-01 15:14:40	2019-08-01 15:14:40	1
49	empresinha	Empresa	11122233344	1112223334	11223344	rua x	1	seminario	1	1	Aves	siosi.d2wdigital.com.br/empresax	empresinha	2019-08-01 11:19:28	2019-08-01 11:19:28	1
\.


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.estados (id, nome, uf, id_pais) FROM stdin;
1	Acre	AC	1
2	Alagoas	AL	1
3	Amazonas	AM	1
4	Amapá	AP	1
5	Bahia	BA	1
6	Ceará	CE	1
7	Distrito Federal	DF	1
8	Espírito Santo	ES	1
9	Goiás	GO	1
10	Maranhão	MA	1
11	Minas Gerais	MG	1
12	Mato Grosso do Sul	MS	1
13	Mato Grosso	MT	1
14	Pará	PA	1
15	Paraíba	PB	1
16	Pernambuco	PE	1
17	Piauí	PI	1
18	Paraná	PR	1
19	Rio de Janeiro	RJ	1
20	Rio Grande do Norte	RN	1
21	Rondônia	RO	1
22	Roraima	RR	1
23	Rio Grande do Sul	RS	1
24	Santa Catarina	SC	1
25	Sergipe	SE	1
26	São Paulo	SP	1
27	Tocantins	TO	1
\.


--
-- Data for Name: fichas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fichas (id, id_itens, id_auditorias, conforme, created_at, updated_at, reaudita) FROM stdin;
48376	131	404	1	2019-08-05 14:44:01	2019-08-05 14:44:01	\N
48377	132	404	1	2019-08-05 14:44:01	2019-08-05 14:44:01	\N
48378	133	406	1	2019-08-05 15:43:27	2019-08-05 15:43:27	\N
48379	133	407	1	2019-08-05 15:43:32	2019-08-05 15:43:32	\N
48380	134	407	1	2019-08-05 15:43:32	2019-08-05 15:43:32	\N
48381	131	408	1	2019-08-05 15:43:37	2019-08-05 15:43:37	\N
48382	132	408	1	2019-08-05 15:43:37	2019-08-05 15:43:37	\N
48383	133	411	1	2019-08-05 15:44:27	2019-08-05 15:44:27	\N
48384	134	411	1	2019-08-05 15:44:27	2019-08-05 15:44:27	\N
48385	133	412	1	2019-08-05 15:44:34	2019-08-05 15:44:34	\N
48386	134	413	1	2019-08-05 15:44:38	2019-08-05 15:44:38	\N
48387	132	414	1	2019-08-05 15:44:43	2019-08-05 15:44:43	\N
48388	133	417	1	2019-08-05 15:55:37	2019-08-05 15:55:37	\N
48389	131	418	1	2019-08-05 15:55:42	2019-08-05 15:55:42	\N
48390	134	419	1	2019-08-05 15:55:47	2019-08-05 15:55:47	\N
48391	134	420	1	2019-08-05 15:55:51	2019-08-05 15:55:51	\N
48392	134	421	1	2019-08-05 15:55:56	2019-08-05 15:55:56	\N
48393	134	422	1	2019-08-05 15:56:00	2019-08-05 15:56:00	\N
48396	132	424	0	2019-08-05 17:26:54	2019-08-05 17:26:54	\N
48397	133	423	1	2019-08-05 17:29:47	2019-08-05 17:29:47	48394
48394	133	423	0	2019-08-05 17:13:33	2019-08-05 17:29:47	0
48398	134	423	1	2019-08-05 17:30:12	2019-08-05 17:30:12	48395
48395	134	423	0	2019-08-05 17:13:33	2019-08-05 17:30:12	0
48399	131	425	1	2019-08-07 11:52:10	2019-08-07 11:52:10	\N
48400	132	425	1	2019-08-07 11:52:10	2019-08-07 11:52:10	\N
\.


--
-- Data for Name: fichas_temperaturas; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.fichas_temperaturas (id, temperatura_painel, temperatura_aferida, reaudita, conforme, id_itens, id_auditorias, created_at, updated_at) FROM stdin;
146	3	3	\N	1	139	405	2019-08-05 15:13:10	2019-08-05 15:13:10
147	3	3	\N	1	140	405	2019-08-05 15:13:10	2019-08-05 15:13:10
148	2	34	\N	0	139	409	2019-08-05 15:44:02	2019-08-05 15:44:02
149	5	3	\N	1	140	409	2019-08-05 15:44:02	2019-08-05 15:44:02
150	3	3	\N	1	139	410	2019-08-05 15:44:10	2019-08-05 15:44:10
151	3	4	\N	1	140	410	2019-08-05 15:44:10	2019-08-05 15:44:10
152	12	23	\N	0	140	415	2019-08-05 15:44:55	2019-08-05 15:44:55
153	5	4	\N	0	138	416	2019-08-05 15:45:08	2019-08-05 15:45:08
\.


--
-- Data for Name: funcionarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionarios (id, nome, ativo, created_at, updated_at, cpf) FROM stdin;
37	Funcionario	1	2019-06-06 15:59:34	2019-06-06 15:59:34	123123123123
38	Funcionario 1	1	2019-07-02 11:03:53	2019-07-02 11:03:53	999999999-99
39	Funcionario 2	1	2019-07-02 11:04:25	2019-07-02 11:04:25	999999999-99
\.


--
-- Data for Name: itens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.itens (ativo, id, nome, processos_setor_id, created_at, updated_at) FROM stdin;
1	131	Item C1	141	2019-06-26 17:25:17	2019-06-26 17:25:17
1	132	Item C1	141	2019-07-01 15:10:56	2019-07-01 15:10:56
1	133	Item C1	143	2019-07-02 14:01:24	2019-07-02 14:01:24
1	134	Item C2	143	2019-07-02 14:01:53	2019-07-02 14:01:53
\.


--
-- Data for Name: itens_temperaturas; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.itens_temperaturas (id, nome, temperatura_minima, temperatura_maxima, processo_setor_id, ativo, created_at, updated_at) FROM stdin;
138	Item T1	5	10	141	1	2019-06-27 14:07:45	2019-06-27 14:07:45
139	Item T1	1	4	143	1	2019-07-02 14:01:44	2019-07-02 14:01:44
140	temp teste	3	6	143	1	2019-07-03 16:17:51	2019-07-03 16:17:51
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
48	2014_10_12_000000_create_users_table	1
49	2014_10_12_100000_create_password_resets_table	1
50	2016_06_01_000001_create_oauth_auth_codes_table	1
51	2016_06_01_000002_create_oauth_access_tokens_table	1
52	2016_06_01_000003_create_oauth_refresh_tokens_table	1
53	2016_06_01_000004_create_oauth_clients_table	1
54	2016_06_01_000005_create_oauth_personal_access_clients_table	1
55	2018_08_23_172002_create_processos_table	1
56	2018_08_23_174818_create_setor_table	1
57	2018_08_23_183330_create_processorsetor_table	1
58	2019_07_24_064305_create_empresas_table	2
\.


--
-- Data for Name: naos_conformidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.naos_conformidades (id, descricao, created_at, updated_at, ativo, nome) FROM stdin;
59	Descrição	2019-06-06 15:52:21	2019-06-06 15:52:21	1	Não Conformidade 1
60	Descrição	2019-06-06 15:52:34	2019-06-06 15:52:34	1	Não Conformidade 2
61	teste	2019-06-25 14:06:41	2019-06-25 14:06:41	1	teste
62	Não Conformidade	2019-07-02 10:12:29	2019-07-02 10:12:29	1	Não Conformidade 3
63	propend	2019-07-03 14:49:35	2019-07-03 14:49:35	1	propend
64	1	2019-07-03 15:06:16	2019-07-03 15:06:16	1	1
65	2	2019-07-03 15:20:00	2019-07-03 15:20:00	1	2
66	e	2019-07-03 16:03:48	2019-07-03 16:03:48	1	e
67	3	2019-07-03 16:04:06	2019-07-03 16:04:06	1	3
68	44	2019-07-03 16:17:32	2019-07-03 16:17:32	1	44
\.


--
-- Data for Name: naosconformidades_itens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.naosconformidades_itens (id_naoconformidades, id, id_fichas, created_at, updated_at, id_acaocorretivaitens, id_funcionarios, observacoes, "statusC", "statusNC", prazo, id_fichas_temperatura) FROM stdin;
62	66583	\N	2019-08-05 15:44:02	2019-08-05 15:44:02	158	39	\N	0	1	168:00:00	148
68	66584	\N	2019-08-05 15:44:55	2019-08-05 15:44:55	173	39	\N	0	1	22:22:00	152
59	66585	\N	2019-08-05 15:45:08	2019-08-05 15:45:08	143	39	\N	0	1	12:30:00	153
59	66588	48396	2019-08-05 17:26:54	2019-08-05 17:26:54	143	39	\N	0	1	12:30:00	\N
62	66586	48394	2019-08-05 17:13:33	2019-08-05 17:29:47	159	39	\N	1	0	08:59:00	\N
62	66587	48395	2019-08-05 17:13:33	2019-08-05 17:30:12	159	39	\N	1	0	08:59:00	\N
\.


--
-- Data for Name: nc_itens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nc_itens (id_itens, id_ncitens, created_at, updated_at, id) FROM stdin;
131	59	2019-06-26 17:25:17	2019-06-26 17:25:17	461
132	59	2019-07-01 15:10:56	2019-07-01 15:10:56	462
132	60	2019-07-01 15:10:56	2019-07-01 15:10:56	463
132	61	2019-07-01 15:10:56	2019-07-01 15:10:56	464
133	62	2019-07-02 14:01:24	2019-07-02 14:01:24	465
133	61	2019-07-02 14:01:24	2019-07-02 14:01:24	466
133	60	2019-07-02 14:01:24	2019-07-02 14:01:24	467
133	59	2019-07-02 14:01:24	2019-07-02 14:01:24	468
134	62	2019-07-02 14:01:53	2019-07-02 14:01:53	469
134	61	2019-07-02 14:01:53	2019-07-02 14:01:53	470
134	60	2019-07-02 14:01:53	2019-07-02 14:01:53	471
134	59	2019-07-02 14:01:53	2019-07-02 14:01:53	472
\.


--
-- Data for Name: nc_itens_temps; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.nc_itens_temps (id, id_itens_temperatura, id_ncitens, created_at, updated_at) FROM stdin;
88	138	59	2019-07-01 17:28:37	2019-07-01 17:28:37
89	138	60	2019-07-01 17:28:37	2019-07-01 17:28:37
90	138	61	2019-07-01 17:28:37	2019-07-01 17:28:37
91	139	62	2019-07-02 14:01:44	2019-07-02 14:01:44
92	139	61	2019-07-02 14:01:44	2019-07-02 14:01:44
93	139	60	2019-07-02 14:01:44	2019-07-02 14:01:44
94	139	59	2019-07-02 14:01:44	2019-07-02 14:01:44
95	140	68	2019-07-03 16:17:51	2019-07-03 16:17:51
\.


--
-- Data for Name: oauth_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.oauth_access_tokens (id, user_id, client_id, name, scopes, revoked, created_at, updated_at, expires_at) FROM stdin;
259c85cdda6a484b4362230d4be1a2c6714d97b95f485f28787546b03bf208c009d787cea82ea014	2	1	MyApp	[]	f	2018-08-27 19:31:06	2018-08-27 19:31:06	2019-08-27 19:31:06
ad78feb7e0071791d5c1948293d867f8d85597873c3f9c0b52f41b187099bf02edf33f66d5a5d6c2	2	1	MyApp	[]	f	2018-08-27 19:33:01	2018-08-27 19:33:01	2019-08-27 19:33:01
18d588c8e23e49cb507c9efab515c0fa07527255b854bc84e23d08668f548cc73f9dc1cae1fe1807	2	1	MyApp	[]	f	2018-08-28 20:03:35	2018-08-28 20:03:35	2019-08-28 20:03:35
6afc5b05fa231560dbada40d467bc2bd8f8fc6cf394c2efdfa30b405290d938cb8d4e41706494760	3	1	MyApp	[]	f	2018-08-28 20:10:39	2018-08-28 20:10:39	2019-08-28 20:10:39
79c47414f315ad314fac08146a2b909c616082bc2fe3e5b8421197bd2c17901ef677c2d04e5dc369	3	1	MyApp	[]	f	2018-08-28 20:16:19	2018-08-28 20:16:19	2019-08-28 20:16:19
4a1f1089e1ad12f189a2d25fe2c81abd118b92e760bf5526441c291386503b770f1080a6e86c2d9e	3	1	MyApp	[]	f	2018-08-28 20:17:04	2018-08-28 20:17:04	2019-08-28 20:17:04
86764fd3619238a05eaa9c1f90746fa28a5bfd8fbd2856967284e689ec83798bc681d050bd6572da	3	1	MyApp	[]	f	2018-08-28 20:17:30	2018-08-28 20:17:30	2019-08-28 20:17:30
ca6f42122fb2c631a6239784f58dad63960153176a3c7b41ff57049821441a042dd621ff31e982db	5	1	MyApp	[]	f	2018-08-28 20:26:34	2018-08-28 20:26:34	2019-08-28 20:26:34
96af6a36f569d9ed76be1eb9667df0a469e367fe406f18494c374f849ffe0102e1073999da8845bf	5	1	MyApp	[]	f	2018-08-28 20:26:44	2018-08-28 20:26:44	2019-08-28 20:26:44
d9aaade0511f3046ab8d6a5eedbb3cb7460b04feea321c3d7de97d1d599ae86abff204207a355773	6	1	MyApp	[]	f	2018-08-29 17:05:44	2018-08-29 17:05:44	2019-08-29 17:05:44
5e68c32a8e10902a3e35b419cb72c2f4781e3a5cd4a5ce93a6542a1d3137f47771cad60fe63f9943	7	1	MyApp	[]	f	2018-08-29 17:14:04	2018-08-29 17:14:04	2019-08-29 17:14:04
f4612cd8652a8e3c370db2778c52511fab848750aef94c748a84aea232979b4553c71358904e234d	8	1	MyApp	[]	f	2018-08-29 17:41:46	2018-08-29 17:41:46	2019-08-29 17:41:46
72d198e9c074bbaa1a7ecba8bc82b543304aeab536e2147e89f082f9ae068fa8018c81c68de26e2c	9	1	MyApp	[]	f	2018-08-29 17:42:42	2018-08-29 17:42:42	2019-08-29 17:42:42
70237cb17b3b3533d8d686be9b7bf3feed6c9c6292721e2b13f351cd1adbb90e493f9cc4a74103b9	10	1	MyApp	[]	f	2018-08-29 17:48:18	2018-08-29 17:48:18	2019-08-29 17:48:18
b77dc125bed79930e7f685cc2509ba5b13b00f81a9512d2d56f6f5afc7a1bcbcaa54b01570b64946	11	1	MyApp	[]	f	2018-08-29 17:48:51	2018-08-29 17:48:51	2019-08-29 17:48:51
b637a2fe197cb93869389a266a046531bf9e728274e0fb0944b1786501306feade3fd24109006298	12	1	MyApp	[]	f	2018-08-29 17:51:05	2018-08-29 17:51:05	2019-08-29 17:51:05
999977c06a2c392e66f11e4594e745ce694ca1343994c92d47bd29b0944fa3921252ef1367c1c0cd	14	1	MyApp	[]	f	2018-08-29 14:54:05	2018-08-29 14:54:05	2019-08-29 14:54:05
fcb565e32b7e38b53beacb92c1a3735f34ceab6b7280259069fcc340593002901dc8ae41d59d9380	14	1	MyApp	[]	f	2018-08-29 14:57:49	2018-08-29 14:57:49	2019-08-29 14:57:49
918d2d89d3fd0baa3a2687d841feb314eb7c708147bf0b5be51424b2b4b67fea0bed663c7c1d7504	14	1	MyApp	[]	f	2018-08-29 14:58:32	2018-08-29 14:58:32	2019-08-29 14:58:32
19e8bcf7a73ccf417b5f5a4139dcbe2935b7586ae34afca0988c29e27b27ad1db3989b62ecf26acc	14	1	MyApp	[]	f	2018-08-29 15:24:11	2018-08-29 15:24:11	2019-08-29 15:24:11
fb10c5c81484a0fd6ba4bb609e68fbb09dfd8109655ffbc0d7b397cc6b51c3900dbd10b0355654c3	14	1	MyApp	[]	f	2018-08-29 15:26:46	2018-08-29 15:26:46	2019-08-29 15:26:46
ce64462277502b848591aa405b7afd2b9811c0615610a65a7de48d8cb517fef9a3f88a184bd152ff	15	1	MyApp	[]	f	2018-09-04 15:08:19	2018-09-04 15:08:19	2019-09-04 15:08:19
b62f6e351740d2c2c5cca229f91b667db4980014b7ecc574842b554f8245ff85c207c8ec77f651c6	15	1	MyApp	[]	f	2018-09-04 15:52:13	2018-09-04 15:52:13	2019-09-04 15:52:13
48b24e1a2267962d486394e700199d5e92e01ec41b96c499988c641d13fd752f435a34c658ea96c2	15	1	MyApp	[]	f	2018-09-04 15:52:26	2018-09-04 15:52:26	2019-09-04 15:52:26
94344571a468c9c3b64f0673f08f3eecb55bb92d16b21185fb427ee08ea9737014c9b5e2441d39b9	15	1	MyApp	[]	f	2018-09-04 15:53:18	2018-09-04 15:53:18	2019-09-04 15:53:18
065a3f1d26fcfe81ae7471ee5cbfbcc5c764ee98745b613259b1da7695ce85fefed325073d866663	15	1	MyApp	[]	f	2018-09-04 15:57:47	2018-09-04 15:57:47	2019-09-04 15:57:47
172034558f8e9675cea334e554c85428fc505b3fe221c07ebf924a1d4cca57d66f72489b64a20db2	15	1	MyApp	[]	f	2018-09-04 15:58:50	2018-09-04 15:58:50	2019-09-04 15:58:50
55a8b11f59a5ed9496bc784ca277643f516a2629973b7364f8528ed04b86d1552a398bf3297dcf91	15	1	MyApp	[]	f	2018-09-04 15:59:27	2018-09-04 15:59:27	2019-09-04 15:59:27
a68290ebe6c0a43f9c822fee00bac7080fd48fe3129d8086c1434b33e1469234b127f28a7ae69bce	15	1	MyApp	[]	f	2018-09-05 14:20:28	2018-09-05 14:20:28	2019-09-05 14:20:28
8950cc7972d1fdfc2c5dfe3e36304928eb1215d97b40a3580ca692bb5ea4414355777c85c3a8bd4b	15	1	MyApp	[]	f	2018-09-05 14:23:14	2018-09-05 14:23:14	2019-09-05 14:23:14
12d4bf709a570eebec05df42086ada72e5481d680f86bda6fc38ec39297a6236f569073b9ee44067	15	1	MyApp	[]	f	2018-09-05 14:23:23	2018-09-05 14:23:23	2019-09-05 14:23:23
faad8aa3613dbb2bf0a12e0e3179a18d7aaf84c1684b9c0362a5489cf9800fc918c5716ae91b5169	15	1	MyApp	[]	f	2018-09-05 14:23:25	2018-09-05 14:23:25	2019-09-05 14:23:25
2443e43364f6137d59620b4af36cc3120ebe3d3e0268aed73fb08c3dec8d206a0f7ef0b80ee79f4e	15	1	MyApp	[]	f	2018-09-05 14:23:32	2018-09-05 14:23:32	2019-09-05 14:23:32
48baa6ba7a2d4ef2f83e4e4a89b02512d8df79863c2e92c6aa4e941eb0797fdc184190f25e2ac44d	15	1	MyApp	[]	f	2018-09-05 14:23:33	2018-09-05 14:23:33	2019-09-05 14:23:33
1ac540016ff29258429694cbed421b0590a82f69e61aecc0ef44c6043aa353f6ad9ac9e90d834f7e	15	1	MyApp	[]	f	2018-09-05 14:23:35	2018-09-05 14:23:35	2019-09-05 14:23:35
67893c4d38a592233270137013d868b24b6c84ba57cc4155945698d3f62dfde7fd3be70ac6e3f118	15	1	MyApp	[]	f	2018-09-05 14:23:35	2018-09-05 14:23:35	2019-09-05 14:23:35
5fbc240cd0f20b863a383551d6fee14b4e6d9cbc2b911a353cf50a5891326cae51794c3e28552acb	15	1	MyApp	[]	f	2018-09-05 14:41:45	2018-09-05 14:41:45	2019-09-05 14:41:45
0274f456a841df0da3c985fed8ccd70f606de89b782cd781547ee3af3f10841b0097c62f53f0ffc7	15	1	MyApp	[]	f	2018-09-05 15:27:11	2018-09-05 15:27:11	2019-09-05 15:27:11
41bc8ada2f195b4bedfc413c5670b817e4bda2bffe60f82e279769c1f8dac8c901b80c2a04587497	16	1	MyApp	[]	f	2018-09-05 16:38:27	2018-09-05 16:38:27	2019-09-05 16:38:27
0dacf62d6a06bed03ed508398eee1704767d66c9a9f818676a748f782e291b60943b87e2b4962ccb	17	1	MyApp	[]	f	2018-09-05 16:39:46	2018-09-05 16:39:46	2019-09-05 16:39:46
e757f1bd931f74fe494639fa91be6b6c4fdd8956a87da1369b9cb46df381ef6a2021334ff519c0a3	18	1	MyApp	[]	f	2018-09-05 16:39:55	2018-09-05 16:39:55	2019-09-05 16:39:55
c9637114b1874cbd32e600e786f1ea866c400c07cdc4be9199d05ddd4a3e85f5a7af2686c781489c	19	1	MyApp	[]	f	2018-09-05 16:40:00	2018-09-05 16:40:00	2019-09-05 16:40:00
8d90b444bd8c4939b5a060ff293baf1f9322c6ce35b1cf4c75e4205e24732ee583030f988722dd71	20	1	MyApp	[]	f	2018-09-05 16:40:02	2018-09-05 16:40:02	2019-09-05 16:40:02
55bbf95356dd1d2e48658851e5a6e86fc2ea8f928a90278c9e780a8b51a4674d0db52fb45672db70	21	1	MyApp	[]	f	2018-09-05 16:40:05	2018-09-05 16:40:05	2019-09-05 16:40:05
5cd70067fe4ddb621c5992eb12c29b739138f666b89312d2a42cd64d4c52dd190bd8c741d07a1712	16	1	MyApp	[]	f	2018-09-05 20:25:01	2018-09-05 20:25:01	2019-09-05 20:25:01
05f5cf57adfa18bd7bb5b9846cc43968c7c03174c77e53cacc177dfe204277e99c2917fe0c7edb49	16	1	MyApp	[]	f	2018-09-06 10:16:50	2018-09-06 10:16:50	2019-09-06 10:16:50
3748e42baf3b22deff26d1bc9b8c106736d70ea3eeaf0e13e317cf9e0aa990966b60c0b9019ba0b7	22	1	MyApp	[]	f	2018-09-11 17:24:28	2018-09-11 17:24:28	2019-09-11 17:24:28
a4eb3fc981b6fd18ef47ef24e8679f18c5e6a3b8c4f246dfb675d6e12acc3ab830a83e28e19a8f74	22	1	MyApp	[]	f	2018-09-11 17:24:52	2018-09-11 17:24:52	2019-09-11 17:24:52
f3675fd1a769b1d5cc1a3be14c96caba6b385e6cc6ee2678cb075921448dbe70fd97c4556d9446f6	22	1	MyApp	[]	f	2018-09-13 16:38:36	2018-09-13 16:38:36	2019-09-13 16:38:36
442e0d9697f6f74338a463ecdee0cdaaa6de73c5ddd52a731cf206f2fb07d6964bf9c201e06c34e8	22	1	MyApp	[]	f	2018-09-14 14:51:59	2018-09-14 14:51:59	2019-09-14 14:51:59
f18964e82ab890b491071c75850d8f670e0b943439a209fb002795d75be10ecd65f9674cae4a4962	23	1	MyApp	[]	f	2018-09-14 16:07:09	2018-09-14 16:07:09	2019-09-14 16:07:09
b43415f37689049dbf29f168f2eb509fc56d3f479dd34bd79ebfdf9eb04f9904111da139958dec9d	22	1	MyApp	[]	f	2018-09-14 17:09:24	2018-09-14 17:09:24	2019-09-14 17:09:24
48e3307cb9bd1810309a52649c680c22e34ce7d284e8e4b36927d1f89eb351bfd70fdd98a0a21814	22	1	MyApp	[]	f	2018-09-14 17:12:39	2018-09-14 17:12:39	2019-09-14 17:12:39
88a53e4c8472eb475af490f3da8936e7efb3ada057d006f5c93228ffc251b30cfe1f7ada85ddf4d0	22	1	MyApp	[]	f	2018-09-14 17:14:14	2018-09-14 17:14:14	2019-09-14 17:14:14
c40ef9b4abe66e15c05ec23a6d8aef623b519ff69735e999e12a7394300bb56cba9278c7473ea680	22	1	MyApp	[]	f	2018-09-14 17:16:47	2018-09-14 17:16:47	2019-09-14 17:16:47
3d9a7a46b996de0e55b9baf3f4f3920c4b2b06ed4991fb8e951fbe8520a8b46554886f6b17fd9853	22	1	MyApp	[]	f	2018-09-14 17:17:36	2018-09-14 17:17:36	2019-09-14 17:17:36
e2d6ed7bb886638f653eddcc77aea0cdf37a3006249405edfdac483c077d0d79c038e7f8d9f0532e	22	1	MyApp	[]	f	2018-09-14 17:18:18	2018-09-14 17:18:18	2019-09-14 17:18:18
b68e5b8d8c24e73d28e07ec0280562faf9cef003676b39fc88b0a4691a8afe460ae2fea4fe095a69	22	1	MyApp	[]	f	2018-09-14 17:21:07	2018-09-14 17:21:07	2019-09-14 17:21:07
09863766b2f2252ff48ab641644fb97afc2903eea820c0f0151b710b864ca631e48f87db101c64e2	22	1	MyApp	[]	f	2018-09-14 17:25:19	2018-09-14 17:25:19	2019-09-14 17:25:19
0e83711a8e8288eeede32ca8bae6587f8b0d734237ed5c226b8210c337b7e530712cc53149a6a3c1	22	1	MyApp	[]	f	2018-09-14 17:26:31	2018-09-14 17:26:31	2019-09-14 17:26:31
2b896bb5e14957436fcb80f0de2a293abedc31ffd030ad197982baf7d517ce46afa4fcfb5bb6e7b9	22	1	MyApp	[]	f	2018-09-14 17:27:36	2018-09-14 17:27:36	2019-09-14 17:27:36
1de72cc55798431b59d03e576aa0d01d004855e6bf21ec6c9e03ff43f2983ba6efa1aa5d0f4314f9	22	1	MyApp	[]	f	2018-09-14 17:30:45	2018-09-14 17:30:45	2019-09-14 17:30:45
c57d97cf8c2d502e38e8006b74a595706b8781774c136e653d02a9b302923ace8fb4e34d03949b16	22	1	MyApp	[]	f	2018-09-14 17:32:02	2018-09-14 17:32:02	2019-09-14 17:32:02
cc0f85e292ef0ad83cf8d7a3b75227e56b57e3ca9628d97dfceb95a47b93471e0e52c2968c9db070	22	1	MyApp	[]	f	2018-09-14 17:32:51	2018-09-14 17:32:51	2019-09-14 17:32:51
f1844401ca15e1322291b317cc4dff7618348de2050074fc63f684bcd4cbc399538338df6e1b7998	22	1	MyApp	[]	f	2018-09-14 17:33:43	2018-09-14 17:33:43	2019-09-14 17:33:43
7fc959112bf63e45ece0978fcb601d9f43a47998d36d333dd2755cf1c1fa3599ad11a99961d62d19	22	1	MyApp	[]	f	2018-09-14 17:35:00	2018-09-14 17:35:00	2019-09-14 17:35:00
e6b333199edb0acffa3b0ec90f438d0ac0e5567bcad93de7e27f850d3fdb9a84dba42133bf2ea9df	22	1	MyApp	[]	f	2018-09-14 17:38:20	2018-09-14 17:38:20	2019-09-14 17:38:20
ade998fdd34efc3d5e243676649b87e92bd71a0d92087aac006de26aea8dd7a997a4d8f5c73fc339	22	1	MyApp	[]	f	2018-09-14 17:38:22	2018-09-14 17:38:22	2019-09-14 17:38:22
2838f5b28b8587eeb3034d9984f6f4c608b6a64a9734aabb680ed85bdb0fa07793d8f27757af6c29	22	1	MyApp	[]	f	2018-09-14 17:39:15	2018-09-14 17:39:15	2019-09-14 17:39:15
2676d4d33c35b6839a325b05c13881311327768bb63d7d158452c07622f91ffd387d4d915091c0f4	22	1	MyApp	[]	f	2018-09-14 17:41:04	2018-09-14 17:41:04	2019-09-14 17:41:04
b3d9b648445ee5f6f9d887b924b5157b02e708cf3804b044c9bb029fbd57550b8e46f7c6291eb5ce	22	1	MyApp	[]	f	2018-09-14 17:41:58	2018-09-14 17:41:58	2019-09-14 17:41:58
d0a5e80263e4a312c44de0d13891e2f5670c8d6c505038e8c0c8b9b888931de2fa1b698a43dd3102	22	1	MyApp	[]	f	2018-09-14 17:42:56	2018-09-14 17:42:56	2019-09-14 17:42:56
eaa6ca08a46e85d2d3dc478419f44620e1565dd9a01c0f60457282d19925f7e7dd343bd0d9c75683	22	1	MyApp	[]	f	2018-09-14 17:42:59	2018-09-14 17:42:59	2019-09-14 17:42:59
b6573d6dd558b9c54314d7c62e096f6feb12b201bb0e779a862d9e839d859aa885b5baaa192577f0	22	1	MyApp	[]	f	2018-09-14 17:43:46	2018-09-14 17:43:46	2019-09-14 17:43:46
3fae0c227239898274306ab5e191b4043fcf52fdceaf4cb34311bf65958565cc947b42aa4c0c8acc	22	1	MyApp	[]	f	2018-09-14 17:46:14	2018-09-14 17:46:14	2019-09-14 17:46:14
051d6e15c47bde2694f553d0f8b6857959d8c601461318f07e89dc77e835b803e9751b24500370a9	22	1	MyApp	[]	f	2018-09-14 17:47:28	2018-09-14 17:47:28	2019-09-14 17:47:28
daa5dec0f302dca02b6b7ef89f1bd0d6191febb7de56f63e37781f805fd2d7f5a0747a0cd28a5b21	22	1	MyApp	[]	f	2018-09-14 17:47:56	2018-09-14 17:47:56	2019-09-14 17:47:56
1533e54da5ff161bb48c13cf34f9151b221b5c364aeb7ca2b8d486b96df35995686bea961ca78a39	22	1	MyApp	[]	f	2018-09-14 17:51:40	2018-09-14 17:51:40	2019-09-14 17:51:40
b6db7b7742ce5d89eeae00e6c384771e20f0c9b2e7fb8023fde56bc4427de9f5cc16d85ac2e0363b	22	1	MyApp	[]	f	2018-09-14 17:52:20	2018-09-14 17:52:20	2019-09-14 17:52:20
88341bfde57c0ab915851ef695bae65cc60a40f882e0d1e663d541bef04ff76134cbb1170eea033b	22	1	MyApp	[]	f	2018-09-14 17:54:24	2018-09-14 17:54:24	2019-09-14 17:54:24
5c0ba4a48a2190c073487becdb1ec0f849c88f51cc3e3795a127b811026398aaf4ffefb06c5d694d	22	1	MyApp	[]	f	2018-09-14 17:55:06	2018-09-14 17:55:06	2019-09-14 17:55:06
c474127c3997dee83110c64cc1fce06fca0140c5d80c67d569263ab9fbc56e6c679c0b1476b5a46f	22	1	MyApp	[]	f	2018-09-14 17:56:10	2018-09-14 17:56:10	2019-09-14 17:56:10
3f5490d04448a5d997134abd4c05ee07b026644476c98321bad28800344e925418d47c64ea68d8e7	16	1	MyApp	[]	f	2018-09-14 20:32:16	2018-09-14 20:32:16	2019-09-14 20:32:16
a2e500478c0cca8dfdeba42c2b9f473397b9c4d03faa96e9eacc95ff70400cdb9423d6dc474f19e0	16	1	MyApp	[]	f	2018-09-17 16:03:49	2018-09-17 16:03:49	2019-09-17 16:03:49
ce0711ddba07525d9e30f681caa058a0ce332309da9eb2c2bde140232ade734d0a5c2ede87359a2a	22	1	MyApp	[]	f	2018-09-17 16:26:09	2018-09-17 16:26:09	2019-09-17 16:26:09
a61c82b82b8aa84337f4b5e8e3302e1993b3d5ebccb13b2203057bef9efc9b65f2b3bbeaefb07fea	26	1	MyApp	[]	f	2018-09-17 16:30:41	2018-09-17 16:30:41	2019-09-17 16:30:41
7b56fc3b9674e750789161ade9742845e222fa095193ef39d165942a431018ef0e05bd699689b6d8	27	1	MyApp	[]	f	2018-09-17 16:31:57	2018-09-17 16:31:57	2019-09-17 16:31:57
26c9e45ebcfce005f3e228d2c1b80f2cb557cdd5829804920c7464d47185e018209e7baaefd02970	22	1	MyApp	[]	f	2018-09-17 16:37:37	2018-09-17 16:37:37	2019-09-17 16:37:37
4e5bc833b8a5a977b53ca7d463a73e2465a01f8b60ae9a210dc8e328377092d766a0efc6fb1f0ff7	22	1	MyApp	[]	f	2018-09-17 16:48:18	2018-09-17 16:48:18	2019-09-17 16:48:18
d204447896ce05e15810d18d44fa81bd32e1607d960fcae1c9084601104190fa86242c40f9322f19	22	1	MyApp	[]	f	2018-09-17 16:50:07	2018-09-17 16:50:07	2019-09-17 16:50:07
eb4329ef2f0c0d908646ffa59c8bd2efa150587f95073c8dc7cd0cc917c66acc23c53c4fdc0e7660	22	1	MyApp	[]	f	2018-09-17 16:56:05	2018-09-17 16:56:05	2019-09-17 16:56:05
8e41adc79b27507314293f277c8d552af3e3510063cec65f75ef3d99291cc837df79cd76f6664ef7	22	1	MyApp	[]	f	2018-09-17 16:57:18	2018-09-17 16:57:18	2019-09-17 16:57:18
8bc9f241a7f6ce22cc182fee7e3794cd06b87f88a700c2fbeb94ba02899a0595b9c355df7a17ba04	22	1	MyApp	[]	f	2018-09-17 16:59:02	2018-09-17 16:59:02	2019-09-17 16:59:02
1d2ef6021c349081d6dbf11512a45d651f597627d120727fde7b0577f2bc9ff18e6afb4d79b23d9a	22	1	MyApp	[]	f	2018-09-17 17:00:27	2018-09-17 17:00:27	2019-09-17 17:00:27
8a80e11d168f40090e25689a335124e2357df20eab99a4e1be6d2c11402494bf171fbb2b9a770774	28	1	MyApp	[]	f	2018-09-17 17:25:42	2018-09-17 17:25:42	2019-09-17 17:25:42
01bd2ae0e2d6c073a2bcb2df63c12c8eb62a7f51b4d2c68b281a794d61202f663fc4934c7a0e99b6	22	1	MyApp	[]	f	2018-09-17 17:33:19	2018-09-17 17:33:19	2019-09-17 17:33:19
251ae11992f06728db111116362b31bf945a9ff71557cf53d64b9f249f30b6638a7e353005c4a676	22	1	MyApp	[]	f	2018-09-17 17:36:40	2018-09-17 17:36:40	2019-09-17 17:36:40
acd5932e7ceb4c501fdceecebd4d87e51764e224974c03959ec85e5ada59cd170bb7a31450953347	33	1	MyApp	[]	f	2018-09-17 18:24:34	2018-09-17 18:24:34	2019-09-17 18:24:34
55820e4443ae50ce2a186956b7f578e3161b1956466033a8ce0109ee1b535b6a69b868d6156f8090	22	1	MyApp	[]	f	2018-09-18 13:49:17	2018-09-18 13:49:17	2019-09-18 13:49:17
c11f29e212189af9d39817a29a6a1e963e1866db35bde82151ab006c7fd713f02649be04a3f5abef	22	1	MyApp	[]	f	2018-09-18 13:51:27	2018-09-18 13:51:27	2019-09-18 13:51:27
6ded3c20d7b8fa9e4523d7a934434c9e8fd935e082f35f563dbd9b67fd30ba3ad887d95dfee92165	22	1	MyApp	[]	f	2018-09-18 13:53:07	2018-09-18 13:53:07	2019-09-18 13:53:07
d31bed89a78c4bae9adcc5cd44ba983c2d95bac025957d2e73732b102978fb2504feb984e4d66dc8	22	1	MyApp	[]	f	2018-09-18 14:05:50	2018-09-18 14:05:50	2019-09-18 14:05:50
85094e753beabba664e3977a0fce575e78e4df15acaf5745f10f6acd03d627a84552bd5cc06319ad	22	1	MyApp	[]	f	2018-09-18 14:07:52	2018-09-18 14:07:52	2019-09-18 14:07:52
b9c2ae427ab71eb6cc5fb9e57964558e5dba5b5caf7284f7d72348389e70142f6bc3215c1105dcc3	22	1	MyApp	[]	f	2018-09-18 14:09:48	2018-09-18 14:09:48	2019-09-18 14:09:48
a0ceea152d700ae1c8a3dc125e9a607964a6e9b7174bae55f720c5e754a9275a33bce392db126571	22	1	MyApp	[]	f	2018-09-18 15:06:37	2018-09-18 15:06:37	2019-09-18 15:06:37
cabebf9e9bef9aa3fa7828c3deee239df2d10e68a6aef71abe06c688e91291280844e591965808b0	22	1	MyApp	[]	f	2018-09-18 15:06:37	2018-09-18 15:06:37	2019-09-18 15:06:37
acb614fe982422d3dbab9477672383f6bae3d5156db14a9745b02cebcacab2168375adb74c3b8d12	22	1	MyApp	[]	f	2018-09-18 15:11:34	2018-09-18 15:11:34	2019-09-18 15:11:34
5d0b4d0b650b64fee4fba2660913f3cbf42aea348bad53b3f3965bb6ddf74e99cea4dbdc603a502a	22	1	MyApp	[]	f	2018-09-18 15:11:34	2018-09-18 15:11:34	2019-09-18 15:11:34
cf161271c9812c28e3f4f7e2b25b24a9171082b55a39ae92b15e76cba9b6d495cd21d6ecf3a5208d	22	1	MyApp	[]	f	2018-09-18 15:14:02	2018-09-18 15:14:02	2019-09-18 15:14:02
688b88dc2b96a2c0905932ce78994614bfb4c8b4f4e47e0ffef1fc3509b4a453c0cb84c1ca797b32	22	1	MyApp	[]	f	2018-09-18 15:14:02	2018-09-18 15:14:02	2019-09-18 15:14:02
9eb42220b7cea318ae2971d72cce46d2ea1cc704fdeb0942bbb93fb4731273c8ae78994b68851adf	16	1	MyApp	[]	f	2018-09-18 15:16:10	2018-09-18 15:16:10	2019-09-18 15:16:10
b1d64059ed49c24c267bd7ad29bed4783c0ec5df78b5f7904d71314aae52906a53ac445c1e5cdff1	22	1	MyApp	[]	f	2018-09-18 15:32:11	2018-09-18 15:32:11	2019-09-18 15:32:11
77605fc5e77d13bc94646d97996d5b77160a703756fcf9adcdd22fc20f909cf6f45c62f6f5a69174	22	1	MyApp	[]	f	2018-09-18 15:32:11	2018-09-18 15:32:11	2019-09-18 15:32:11
e7e190948ef01bf7c4be435123e7ded2fc61b8447d81f80e8d13cbf687999b9576fa47b792633755	16	1	MyApp	[]	f	2018-09-18 16:07:42	2018-09-18 16:07:42	2019-09-18 16:07:42
98ac3607d558b26fb9dbae192f08f1d3459cdfcc98d94f57c2d50656d4724afe25466594015a8902	16	1	MyApp	[]	f	2018-09-18 16:07:42	2018-09-18 16:07:42	2019-09-18 16:07:42
9788098242813a6ac584af51c64c0094e57e14c8d983209ab4a4b4feed7140844760fadccdfa5aa7	22	1	MyApp	[]	f	2018-09-18 16:09:55	2018-09-18 16:09:55	2019-09-18 16:09:55
c6da79853e2215b5a6c48dd50bc4dc882af8731b5b2e24fd5b04d1ff37ebabbc636b7c36569eaf47	22	1	MyApp	[]	f	2018-09-18 16:09:55	2018-09-18 16:09:55	2019-09-18 16:09:55
445166519fe4117590cb8d59e186529e4efdbe6559b7ff7eeb46d65effaffce0486a9ff991da0359	22	1	MyApp	[]	f	2018-09-18 16:11:06	2018-09-18 16:11:06	2019-09-18 16:11:06
e17e050ca5445645bd08facef6b6caeadcd30a6735bc1fdd992de529b00aa94915a8cd56c1a1bf53	22	1	MyApp	[]	f	2018-09-18 16:11:06	2018-09-18 16:11:06	2019-09-18 16:11:06
58591ecf7434b29771f319e4c98c54812096ae1898e904105125abd5897da4e50c04a309c3333849	16	1	MyApp	[]	f	2018-09-18 16:12:31	2018-09-18 16:12:31	2019-09-18 16:12:31
87dc60442bebccb600c32e69ee46fc3061b7b332b36923202e71f71ed4d5961a0228b5a05d6bec50	16	1	MyApp	[]	f	2018-09-18 16:12:31	2018-09-18 16:12:31	2019-09-18 16:12:31
d77e6874776c625d172161a476c269f7b7258ce37711719b291df5056401f5cc3e83023765a968b1	16	1	MyApp	[]	f	2018-09-18 16:12:38	2018-09-18 16:12:38	2019-09-18 16:12:38
ebac33f0198794ba75763b29eefdc14480cd99399c7b207cfca44b7b22fbaa43569d887286ff9835	16	1	MyApp	[]	f	2018-09-18 16:12:38	2018-09-18 16:12:38	2019-09-18 16:12:38
604a6bdc3f825ac13ae35b3b8e190d35aa56722385b30bfca6a3409731f822ce67f96563a35666b4	16	1	MyApp	[]	f	2018-09-18 16:12:44	2018-09-18 16:12:44	2019-09-18 16:12:44
8ecb1a79ed11caade5ffb09f1702d715e531e73a9f57c45dd2cf82d7b0829278bdf33d0197b6762c	16	1	MyApp	[]	f	2018-09-18 16:12:44	2018-09-18 16:12:44	2019-09-18 16:12:44
9b4d421dd1cc11a1a057bf432b05718dcd5b9817bc1ad257e6d182deb1cb4c5ff06801de84616461	16	1	MyApp	[]	f	2018-09-18 16:12:56	2018-09-18 16:12:56	2019-09-18 16:12:56
9640e054e17b1e5fb1e6abb6c58e58fab28bdf7ae6f789bd3723d3cc6bbd8861c6494e2abc14ceb8	16	1	MyApp	[]	f	2018-09-18 16:12:56	2018-09-18 16:12:56	2019-09-18 16:12:56
b15ab51124b35eba489fc8682c2b606ecbaeb86f092c6a2f6365fadcc1ccf208d6dc4c242fd15732	22	1	MyApp	[]	f	2018-09-18 16:13:16	2018-09-18 16:13:16	2019-09-18 16:13:16
6bb72b9a5bba1e7b5d2cce06404a97767e75fe5bff87046a36414dbb68612e7fceeddd9ea302e005	22	1	MyApp	[]	f	2018-09-18 16:13:16	2018-09-18 16:13:16	2019-09-18 16:13:16
1587bfe4f801a90ad3fd3fef0871236cd53a4fd3bb36e3c1c23ebf8977ab600d590b6aa8dbd2926a	16	1	MyApp	[]	f	2018-09-18 16:14:56	2018-09-18 16:14:56	2019-09-18 16:14:56
5563be752aef73067dedc48ad47f03aa9e079ec6770d628bded8bdd03d094ab3e7fc17396651e952	16	1	MyApp	[]	f	2018-09-18 16:14:56	2018-09-18 16:14:56	2019-09-18 16:14:56
069f432414700b957c7ba74d0b8912aafe993a2e75604b117a155040c8340783f6495579927472c6	16	1	MyApp	[]	f	2018-09-18 16:29:50	2018-09-18 16:29:50	2019-09-18 16:29:50
ee7597d8c882224076f4deaded5e6ad4c6f79f7849965c82fa31c0876f512de8c0758bf20293fdca	16	1	MyApp	[]	f	2018-09-18 16:29:50	2018-09-18 16:29:50	2019-09-18 16:29:50
7c4850af64665c336e2f13108426d1a0d22f85856b99f8aba22e4ce71bc42816681187b62fd292bc	16	1	MyApp	[]	f	2018-09-18 16:29:59	2018-09-18 16:29:59	2019-09-18 16:29:59
c869aa7543a9fc052dff5d7aa768f963356dab377e1683617f956ff6566f45abcc4aae4efc8af217	16	1	MyApp	[]	f	2018-09-18 16:29:59	2018-09-18 16:29:59	2019-09-18 16:29:59
951c245d62331ed63ae34c39e680068bd3d7e29af1f59fa65e0e46bd457f5303c219cc9125b08146	22	1	MyApp	[]	f	2018-09-18 16:30:12	2018-09-18 16:30:12	2019-09-18 16:30:12
47466567e849c5ee1a05b1b4e1976e94ed42cd9fdf0cce686f44f7d46d25fba2f6ddecf29252c9d9	22	1	MyApp	[]	f	2018-09-18 16:30:12	2018-09-18 16:30:12	2019-09-18 16:30:12
e594138bd40416e02301eb48e179060e0cbed02c0aafeba77cc85cbca95156c75a3c5a2411f8e2ba	22	1	MyApp	[]	f	2018-09-18 16:31:02	2018-09-18 16:31:02	2019-09-18 16:31:02
0aa42b4f8d7938200211cde0e783d0da817e06c0a3e3740bf5a2e3c98334c4be9a4aae3ccd7d6bdd	22	1	MyApp	[]	f	2018-09-18 16:31:02	2018-09-18 16:31:02	2019-09-18 16:31:02
179f86e263ed873e55aaf4f51410b2d49f7c60c20eff38025f2a43cbbe9b549cda157a9904d6f919	22	1	MyApp	[]	f	2018-09-18 16:31:44	2018-09-18 16:31:44	2019-09-18 16:31:44
2edf2c313cd174ba41d99e22ccf28d64dd8a6a37e2e187f71a0af6478eae4b48cc9c2c6b66e501e4	22	1	MyApp	[]	f	2018-09-18 16:31:44	2018-09-18 16:31:44	2019-09-18 16:31:44
f065f4ad6571689a75f3f27d796b9804ee7a8c39d8d4dadca1e1bcd8a92220c71dd6afa48f04d77f	22	1	MyApp	[]	f	2018-09-18 16:34:32	2018-09-18 16:34:32	2019-09-18 16:34:32
8501391cd7245b6d656e2f05af3ea0351bebfcecefd07c894c3e641d27e000d7a3c0ab7606fdb6a1	22	1	MyApp	[]	f	2018-09-18 16:34:32	2018-09-18 16:34:32	2019-09-18 16:34:32
9a7aa8615460b6b65b7ac42bab7a63cd912e25587d207f6f218955ae8fd437f50ecfcdaeb63c20c9	22	1	MyApp	[]	f	2018-09-18 16:35:19	2018-09-18 16:35:19	2019-09-18 16:35:19
f88f3e34f84bc40addca9f77ee5eddaed3b39027680e554d5f2711391a62f76f5fdfc9e732335d5f	22	1	MyApp	[]	f	2018-09-18 16:35:19	2018-09-18 16:35:19	2019-09-18 16:35:19
514cb58d21796d4869158544a4034ddd5855efd963bec56245acc1a1ef165baf840b4df37ea9c6a9	16	1	MyApp	[]	f	2018-09-19 14:25:21	2018-09-19 14:25:21	2019-09-19 14:25:21
adb729de30b489d95a44f24deb4354f5ce6aeab9c11b436e66e811240c9578ea9584b958ea951458	22	1	MyApp	[]	f	2018-09-19 14:36:21	2018-09-19 14:36:21	2019-09-19 14:36:21
b308e0c303c8b8eda6e3cf1fd7ec7c8d49e4245decb490e9bbf561453055a4f5da15146dde3b2c4b	22	1	MyApp	[]	f	2018-09-19 14:36:21	2018-09-19 14:36:21	2019-09-19 14:36:21
b7a8344fd52929110608bc7f6a104ba004659ab420425de400607e820b8025260daf69bf1327f98d	22	1	MyApp	[]	f	2018-09-19 14:53:11	2018-09-19 14:53:11	2019-09-19 14:53:11
f7ca136e12fe84dcdf28d7d4303649ea69962ce397f305c9572f79512cd679c47c617e28b8259a90	22	1	MyApp	[]	f	2018-09-19 14:53:11	2018-09-19 14:53:11	2019-09-19 14:53:11
bd75042c25171ea4f98a62b8245f4eba11f9d699be3b35582d292fa16e9d8cbbf1a1a6e30e23d706	22	1	MyApp	[]	f	2018-09-19 15:15:50	2018-09-19 15:15:50	2019-09-19 15:15:50
c2172fb1f9420b3c399edaf3f0f903376a18f0553751c2a595b86222d639af4df1ce8ccbda7c88ba	22	1	MyApp	[]	f	2018-09-19 15:15:50	2018-09-19 15:15:50	2019-09-19 15:15:50
912c7b11e885a66620782d3329056a1d5acd4f7ee652a27a9ae34273f48ee016e7cdf812c7469199	22	1	MyApp	[]	f	2018-09-19 15:20:58	2018-09-19 15:20:58	2019-09-19 15:20:58
e5207d4474bf96f1137bd24c3a24d17a2c62353f496712fb1fd73f749183bdc2e460b1dd71a49464	22	1	MyApp	[]	f	2018-09-19 15:26:43	2018-09-19 15:26:43	2019-09-19 15:26:43
05e3c3948577d293e458c0bccf55cdaa8f4dc4535655a6b8b97f7ea30051aeeb1563208dd3f6c369	22	1	MyApp	[]	f	2018-09-19 15:26:43	2018-09-19 15:26:43	2019-09-19 15:26:43
1515606c174ac77ae4bd9ad013b2215b75abe4c3fa957b8b57d1c68ab15d909185d52baea866a416	22	1	MyApp	[]	f	2018-09-19 15:28:18	2018-09-19 15:28:18	2019-09-19 15:28:18
c8286dc776432033c96235e912f3b75c1ac818c4f88f9b4485f3f42bf37e713f0718999d64f28739	22	1	MyApp	[]	f	2018-09-19 15:28:18	2018-09-19 15:28:18	2019-09-19 15:28:18
476a7459f473e4296a815c55f96712d488b3ab901c43ad6f1cd61a04f769c3538d70b12d6cdadfd3	22	1	MyApp	[]	f	2018-09-19 15:33:05	2018-09-19 15:33:05	2019-09-19 15:33:05
e9fb4be8eb28d8fd34e2d57d29ed4cd77d83d745063b3d910e56679f1d828de7dce00570ed77398a	22	1	MyApp	[]	f	2018-09-19 15:33:05	2018-09-19 15:33:05	2019-09-19 15:33:05
81b57c4154c292f3fccec48f9189b6347592e4cea089f231b32b1c3ccc8a217a3c661c24ae021b50	22	1	MyApp	[]	f	2018-09-19 15:49:09	2018-09-19 15:49:09	2019-09-19 15:49:09
07e2964a1c38c923b6df0975428466dd508ba044eb573bb6c656f1a8e1d0fac8353b27756ad3828b	22	1	MyApp	[]	f	2018-09-19 15:49:09	2018-09-19 15:49:09	2019-09-19 15:49:09
c58276fa70e6edfd28f22834ad94602727f6a3c4862284b4ac50dbde2c0b5fdc9826e54a749250fe	22	1	MyApp	[]	f	2018-09-19 15:57:24	2018-09-19 15:57:24	2019-09-19 15:57:24
38fdb723cce1afd564d3cb58ca59ac1f5226edb209297b0771f063981f32ff27f3078883832f025c	22	1	MyApp	[]	f	2018-09-19 15:57:24	2018-09-19 15:57:24	2019-09-19 15:57:24
803a28ab2a07df3779297fe920519aae40fd32c4209225d9ea9e3056355076b54bd617bbf9c12d30	22	1	MyApp	[]	f	2018-09-19 16:03:40	2018-09-19 16:03:40	2019-09-19 16:03:40
13c3ede42758971e9c2cefc146ccb37f4f03eb01024b10072eff23ced68ae488f5504622a79a1df5	22	1	MyApp	[]	f	2018-09-19 16:03:40	2018-09-19 16:03:40	2019-09-19 16:03:40
214bcf9262e94c147e98b9d6863890153d3c885559a062775e336b84778f8e6be0e6ce44b444e358	22	1	MyApp	[]	f	2018-09-19 16:06:33	2018-09-19 16:06:33	2019-09-19 16:06:33
a98d468128a6b275a2bc98e3df4750691ae80f2515be6a6f76df48150dd7d76be0e3607cd2d8ac91	22	1	MyApp	[]	f	2018-09-19 16:06:33	2018-09-19 16:06:33	2019-09-19 16:06:33
d527a69e0c87e0c66c72d9ac75861e2dcdb45d5344a2eb92f5f9939473a3ffd7541f5b205339127f	22	1	MyApp	[]	f	2018-09-19 18:27:47	2018-09-19 18:27:47	2019-09-19 18:27:47
e0ce8ee49c5289eb4a55393e173d178e38f7cda84f7a0427789b6dc125e696964fb48e0f20e218d6	22	1	MyApp	[]	f	2018-09-19 18:27:47	2018-09-19 18:27:47	2019-09-19 18:27:47
2fc057f5f7aa39fc7736f5c0d5bebba63d89ee475aaf2d37afb8eaa13713bdbbbd857dd9cdadc3a9	22	1	MyApp	[]	f	2018-09-19 18:28:20	2018-09-19 18:28:20	2019-09-19 18:28:20
51b1684d449de2c26ff72448519e7168250da9edc87edba36c36e56beee335b6b03ee5845128abdc	22	1	MyApp	[]	f	2018-09-19 18:28:20	2018-09-19 18:28:20	2019-09-19 18:28:20
dbbc50712075b8b85286a391e01caeb8d9392fbe236e1483936d5a7af136f6a7121df3859d3c609b	22	1	MyApp	[]	f	2018-09-20 13:44:25	2018-09-20 13:44:25	2019-09-20 13:44:25
57944a897a481db6497cf3d596dab895b14022f6556788ce40849c86eb1a5307b01d01f901e96b43	22	1	MyApp	[]	f	2018-09-20 13:44:25	2018-09-20 13:44:25	2019-09-20 13:44:25
d6d30cd817ceba45e24b59ace42e92c94943ec1e0ebddbd002449edbe6018560bd7572a7273ad8d1	16	1	MyApp	[]	f	2018-09-20 13:52:26	2018-09-20 13:52:26	2019-09-20 13:52:26
09e3092afb18ff3a40fb71eaf3a84635b3c24ba3c23daef007f1607bc5d0be5f084b02f7754dad1d	22	1	MyApp	[]	f	2018-09-20 15:28:56	2018-09-20 15:28:56	2019-09-20 15:28:56
5667741a5a6c6d6810a2d6e3aa221162fa55d6f7d3fa92d635bf4639baad06b5509437a493cdc212	22	1	MyApp	[]	f	2018-09-20 15:28:56	2018-09-20 15:28:56	2019-09-20 15:28:56
ff9d89bb4205ce32d455030442f043e46dca82a3313b1582cedf3c02ef84e8cbb4a850d4d6561842	22	1	MyApp	[]	f	2018-09-20 17:55:42	2018-09-20 17:55:42	2019-09-20 17:55:42
390e0c226ad9e2ff25e9ec8a3d2ec164485a86f598501fc89d88de215061fce139cb870924daf30d	22	1	MyApp	[]	f	2018-09-20 17:55:42	2018-09-20 17:55:42	2019-09-20 17:55:42
0cfd13f50c7454b4be93b33b7fc0494f1a6f3527e6deff637400baa7839aa7591594857a47438a7f	22	1	MyApp	[]	f	2018-09-20 17:57:20	2018-09-20 17:57:20	2019-09-20 17:57:20
1476f8bad183bfd5fa00330f42fd761d9e2bc3bcb91f1abc01e3beae3226f3b1211e2bc900426e79	22	1	MyApp	[]	f	2018-09-20 17:57:20	2018-09-20 17:57:20	2019-09-20 17:57:20
41e601593dce316e1ac11ff0125540b39f5d1379a1d4421f147cd55d3f51e5972c891d3464a89d14	22	1	MyApp	[]	f	2018-09-20 18:30:50	2018-09-20 18:30:50	2019-09-20 18:30:50
245c0f84583fae399bf4f4819967cb398a62f26f0bc1381167a4e27ff772ab50d25f9c1f06850e83	22	1	MyApp	[]	f	2018-09-20 18:30:50	2018-09-20 18:30:50	2019-09-20 18:30:50
453ba361fcd8479b41c5d03ec16d49e98b1e3cbde2cb7000b30d46505b02038a365803e6e22264d3	16	1	MyApp	[]	f	2018-09-21 10:56:26	2018-09-21 10:56:26	2019-09-21 10:56:26
1e21344083886ce00a484a57f80100d0ab0a44c3c2e9452716370841ebe9315ae96c13e6eb729ab9	22	1	MyApp	[]	f	2018-09-21 11:19:34	2018-09-21 11:19:34	2019-09-21 11:19:34
0b058f842fe5fbd97181e5a1eaf01a4689dbc1d6e4392b3a2077953a806471bf3edd614d7aac0fc0	22	1	MyApp	[]	f	2018-09-21 11:19:34	2018-09-21 11:19:34	2019-09-21 11:19:34
562ff2a1e39dd15602a346e1666d5b98f4c64e0abcb1ecfba39ac3a90a59fd0f192b63ede5e8ac9b	22	1	MyApp	[]	f	2018-09-21 13:50:28	2018-09-21 13:50:28	2019-09-21 13:50:28
94df1a36b4c029b08d46c5b0dbe462199ced0a1ee4aab8bf54e6b4c77eaca4bce4b262597beaceb5	22	1	MyApp	[]	f	2018-09-21 14:12:58	2018-09-21 14:12:58	2019-09-21 14:12:58
259315fc03cad3e08c86f024e152ddef8c534016804bf0a7db744296999bf9b757871bf10204cd77	22	1	MyApp	[]	f	2018-09-21 14:12:58	2018-09-21 14:12:58	2019-09-21 14:12:58
6bc85acff8b357aa8766e803b7b9214fd155ce5e659b07c8f287c66c690118b9f40bc962c8cc5f8b	22	1	MyApp	[]	f	2018-09-21 14:50:30	2018-09-21 14:50:30	2019-09-21 14:50:30
0aaa3065f57d5f4744812ef3e5fb58ca74137725905a8e9267c9c33df8614a89fda9c44b03ebcc82	22	1	MyApp	[]	f	2018-09-21 14:50:30	2018-09-21 14:50:30	2019-09-21 14:50:30
c3eb729fc152782b888c4b27d9da01e23053555351b4b7fe9ade0c3c005744a9de7e83ffdd5dd0b3	22	1	MyApp	[]	f	2018-09-21 14:50:56	2018-09-21 14:50:56	2019-09-21 14:50:56
49eb6281321f5d673f32a372378226a7c9fdbeb7c250a0d6905cf14c91e65671f247ddf7240f0499	22	1	MyApp	[]	f	2018-09-21 14:50:56	2018-09-21 14:50:56	2019-09-21 14:50:56
9b826e24960d3495657839470784276327642a801d1f57512c40708fd428dfd6836722c28f7eb5ad	22	1	MyApp	[]	f	2018-09-21 15:01:33	2018-09-21 15:01:33	2019-09-21 15:01:33
3a41d0ec912586115d9528e0c95eb99f83cb5a97950f7de36374d992ed634b4ebb4c60bcd96f52b3	22	1	MyApp	[]	f	2018-09-21 15:01:33	2018-09-21 15:01:33	2019-09-21 15:01:33
75d97bfdf94cafb5b4287f80c4fa44e5e6aa03bae43b25f1963556cd4c31fa3c18e3d924dc1085e1	22	1	MyApp	[]	f	2018-09-21 15:06:37	2018-09-21 15:06:37	2019-09-21 15:06:37
01bbaaa20ebd74eff2e9a3a22e00bc2fa9c8dcb6332effbdf04cbc993a4cd203262d09558dc4c6f0	22	1	MyApp	[]	f	2018-09-21 15:06:37	2018-09-21 15:06:37	2019-09-21 15:06:37
f9a1ab3f8f7f5ac631cf85919309fb0b9b3a8f1288d9e8faec95e9dce6503af87ee01f88c7ed2eff	22	1	MyApp	[]	f	2018-09-21 15:59:34	2018-09-21 15:59:34	2019-09-21 15:59:34
ce141c83f6c3a46ce14f3555692450630d781a33fee6eea74bc892ebcf90ee5f2b6376de74b05e6a	22	1	MyApp	[]	f	2018-09-21 15:59:34	2018-09-21 15:59:34	2019-09-21 15:59:34
f7dc98d314d763490be075d30399894e62e22af843726590a2c2b4100f9e8c048beba86a5951aaef	22	1	MyApp	[]	f	2018-09-21 15:59:59	2018-09-21 15:59:59	2019-09-21 15:59:59
36cec8fc85296cb14ea2f05f84f1ec6685ff260c6fa1cfd43782c9a5ea68aed181fc646efdd9638f	22	1	MyApp	[]	f	2018-09-21 15:59:59	2018-09-21 15:59:59	2019-09-21 15:59:59
ea5ec7fa4d5eacbe3ce4bda779df7d8400891288759d2ca03f330b63773be51420ed2c043829be97	22	1	MyApp	[]	f	2018-09-21 16:00:53	2018-09-21 16:00:53	2019-09-21 16:00:53
a4d879bd01c2ec7a8c2c3b036f397ea234b3e6cd562cca396ae8894c6195f1a5bf1c97d76616b2b7	22	1	MyApp	[]	f	2018-09-21 16:00:53	2018-09-21 16:00:53	2019-09-21 16:00:53
14a4eb81fc20a7d94087afda0a96b0db4860725f1063a4f3c11db6ece7b8311a4d5ead17e85b2e3e	22	1	MyApp	[]	f	2018-09-21 16:01:24	2018-09-21 16:01:24	2019-09-21 16:01:24
0760bf0b8a00196bb869d2d1cf9bcd4d67b85f6b599abda32d5e8cf4e40ad754b623561577532e2a	22	1	MyApp	[]	f	2018-09-21 16:01:24	2018-09-21 16:01:24	2019-09-21 16:01:24
1d6b9fa110357816efe73da07c1d8950eb107df39345af5250b736fa32f711115f098a5581346b64	16	1	MyApp	[]	f	2018-09-21 16:02:00	2018-09-21 16:02:00	2019-09-21 16:02:00
b4a610c98bf5ab414efe69191c4b4e1329e9ef4e027bbd8a8e50f0860bea3d4573d2f7cfb37b7567	16	1	MyApp	[]	f	2018-09-21 16:02:00	2018-09-21 16:02:00	2019-09-21 16:02:00
3c77bad9372caca2267474ebd662ed26f2302d18d87d2f9f6a6151d2e4d5d83686e45da9356dbb87	22	1	MyApp	[]	f	2018-09-21 16:02:47	2018-09-21 16:02:47	2019-09-21 16:02:47
dbacafd72f1b91e4326eadbe076f7f4517aa98c0cb662e0d783a6a76c9fb933ba52de350c8480b44	22	1	MyApp	[]	f	2018-09-21 16:02:47	2018-09-21 16:02:47	2019-09-21 16:02:47
5bebcb3d4dc438a6c929edcccd1f1fe9a681f4648eb2c4a307eadb08df86e7b44388b4bb1a699df2	22	1	MyApp	[]	f	2018-09-21 16:04:43	2018-09-21 16:04:43	2019-09-21 16:04:43
f61241bd8555b631bcd9cab165e62944b6f2c3a4fa81841f756d65f4aa4e6fbc281154566cd6feba	22	1	MyApp	[]	f	2018-09-21 16:04:43	2018-09-21 16:04:43	2019-09-21 16:04:43
cd7824e00928ff8f8f88cbf038685a9de6e928152d1d9eca00200065908657190e21536220b8ccf8	22	1	MyApp	[]	f	2018-09-21 16:06:56	2018-09-21 16:06:56	2019-09-21 16:06:56
b7f6f0a21e626cbe2bbbf16060624d2ef9b019792b348e2eff21dddf41add6a6c47b9769a8cd2eeb	22	1	MyApp	[]	f	2018-09-21 16:06:56	2018-09-21 16:06:56	2019-09-21 16:06:56
d85eaa2f25755a2d00f68063112452d25148e6c668f2f61d56c12a64e9649382bc28db40e557bce3	22	1	MyApp	[]	f	2018-09-21 16:09:03	2018-09-21 16:09:03	2019-09-21 16:09:03
ca67e980d6aa5274cd55c0bf18e81214437417cde2963b3f7c37eb352c6865eec67b240ebf90a0c7	22	1	MyApp	[]	f	2018-09-21 16:09:03	2018-09-21 16:09:03	2019-09-21 16:09:03
cde2fe2da10175994dd92f69d033efd9b6a3fd0ce175883f2bce447148fdf97cadbd62e14ebd6eee	22	1	MyApp	[]	f	2018-09-21 16:09:31	2018-09-21 16:09:31	2019-09-21 16:09:31
e223f310ae40473101b35c4ea70b39dbca6319ebe12a09d8b0d9759db54709733c0990846eba77ee	22	1	MyApp	[]	f	2018-09-21 16:09:31	2018-09-21 16:09:31	2019-09-21 16:09:31
8b29f414ad4a2982cf6f2bc061c421984e8424b3ae2797fce05a3696a4b68b0c02d62fec0c1a7fa8	22	1	MyApp	[]	f	2018-09-21 16:10:13	2018-09-21 16:10:13	2019-09-21 16:10:13
6521e269cea6a269267dc18c8ae33821851fa33a40bd8f16591fce82b0ceb963aa16241a4843bae2	22	1	MyApp	[]	f	2018-09-21 16:10:13	2018-09-21 16:10:13	2019-09-21 16:10:13
38ff46baf447837b3eac8d9ec07458c547e1b0ddf5709583f1aeb91c1269af47a680e64d8f53403f	22	1	MyApp	[]	f	2018-09-21 16:10:47	2018-09-21 16:10:47	2019-09-21 16:10:47
dcf8525de9d32fe6a7fbf85fb495ca971c65f7cc298547f4115d44d1d5e62268d8930938aec2b10b	22	1	MyApp	[]	f	2018-09-21 16:10:47	2018-09-21 16:10:47	2019-09-21 16:10:47
fdec3ffdd563d999b11001a3a68cd285ea9af47122981e893a1c190e1db3a4e76d74ce7833befd66	22	1	MyApp	[]	f	2018-09-21 16:11:29	2018-09-21 16:11:29	2019-09-21 16:11:29
282420bd0d4c73ec1290617e3a7a61b87e594b156b03492a4a16f93008701e0003dd0ef7e1b22705	22	1	MyApp	[]	f	2018-09-21 16:11:29	2018-09-21 16:11:29	2019-09-21 16:11:29
958b5d321d319eaa06566845b8e98cfe8ca68cff7249d7f97228c3f5aa37ca144914f100c2f8ff4c	22	1	MyApp	[]	f	2018-09-21 16:11:38	2018-09-21 16:11:38	2019-09-21 16:11:38
7e9bdfa02098df7af4b4806eedd59d095f9c892eb9b21873c0badb1d424a6732b6ee77646755bad1	22	1	MyApp	[]	f	2018-09-21 16:11:38	2018-09-21 16:11:38	2019-09-21 16:11:38
6ef49bcd6bc79d45c71882ae7cca5ba5ee83f0f977c92d6e527827658940248971ac06f550b63876	22	1	MyApp	[]	f	2018-09-21 16:11:53	2018-09-21 16:11:53	2019-09-21 16:11:53
697adf45d8d1f082aeef5b28c2f5fd588bbf305e288f57ac8c1969d74233ea60298bdf8c7e2c99a1	22	1	MyApp	[]	f	2018-09-21 16:11:53	2018-09-21 16:11:53	2019-09-21 16:11:53
28affc2c089520b20f080ac02088cd6a9ccafee31d8193892ed4e207a480f7e3e27391799ec36b69	22	1	MyApp	[]	f	2018-09-21 16:12:01	2018-09-21 16:12:01	2019-09-21 16:12:01
ffbf1fa146a670a4e964cd5824781497702f4f644a6862d1ec592dfa0b2380e0bde2a3e57a2c30e1	22	1	MyApp	[]	f	2018-09-21 16:12:01	2018-09-21 16:12:01	2019-09-21 16:12:01
a45791fea11a5a152cb4750d6f3241e0712177ce8e28cacdf6ad0860f487e1f8d2200fc99ac49d18	22	1	MyApp	[]	f	2018-09-21 16:12:14	2018-09-21 16:12:14	2019-09-21 16:12:14
cdeb8f58da948c6b4c1b9e92544d6fe4fc5d8a692d503190115b2795d8067f9f39140110b91023e4	22	1	MyApp	[]	f	2018-09-21 16:12:14	2018-09-21 16:12:14	2019-09-21 16:12:14
7f5ce576cfbcbbff9300e654ad0a3d563cf65472ba682b4357d09381f9610285526c7dccf97ae4f3	22	1	MyApp	[]	f	2018-09-21 16:12:25	2018-09-21 16:12:25	2019-09-21 16:12:25
f7432105b2bbcb92ef4837e60f71b28ef395e6f9fb8ba28c7c5099d411e756ba5836d0501c72a706	22	1	MyApp	[]	f	2018-09-21 16:12:25	2018-09-21 16:12:25	2019-09-21 16:12:25
ae025d6254e3832135f6982be6d182a3d2d70b72579cc1876169d7d94dddd56a309931e13d1cc26a	22	1	MyApp	[]	f	2018-09-21 16:12:31	2018-09-21 16:12:31	2019-09-21 16:12:31
ecca2667574b28d37bf894e1619029b0a71fdd0490266e98094d75edaf577abfe9fa6786e49966ee	22	1	MyApp	[]	f	2018-09-21 16:12:31	2018-09-21 16:12:31	2019-09-21 16:12:31
af60a6be03beabf18fc7dc0d650590cd22e7fed9da0027352e0ee27f73a6ff5ecf5c7656264d1ede	22	1	MyApp	[]	f	2018-09-21 16:12:56	2018-09-21 16:12:56	2019-09-21 16:12:56
5eab8d82efb162b13c0696433847d40b3ffb785fc3c8600851b7938880e02713037dcdef384b2741	22	1	MyApp	[]	f	2018-09-21 16:12:56	2018-09-21 16:12:56	2019-09-21 16:12:56
a6d7846e2dd022af586b5fbda0d53d67e8b04cf44d3b499fe2d4d5c62c07a51d10c130499e23b6ce	22	1	MyApp	[]	f	2018-09-21 16:19:17	2018-09-21 16:19:17	2019-09-21 16:19:17
4dec1f76c739abf4bbec37bc76e46b3404b2fa3d903958236a534e4a872e506c12e4ca0f4890d68e	22	1	MyApp	[]	f	2018-09-21 16:19:17	2018-09-21 16:19:17	2019-09-21 16:19:17
9262f014f584fd1790f25f681ed8a5abf67442521858e888e5b73a78567f007efdec461249feee71	22	1	MyApp	[]	f	2018-09-21 16:21:34	2018-09-21 16:21:34	2019-09-21 16:21:34
3050ee99ff7206e31014957aceef1d9794618b7d156ec75400959e1d266ca68bf7679445d0c7effd	22	1	MyApp	[]	f	2018-09-21 16:21:34	2018-09-21 16:21:34	2019-09-21 16:21:34
29d0baf77d95577e124e2ce7fa4891eae107a4a94da1394b0cf57df342121196ed2297da6a2590db	22	1	MyApp	[]	f	2018-09-21 16:26:33	2018-09-21 16:26:33	2019-09-21 16:26:33
e048f963e07742f8c08b8f3ee0a33a04d104d6a7550268305b047e3bad2e5f921968fc0fb4b3d4df	22	1	MyApp	[]	f	2018-09-21 16:26:33	2018-09-21 16:26:33	2019-09-21 16:26:33
51acbddc4a3f56aee539fc6bef4e28bdd4de40f15edaa4c00ea5fb86ede5e2dfd24b4014ca675c61	22	1	MyApp	[]	f	2018-09-21 16:31:55	2018-09-21 16:31:55	2019-09-21 16:31:55
11577cf5feef2222e0e165d56240cffeefd39970446dbda20c8c30a4a2e30dea3f19259316b57721	22	1	MyApp	[]	f	2018-09-21 16:31:55	2018-09-21 16:31:55	2019-09-21 16:31:55
4932d4a64009dec5f54d845b9343ee725336bf232507d9e3e66531f33cb7b15119a0a5da3f5cdc0e	22	1	MyApp	[]	f	2018-09-21 16:35:17	2018-09-21 16:35:17	2019-09-21 16:35:17
76b1a7f469e304b3d5fa98fd72084136613d0714046d9715549264df6891776e999f73f87b138800	22	1	MyApp	[]	f	2018-09-21 16:35:17	2018-09-21 16:35:17	2019-09-21 16:35:17
73e6528d6ab73faf134df0e87886a2cc4df64cf3330cc290e863749e12949186e6e04056e3b1869e	22	1	MyApp	[]	f	2018-09-21 21:06:10	2018-09-21 21:06:10	2019-09-21 21:06:10
164d6aa0bf1f8d5025272ab0dc97cc3f2268df82db0fbd8ea0b0757dfc622fdc8f96e9b0434e36fb	22	1	MyApp	[]	f	2018-09-21 21:06:10	2018-09-21 21:06:10	2019-09-21 21:06:10
947bb3ddc9f3698c1b8b811a325ea81434f26a8ee1624004362c617787f18b45785920eb8588237a	22	1	MyApp	[]	f	2018-09-24 15:25:53	2018-09-24 15:25:53	2019-09-24 15:25:53
f066c55407d5dab63a4fe1c1ba9e20e8f6483cde404915fabb268e854a837f1fd7bef846b68c6e09	22	1	MyApp	[]	f	2018-09-24 15:25:53	2018-09-24 15:25:53	2019-09-24 15:25:53
487f24cb328a08e4a019d97f60de70d1aaefc30ccf27fff3cd4b5b03ff96e8ed215723dd50571c48	22	1	MyApp	[]	f	2018-09-24 16:29:42	2018-09-24 16:29:42	2019-09-24 16:29:42
12c8975f86ba9e2daad476b6d7cefaefd70a1b0a376620532450844b8103672e31f00c1b783c1d2f	22	1	MyApp	[]	f	2018-09-24 16:29:42	2018-09-24 16:29:42	2019-09-24 16:29:42
bb51a6fb3dba21aa0facc9d1ae8d6083c7ef865fc891cddda98ded3c157c233cbb58567e60759aa9	22	1	MyApp	[]	f	2018-09-26 15:07:17	2018-09-26 15:07:17	2019-09-26 15:07:17
51e03417f99bc9f4864c610efa55333eb4af507feefb63cc6df90f61c94b63579ae587a8c65c094f	22	1	MyApp	[]	f	2018-09-26 15:07:17	2018-09-26 15:07:17	2019-09-26 15:07:17
78e208245060ece7f3428cb85e60db4a8d18be4385753f49410e799c986744e03db2d1f9bfffcddb	22	1	MyApp	[]	f	2018-09-28 14:27:53	2018-09-28 14:27:53	2019-09-28 14:27:53
53623dfb87c53766a23b299af2469a8ff7a4a60ee3241e142938b8234c0d393b822d5c11bf86e12c	22	1	MyApp	[]	f	2018-09-28 14:27:53	2018-09-28 14:27:53	2019-09-28 14:27:53
f2d91738104724bba1027b8e93478fed6eda92359dad15e3b7e31ef89026b3adeb966dcd4f881ed9	22	1	MyApp	[]	f	2018-09-28 14:55:21	2018-09-28 14:55:21	2019-09-28 14:55:21
a26bd95f9bde7e1d06200017212f496a3ae00de43c86356dcd101bbd037dbaa4c012bfce8ea8c92b	22	1	MyApp	[]	f	2018-09-28 14:55:21	2018-09-28 14:55:21	2019-09-28 14:55:21
6bc2f7ff8f8225369ac7e493ae5718b425799e8967bd932b7b8ea7dc142d51970abf882645276d5f	22	1	MyApp	[]	f	2018-09-28 15:51:44	2018-09-28 15:51:44	2019-09-28 15:51:44
90230d82d2e041fc563b4d47bf323c459079b2fd0f65d7edda3bce518e8719cb8ec50c647ecccaeb	22	1	MyApp	[]	f	2018-09-28 15:51:44	2018-09-28 15:51:44	2019-09-28 15:51:44
38563d2ec160735b43cf49c3372a32284c378ea63cc6c9e41d9ade4d8a79692d4766a6e6a863887e	16	1	MyApp	[]	f	2018-09-28 17:53:35	2018-09-28 17:53:35	2019-09-28 17:53:35
7b18ca1b3d671aa0c68c323a68b47b116283a2713f5b0b549d2169132fcc145cb19d382ac2751eb0	22	1	MyApp	[]	f	2018-10-01 13:50:53	2018-10-01 13:50:53	2019-10-01 13:50:53
bee6c33794a9a61123ce50b46e73762eafd774241cb6f9685dc15e919dd23c3cabb25e3456f38be6	22	1	MyApp	[]	f	2018-10-01 13:50:53	2018-10-01 13:50:53	2019-10-01 13:50:53
6b42aa3c397b03d3230b6806012d4b2789bc75075363fde94e679057974bb50e3650cd5f3f6bd25e	22	1	MyApp	[]	f	2018-10-01 14:24:59	2018-10-01 14:24:59	2019-10-01 14:24:59
45a5aa2d884d5797fe4a6878e63c5df60f7d8ad6712cdec07d8186c59aa65ceb824dd4fe495cded1	22	1	MyApp	[]	f	2018-10-01 14:29:35	2018-10-01 14:29:35	2019-10-01 14:29:35
8c4cf973d8dedce28e3efce091f6ae6ef19d557e66f36f934f6ed1361b01e6b5e63ae02e7d45e202	22	1	MyApp	[]	f	2018-10-01 14:29:35	2018-10-01 14:29:35	2019-10-01 14:29:35
e333d511f70ed723d1899df8a18c57882c26533167c521c734fff142504683c827d19b1bfa4b28c4	36	1	MyApp	[]	f	2018-10-01 14:44:36	2018-10-01 14:44:36	2019-10-01 14:44:36
44fd06b122af2552a7fc17a7d09d1c449ab2e17e93fa04d97ac56266707d9cc9a736edcc661bd067	36	1	MyApp	[]	f	2018-10-01 14:45:19	2018-10-01 14:45:19	2019-10-01 14:45:19
1d1920377819cc9be7691b7204cb964df73a41babe022aa3b0b3129ccf95b954c726c0fa4ac4735b	36	1	MyApp	[]	f	2018-10-01 14:45:19	2018-10-01 14:45:19	2019-10-01 14:45:19
3e71c22ef4c6309cbf6aea86270fe8bdce0131f24c6875697417123e05381455d6631f768862b37d	36	1	MyApp	[]	f	2018-10-01 14:47:13	2018-10-01 14:47:13	2019-10-01 14:47:13
15edde5ce0083d9499d9db119f356962dec0e7404d584f254c47d07eb7af1cd45df7852137ddf594	36	1	MyApp	[]	f	2018-10-01 14:47:13	2018-10-01 14:47:13	2019-10-01 14:47:13
f639071766a49e33997cc5dc73349be89e612017198c78115b7e080496feaab8002586a12c9a37c6	36	1	MyApp	[]	f	2018-10-01 14:52:18	2018-10-01 14:52:18	2019-10-01 14:52:18
d412b8ecc3c196a3c8fecf32b10bfa9202f0a9868992ab4eac5caf9a00f73f8b66f6f77599601806	36	1	MyApp	[]	f	2018-10-01 14:52:18	2018-10-01 14:52:18	2019-10-01 14:52:18
96ff2c6463c3e39baadcef48fcd93b6727bf77d697aa3f14fdce642971f7176b3b22e669eb9fd471	22	1	MyApp	[]	f	2018-10-01 14:55:31	2018-10-01 14:55:31	2019-10-01 14:55:31
38185b05b1b9fdc76e096a480018d01c830e94a43e0e5c4efb79c23026946cf11e6bcd5f895d3137	22	1	MyApp	[]	f	2018-10-01 14:55:31	2018-10-01 14:55:31	2019-10-01 14:55:31
aa5c4283c031e6b20b69e22513bfe13c34822edbb1c972aea04923ebd6d138ac26cb0488677714ec	36	1	MyApp	[]	f	2018-10-01 15:01:06	2018-10-01 15:01:06	2019-10-01 15:01:06
71996da61781764f142df1f809d81d9728690e7f1f535d44cea367a8c3dfdc1ec0ae5f29c06b82b4	36	1	MyApp	[]	f	2018-10-01 15:01:06	2018-10-01 15:01:06	2019-10-01 15:01:06
69765799e9d57712acd0dbf1db6d32154478b66f1897fc685b87a6050c9e8af9a6259987af442dc4	36	1	MyApp	[]	f	2018-10-01 15:10:06	2018-10-01 15:10:06	2019-10-01 15:10:06
e7a6650e7b27d2338cadae030a0ff6ac0cd58ae1650efa0fb867ac12ec4818c2ebd969f3a3f3095b	36	1	MyApp	[]	f	2018-10-01 15:10:06	2018-10-01 15:10:06	2019-10-01 15:10:06
c3c075902b939fff218b3a6921aa6a4cbd6a66015e5c41f426b3a19b03525f6eff5bcde87b702625	36	1	MyApp	[]	f	2018-10-01 15:13:08	2018-10-01 15:13:08	2019-10-01 15:13:08
57e25c83b85dc566160ae1a28c99f982b8b13481b40101c9615981663280aea6010a3cd726e82ab6	36	1	MyApp	[]	f	2018-10-01 15:13:08	2018-10-01 15:13:08	2019-10-01 15:13:08
9694ee4af6f62db6ca3481fdbe6d08c684699bd4fbd7a579c187bc3fb36372e224e2f7a81097c4f8	36	1	MyApp	[]	f	2018-10-01 15:17:31	2018-10-01 15:17:31	2019-10-01 15:17:31
da2e63ca7fcba4d574cf4f90e8b796e0793e5632bc6d5b987f8f96f25f6f1d9297dd114e82ac7686	36	1	MyApp	[]	f	2018-10-01 15:17:31	2018-10-01 15:17:31	2019-10-01 15:17:31
97c4788cded142ca3683171121fe00e5f53611f3b4ffa2168faf4a29495ac226a157665a432ae570	36	1	MyApp	[]	f	2018-10-01 15:18:40	2018-10-01 15:18:40	2019-10-01 15:18:40
f23b3ccf357a6fae6eb8630702ebf965db01d81c77e886e28943c7f00141942c62f71447e082a3c8	36	1	MyApp	[]	f	2018-10-01 15:22:04	2018-10-01 15:22:04	2019-10-01 15:22:04
59550b8c6ec0016bfa0ad47be9aa730b23807b4fe302580ddb71ced8008415343ac5401ba3d5e449	36	1	MyApp	[]	f	2018-10-01 15:22:23	2018-10-01 15:22:23	2019-10-01 15:22:23
896fd7d0658e6cd9b075476efff0ab2b8de0be46208063c0c20666682386159000596df820271432	36	1	MyApp	[]	f	2018-10-01 15:22:23	2018-10-01 15:22:23	2019-10-01 15:22:23
ea696b545e4d139eff931d73a35a81be37ca6018ba936c566cedcaaeb547b1fc3a791921d08f6339	36	1	MyApp	[]	f	2018-10-01 15:22:39	2018-10-01 15:22:39	2019-10-01 15:22:39
aa6d6bb932e03a3539b0cbdbfabb9e672958870685fbb31d8f40755c52b579446d00b03918c218f7	36	1	MyApp	[]	f	2018-10-01 15:22:39	2018-10-01 15:22:39	2019-10-01 15:22:39
51c885aaef5b14c7a3e2ee8d9656720de3c4a6710f8d6b5ceb597aeeb6a3868e50d24b76613ba914	36	1	MyApp	[]	f	2018-10-01 15:22:54	2018-10-01 15:22:54	2019-10-01 15:22:54
1f12326f33a6dd699c25ac3b1b070f81fc93f436b62848e18b38cca2400423734704ebfbd4bee57a	36	1	MyApp	[]	f	2018-10-01 15:22:54	2018-10-01 15:22:54	2019-10-01 15:22:54
56d43b7f07f45b77b685ad19c6ee8ca75d42013d0af25ff6f8e98b493c04743ab6865a6cf94accb4	36	1	MyApp	[]	f	2018-10-01 15:23:35	2018-10-01 15:23:35	2019-10-01 15:23:35
fd0fc42fd02bf0ed34b110679ff4dce4ec9a25a06ec38b186dd00071151d1e86261cdafcdf5047e4	36	1	MyApp	[]	f	2018-10-01 15:23:35	2018-10-01 15:23:35	2019-10-01 15:23:35
4db84edfc8c5161a67eef1b75816a04b186e41198b622fceb94e9a6b7553c3010d590542231aee8a	36	1	MyApp	[]	f	2018-10-01 15:23:53	2018-10-01 15:23:53	2019-10-01 15:23:53
30609168ce272de22ea1c89c5c505474623a55f66e1ae766fba84fb1057da420d406cc22e30aded6	36	1	MyApp	[]	f	2018-10-01 15:23:53	2018-10-01 15:23:53	2019-10-01 15:23:53
fd3c4db13e518f1b9e49b1f0e384202ed6ec73b702df0bb3c5b9c821b1152760e9e2924084788c36	36	1	MyApp	[]	f	2018-10-01 15:25:45	2018-10-01 15:25:45	2019-10-01 15:25:45
199afc04b279a63be59a40fe1023e71e50938617cff2a987cd132b588416565dc23ccc58e0cfc000	36	1	MyApp	[]	f	2018-10-01 15:25:45	2018-10-01 15:25:45	2019-10-01 15:25:45
7b1382ae41968364c0f69cdd2a1b5b7a6d2a38e9cba8317887cfe86e8d7e661f8f59f03544ab267f	36	1	MyApp	[]	f	2018-10-01 15:26:22	2018-10-01 15:26:22	2019-10-01 15:26:22
2dcb8b3c80ace2ba470b34646efdfdcc8294b3923385289ba8b7d17bf10ed4ad1d9836dc140e8344	36	1	MyApp	[]	f	2018-10-01 15:26:22	2018-10-01 15:26:22	2019-10-01 15:26:22
0fb0e440933b645c5d4208ee404ecb147e19f5c71c3426ac31f90969a7fef2ec5a9de8574ab0ab53	36	1	MyApp	[]	f	2018-10-01 15:26:39	2018-10-01 15:26:39	2019-10-01 15:26:39
1145cbea3696d5dfe62c9dc130bd06dabed39a7e4e5a94affff810e2ac205ecf93e3048169cb65dd	36	1	MyApp	[]	f	2018-10-01 15:26:39	2018-10-01 15:26:39	2019-10-01 15:26:39
db51ba4ae7862fc790384608d01f10512eb7a00a393dc792a2a7f66603191bbe83709807f6bff37c	36	1	MyApp	[]	f	2018-10-01 15:27:25	2018-10-01 15:27:25	2019-10-01 15:27:25
bbc805b77b9d77f5e310598bdf745f41ed0e4e87fdb92456c4b5ea901d7c61c7293295087b60e4b4	36	1	MyApp	[]	f	2018-10-01 15:27:25	2018-10-01 15:27:25	2019-10-01 15:27:25
95e38449260e2b3738e598afa871aefd5778e5f065233196633069a89d4108058ae6f90158758ada	36	1	MyApp	[]	f	2018-10-01 15:28:46	2018-10-01 15:28:46	2019-10-01 15:28:46
6f17b76979947da3e697b1763a54335bd97204cd1a908e0be5534bc7a3e960c1b08798a9954ca2cd	36	1	MyApp	[]	f	2018-10-01 15:28:46	2018-10-01 15:28:46	2019-10-01 15:28:46
b5ac475390b41a686c196669f008b05c055bd25b681de917e39840bd1ee61bd554e96f9e7a798a0f	36	1	MyApp	[]	f	2018-10-01 15:30:08	2018-10-01 15:30:08	2019-10-01 15:30:08
4e23ad1f7c01fc63a6cc02da8a36356cb1b3d9cdebcf71cfaa5e6ed6db95eb470371103a43b74b60	36	1	MyApp	[]	f	2018-10-01 15:30:08	2018-10-01 15:30:08	2019-10-01 15:30:08
63eebf79f032fdff946fa862f72d340c3c136a8c2e2648117e68a86c18d15a357b49a0ba7b9f9984	36	1	MyApp	[]	f	2018-10-01 15:30:08	2018-10-01 15:30:08	2019-10-01 15:30:08
701ac8b610243d3853e96323cd4c844df264b9182d65e077b91ceb80ea979ab82f6708dbe2cdfa7a	36	1	MyApp	[]	f	2018-10-01 15:30:08	2018-10-01 15:30:08	2019-10-01 15:30:08
40e5de2e8be172bc207bb1b21e692a4a6d8bc2094760054c50b0537c58672807b861fe8d44774b36	36	1	MyApp	[]	f	2018-10-01 15:32:11	2018-10-01 15:32:11	2019-10-01 15:32:11
d10836166c1f29d8435ef47c64fb9c9787f822c134249cd0fee9c4020d3432391b3d7203c4d89757	36	1	MyApp	[]	f	2018-10-01 15:32:11	2018-10-01 15:32:11	2019-10-01 15:32:11
74803d45ecd5758fb84d89196fd15906130e9e3ed1a5f674ff0e06ccf1e70499f9f05bf965e9cfed	36	1	MyApp	[]	f	2018-10-01 15:33:23	2018-10-01 15:33:23	2019-10-01 15:33:23
b902262b9a51923ae4c2962547b66f7971f4203c5af9e96d40361b13d831ff1705c0a18de7e68817	36	1	MyApp	[]	f	2018-10-01 15:33:23	2018-10-01 15:33:23	2019-10-01 15:33:23
4963424b77a52831952c4baecdb2aeaebbbb7fdcb9fa3bfc33dd0efc426437efdc48c42b3e9eb004	36	1	MyApp	[]	f	2018-10-01 15:35:05	2018-10-01 15:35:05	2019-10-01 15:35:05
19d1d4a4fd102aab4cb3cb3755fe1cf7b5ddd3b18698bd83a434d8f09fafa02308650ff7bf8be15f	36	1	MyApp	[]	f	2018-10-01 15:35:05	2018-10-01 15:35:05	2019-10-01 15:35:05
60b1109b32a9e339fb8ac48bc4f509370350ac7335973987deda58d953395afe139d45f021de447d	36	1	MyApp	[]	f	2018-10-01 15:36:21	2018-10-01 15:36:21	2019-10-01 15:36:21
f02a07c6c8ba9e590e5d8032ea50bfefb481c67631ec67c7aae6bb659651c3c90d0ed3951ed6dfe9	36	1	MyApp	[]	f	2018-10-01 15:36:21	2018-10-01 15:36:21	2019-10-01 15:36:21
518e7034284709790e80f429de239fe75d7cf70ec92e4c13603d8cf9f484cd8eee620ef007164b7c	36	1	MyApp	[]	f	2018-10-01 15:37:26	2018-10-01 15:37:26	2019-10-01 15:37:26
576b71ba2cc96f759aac6c50d3052c78bc70bf71a6f6a5c37df4aece8b4dada7ad1b4817389aa341	36	1	MyApp	[]	f	2018-10-01 15:37:26	2018-10-01 15:37:26	2019-10-01 15:37:26
7845c50202103042e22d923f283e8fd43ab94b4db8c655707db05e3e049fde1eb2307bc6374810ed	36	1	MyApp	[]	f	2018-10-01 15:38:50	2018-10-01 15:38:50	2019-10-01 15:38:50
f60fee89db695d5542b4852615fe6262edc9801c3b3925063a1d4951ca4d95133c846d7d44e991ae	36	1	MyApp	[]	f	2018-10-01 15:38:50	2018-10-01 15:38:50	2019-10-01 15:38:50
e89bb355be34f6bd3b91c35e11cb82caceca7dbccd50cbb72537036be8c010e018c0cb26db96cd45	36	1	MyApp	[]	f	2018-10-01 15:39:45	2018-10-01 15:39:45	2019-10-01 15:39:45
ea684b0b579fa2c0a7c9304dcdeec0418165405c667f0ac1af3de55b6aa5d9ea6b735d6481206a81	36	1	MyApp	[]	f	2018-10-01 15:39:45	2018-10-01 15:39:45	2019-10-01 15:39:45
728c98aab90914e9a774122ecea098da72b5e0fac03657a8e62578c3db7efd14895f9e7396eec917	36	1	MyApp	[]	f	2018-10-01 15:41:03	2018-10-01 15:41:03	2019-10-01 15:41:03
2818fd22558eb6e9df2e9ffa47b6f14f5eebc8e634becd98b6ada7d3ad4a129a7d7a51a3dd6c1dc1	36	1	MyApp	[]	f	2018-10-01 15:41:03	2018-10-01 15:41:03	2019-10-01 15:41:03
dbece514c6e16eba5cbb558c40002901769f646f1b3ac0866b44acd7d8b0478ca6055850fd8c7ab9	36	1	MyApp	[]	f	2018-10-01 15:42:21	2018-10-01 15:42:21	2019-10-01 15:42:21
644124fe88c6fe7b497e7005c74d453bf9a64e7ab22a2de728abd625227e359b9a4154aebe6ab6bb	36	1	MyApp	[]	f	2018-10-01 15:42:21	2018-10-01 15:42:21	2019-10-01 15:42:21
e4dfbb5d0488965b7c6bc42ecd34517e75e41d2457e773cc130710ef733577b3bfe350311abdca35	36	1	MyApp	[]	f	2018-10-01 15:43:52	2018-10-01 15:43:52	2019-10-01 15:43:52
4cf6f6746620792491783e3269958f743e2adf2824004bb359532f99f96c9395ba04d230876e4e92	36	1	MyApp	[]	f	2018-10-01 15:43:52	2018-10-01 15:43:52	2019-10-01 15:43:52
d8b260c99371b4c224b6cbf471d1eae57c2624f8aa81272debabbf5415978078234bf5fa63ce6b00	36	1	MyApp	[]	f	2018-10-01 15:45:52	2018-10-01 15:45:52	2019-10-01 15:45:52
2407e1570fda02c9e0b7c458ad41ccfef0674ffbc86ad1e426941460e1c0e4913f8dbd82c819e2d7	36	1	MyApp	[]	f	2018-10-01 15:45:52	2018-10-01 15:45:52	2019-10-01 15:45:52
60071e5700831de82e61a984848950578def9977d3b8b437e695413e42709bd74e01d03f947c0578	36	1	MyApp	[]	f	2018-10-01 15:51:12	2018-10-01 15:51:12	2019-10-01 15:51:12
98ce2e91a55aa289725e4fa3af553dd6b467b3b21a038b0f034f8db38c79ff928543b23fad9b98a2	36	1	MyApp	[]	f	2018-10-01 15:51:12	2018-10-01 15:51:12	2019-10-01 15:51:12
ce8e689849a4495dfa04420291bb1a3aec0b41d4073cce14274c8102f397551822e16504bf19f6be	36	1	MyApp	[]	f	2018-10-01 15:52:51	2018-10-01 15:52:51	2019-10-01 15:52:51
3db4dcffa2dd798cf16503d9a8cdbd99fdc86bb8e649735af27b7c03ac0c896d6a701f8b26723da8	36	1	MyApp	[]	f	2018-10-01 15:52:51	2018-10-01 15:52:51	2019-10-01 15:52:51
c7f71344d686e2d002b4e95de29d8ab9870611939d6ba103b1d065daedb436889c1d6227cdead07e	36	1	MyApp	[]	f	2018-10-01 15:54:00	2018-10-01 15:54:00	2019-10-01 15:54:00
d3b16d035556da4204d127e4dea9194b4fec8cb0e72720e59e016bac3bd746d0efb0359114e1ffb6	36	1	MyApp	[]	f	2018-10-01 15:54:00	2018-10-01 15:54:00	2019-10-01 15:54:00
441d4c1a1af7bb0e3a3ab2984a8642293d3a23e1784499f45ee9e598855766b237c978bc0e522c52	36	1	MyApp	[]	f	2018-10-01 15:54:52	2018-10-01 15:54:52	2019-10-01 15:54:52
54abe5e4fbfca0e1a3a42e4764b9b088c02f1b1ed857a9939a3125fcd815efff2c686d72aeb808f5	36	1	MyApp	[]	f	2018-10-01 15:54:52	2018-10-01 15:54:52	2019-10-01 15:54:52
ce3877870c3c7a6bf4304519def2bb23fe0c7217762300d5348a49a960e0f2c7615f90aaf568ab75	36	1	MyApp	[]	f	2018-10-01 15:57:52	2018-10-01 15:57:52	2019-10-01 15:57:52
d912a3d2c6dc1f512935b8d1506476276e53c285bc4f6b0e062a0ae05d0fa9cb8f76f72df8a6238c	36	1	MyApp	[]	f	2018-10-01 15:57:52	2018-10-01 15:57:52	2019-10-01 15:57:52
aca3a8e5475b8d35d44a71accb0db0a2169bdc4c730f7beb37e0cf56f647b7a6382fd46300a72a82	22	1	MyApp	[]	f	2018-10-01 16:10:11	2018-10-01 16:10:11	2019-10-01 16:10:11
7c9129f816f6b188c179ffe12dbdc6a5fe54b86f15a905f56252b771b55eba9c60e9965c66f2a866	22	1	MyApp	[]	f	2018-10-01 16:10:11	2018-10-01 16:10:11	2019-10-01 16:10:11
c832b157d2a9652253ba7bebd0163d634a661dd26bfb0c3b278bd00de20afbc83cacf2e0240155b1	36	1	MyApp	[]	f	2018-10-01 21:47:05	2018-10-01 21:47:05	2019-10-01 21:47:05
1c30806aac5e5e0d41fb1d172d669fa403a92738cbed8733318672c836744232f998b93b98a21ef0	36	1	MyApp	[]	f	2018-10-01 21:47:05	2018-10-01 21:47:05	2019-10-01 21:47:05
854a163fba27dcea72bef325ead43eb6604d30b2194fb47f40698e2850050fbbca390b26e256e779	22	1	MyApp	[]	f	2018-10-02 16:33:57	2018-10-02 16:33:57	2019-10-02 16:33:57
a3ba85480beb1133c39e29657f6a792a8153bd126423654544a2b6085c75735b6f0f8ea4e5ebde20	22	1	MyApp	[]	f	2018-10-02 16:33:57	2018-10-02 16:33:57	2019-10-02 16:33:57
9bc2c9432ff7502b58fb917fce358aea36e74d033bceace051f67aaf14a491b68ab1355f12673262	36	1	MyApp	[]	f	2018-10-02 16:46:59	2018-10-02 16:46:59	2019-10-02 16:46:59
d1deb5fcca422bee0decb8991d2b28a76c0a4dd3b60d8284c649026f3727545657bc15170ccf3548	36	1	MyApp	[]	f	2018-10-02 16:46:59	2018-10-02 16:46:59	2019-10-02 16:46:59
75a268e0664f359ba8a977926b2ec1f579c5619ac02b9bed622630d3003ced1b7ed9e3b5db9144aa	36	1	MyApp	[]	f	2018-10-03 13:36:42	2018-10-03 13:36:42	2019-10-03 13:36:42
25dab1671c30f5b8001c09b3530f6dca09a4dc19a3a8370f866952ed4fd34e452bf64ab7bbd63249	36	1	MyApp	[]	f	2018-10-03 13:36:42	2018-10-03 13:36:42	2019-10-03 13:36:42
eaf294797c7a36acbe22301e4686e25ecffeed3f05e3ac3c206904967ae21fa5f4611009dcd6bf8a	36	1	MyApp	[]	f	2018-10-03 14:13:57	2018-10-03 14:13:57	2019-10-03 14:13:57
83ae790d1a609da2b27e85b36927a2843775cf3430f4863eaa06ca50242b536a0bbcb85e8a4a20e1	36	1	MyApp	[]	f	2018-10-03 14:51:38	2018-10-03 14:51:38	2019-10-03 14:51:38
b6a835165e5c53f0cd1237fc8ddb531052026dc4c3e47e9bc9bd60b2effb2cb955816d44a7d3307d	36	1	MyApp	[]	f	2018-10-03 14:51:38	2018-10-03 14:51:38	2019-10-03 14:51:38
9670b2d9f56ac2f4144b9f8faf42d5f3b80d616241737f355512d2a185600f2c9631d800083d5bb3	22	1	MyApp	[]	f	2018-10-03 15:03:11	2018-10-03 15:03:11	2019-10-03 15:03:11
e7edfe242cf6a82ab1a8320b38fb8b67fdb12d18e2af254dabf075196ec4870ab614a936f0dc0419	22	1	MyApp	[]	f	2018-10-03 15:03:11	2018-10-03 15:03:11	2019-10-03 15:03:11
7cfae0c5fdf0fa745645a9bb9d64659b24d89b7abf10fb3bf4c378115954bb850a16ec0bb9b72a64	22	1	MyApp	[]	f	2018-10-03 15:07:41	2018-10-03 15:07:41	2019-10-03 15:07:41
0a564f0a85de4a4d6d91be229b76aab220de28d38b1e5f80933dd82d621ca4068b2d7975924066b4	22	1	MyApp	[]	f	2018-10-03 15:07:41	2018-10-03 15:07:41	2019-10-03 15:07:41
f9a6fdf327c95cd9e0d8e27f4682589b9969d64427a7f51e76218466700c3c39f99db395d81cbef5	36	1	MyApp	[]	f	2018-10-03 15:07:56	2018-10-03 15:07:56	2019-10-03 15:07:56
73ff92a33ab96f63dcd8dba538c3135315b909bd4a1695dbc32901fe228a7c66daa116ec07ba7256	36	1	MyApp	[]	f	2018-10-03 15:07:56	2018-10-03 15:07:56	2019-10-03 15:07:56
0e1da81e78ad9f2f2ed2049300019c939d040546cb32ca8d19ce23bcb67d420cbab8ea08f03328b2	36	1	MyApp	[]	f	2018-10-03 15:08:15	2018-10-03 15:08:15	2019-10-03 15:08:15
808d72ef7eefe606e411211c941a3fa0f42cd23580b9d308b21506a746133eadd47787f78446049a	36	1	MyApp	[]	f	2018-10-03 15:08:15	2018-10-03 15:08:15	2019-10-03 15:08:15
bbaaa05766ef1b31e9fda64b4ddaab51497ccc50bcd8624092122bae733c049ec82d327724f6d1ed	36	1	MyApp	[]	f	2018-10-03 15:10:01	2018-10-03 15:10:01	2019-10-03 15:10:01
47dc1c71e5c3dfc18ca382c80b7caf1ae40a6db796119b8b52ba1411ae289043b1d1f073aaab6b11	36	1	MyApp	[]	f	2018-10-03 15:10:01	2018-10-03 15:10:01	2019-10-03 15:10:01
22b6c06191de8fdcdd492b3e1b6acdd028dc8d6841b3cf119ad7f75e30043b540e7af09f0fa0479d	36	1	MyApp	[]	f	2018-10-03 15:13:36	2018-10-03 15:13:36	2019-10-03 15:13:36
163fd82da1a12ec5feb55406d1e67d202c49a1535f4c8e9c3bc7ebd07e1366e29e51eee68f2e65e7	36	1	MyApp	[]	f	2018-10-03 15:13:36	2018-10-03 15:13:36	2019-10-03 15:13:36
7326e889514666932d79a446f81403c2673dd0924fce39f44732ebbca6f8c5de4f6fc9158ac0f179	36	1	MyApp	[]	f	2018-10-03 15:16:54	2018-10-03 15:16:54	2019-10-03 15:16:54
43e2026ee4ede0dc7bbc188e12a58df27f02029af800c67c0d255d25dc9938c372683b35448afbfa	36	1	MyApp	[]	f	2018-10-03 15:16:54	2018-10-03 15:16:54	2019-10-03 15:16:54
d50e67dda471f965922d6351bfd9404da6655723bae3f35d1f8a9ffc333fe5ced98e208555925d0d	36	1	MyApp	[]	f	2018-10-03 15:20:02	2018-10-03 15:20:02	2019-10-03 15:20:02
ca581ab432e3646b8e19a6326b10da2925b872bd003080e3b5019d6d4052b44c0bce7909c671d695	36	1	MyApp	[]	f	2018-10-03 15:20:02	2018-10-03 15:20:02	2019-10-03 15:20:02
bfe0e7e9de0064475c07a3b5d20a76d1a32a369dfb0840d4bf5fadffa8dbf29afaa82a9595f4bb65	36	1	MyApp	[]	f	2018-10-03 15:20:16	2018-10-03 15:20:16	2019-10-03 15:20:16
86af22781c95e14b28cc05a75645cc22b25e677d137c70c80b634584ef3e948242044c0c8928a8b9	36	1	MyApp	[]	f	2018-10-03 15:20:16	2018-10-03 15:20:16	2019-10-03 15:20:16
eed176513bb3d263befc5fc710c62f6e46a5be91be0a7dfc850ceae2cc71ba7e12918b5eeb5be9bb	36	1	MyApp	[]	f	2018-10-03 15:22:10	2018-10-03 15:22:10	2019-10-03 15:22:10
8cb5fa57f55c4244dbd3a2d0590112d697832b839c6f70f55ff587c342a8e6aca663eaa122d37e3b	36	1	MyApp	[]	f	2018-10-03 15:22:10	2018-10-03 15:22:10	2019-10-03 15:22:10
b3b830589a25922b95dfc703661c7dfbe67e5ee405f0fc0cf52fd03a00bac5efc491fab50597013f	36	1	MyApp	[]	f	2018-10-03 15:22:32	2018-10-03 15:22:32	2019-10-03 15:22:32
da7c3edf085df70b5f9f1566ece92bba56c92b52c9d07c38eb7829458cc3b1f7386e3221f2beca24	36	1	MyApp	[]	f	2018-10-03 15:22:32	2018-10-03 15:22:32	2019-10-03 15:22:32
b783a5723e2fcfd9f8a917a56d94cfcaa82fd6078f1f66cc3fd10cc4b81d818588120b8fa480d5c9	22	1	MyApp	[]	f	2018-10-03 15:28:06	2018-10-03 15:28:06	2019-10-03 15:28:06
1ff989df18aac60f91d7c632641e1e6fda5efc8f9e8034e7416d3e310e6f90077216bf9817df5f26	22	1	MyApp	[]	f	2018-10-03 15:28:06	2018-10-03 15:28:06	2019-10-03 15:28:06
2b8e0f7e006d3f55d903d67808efec5e5ce4103ba2724bca7dc09c5cf6a4265120bd9b38f5aee8c2	36	1	MyApp	[]	f	2018-10-03 15:42:41	2018-10-03 15:42:41	2019-10-03 15:42:41
735535bd4f4856e8067e1e8f13135c072bd43b7377c51946e3ba4ee32257fe9afef211a0618b6b4c	36	1	MyApp	[]	f	2018-10-03 15:42:41	2018-10-03 15:42:41	2019-10-03 15:42:41
f7629481deae4cb257fda676e45465ea45588bd9b3d97e9656ae343557ea7921a51c1f1f0529ba78	22	1	MyApp	[]	f	2018-10-03 15:54:51	2018-10-03 15:54:51	2019-10-03 15:54:51
9bbd75034a9e8493cc5a10abdb1a8290d4467a5d376c768c70af482e58229244d4aeef24b64813c5	22	1	MyApp	[]	f	2018-10-03 15:54:51	2018-10-03 15:54:51	2019-10-03 15:54:51
6c279279d122aac7e8c455c1d970b3b7dad9feaca9f52021bd14107644084f1918895a5b67fd884c	36	1	MyApp	[]	f	2018-10-03 16:57:21	2018-10-03 16:57:21	2019-10-03 16:57:21
fe8cffb67e9dce1cb60be853a59803fadf9bf72ea0553ce6154a4be1a9ccf742436ad160c93e5097	36	1	MyApp	[]	f	2018-10-03 16:58:07	2018-10-03 16:58:07	2019-10-03 16:58:07
2aeb31e4deb3e2964de5ed2f2e671b8c7b2c61d7f57b038855805638018fd82df3175b1922c18c49	36	1	MyApp	[]	f	2018-10-03 16:58:07	2018-10-03 16:58:07	2019-10-03 16:58:07
a2748f09a9d4e05066a05df6d5adc9ba5c23f6349b679cceedc98d361d5bd0cadb4d6fb241002f77	36	1	MyApp	[]	f	2018-10-03 17:01:15	2018-10-03 17:01:15	2019-10-03 17:01:15
533cf3b8e215178fa12cc742b83c37f28669bd872ccbd25dbc672c2ba34b6291a42ae5e935f95110	36	1	MyApp	[]	f	2018-10-03 17:01:15	2018-10-03 17:01:15	2019-10-03 17:01:15
a3a7e4c24993df0aa1711f6f105e231a4e593d88014fca8919db8ae8a1a665d6d8642917d4a30bac	36	1	MyApp	[]	f	2018-10-03 17:34:28	2018-10-03 17:34:28	2019-10-03 17:34:28
255b83dea2c21d83d9052ff4ed07cab6d3d9468fd63a5c5b912d05bd4481a02d31968349517ae0d3	36	1	MyApp	[]	f	2018-10-03 17:36:46	2018-10-03 17:36:46	2019-10-03 17:36:46
dfd67e605d388b1c97edfaa16d7f72654f8796580078a39173ec3b33cea8de3ce1da1cf531f7e14b	36	1	MyApp	[]	f	2018-10-03 17:36:46	2018-10-03 17:36:46	2019-10-03 17:36:46
723d46e7e78952a66e4ea1e7b866a40e02a101e6d7e6a517a7fbac5e44cb32015e0f29875db151db	36	1	MyApp	[]	f	2018-10-03 18:50:10	2018-10-03 18:50:10	2019-10-03 18:50:10
35f95d31ad5799b1697da8ce1f2fa3102ffe3226233bb40a05b5d8126d67ed2ab96efbcb4ccf9f17	36	1	MyApp	[]	f	2018-10-03 18:50:10	2018-10-03 18:50:10	2019-10-03 18:50:10
a7738d8af70ea4353276bc51540f9898520ef45a26195260709e8604818222e52be202a6dafad375	36	1	MyApp	[]	f	2018-10-04 12:51:11	2018-10-04 12:51:11	2019-10-04 12:51:11
cf16b9a8add886c67b5be1664185d2733db14c6245aab26d458800a145f3d51c7df4b945d06d19de	36	1	MyApp	[]	f	2018-10-04 12:51:11	2018-10-04 12:51:11	2019-10-04 12:51:11
bcfca4144ffc1d89c8f5286d9cd1614a7565b1375b5a35e9538c008af60b4ff8ed3f47ba8032b6d3	36	1	MyApp	[]	f	2018-10-04 13:06:43	2018-10-04 13:06:43	2019-10-04 13:06:43
f3c8717182230f23e6c6ff3680ddff2cde48cd53d804db5092e493b14b167e8767aad2705860b73f	36	1	MyApp	[]	f	2018-10-04 13:06:43	2018-10-04 13:06:43	2019-10-04 13:06:43
303352aca7322dc614a5c04dbadf59785481f163041908c21212cf7e8af68bc2ff821e7d04f5f758	36	1	MyApp	[]	f	2018-10-04 13:12:50	2018-10-04 13:12:50	2019-10-04 13:12:50
1d4a8a3f22f77d739a4d1f213fcd50d532e9feb641da03eb2c5fa312a27666080e866dac3633e90e	36	1	MyApp	[]	f	2018-10-04 13:12:50	2018-10-04 13:12:50	2019-10-04 13:12:50
b5d367dcecc96be2340fc001b73de3cda8736c99d1ca233f0c60ec697bae0be2264b1991a7028038	36	1	MyApp	[]	f	2018-10-04 13:45:43	2018-10-04 13:45:43	2019-10-04 13:45:43
44421eba67b82224b6ca27ad7b39db897ff38e7d3a7ebbc493818f51fff584cfb855ab5108b0b22e	36	1	MyApp	[]	f	2018-10-04 13:45:43	2018-10-04 13:45:43	2019-10-04 13:45:43
8a6bfba4844935bbe08190d185450dcffa8abbe09f175f49b02ea623a305b2086025b5ace06434cf	36	1	MyApp	[]	f	2018-10-04 14:15:54	2018-10-04 14:15:54	2019-10-04 14:15:54
57966079d1ecb0fbc1de417d20a953480003d220ab9f4a7e775a800a1b65d1cac78e55eae5784a59	36	1	MyApp	[]	f	2018-10-04 14:15:54	2018-10-04 14:15:54	2019-10-04 14:15:54
ca56cb96529f3e3427bd7fd2790599dc320d213551fc0e3f65080d061fa3979f55eab7d301536e32	36	1	MyApp	[]	f	2018-10-04 14:24:28	2018-10-04 14:24:28	2019-10-04 14:24:28
27f36673caed56f81547f2aab33bf64394d31898eabb2656350c4237b30fb15a5ce479137df12087	36	1	MyApp	[]	f	2018-10-04 14:24:28	2018-10-04 14:24:28	2019-10-04 14:24:28
9cd4bbb5b56b16eb906f0f623067beed253acab2657ceeb917cef753d84ff346d003eb68d2cf4c4c	36	1	MyApp	[]	f	2018-10-04 14:31:02	2018-10-04 14:31:02	2019-10-04 14:31:02
13f6e39a1349fdb5f396070b03bd3fd3d3a8318cd263acd610839d3c5533015e9443769e698531d8	36	1	MyApp	[]	f	2018-10-04 14:45:25	2018-10-04 14:45:25	2019-10-04 14:45:25
e1120b749a2897438badb7cb9ee7cfe902cd3953ef9085bdf9b23ff8b301392065335a89a161fd89	36	1	MyApp	[]	f	2018-10-04 14:45:25	2018-10-04 14:45:25	2019-10-04 14:45:25
9ff1e345407046657edefe789fa8a09b815dc84181038caae5d2fd34105e3290f79d0c2fc6b938fb	36	1	MyApp	[]	f	2018-10-04 14:45:37	2018-10-04 14:45:37	2019-10-04 14:45:37
abb16d860b797f13b92fde00b0ba6511445d996e72965b5017d23833f605c866cabfd5ffffc4d0d2	36	1	MyApp	[]	f	2018-10-04 14:45:37	2018-10-04 14:45:37	2019-10-04 14:45:37
eab7db383cc917a6ec8997554b045d63b947da7e89f38111baef4c2a12790cadec6fec1de7d36256	36	1	MyApp	[]	f	2018-10-04 15:23:40	2018-10-04 15:23:40	2019-10-04 15:23:40
c56ccc7214389bb84f1e63ac83d47b21bc7b815ec482492370fe5f58eb75b49d9fcc377d78f68a34	36	1	MyApp	[]	f	2018-10-04 17:19:35	2018-10-04 17:19:35	2019-10-04 17:19:35
31495aa95abcb5fa7fc1f4a24453858375a533e3ddaa40d54ce6eebe2de0b83bd3a0049323f2d4e0	36	1	MyApp	[]	f	2018-10-04 17:19:35	2018-10-04 17:19:35	2019-10-04 17:19:35
bd469bb5e928ffc1879fe047e1606df57f212046a17187577d87f24ceca37e6454d90577939792c8	36	1	MyApp	[]	f	2018-10-05 11:46:16	2018-10-05 11:46:16	2019-10-05 11:46:16
042c8e729f96a662b7e8aee504b82bf5743713fe5c1a4ba307700a6bd0e3d54fca96af9be567e14d	36	1	MyApp	[]	f	2018-10-05 11:46:16	2018-10-05 11:46:16	2019-10-05 11:46:16
ed1a0045dd9fbc2498b2f4d3ba9bb5c45d2c4c5b161b5e2550cfc129d0db53c04e946c1b4e22949d	36	1	MyApp	[]	f	2018-10-05 12:09:00	2018-10-05 12:09:00	2019-10-05 12:09:00
74f329bac85a36818f9f7f43b67f2118d07ec073cd8714a2284adda507405a0724a8c566e47cf21e	36	1	MyApp	[]	f	2018-10-05 13:19:29	2018-10-05 13:19:29	2019-10-05 13:19:29
17b7e956c07462d09fcee57bc4fe4b36e825b78da56aa3f8d0918ff71e2b6879dc786e240306f22c	36	1	MyApp	[]	f	2018-10-05 13:29:07	2018-10-05 13:29:07	2019-10-05 13:29:07
95d19f1aabfee7bb08ad370e8012c21cb6c9c285a677b468469e2f2bd32924d5ad65373493c371ee	36	1	MyApp	[]	f	2018-10-05 13:29:07	2018-10-05 13:29:07	2019-10-05 13:29:07
05f5c1425cb2463289dec76aca42c03c519f7b4292578d0a84546c8221ced96c8c008283432eba48	36	1	MyApp	[]	f	2018-10-05 14:08:18	2018-10-05 14:08:18	2019-10-05 14:08:18
75103b945d59c7a325fa986dedfbfced512cbc5fd9845b0f743b7dc76ef6740e6d4e8f189cf36852	36	1	MyApp	[]	f	2018-10-05 14:08:18	2018-10-05 14:08:18	2019-10-05 14:08:18
a2fee775a0781c77fd50906b899903ee48c7f898d0122f417139f41e5f9cbe52556304db0e5ed183	36	1	MyApp	[]	f	2018-10-05 16:06:48	2018-10-05 16:06:48	2019-10-05 16:06:48
1cf756db85561c9f107d355f620588eaed62f361901f54b631161701db911e04167feb6ba78608f8	36	1	MyApp	[]	f	2018-10-05 16:06:48	2018-10-05 16:06:48	2019-10-05 16:06:48
8f0e5ae887c5e37540da836910aeb6db61755f0052121da49106d8048282b37ed0abf77aa9ade58f	36	1	MyApp	[]	f	2018-10-05 16:11:43	2018-10-05 16:11:43	2019-10-05 16:11:43
e1b103ddabfbd01256313e50d1da9636fa5fd243331df4bca43fde28f847537670e68cf471e579b0	36	1	MyApp	[]	f	2018-10-05 16:11:43	2018-10-05 16:11:43	2019-10-05 16:11:43
7944edc8383576f9791a024c24e88af2194b06eb01abfb50ba2b64025aa77d457d94a5cba9c03f6a	36	1	MyApp	[]	f	2018-10-05 20:01:15	2018-10-05 20:01:15	2019-10-05 20:01:15
edf529890e6e095a1b7c91369a12fa496dba540a32b6f0436df7b9ff68ffdf5622e753ff17cd22ed	36	1	MyApp	[]	f	2018-10-05 20:01:15	2018-10-05 20:01:15	2019-10-05 20:01:15
cf34859fa6c8c3c981e4dfeacd66fee2be8a5da847399004615f3475ea9bb3d39959c0028604351c	36	1	MyApp	[]	f	2018-10-08 14:20:38	2018-10-08 14:20:38	2019-10-08 14:20:38
d9914aed4c3c6ad528633e0c89825fb6d6c7b15f20f768e59cef57080a8c8b1e452698e40462df9a	36	1	MyApp	[]	f	2018-10-08 14:20:38	2018-10-08 14:20:38	2019-10-08 14:20:38
28e4645304e10e2b462cc293ebdb6b6ae30d3a624c2f44ef312a5044a2e887bf67b2212ae6873636	36	1	MyApp	[]	f	2018-10-09 15:42:30	2018-10-09 15:42:30	2019-10-09 15:42:30
37fee0d6af1d9814a96adacd0ad4a4445fd70bd21e910c9e444a60e193da4b634670efd7db202867	36	1	MyApp	[]	f	2018-10-09 15:42:30	2018-10-09 15:42:30	2019-10-09 15:42:30
81775809fc876ede15b85bd432839640d65e40e0e67612f0bb9f5b29c989bed31c96ab3a687afe52	36	1	MyApp	[]	f	2018-10-09 15:52:41	2018-10-09 15:52:41	2019-10-09 15:52:41
209a5019a97b30a3c5f67cbfd0b395bcbb79181962a6f95e8e83bfaa2ac429ea7493410ab96767ca	36	1	MyApp	[]	f	2018-10-10 14:20:36	2018-10-10 14:20:36	2019-10-10 14:20:36
fbb19d5e39b667cd72fbec26e354ca67987d779ac831019573fdba243b3e1b0613ee6fffe60b6641	36	1	MyApp	[]	f	2018-10-10 14:20:36	2018-10-10 14:20:36	2019-10-10 14:20:36
535b87891b3af22fe7bf331beefbb4513c9e745602e114020fd382ffd177164a39040fe4f74f4043	36	1	MyApp	[]	f	2018-10-10 14:32:55	2018-10-10 14:32:55	2019-10-10 14:32:55
78591d816aa5c4a111cb8f2c187ce68f4458838eb5eaaf9c6575b8ce7397d21d72ae457af600738d	36	1	MyApp	[]	f	2018-10-10 14:32:55	2018-10-10 14:32:55	2019-10-10 14:32:55
b1e7d29c46764369f50e5aeff3d71b5f021d7d9252f957bfa8370126704505619e29f6bf3cd5282e	36	1	MyApp	[]	f	2018-10-11 13:18:22	2018-10-11 13:18:22	2019-10-11 13:18:22
0acff46c429275141df00da468797ddabdfee57522061695483533a2282440ac92b2d5d6f83ec64c	36	1	MyApp	[]	f	2018-10-11 13:18:22	2018-10-11 13:18:22	2019-10-11 13:18:22
09e74e0f7a636ea2d1a46e3b59b06ccba2d7d4423bda52198c6eb92a648751b746c4a4ece2da225e	36	1	MyApp	[]	f	2018-10-11 13:43:43	2018-10-11 13:43:43	2019-10-11 13:43:43
5db4a5beab4a6e09f27ec7d24843bcc60cef4d6921dca94f19c073df1e7763ebf367f682e97014b1	36	1	MyApp	[]	f	2018-10-11 13:47:56	2018-10-11 13:47:56	2019-10-11 13:47:56
433be260e98fc3d0e8f8691b435b7b8b93cc48cdbefd9874005303f162efb24e5272404ac31a646a	36	1	MyApp	[]	f	2018-10-11 19:49:16	2018-10-11 19:49:16	2019-10-11 19:49:16
989b05eac7289819dea9e8b3542b2199b55682cb8e93f4cb680b5b91b43c079a0e217f57d0c6df12	36	1	MyApp	[]	f	2018-10-11 19:49:16	2018-10-11 19:49:16	2019-10-11 19:49:16
7e83a38610425b7d24efdec57c6f671e6f60496515deb7ece38ee3c96ca192d1964a7690062874b7	36	1	MyApp	[]	f	2018-10-11 19:50:52	2018-10-11 19:50:52	2019-10-11 19:50:52
3f6641090aa72e75cb7fdaf2c149637e4086ccfd37477ea8cbe104e5e9d11ffad4bfb3b86e94b7a9	36	1	MyApp	[]	f	2018-10-11 19:50:52	2018-10-11 19:50:52	2019-10-11 19:50:52
0be82b295b6a3edbed34dd340a028c27bef22e66f2168ffeffcb62a7ba851fd284b59401fd730470	36	1	MyApp	[]	f	2018-10-11 20:23:40	2018-10-11 20:23:40	2019-10-11 20:23:40
d8155bce6b774187baa8875dde7b628333e3b40a0b57b3590501487148ed8c13ff598e3e2519b319	36	1	MyApp	[]	f	2018-10-11 20:23:40	2018-10-11 20:23:40	2019-10-11 20:23:40
32445a2b486af7032f096dfcf76a82fc485b36e7bd09be06cc0523b0c169c2e550d7be297a1032c3	36	1	MyApp	[]	f	2018-10-16 14:51:22	2018-10-16 14:51:22	2019-10-16 14:51:22
96ee75d68239c61c791017a4d6977dfce9357b4986cef322a571e61f48f1a1e3866cff60ffde8713	36	1	MyApp	[]	f	2018-10-16 14:52:38	2018-10-16 14:52:38	2019-10-16 14:52:38
bafefa3b2bdd3987b46e86acc9326c065fc51a509e665a2167b71fd8980c4650d9ff8184e35ffa33	36	1	MyApp	[]	f	2018-10-16 15:15:48	2018-10-16 15:15:48	2019-10-16 15:15:48
3cbda5a07e2fc98c6a91948b0f413f92b03b715cb5c006771a30cfe95d4ed67bb4cb362681b86877	36	1	MyApp	[]	f	2018-10-16 15:15:48	2018-10-16 15:15:48	2019-10-16 15:15:48
ff035621b7bb12183cf533295d316606ede57b39ac4368da6affabbd6d7474d7463eecbf51434316	36	1	MyApp	[]	f	2018-10-16 15:37:31	2018-10-16 15:37:31	2019-10-16 15:37:31
168df3eeaa21144d1b05300574481d4880fa605e87727c45a0010ae094ac9a1591c9cf5ac4730615	36	1	MyApp	[]	f	2018-10-16 15:37:31	2018-10-16 15:37:31	2019-10-16 15:37:31
6272ec28326679d4a8490574c3b758f6a7b820679895d9e58c46d916dfb048d426b98db0b74b2dbf	36	1	MyApp	[]	f	2018-10-16 16:09:23	2018-10-16 16:09:23	2019-10-16 16:09:23
67d368ec8dc4e9cdfd9602b4e7e04ca47e18d64bdfa2b8e0c98a8e868c7d5aa06636bdd2eb2b6c6d	36	1	MyApp	[]	f	2018-10-16 16:09:23	2018-10-16 16:09:23	2019-10-16 16:09:23
2939bb07a4951e5ec89c44d2677b56b87b90ef03ff364fd1b6e9d33fa87ce011aa4aa7492f9472b1	36	1	MyApp	[]	f	2018-10-17 14:04:34	2018-10-17 14:04:34	2019-10-17 14:04:34
019913e287ecdb71a1e71208c72f09f9cd5b2d265bf26c3142800a55a870fcf7588df9b206b437b8	36	1	MyApp	[]	f	2018-10-17 14:04:34	2018-10-17 14:04:34	2019-10-17 14:04:34
30e9a818e34d6f07d56a85db17f5fef670367f3208fd3003079322ce1db2201bb09c389fd881b16f	36	1	MyApp	[]	f	2018-10-17 14:18:08	2018-10-17 14:18:08	2019-10-17 14:18:08
1eab1b21aed0b4d97e9e13aac251433952ad0df6c435ceef1a8e1fe6e7f88edd3525f0e223ef4a9a	36	1	MyApp	[]	f	2018-10-18 13:39:53	2018-10-18 13:39:53	2019-10-18 13:39:53
bc01440fd37c3e8a007db35d09432911dafa7ef832eeba06b8806f2407ceb40a88e419a7807f2b9f	36	1	MyApp	[]	f	2018-10-18 13:39:53	2018-10-18 13:39:53	2019-10-18 13:39:53
8007ce7126716ddebaa5e9e3b6a4886db8ad76f10b3635073568c0f2925d8340e84ecf1824110204	36	1	MyApp	[]	f	2018-10-18 13:56:39	2018-10-18 13:56:39	2019-10-18 13:56:39
585a3021da8ad640246698e0d89093c69416a10cf923bdd09aaa8a0c0faba3688a6f40dc0a541cc9	36	1	MyApp	[]	f	2018-10-18 13:56:39	2018-10-18 13:56:39	2019-10-18 13:56:39
c4901f4e218138bc41cbf3f19b890ff0f84ebf768a42739a946620b1be6af0afc8cf08b0f109d4a8	22	1	MyApp	[]	f	2018-10-18 13:57:47	2018-10-18 13:57:47	2019-10-18 13:57:47
ef1d50a5a32f4fbcb712945777708f4a7dbd245b3488a02c9152cb04ac1a1b3edc76ccaa51629e1b	22	1	MyApp	[]	f	2018-10-18 13:57:47	2018-10-18 13:57:47	2019-10-18 13:57:47
53495285ee6196e9038d3857af2c6e94452c70dd99e855578c728e8612caa6bfa8460c612d1939b9	36	1	MyApp	[]	f	2018-10-18 14:08:55	2018-10-18 14:08:55	2019-10-18 14:08:55
bd76271b7f12a2c1ec008f2eea6e1597fa058199f040cd560c43f10e163da6f6ae83ce2606e59653	36	1	MyApp	[]	f	2018-10-18 14:08:55	2018-10-18 14:08:55	2019-10-18 14:08:55
2d381d2aed00101ff2cf0b91fd45c21fa5afbb3c4bce700480ac5ddab5e06c509ea5319c2c3b8620	22	1	MyApp	[]	f	2018-10-18 14:09:45	2018-10-18 14:09:45	2019-10-18 14:09:45
5b0e54ebdcb75b0addec18b6cdc2fdaae900340a456f7b17edccb8c90ea04e577e6a4c696f3fde74	22	1	MyApp	[]	f	2018-10-18 14:09:45	2018-10-18 14:09:45	2019-10-18 14:09:45
6d5172614d9e0b98cdb5ff03d60d438654fee2c8395ba72c7b00d097368117135509c163ea9d5c58	22	1	MyApp	[]	f	2018-10-18 14:10:14	2018-10-18 14:10:14	2019-10-18 14:10:14
e5a2b4b9a0733568ce228ea1391f03ec7c48969b6cce81ac82d7be64570e685c62cc40ab201d0c48	22	1	MyApp	[]	f	2018-10-18 14:10:14	2018-10-18 14:10:14	2019-10-18 14:10:14
7c5506e677bdabaf63b04cc4622dc14181d81938d93f16dfccf55fff31cd74f332e0632c018b0b2e	22	1	MyApp	[]	f	2018-10-18 14:10:39	2018-10-18 14:10:39	2019-10-18 14:10:39
63fb83ff32e181f058148f97345590f7e947141a250ff02d4720dd5a31db022368c9624623424434	22	1	MyApp	[]	f	2018-10-18 14:10:39	2018-10-18 14:10:39	2019-10-18 14:10:39
4754eb8533d488e26c6949d53a80dfb8b47527aa0315aed69bdbda77910a8a2867bc22b5ece2c9ff	22	1	MyApp	[]	f	2018-10-18 14:12:30	2018-10-18 14:12:30	2019-10-18 14:12:30
0b7a97ee92759112d1740343f80251286c7a42d9060015364258ca479a1c678521199f055de252f1	22	1	MyApp	[]	f	2018-10-18 14:12:30	2018-10-18 14:12:30	2019-10-18 14:12:30
e57bff7070188c80d0b75c3985d91967907d0a5f3085e569f81f0057df8ab22bdc5f8e8d561f8456	22	1	MyApp	[]	f	2018-10-18 14:16:53	2018-10-18 14:16:53	2019-10-18 14:16:53
41d55928f91cd2edbfc05f9eacbc64344dc37a2fe5bd265e9bb9ce0e1fdf174b1ae146c8ab2b16f3	22	1	MyApp	[]	f	2018-10-18 14:16:53	2018-10-18 14:16:53	2019-10-18 14:16:53
d32cef5896f27da5a22754e551b7f20e69d35dbee1da7b442a3c76966834401e790c4cc9a542a778	36	1	MyApp	[]	f	2018-10-18 14:22:00	2018-10-18 14:22:00	2019-10-18 14:22:00
0a6e9b7a1f7a4eeb3e0c542fe6931a74a6768b95d3baa9e2df5fa747604f32884b29b274180533c7	36	1	MyApp	[]	f	2018-10-18 14:22:00	2018-10-18 14:22:00	2019-10-18 14:22:00
44a8b712db53fb85451c92a4307270c06a0eca1f7f0cc8fe8a81c368b95d2b77e3bee1ed290b3702	36	1	MyApp	[]	f	2018-10-18 14:24:20	2018-10-18 14:24:20	2019-10-18 14:24:20
274f5593d8edfc84ac475c70bd8eed4eb20051225e5afb09ac9b99893caf7689652fb0eaeda32075	36	1	MyApp	[]	f	2018-10-18 14:24:20	2018-10-18 14:24:20	2019-10-18 14:24:20
89e1ae1c4e78976002d83531b06d619ef5480826da9e3515bac683e5a23d0c908ca5896094605b06	36	1	MyApp	[]	f	2018-10-18 16:13:44	2018-10-18 16:13:44	2019-10-18 16:13:44
f7c1751bc44ff94d764515c56f83caf41580c6b7af7d2a356e3d928e198b6bc2a2d5b7363773a33f	36	1	MyApp	[]	f	2018-10-18 16:13:44	2018-10-18 16:13:44	2019-10-18 16:13:44
e94180860f7a1d4cd78f737ca1b925c28807245bdbf6f8fcded13f32786584671aa7196f3f70707d	36	1	MyApp	[]	f	2018-10-18 16:18:49	2018-10-18 16:18:49	2019-10-18 16:18:49
18b96c4ba269988c96ad0a942fef410cdc75592f8b455dd805c837d5f2b35a6a4073ec9905555b8f	36	1	MyApp	[]	f	2018-10-18 16:18:49	2018-10-18 16:18:49	2019-10-18 16:18:49
7b5b7c90704ab5a888aa8124a4ff992492e1a7cb7a6bade340470e56bc144929ecbebf3d3b3af304	36	1	MyApp	[]	f	2018-10-25 15:39:27	2018-10-25 15:39:27	2019-10-25 15:39:27
99f2b3632a004fea6ebb22efd8314230b7e9cc1360fa8ba87ece17547ab0745e75f9c61cc7466576	36	1	MyApp	[]	f	2018-10-25 15:39:27	2018-10-25 15:39:27	2019-10-25 15:39:27
649e1f5bb6fe984afdfbb23d26c67dd636207d0bf8b1ac311d6846c6f986e1aac924387b8e901395	36	1	MyApp	[]	f	2018-10-25 16:08:54	2018-10-25 16:08:54	2019-10-25 16:08:54
df797e23152726db3ab8f4e040154d6f23fc6894947c4a98fee40abe9788ae139d8e77437ae31de5	36	1	MyApp	[]	f	2018-10-25 16:08:54	2018-10-25 16:08:54	2019-10-25 16:08:54
76c0d302df34a4133504efea5e223c8785a400c6dbc2bab6a248e77ca2ba0950b8c9cc47db47e3bf	36	1	MyApp	[]	f	2018-10-26 14:05:50	2018-10-26 14:05:50	2019-10-26 14:05:50
0c42b92e7e2563487c5d64f22562dd28b00b1a7e653e5a99d449ca623a82d8000cf9be52a6d62ecb	36	1	MyApp	[]	f	2018-10-26 14:05:50	2018-10-26 14:05:50	2019-10-26 14:05:50
80e7f454919382a19e64aeab45ad2ad47b0cdb5a7edef4bb8d6e81fb86efdf4d8837dbab68c34f53	36	1	MyApp	[]	f	2018-10-26 14:58:24	2018-10-26 14:58:24	2019-10-26 14:58:24
a69b71c713198958bb5a935fdf5a83d4ef43b0f159e2fe46e1d57945edcd54fba8bfd0d8da226787	36	1	MyApp	[]	f	2018-10-26 14:58:24	2018-10-26 14:58:24	2019-10-26 14:58:24
c5b381b6c8b83c0645b9232e87884d0b63046cb6c87e4233d834ae49eccc356153d93702c99a1db6	36	1	MyApp	[]	f	2018-10-29 13:54:49	2018-10-29 13:54:49	2019-10-29 13:54:49
dd1c42e254bacdab920c56cc378840204fa09816e868d28c31dd457cfb04716cce7bdfe415f1435b	36	1	MyApp	[]	f	2018-10-29 13:54:49	2018-10-29 13:54:49	2019-10-29 13:54:49
1af14864ae7ce51dad8f33fbb726ff53588d376ab829590c3e0b20735b45d9a4fab9051b7959744e	36	1	MyApp	[]	f	2018-10-30 14:47:11	2018-10-30 14:47:11	2019-10-30 14:47:11
92529351bc435bcb5493ef68595979e34cde193e76cb36113f05a52ebd4df8d47628d19dd779083d	36	1	MyApp	[]	f	2018-10-30 14:47:11	2018-10-30 14:47:11	2019-10-30 14:47:11
ebabc88f43c9ef074698a28047a3bf327258ebfb00286e0e9579584e15ef6170b40f5e0ecff3ef2f	36	1	MyApp	[]	f	2018-10-30 19:33:35	2018-10-30 19:33:35	2019-10-30 19:33:35
7987205a3201279fbcdf0b065f8ef149abbf878065fd5be3390d0a5f0c7a57670aa8ba7393d6536f	36	1	MyApp	[]	f	2018-10-30 19:33:35	2018-10-30 19:33:35	2019-10-30 19:33:35
ab2426cb4dccdff016b083090aa771c3ed0573eb0669e49354b4382bb127e5d0b76b3828bbcff487	36	1	MyApp	[]	f	2018-10-30 19:45:11	2018-10-30 19:45:11	2019-10-30 19:45:11
94e2a8ddba1dcbdce0af37aa37aca61688cd84e88ee47e50ea7338bd4731107547bc2175a941f5e5	36	1	MyApp	[]	f	2018-10-30 19:45:11	2018-10-30 19:45:11	2019-10-30 19:45:11
1a2be2d15d2c62e90d974185ab29e0d9e94112970036961ca143ca82b2e1d3ad129282dc04fb96d9	36	1	MyApp	[]	f	2018-10-30 19:47:24	2018-10-30 19:47:24	2019-10-30 19:47:24
7d134ec060a27ece7b022c60c8f00e307b41dac87a4b91ab20ccc98cc5cf8ab82501454afdfd386a	36	1	MyApp	[]	f	2018-10-30 19:47:24	2018-10-30 19:47:24	2019-10-30 19:47:24
8dae6aa2b9ec40815e6af2c0307c2f8c07ec382ffed2a33dae927e2e2c1aead0aaddf1945b7b29e6	36	1	MyApp	[]	f	2018-10-31 13:20:41	2018-10-31 13:20:41	2019-10-31 13:20:41
6912a731a0019458acf0c8c4b31206879a99623049e17489f71e1dd4d169e0556b79bc37df30be0a	36	1	MyApp	[]	f	2018-10-31 13:20:41	2018-10-31 13:20:41	2019-10-31 13:20:41
fba239ba6ad13d848eb93613cdae6e8de340e7103e895d7cb0b182ccce5ae547cf2d27810ea5d69c	22	1	MyApp	[]	f	2018-10-31 14:44:42	2018-10-31 14:44:42	2019-10-31 14:44:42
d4f391f6ea7bafc197295201e28cfbc2575ec69518adca28c4218a44acc8e36b0757b954160a9f98	36	1	MyApp	[]	f	2018-10-31 15:45:48	2018-10-31 15:45:48	2019-10-31 15:45:48
ec872313ba480adb11b9fe93cfe965237a463820b046f4acc92081e16ccb9a70bb57a3c82253e6dd	36	1	MyApp	[]	f	2018-10-31 16:30:37	2018-10-31 16:30:37	2019-10-31 16:30:37
4426ec3fc2f1c758afae6aa71bdabbd00152df74558e2e80baa44c234421d43d42b363f74ad9aea0	36	1	MyApp	[]	f	2018-10-31 16:30:37	2018-10-31 16:30:37	2019-10-31 16:30:37
3a0fe02f486e07ec0060083b93cc09aaace33c86263792c6d6b22e029bad6667da36c9c43726c85e	36	1	MyApp	[]	f	2018-10-31 17:01:19	2018-10-31 17:01:19	2019-10-31 17:01:19
6c5e8cb3522cd79e291b12907d8e2c99145a99faa83a79d2779877e169f740b920d5b313b56c5498	36	1	MyApp	[]	f	2018-10-31 17:01:19	2018-10-31 17:01:19	2019-10-31 17:01:19
e295c7e171a1f80afb1ea29c51ef71f10e83175ff41be966a18800ddc2bb997c2737e0f41916d5de	36	1	MyApp	[]	f	2018-11-01 09:02:34	2018-11-01 09:02:34	2019-11-01 09:02:34
d379d177a4e1c09cb5dabdcfd1c7eab69f194ca80182a57cf915b2e59223dbabf46ab134266b05bb	36	1	MyApp	[]	f	2018-11-01 09:02:34	2018-11-01 09:02:34	2019-11-01 09:02:34
c3a4a5c9e98fd0df516fc733e4170fb06c298cdda7b45593bb62a8f6e024d0a32e1066270327ac26	36	1	MyApp	[]	f	2018-11-01 14:53:13	2018-11-01 14:53:13	2019-11-01 14:53:13
a1d92b88d87eb914e3707ae5309237cf3e13fd466b44f91b0cf5ff6be4e03468fbae85f2c6131d79	36	1	MyApp	[]	f	2018-11-01 14:53:13	2018-11-01 14:53:13	2019-11-01 14:53:13
e9568012eac0eb962f368e4674a51eb73349f666844f5e65c893e1b293f2efe47c7ec38d49d029c5	36	1	MyApp	[]	f	2018-11-01 16:05:33	2018-11-01 16:05:33	2019-11-01 16:05:33
029b336937cae0737d15dd49081724169b17d18d9eb58259c82f4c2979c33a2e8099fcfcf291f749	36	1	MyApp	[]	f	2018-11-01 16:05:33	2018-11-01 16:05:33	2019-11-01 16:05:33
fa995c89cc72043b98aedbc7ff4e48c44c3530e6e14d1eb9ee0bc1f6222d8996230ac804f64fdade	36	1	MyApp	[]	f	2018-11-05 19:12:21	2018-11-05 19:12:21	2019-11-05 19:12:21
ec8af8ee604152aeef5efd60079f81b2082630fff7fd46f6add6d7ed32d7c72c3de020e0466a1181	36	1	MyApp	[]	f	2018-11-05 19:12:21	2018-11-05 19:12:21	2019-11-05 19:12:21
0a3aa2951f28cade5c6144c9fb97385decbda58a9d80d993b6f82c082eb3696ff809163409bedb85	36	1	MyApp	[]	f	2018-11-06 14:06:14	2018-11-06 14:06:14	2019-11-06 14:06:14
6a048dd7569bd31ead19194c25a2f742c6f71f95998e594d38dd68fa7cc344aca34a301b4347e877	36	1	MyApp	[]	f	2018-11-06 14:06:14	2018-11-06 14:06:14	2019-11-06 14:06:14
d77ec33f6c7ba86255a8b59fe7d20cdcbb4f293f7c7ee86b20551dbf95cfc37f9c1f620f48806c5a	36	1	MyApp	[]	f	2018-11-06 15:10:36	2018-11-06 15:10:36	2019-11-06 15:10:36
411ab6f4300c3c4de359639bc5063bab337cbf0d7ebf1d7a9fab089d8d24f0a53af6d98189277ddf	36	1	MyApp	[]	f	2018-11-06 15:10:50	2018-11-06 15:10:50	2019-11-06 15:10:50
0d55b98b6560f4a7faae77532bf1268fc570bb39a61b7977a5f87ff095081b892b8dca47fbbf3258	44	1	MyApp	[]	f	2018-11-06 16:35:02	2018-11-06 16:35:02	2019-11-06 16:35:02
d139de92b992903a546cf814e2ad29df1f310d2284463db0908792817bb087c33b10882d395c8e8d	36	1	MyApp	[]	f	2018-11-06 16:35:28	2018-11-06 16:35:28	2019-11-06 16:35:28
7ca33abbb2a3a4b943b1c8d08cc3eb472826077e5e89b34131adabcd1d73b4c7cbe4fe0da6a0b779	46	1	MyApp	[]	f	2018-11-06 16:50:55	2018-11-06 16:50:55	2019-11-06 16:50:55
78c8ae4378324b646ca35748d7398ecd98034df71551379229a7e20acea695a926458f4c902369d2	36	1	MyApp	[]	f	2018-11-07 14:24:12	2018-11-07 14:24:12	2019-11-07 14:24:12
3e719d5658d572ff188656fdf1120fd1e61a5e0ade28e639d293d49bef0c0365220c5b2535406f1f	36	1	MyApp	[]	f	2018-11-07 15:07:57	2018-11-07 15:07:57	2019-11-07 15:07:57
71c4be47f16d8de282f8c0d11a1e54f31e28f054c8ad6a04f29ccfe243d3fa75739bc8c29186004c	36	1	MyApp	[]	f	2018-11-07 15:18:07	2018-11-07 15:18:07	2019-11-07 15:18:07
bb18bf4472ebd6cab157293c8c2708c84950be695e049bc30894b3a4d2e530f24a3fd8b5ba36d1c7	36	1	MyApp	[]	f	2018-11-07 15:28:07	2018-11-07 15:28:07	2019-11-07 15:28:07
a1fdd805ef18c6ab1a3bb7306e80aa692849e3d69a7f28dcf4f1543f7b89685b1b99fa0aab6d91cc	36	1	MyApp	[]	f	2018-11-07 15:28:48	2018-11-07 15:28:48	2019-11-07 15:28:48
c969510bd63d11030cf3a2d3ab340d27e1dd2bd8f19bcfb7bff45b0c3f44f7f5a46bc8061566dae7	36	1	MyApp	[]	f	2018-11-07 16:14:17	2018-11-07 16:14:17	2019-11-07 16:14:17
9c8b7fbf3bd250f6cc74d26670520683e318d33019a0d69f64d2343421716786a4d6be43421043f6	36	1	MyApp	[]	f	2018-11-07 19:09:44	2018-11-07 19:09:44	2019-11-07 19:09:44
475a4a79eaa03f8bfe803e0279c7f4880f209975a12e778c936c90bc780f203b8eba2e82ac56c6bd	36	1	MyApp	[]	f	2018-11-08 13:55:53	2018-11-08 13:55:53	2019-11-08 13:55:53
ad2696947bc65548d51b860941ee6794490c4427d4bbb94a56f0353ecf6905f739f9ad2e7778237d	36	1	MyApp	[]	f	2018-11-08 14:42:40	2018-11-08 14:42:40	2019-11-08 14:42:40
7ed9b847cc2edb7d3783a45dff142b680aac6ee1c118f39e7304738e0049918f74d8c1dc5e7288ae	36	1	MyApp	[]	f	2018-11-08 14:54:06	2018-11-08 14:54:06	2019-11-08 14:54:06
7b822927f72fe3c8ca84f120fd517f57b2b9ea270725a661c821b80026be06cbeefc23e1265945e7	36	1	MyApp	[]	f	2018-11-09 14:12:35	2018-11-09 14:12:35	2019-11-09 14:12:35
4c93f10ca463509f6d7e0b631a3b8a331933a5e0d9433b48a1d50c382db966247ee529677b695811	36	1	MyApp	[]	f	2018-11-09 14:23:59	2018-11-09 14:23:59	2019-11-09 14:23:59
8efc7e0031d0b23629c0ec6af2e04cd94f86ae7fa75ea696c21dd0c478c7f6453cc89c561288a679	36	1	MyApp	[]	f	2018-11-09 14:54:30	2018-11-09 14:54:30	2019-11-09 14:54:30
afe9599b34fba6ab5de3c869711f1296c456c19a10ade82fb23369bf7ca310a470c965b572774f48	36	1	MyApp	[]	f	2018-11-12 14:36:47	2018-11-12 14:36:47	2019-11-12 14:36:47
07343b3c7d12a985d5b61ec0bd06e6857d41c1149557278fc92845cca42b5bf6e223bd75aee9b0e3	36	1	MyApp	[]	f	2018-11-12 14:49:28	2018-11-12 14:49:28	2019-11-12 14:49:28
376070c8a42a6df6f2b09b3e025f4819692120a5dee36ad76b36871cf19b0cae74911085e0edd1ed	36	1	MyApp	[]	f	2018-11-13 11:45:54	2018-11-13 11:45:54	2019-11-13 11:45:54
adf93192ed7631fefb801e61dab6152293f8aeb666bb384a8e6e0de92059bcf4d9c845dea1fe4e9a	36	1	MyApp	[]	f	2018-11-13 13:24:15	2018-11-13 13:24:15	2019-11-13 13:24:15
ac5aba7a2442e4c311e9dec5219654f957199e4301f992554cb8b5a338dd10dce99f6e12d8f9a6ca	36	1	MyApp	[]	f	2018-11-13 16:51:35	2018-11-13 16:51:35	2019-11-13 16:51:35
ec4568e13e1d238c80321620eae44098f8ec4cfe5c110ca599fa5de63a36df12c41465af542e9478	36	1	MyApp	[]	f	2018-11-14 10:30:48	2018-11-14 10:30:48	2019-11-14 10:30:48
d7fb39d4645485ef057d6c1179fe504b14bf5b3244dd6f74468308eae86f3bb649e04dddec789987	36	1	MyApp	[]	f	2018-11-14 16:18:39	2018-11-14 16:18:39	2019-11-14 16:18:39
d30efabb3a2ca5fbbaf18c82cc2206ec3941956e9aa4fa289a30bd0ddecc2c3e05a932cf9ee740de	36	1	MyApp	[]	f	2018-11-14 16:26:10	2018-11-14 16:26:10	2019-11-14 16:26:10
aab1e922b341abcc0dad6071fe90be26128ca07dc43c2f01dc194352e361aef5fec96fbd0ffe7cb9	36	1	MyApp	[]	f	2018-11-14 18:50:15	2018-11-14 18:50:15	2019-11-14 18:50:15
e01d984188078cf01089fe8224185486057df702be63eac57a929cd1117c4ba7816a9eecd6b8d290	36	1	MyApp	[]	f	2018-11-16 10:13:56	2018-11-16 10:13:56	2019-11-16 10:13:56
1bc87aeb6540b0a34886d12776073609381f00f6ba034947d98efaff58918f0c3db2676deb4077f9	36	1	MyApp	[]	f	2018-11-16 13:17:23	2018-11-16 13:17:23	2019-11-16 13:17:23
0e58b0ac4fac7588d203235955b7bc92df2e745c16e8bd3f15bb31588da8ecb468f0c54a2de5425d	36	1	MyApp	[]	f	2018-11-16 13:59:27	2018-11-16 13:59:27	2019-11-16 13:59:27
e8375650c6aad85921d290e987c09cfabd1a391b74c612df7d92d94934405231f840e6e7e5f7ca11	36	1	MyApp	[]	f	2018-11-16 14:06:28	2018-11-16 14:06:28	2019-11-16 14:06:28
d8c5ef343a4f1a286323bc535a695564c5cf300d61ad7d6cf6f529d3f779e52be4a1274ee08a17d8	36	1	MyApp	[]	f	2018-11-16 14:33:22	2018-11-16 14:33:22	2019-11-16 14:33:22
8b1bf4f4a3d7c1a6c7cef80b442e07ee7e70b27ebc05ce1dc013f1a2a2e182ecd3d4057caecbb5f3	47	1	MyApp	[]	f	2018-11-16 16:38:14	2018-11-16 16:38:14	2019-11-16 16:38:14
3273d19528c97cfec65edf469f0ea3ade4ff6345a48537da8abb24efc49082dd1b43c47921935113	36	1	MyApp	[]	f	2018-11-17 09:44:16	2018-11-17 09:44:16	2019-11-17 09:44:16
de7ef195d5c893dc33f62af257f7a40fb94964e3df79e6b7d1d1bf812b82836717a3970964736af6	48	1	MyApp	[]	f	2018-11-17 09:49:44	2018-11-17 09:49:44	2019-11-17 09:49:44
7cfad1fdafb29d40e9b54182c7e76ab17033292e17633c53762108e1bb65a464225f936e7861c864	48	1	MyApp	[]	f	2018-11-17 09:50:23	2018-11-17 09:50:23	2019-11-17 09:50:23
559b88aeb9ea093bdacfcddd14aae8ca26e9d24f3ed146f872c2737014f515e2b79c4e6b2f414f11	36	1	MyApp	[]	f	2018-11-17 09:53:52	2018-11-17 09:53:52	2019-11-17 09:53:52
f04fad96d095c2d2abf550ad0cb1134a190589087fab4f0862466e8464c9029cc16019219bdd875e	36	1	MyApp	[]	f	2018-11-17 10:00:14	2018-11-17 10:00:14	2019-11-17 10:00:14
2ffba14999934e9913a561a00466cc9cad2675b4fed473cd5032720f641cd5bc3bda46b912351a2b	36	1	MyApp	[]	f	2018-11-17 10:00:46	2018-11-17 10:00:46	2019-11-17 10:00:46
3642cce5189deba21c2e9e506b4be040aef591b9c23b410bf5aeeafcd341f90de77444ebe9acfcae	36	1	MyApp	[]	f	2018-11-17 10:03:19	2018-11-17 10:03:19	2019-11-17 10:03:19
0ce3451bf8d99d5f20b17a2892c289364e9f696cbfa062ff0345da7587da2c183d8cc192717950db	36	1	MyApp	[]	f	2018-11-17 10:04:23	2018-11-17 10:04:23	2019-11-17 10:04:23
039546bff32abf3ba21b5b52bd83d56c70f79ca0bf3725d3208bdab69debe0a4253e8cb2995c4183	36	1	MyApp	[]	f	2018-11-19 13:13:39	2018-11-19 13:13:39	2019-11-19 13:13:39
2a341f9604d6fdc385ce1286ed32670a3bfa7cd13c3966d4035ea63f9ccb70455ce748f3c1451477	36	1	MyApp	[]	f	2018-11-19 13:48:04	2018-11-19 13:48:04	2019-11-19 13:48:04
37356d2c627bfc83542d0080c1f63bfc9bfa9fb224dc35f26bad254c665d2934f1c4cc010b8e6758	36	1	MyApp	[]	f	2018-11-19 14:55:10	2018-11-19 14:55:10	2019-11-19 14:55:10
8708b89556c27c40df57778fd24d264bf41cfa1360ddeca1ccb0354df8fe96f48ad36d03bc9522f4	36	1	MyApp	[]	f	2018-11-19 14:58:47	2018-11-19 14:58:47	2019-11-19 14:58:47
9fe92e3ed60e634ebb5c5ce920d48747b44ab7f64b828903b9fe9af461bd12a35609d08837653fa9	36	1	MyApp	[]	f	2018-11-19 16:32:48	2018-11-19 16:32:48	2019-11-19 16:32:48
5283bd96152e39cfb458fae628ade6594cc16fd3c0a617b5c333fa5b5518e2017ed9f9842f8430af	36	1	MyApp	[]	f	2018-11-19 16:34:03	2018-11-19 16:34:03	2019-11-19 16:34:03
22661a31bd489004ee1004adfc460e12b76b2410718296f2f04ae07a05618b14c5c6702555f76b13	36	1	MyApp	[]	f	2018-11-20 16:02:34	2018-11-20 16:02:34	2019-11-20 16:02:34
fea122196229857d0b7c01bf69277274c1da5ddf5aa706e25d0b35651b4a3302c33fe440d8d0f7d3	36	1	MyApp	[]	f	2018-11-21 14:25:42	2018-11-21 14:25:42	2019-11-21 14:25:42
219919957ed2e99ed9fbfadd054a5546beb777c55a2f30f0e356899b549d8ed93edfff277452bfc5	36	1	MyApp	[]	f	2018-11-21 14:59:28	2018-11-21 14:59:28	2019-11-21 14:59:28
5e1aacfd97c1e5d66886604cb01e4b7d4b1017da8ec0a38e1f0cf4f26405f731eaca08936b8a54ec	36	1	MyApp	[]	f	2018-11-21 15:05:41	2018-11-21 15:05:41	2019-11-21 15:05:41
30934a33da5e8f89332f9be59803e012079e1330f38a47e4e7a09507191a228088470ed62e7c0295	36	1	MyApp	[]	f	2018-11-21 17:43:19	2018-11-21 17:43:19	2019-11-21 17:43:19
7e64ceb25c6bb865773744780d231d55d37d77177674172b552d0e1db8001cb60fae1e801d0a4bf8	36	1	MyApp	[]	f	2018-11-22 14:04:22	2018-11-22 14:04:22	2019-11-22 14:04:22
c559f287ca2902fd71c7c768a476a5bad7fbbd59178a2dec528d9ae48c0f673ff11229c5fed6555a	36	1	MyApp	[]	f	2018-11-22 15:02:47	2018-11-22 15:02:47	2019-11-22 15:02:47
760c3e022fa3f01bdc0477a0101da03edcca03babf0e91d42f54e9e980fd51e50aac4b8d8d7e46bc	36	1	MyApp	[]	f	2018-11-23 14:07:18	2018-11-23 14:07:18	2019-11-23 14:07:18
45ab99273b12e645e3f020a789570ad5351f47ac85a7d7500876a6230dc91d7b73ace8411798a30e	36	1	MyApp	[]	f	2018-11-23 16:18:34	2018-11-23 16:18:34	2019-11-23 16:18:34
b5a83627026946607c37c29405fe8fdac7acbbe782e73a1ad4ca83647a405ca55f5fc4e945ea9882	36	1	MyApp	[]	f	2018-11-26 14:18:59	2018-11-26 14:18:59	2019-11-26 14:18:59
ea028f8331b3dd0f93e72209c62561089a7798790d6cb8aab467c6ba8e65ca0f12c9196497fb11c7	36	1	MyApp	[]	f	2018-11-26 14:19:00	2018-11-26 14:19:00	2019-11-26 14:19:00
06e5e0807063055caa08515d80f566ed50e3535e1d6af12435a7275a463a4419242a129aa9c2bbad	36	1	MyApp	[]	f	2018-11-26 15:36:58	2018-11-26 15:36:58	2019-11-26 15:36:58
423c58ef21d6b6c5d19bae9d8fb39d9301d5b01b0e6ed107a0d7402c3a97ff8d82814ccdb40a7990	36	1	MyApp	[]	f	2018-11-26 16:57:42	2018-11-26 16:57:42	2019-11-26 16:57:42
922ae193ffbd40139620292578df40599832ef2cb20aa5a2c3dde1db5ec7d142ab31a40bbbcec7a2	36	1	MyApp	[]	f	2018-11-27 14:26:33	2018-11-27 14:26:33	2019-11-27 14:26:33
1476d6d5dfa2bf2a070b6c2580f26f818f2b6f7c9a0e508ff9e55a700e744ac67ae10999b9257e76	36	1	MyApp	[]	f	2018-11-30 14:23:17	2018-11-30 14:23:17	2019-11-30 14:23:17
7cd9272ddac1b8d0a88223384eb9a0b3320ce57ca99c3fa7f43353b72b01bc79fcb10204fcde272b	36	1	MyApp	[]	f	2018-12-03 14:31:40	2018-12-03 14:31:40	2019-12-03 14:31:40
113b00aebdd52e0b9a3237755c196ebefb466a56311582a264c4800b8c578281dd3ca4d08fe85cf9	36	1	MyApp	[]	f	2018-12-03 14:46:15	2018-12-03 14:46:15	2019-12-03 14:46:15
e0ab237cc09af060f4f0e6545768e2dec3a0005e5ae4d8e40ad42f40bf323c50e4b46a3ae4f33b59	36	1	MyApp	[]	f	2018-12-04 14:24:01	2018-12-04 14:24:01	2019-12-04 14:24:01
8d62a152675f0bf866af84cf62fd58a5f435390e49e461be189c260e20ab73160cfc285e22f59f27	36	1	MyApp	[]	f	2018-12-04 15:14:15	2018-12-04 15:14:15	2019-12-04 15:14:15
733daddc2a3792ad6bf886b1034ba92d8fa8fc51fffce99940462e40e3be93479183c962ce316c08	36	1	MyApp	[]	f	2018-12-05 13:39:43	2018-12-05 13:39:43	2019-12-05 13:39:43
2132504ad06a05be0cae45907f315f31b6bfaa0efd620458f2d4ec1267138ce2954515f023c31baa	36	1	MyApp	[]	f	2018-12-05 14:43:31	2018-12-05 14:43:31	2019-12-05 14:43:31
4e74b7d63debe23ecf6757b710636ea4b8378748bcc8c9d39cf8751abc8fe59a42d4f78cfbc500d9	49	1	MyApp	[]	f	2018-12-05 14:58:09	2018-12-05 14:58:09	2019-12-05 14:58:09
b609f52927da8479ec6496dce1c26aabc199bf347d255c4c42cd545c215466023572eaeb76b08613	49	1	MyApp	[]	f	2018-12-05 14:59:41	2018-12-05 14:59:41	2019-12-05 14:59:41
f738bb5e54af105535ee26ded62025a55f9cd5a17b832e4337c9bc550bdcb8329cf4e23e5a7a33e4	36	1	MyApp	[]	f	2018-12-05 15:33:50	2018-12-05 15:33:50	2019-12-05 15:33:50
34121eebb55461191e155abfdc829f6b4079e683668c086389b4d772eda9170eb5d72386abf6983b	36	1	MyApp	[]	f	2018-12-06 15:27:14	2018-12-06 15:27:14	2019-12-06 15:27:14
ed1bdc7d11564f98ab59ad4c5b8da8a94d0ca19815ce2cd613a3552f8b213987b2ecb6147fcc51af	36	1	MyApp	[]	f	2018-12-06 15:41:07	2018-12-06 15:41:07	2019-12-06 15:41:07
6903e5bf27d0ad738faf6796fe89e6f4c5ca78f65e457f829237c4cd9e637c8f869502eecdde446c	36	1	MyApp	[]	f	2018-12-06 15:58:20	2018-12-06 15:58:20	2019-12-06 15:58:20
ad80cd30cd0ebc5d09b28e005a38baa63516530a0808849125a5a27e93335cc3d621a88a9f39b753	50	1	MyApp	[]	f	2018-12-06 16:50:13	2018-12-06 16:50:13	2019-12-06 16:50:13
d0af2256873151605b4c10a3a3cbeff3ee19e20440f3a8adaefbdb184a5af3cb585b03e8e63dbf05	36	1	MyApp	[]	f	2018-12-07 14:02:10	2018-12-07 14:02:10	2019-12-07 14:02:10
2d25fe28c74dc37d749e87906d65a082683db3696addccb420d80ab20e83a680a46e0ae740aae9bd	36	1	MyApp	[]	f	2018-12-07 14:13:28	2018-12-07 14:13:28	2019-12-07 14:13:28
d7f16e3421274ae14020482af46d1bbaa027ecab53f609fb3d59d053e20e4a7c0d7e92610eca483a	36	1	MyApp	[]	f	2018-12-07 15:44:04	2018-12-07 15:44:04	2019-12-07 15:44:04
5811eac9ca239564d1a7fc0f299fec1684b9fa7c20196993082e5e51923fdc528fbc00e0ec123bbe	36	1	MyApp	[]	f	2018-12-10 14:14:08	2018-12-10 14:14:08	2019-12-10 14:14:08
610b5868f9a5401b38751312d62d3bd6fc2838958854a46b06b8f85470e4140f10f9bf07c3de96b4	36	1	MyApp	[]	f	2018-12-10 14:56:41	2018-12-10 14:56:41	2019-12-10 14:56:41
233b9563eefd6ccd9d67784eae9aada97dd5e42b8276d71bba04a8477ae0933c5fc9e48a23108e12	36	1	MyApp	[]	f	2018-12-10 15:48:18	2018-12-10 15:48:18	2019-12-10 15:48:18
cd2670d5f46ce48261d25e187dd1818441f04f6d006d0a93118407850d0ce95252f6e3c2e01e2673	36	1	MyApp	[]	f	2018-12-11 08:57:52	2018-12-11 08:57:52	2019-12-11 08:57:52
a16f4c1e61892394ff0f44f65f32b528150c8fca5cc25caa74926fa89faf7b5683963b490380bd3b	36	1	MyApp	[]	f	2018-12-11 09:12:06	2018-12-11 09:12:06	2019-12-11 09:12:06
64edd0e95c084bb67b95177a616d2cf8c2ba92b861b7403ea1a498683450e075a5d54cae7affb3aa	36	1	MyApp	[]	f	2018-12-11 14:19:05	2018-12-11 14:19:05	2019-12-11 14:19:05
66fafac3aa77dbae99f09ab798f4b8551053de048c4674321fa1f4dba757ff907dfb775ee5765794	36	1	MyApp	[]	f	2018-12-11 15:05:25	2018-12-11 15:05:25	2019-12-11 15:05:25
c4a24160e8d922adc39b8125fd2216c885cc1161832fdbbacc50e0210a539e065be7152c41ab8b20	36	1	MyApp	[]	f	2018-12-12 13:52:13	2018-12-12 13:52:13	2019-12-12 13:52:13
39831bd2f3c51dd77fdd217283faf26f0c52fded9f4686c9bfdfe2087abe4740bf8bc06f336e6b0a	36	1	MyApp	[]	f	2018-12-12 14:05:30	2018-12-12 14:05:30	2019-12-12 14:05:30
a03b113b9f795cbb62590a06e15067c9b54f09a7abe641f8c291be71d150723721ca1a17c47ac7af	36	1	MyApp	[]	f	2018-12-12 16:18:27	2018-12-12 16:18:27	2019-12-12 16:18:27
3fb6495c33b51b40b57cb955ebe7494e057724baaf69b56a744d9859526a07da99e7ee42b299d41d	36	1	MyApp	[]	f	2018-12-12 16:18:51	2018-12-12 16:18:51	2019-12-12 16:18:51
91925172fe0aa86ee96df853a304a312538fade5f206fd35d6d502468b3fd063c006e352bc49d073	36	1	MyApp	[]	f	2018-12-12 16:27:19	2018-12-12 16:27:19	2019-12-12 16:27:19
cfe930cab0400994eba6e0bd01ff6985aa410b65358f01fdd630c449e1fb215859c1565359258523	36	1	MyApp	[]	f	2018-12-12 16:30:15	2018-12-12 16:30:15	2019-12-12 16:30:15
79c4c677c14409d10bbff0ba4a09b11c853bafb2f01e616c46067c0a4dbef0cc1ee8a5150a47cf19	36	1	MyApp	[]	f	2018-12-12 16:30:26	2018-12-12 16:30:26	2019-12-12 16:30:26
2f4bdb5021dc8128b3d83691a01f450f0f32c9c4a97bae3565da90f1585cac912e4b951e76a7b6ca	36	1	MyApp	[]	f	2018-12-12 16:54:38	2018-12-12 16:54:38	2019-12-12 16:54:38
16728dc942f2d43130c9df1ab7e989b7d75aaa670d5e344ed70caa5e8b82accd4c202c8b857480ca	36	1	MyApp	[]	f	2018-12-12 21:02:16	2018-12-12 21:02:16	2019-12-12 21:02:16
ed1cfe3058611d7110d735583d4aed9f69369433c3b2faf181c562f904748160ba6fb950ac338f95	36	1	MyApp	[]	f	2018-12-13 14:31:15	2018-12-13 14:31:15	2019-12-13 14:31:15
ff44200f1ad0306ac9af02793efb99c7b2ec0041618b4f10d48889f5e255bea953b89066d1bb1491	36	1	MyApp	[]	f	2018-12-17 14:47:48	2018-12-17 14:47:48	2019-12-17 14:47:48
fdc21af4376af72d6c307613db7e678140c1cae9ff2528b82972f574fe9991916510f8deb52c2a76	36	1	MyApp	[]	f	2018-12-19 13:58:47	2018-12-19 13:58:47	2019-12-19 13:58:47
89e0105ccaaa0bb36b325444802fadc1f888afcf86493348cde9fb9d0efa6ed18a776a4c27513cf6	36	1	MyApp	[]	f	2018-12-20 11:05:57	2018-12-20 11:05:57	2019-12-20 11:05:57
e707be36ea86d17b1c02979e8422e9b75fee313860e61ca75fd03ee4df988e5cecebaecab490da7e	36	1	MyApp	[]	f	2018-12-20 11:14:00	2018-12-20 11:14:00	2019-12-20 11:14:00
96058bae9c1164bd6cd5689c5128a1823a00f658c070923ade0ca7de1b5e0f7d6d2e61484c8b3a64	36	1	MyApp	[]	f	2018-12-20 11:40:52	2018-12-20 11:40:52	2019-12-20 11:40:52
95509a32353d7f69c9dfc8893a80be616ac75bfa47f85f78d4d5381b8362d7309a536432cef0660a	36	1	MyApp	[]	f	2018-12-20 15:07:54	2018-12-20 15:07:54	2019-12-20 15:07:54
902b82cb7a0c4b4cfc990085827d253bd61b93a9714e614ba65e05cf5e3ae2cfdc867b1ddaca9707	36	1	MyApp	[]	f	2019-01-25 13:51:55	2019-01-25 13:51:55	2020-01-25 13:51:55
ddcc50d08e5f292c3aa54ac9cc27850156251210a9b2bdbc3b763ba9f1f51cd6ce17a82960a4ef44	36	1	MyApp	[]	f	2019-01-28 10:10:34	2019-01-28 10:10:34	2020-01-28 10:10:34
165551a1a45f30d8f7ed95c30f130c166a0f23429fafa5b8b776296f38330c0ec08909102dfb3e02	36	1	MyApp	[]	f	2019-01-29 14:43:15	2019-01-29 14:43:15	2020-01-29 14:43:15
68d8523fa1d7f2cce6d6750630c5787a52eb392cde9ad62c1f72cadd7a9eada4b3debe6a0f66c7ea	36	1	MyApp	[]	f	2019-01-30 13:59:15	2019-01-30 13:59:15	2020-01-30 13:59:15
c6ca4227881be96f940ae5771991a0dfc35779301f51a2051215022954ad96a75b9ab126d6444cd1	36	1	MyApp	[]	f	2019-01-30 15:07:58	2019-01-30 15:07:58	2020-01-30 15:07:58
397a709256a8899b2969176eab592e78ddd6677012a4cec3358e39baebdfa3fe2574811f79739aca	36	1	MyApp	[]	f	2019-01-30 15:10:42	2019-01-30 15:10:42	2020-01-30 15:10:42
6e782a1eac6e70f60c442ab057bbce169d517e1a38a0ca57fdd95f9f61b2e9d2978b65e84f2b84bf	36	1	MyApp	[]	f	2019-02-27 16:21:33	2019-02-27 16:21:33	2020-02-27 16:21:33
85844b9c498b4f905b0cb890edf90e110f3b7f900fbb1d5533840478e57292f871bcad4ee903c382	36	1	MyApp	[]	f	2019-02-27 18:53:33	2019-02-27 18:53:33	2020-02-27 18:53:33
4d4dde3ddba982b1f3ba23e3751a4ff323770db63666fa05d272ad66a6daaf6b47df3ec1f026de83	36	1	MyApp	[]	f	2019-02-28 13:52:36	2019-02-28 13:52:36	2020-02-28 13:52:36
5628ded254a1fc54c0fed5f2db490be470b717b3ccdb76eaf50ca2fea37bd67ef5717a312c4be137	36	1	MyApp	[]	f	2019-02-28 20:09:05	2019-02-28 20:09:05	2020-02-28 20:09:05
f9ae0b0aa06b68c68a501d56f758d57d971ac027f4eb33332d4fb9cc6e72c53f4f32c5b0beeb8ec6	36	1	MyApp	[]	f	2019-03-01 11:09:07	2019-03-01 11:09:07	2020-03-01 11:09:07
9667f86d485a32355e9f3c92115b91b716136ead9e71da19b9cb13e999fa1d17234bbb7b0065f381	36	1	MyApp	[]	f	2019-03-06 14:13:43	2019-03-06 14:13:43	2020-03-06 14:13:43
9b158470b1b522996a51e836dd8b3c28413e431e31085dd1ecc9daad321932619d8cf1bb58c0825e	36	1	MyApp	[]	f	2019-03-07 10:53:36	2019-03-07 10:53:36	2020-03-07 10:53:36
ffa92e418d48e11afc9d66bbfec30b72505aad91d4db84d0301e118279eaa0d05950734d72dfde52	36	1	MyApp	[]	f	2019-03-07 14:51:16	2019-03-07 14:51:16	2020-03-07 14:51:16
291e1201da4866e5937563f467b43d687d2a0e00e7eb9d345df75894b0cf959009cd8d025e6b5d83	36	1	MyApp	[]	f	2019-03-07 15:38:57	2019-03-07 15:38:57	2020-03-07 15:38:57
98ceb1cc0a7c887e8f27e47928e25a68118d36ef4590ebeccb2122ba12782d772d954bdbeed5860f	36	1	MyApp	[]	f	2019-03-07 15:47:58	2019-03-07 15:47:58	2020-03-07 15:47:58
e70e5d4c2ac75a7312edb3fdc4a77bfacbd5e4e3e184f646627d83a64ce81ed442085501664be939	36	1	MyApp	[]	f	2019-03-07 15:56:20	2019-03-07 15:56:20	2020-03-07 15:56:20
9b93a548ea0d0125140c1431f98c146b8f4faa5926f089d7e3b695db8233de76125ea1a3fe186f34	36	1	MyApp	[]	f	2019-03-08 11:48:31	2019-03-08 11:48:31	2020-03-08 11:48:31
aab281a19611db5f7385603c9c8bf1b261607959352529563ca9c3f3beb40e66e4a8c7ec8529723c	36	1	MyApp	[]	f	2019-03-08 14:00:03	2019-03-08 14:00:03	2020-03-08 14:00:03
fcde7157a761dc72df547e53ad169ce2e84e65913a283774873dbcacaa2dd7e927db7198586e7e14	36	1	MyApp	[]	f	2019-03-08 14:18:55	2019-03-08 14:18:55	2020-03-08 14:18:55
ab70cfd3ea1d483300a15f7acaf07d1d00cbc811c2425ccda4589ce3a90545d7657c129dc90ea61f	36	1	MyApp	[]	f	2019-03-09 03:28:41	2019-03-09 03:28:41	2020-03-09 03:28:41
3e642f3804dfd233822904e1fd6171d256de1f36781a2650c872c3cf6b6e7ab5017cd00cbcd9714f	36	1	MyApp	[]	f	2019-03-11 13:43:47	2019-03-11 13:43:47	2020-03-11 13:43:47
34b363bd84bcb0b09afaed7ee3c320ebabbb0a00aff262b7ffa249a0eb1bff15aaae451a75272fa1	36	1	MyApp	[]	f	2019-03-11 16:54:10	2019-03-11 16:54:10	2020-03-11 16:54:10
414b5c89835f06dc3d0ceb0fa917f32075cf643d6272176c658fe378dc78267d3cdd5c12491eb1fe	36	1	MyApp	[]	f	2019-03-11 17:14:30	2019-03-11 17:14:30	2020-03-11 17:14:30
4ffc975f4059278dfec15c84b993fb3802e2dbbe1d5b78d82b4e24e6c39c4b65a8e649ccc458c3f4	36	1	MyApp	[]	f	2019-03-11 17:17:33	2019-03-11 17:17:33	2020-03-11 17:17:33
98cf087ee65cff11661891e93140087199e4542b0228c397dd89f4f1fa88b3a2b0e276d9547929d2	36	1	MyApp	[]	f	2019-03-11 17:18:49	2019-03-11 17:18:49	2020-03-11 17:18:49
abe4fff8f2330872b7d33ec9ce3a31cbfc82a0ce78703fa789065b27122b8f1fabba0ddd7c32dbf5	36	1	MyApp	[]	f	2019-03-11 17:18:54	2019-03-11 17:18:54	2020-03-11 17:18:54
6a57a4818940586cf0eef6d7bc8a9e02cddbf2f0ebc718c185cf1998cbb0218096872bb13448680a	36	1	MyApp	[]	f	2019-03-11 17:23:52	2019-03-11 17:23:52	2020-03-11 17:23:52
0aa5d8bc041cbb133cfce2b85dffb7c72e55029e7293a40888f32abd0833470da7e7c6c83bf9e652	36	1	MyApp	[]	f	2019-03-11 17:33:13	2019-03-11 17:33:13	2020-03-11 17:33:13
b1552eae7493187487ac8cf2e1a854cabefc8b6bd2c50bf986a311e4fdd345eb23de146ab4e5979b	36	1	MyApp	[]	f	2019-03-11 17:33:50	2019-03-11 17:33:50	2020-03-11 17:33:50
e3232b68b10037705140d453137da9aebc1212e99dabc0db2e992e24fb4d7b2cc23db2decc1e4e15	36	1	MyApp	[]	f	2019-03-12 01:21:41	2019-03-12 01:21:41	2020-03-12 01:21:41
002f033e0e08d9737beef2d0231da1cbe0cf0e6ea492b38a16de500164b8372c919e3b848d7ef3e0	36	1	MyApp	[]	f	2019-03-12 13:56:53	2019-03-12 13:56:53	2020-03-12 13:56:53
3b1e12b9232e454397f72a873a90215eceba765cd029db45611e1b988e9a6d942fbab29169f0b2f0	36	1	MyApp	[]	f	2019-03-12 14:58:18	2019-03-12 14:58:18	2020-03-12 14:58:18
629bedfb010e34498c0db1db7d5b533ee7f8dcdd490eff67ae36dbb290c157b7470e751c35e80461	36	1	MyApp	[]	f	2019-03-12 16:16:57	2019-03-12 16:16:57	2020-03-12 16:16:57
df8c96cd3ec54ed6a2cb25b0cd80714ffe9f70a647e6a3ed1f96d797e3eebf19db78c61b912224d2	36	1	MyApp	[]	f	2019-03-13 13:29:48	2019-03-13 13:29:48	2020-03-13 13:29:48
deabb8a6e0b07ff303083bc92c52d264d51b02c04ad511d2797144d5f73fceb3a908d3e1791aaab8	36	1	MyApp	[]	f	2019-03-13 14:09:34	2019-03-13 14:09:34	2020-03-13 14:09:34
45637360bd4c3858632edcb106ca5edb22be94dc10aa6c9bcb9735b8b320e2f028029266e448412b	36	1	MyApp	[]	f	2019-03-13 14:45:55	2019-03-13 14:45:55	2020-03-13 14:45:55
4701e5e3c47015c123c0a01779a1500c1a6756948b631095630d4bb83622082e2a50f39cc6d17c4c	36	1	MyApp	[]	f	2019-03-14 11:17:35	2019-03-14 11:17:35	2020-03-14 11:17:35
c50111846aa834157d36005b8aa0a894171b9a74daebf2fc83a6516a091a4ad94a70de0f4a77c157	36	1	MyApp	[]	f	2019-03-14 14:21:06	2019-03-14 14:21:06	2020-03-14 14:21:06
a22269b06add098c7cca406e256e37fa3c5d2fc7aa56a5986699b78cd940365a890bb5a6083c269c	36	1	MyApp	[]	f	2019-03-14 15:49:26	2019-03-14 15:49:26	2020-03-14 15:49:26
97545d8cfc86246af039d28020e12210ac386a7030bb06341d77c42cc4508824727cf5be666a4cb7	36	1	MyApp	[]	f	2019-03-15 13:56:59	2019-03-15 13:56:59	2020-03-15 13:56:59
a68ee091c33fd36e497cdc9148b34ff3627d96d71a7ab12303634cf8772bbc7b2453962763163643	36	1	MyApp	[]	f	2019-03-15 14:14:38	2019-03-15 14:14:38	2020-03-15 14:14:38
e12ed03b60ff7ef4e03e2ef1d304359903519923fe68c5144343e9722f62a66afbaa2b8bd6c3dcb1	36	1	MyApp	[]	f	2019-03-15 14:20:37	2019-03-15 14:20:37	2020-03-15 14:20:37
653ebfa894d267c78647e1ceddb9730a7baf6324cf037c05543754126ff2a368a2d234c2c784a06d	36	1	MyApp	[]	f	2019-03-15 14:21:07	2019-03-15 14:21:07	2020-03-15 14:21:07
293c946c3435b8a7da81f8b4918314b33b57ae5df2e4c680489c515d71f2c36e9232358bb01420f0	36	1	MyApp	[]	f	2019-03-15 15:27:03	2019-03-15 15:27:03	2020-03-15 15:27:03
b5848fe2160d4fedfd4742ef1c7b9484fe53066c5f97dce399cb780459400474f38fb3aa358b32e7	36	1	MyApp	[]	f	2019-03-15 16:24:21	2019-03-15 16:24:21	2020-03-15 16:24:21
2a373e17b03e3b76bc1bc29b88dfdc16989f7436449c5f7a0798af4471fe6245b8a72303d72e5f65	36	1	MyApp	[]	f	2019-03-15 16:39:35	2019-03-15 16:39:35	2020-03-15 16:39:35
ce22c27dd7b88d0a2c7290dbc0971d75cadb7e09d7a60d087077290898a5ec631434d690225b0041	36	1	MyApp	[]	f	2019-03-15 17:28:30	2019-03-15 17:28:30	2020-03-15 17:28:30
5db5ca2ce24bc6a79116eb74bf3bdaaa64a19beebed5f6303c923ee67f2545e724b37ad0019cd2e0	36	1	MyApp	[]	f	2019-03-15 22:41:27	2019-03-15 22:41:27	2020-03-15 22:41:27
6b9c1bf382ad71196d550111f1b664fbe3e495dd750541556bee326c789d26066049e15c613d90dc	36	1	MyApp	[]	f	2019-03-18 13:49:11	2019-03-18 13:49:11	2020-03-18 13:49:11
ba967cb2e67b3bc6eb70adddc67ec6ccc4c060bb41456c61346e77e1f05efab29f18678897298985	36	1	MyApp	[]	f	2019-03-18 14:10:16	2019-03-18 14:10:16	2020-03-18 14:10:16
35040c05b15c0d2a657d501dd07823a905d55c449864411447896adbf7f60c9e5182df01d8ad6122	36	1	MyApp	[]	f	2019-03-18 14:36:14	2019-03-18 14:36:14	2020-03-18 14:36:14
6599c8ad74e325d03dbc27b0eade746ba07acfccfef5004aa0aac64af05182af45ba4077331256a8	36	1	MyApp	[]	f	2019-03-19 13:44:15	2019-03-19 13:44:15	2020-03-19 13:44:15
dac73eb517448d10e8e60794be157c1407533deb1cc6db18a3fc0acc19281f641004f0744f355801	36	1	MyApp	[]	f	2019-03-19 13:45:44	2019-03-19 13:45:44	2020-03-19 13:45:44
b61df9b13c81663eac38e25085512b525b161aada4b30d52b8138b135eb6e94661bd470971336a89	36	1	MyApp	[]	f	2019-03-19 14:50:46	2019-03-19 14:50:46	2020-03-19 14:50:46
0538ceea5e08ad6dd9553d2ccaa072caf8f9ec0f45ab00903b1352fe0e570b32b380e9e479059dde	36	1	MyApp	[]	f	2019-03-19 16:06:36	2019-03-19 16:06:36	2020-03-19 16:06:36
fb858eb2f31e011f44c145e4dc636185feb3b8fe83029b0f5f1aed0e8b6b5d9dcad8a99e7e934500	36	1	MyApp	[]	f	2019-03-19 16:06:56	2019-03-19 16:06:56	2020-03-19 16:06:56
eab0dcf9d03f3278d69b1d4d67b5950ae792123614d159ba0aa754e22f8fa9db3ab6168fcaf10e40	36	1	MyApp	[]	f	2019-03-19 16:07:09	2019-03-19 16:07:09	2020-03-19 16:07:09
adbf11189d9b404b40a26724d9037fe8d072e1a04bc1425988929063e804cc64ddba9bf407d29de6	36	1	MyApp	[]	f	2019-03-19 16:12:11	2019-03-19 16:12:11	2020-03-19 16:12:11
a0ee699476bf9edf8d9b4459eb2d04e682d8706a1a5b36e961934d1b50b9549156cb7226ea7d9ac7	36	1	MyApp	[]	f	2019-03-19 16:16:06	2019-03-19 16:16:06	2020-03-19 16:16:06
04d995da494f75c940e98346695fc216730451d76a453cf3d0cfd544babc35aaa466e447cfe3aa2d	36	1	MyApp	[]	f	2019-03-19 16:18:47	2019-03-19 16:18:47	2020-03-19 16:18:47
15b129e8e222d1a500f09dad7077a618bfbaa45627a03fad86ac653c41c9d560f0d0772ce8dd844c	36	1	MyApp	[]	f	2019-03-19 16:27:34	2019-03-19 16:27:34	2020-03-19 16:27:34
7c3a44f98b725f8adb8172116a9c9c0315171b633ee1b5092ae0c1c8a8cbbb4d5be2d62f8dc1b234	36	1	MyApp	[]	f	2019-03-19 16:29:16	2019-03-19 16:29:16	2020-03-19 16:29:16
7f25bb4f0dfc382c2e4b7f732a83c3431a1e51288696b8e25ee5e6fc79eb0af23974682fae72c86a	36	1	MyApp	[]	f	2019-03-19 16:45:31	2019-03-19 16:45:31	2020-03-19 16:45:31
600538aa25a1c729512f2636fc195acca5a67488ac6be3bce4ca28a4854cbfc820b835f375e0dd30	36	1	MyApp	[]	f	2019-03-19 16:46:11	2019-03-19 16:46:11	2020-03-19 16:46:11
976281375594850533cfcea6751365d8e004a9f95c701c331f35cfa6b1205aba25bd0304a3f67937	36	1	MyApp	[]	f	2019-03-19 16:48:53	2019-03-19 16:48:53	2020-03-19 16:48:53
b78d3d3a83e570460c145a18f0b407bb2e6732ec480a7559ab3a8ab986603637acd23fe45daefeff	36	1	MyApp	[]	f	2019-03-19 16:54:07	2019-03-19 16:54:07	2020-03-19 16:54:07
93bdb56ccff34793cfb660c7c8c629b1eff4cbc28ac0896ce358f9bc6c93769abeb1ebf5c183f18e	36	1	MyApp	[]	f	2019-03-19 16:57:37	2019-03-19 16:57:37	2020-03-19 16:57:37
db27b564bdfda7733a4ac35a6d1644c82c3026d18f395ea6e515ad50995e353008cdc1f2b374687f	36	1	MyApp	[]	f	2019-03-19 16:59:28	2019-03-19 16:59:28	2020-03-19 16:59:28
3faee6260b8d032eab34c8b932670929d9dd633bbbacd93e0c850d09202a37f0102494ccb3cdc37c	36	1	MyApp	[]	f	2019-03-19 16:59:28	2019-03-19 16:59:28	2020-03-19 16:59:28
0d6604b267153492680cb525dea16dec7680ec01c3b0f3c4b69e56b5aa1e1a377f9ca4d00a68dfa5	36	1	MyApp	[]	f	2019-03-19 16:59:43	2019-03-19 16:59:43	2020-03-19 16:59:43
bfe89a4edf82e044ac034087cee44c059004e56828ff8cb01f3f3805c60ab2c84782fb12d14c3c50	36	1	MyApp	[]	f	2019-03-19 17:02:07	2019-03-19 17:02:07	2020-03-19 17:02:07
05db6b9a2690d50610f34d42a833fe0fc2c1c7307665be92144171b8c2a27c22bd58cdffab4eeb92	36	1	MyApp	[]	f	2019-03-19 17:02:24	2019-03-19 17:02:24	2020-03-19 17:02:24
2e7e074ba116cd91ffea1e20aa49c35144d8e9745f74251e0ca2e36c8eb977e1914c8568f926d101	36	1	MyApp	[]	f	2019-03-19 17:03:29	2019-03-19 17:03:29	2020-03-19 17:03:29
d78c04134932990ca001d791889bc7aa626d236f95291705b87dad5e26a907bab459b5bb5e071bdc	36	1	MyApp	[]	f	2019-03-19 17:36:31	2019-03-19 17:36:31	2020-03-19 17:36:31
7e998edb946c99f1886a16b92cdc52d1b0e03d80e6b7e72e8647a560ebf3564466f1653bc71272ed	36	1	MyApp	[]	f	2019-03-20 14:22:00	2019-03-20 14:22:00	2020-03-20 14:22:00
9f4853619bb877d58e3749211816adc586fa2ddfca340b4604af1ebc024c1208425b48d87c63eebd	36	1	MyApp	[]	f	2019-03-20 14:35:12	2019-03-20 14:35:12	2020-03-20 14:35:12
a30173c02154ff7106870cf25dd939e751907a160db9287debc3643a7d230d783ba802b5e178f67c	36	1	MyApp	[]	f	2019-03-20 14:35:19	2019-03-20 14:35:19	2020-03-20 14:35:19
3f813adb3780540f66d0a691a86570108cd400dfec1e5480f3a44eabb9e283edfd5b99f524b347ae	36	1	MyApp	[]	f	2019-03-20 14:35:22	2019-03-20 14:35:22	2020-03-20 14:35:22
80593f09c00ab42a3722055addb8afb0cea3cc6b8c9f9a8d0f5a02c53fcf9c33f02b38e51ca75b69	36	1	MyApp	[]	f	2019-03-20 14:50:59	2019-03-20 14:50:59	2020-03-20 14:50:59
ada551c05fc607b5e2f151d4eef02ec5793de3aa432be8cacf84600a0dd812213319409dae2be4bf	36	1	MyApp	[]	f	2019-03-20 15:08:28	2019-03-20 15:08:28	2020-03-20 15:08:28
2b334fb3d912c95019245136ebe79dcd2067c3a05a988d83f724a129e58b754a7c6867e4cad77a55	36	1	MyApp	[]	f	2019-03-20 15:23:26	2019-03-20 15:23:26	2020-03-20 15:23:26
17b3e406218615b6b27ce86e2abe2362f5b93070fe3652cdd5991d8194df3999972b03b36c36a688	36	1	MyApp	[]	f	2019-03-20 15:27:23	2019-03-20 15:27:23	2020-03-20 15:27:23
4cc5dcb33ef27e35e995767f8d78b5f648a6595e96a37da21cebbc274893650c0abd144ae130907c	36	1	MyApp	[]	f	2019-03-20 21:12:35	2019-03-20 21:12:35	2020-03-20 21:12:35
0034e8dc5d9faaa0de5e2bcc240d0889eb240cf2a0b421c735e2854b994d565eb2f7c9add13400e1	36	1	MyApp	[]	f	2019-03-20 21:12:36	2019-03-20 21:12:36	2020-03-20 21:12:36
4a83e038063953fa6b53cfd42451ced665df05a381015679b7d4b56eb18fd5075f474070f844d5bf	36	1	MyApp	[]	f	2019-03-20 21:15:07	2019-03-20 21:15:07	2020-03-20 21:15:07
eef99ff0cb630f4962f2c8399416310017e453239dfe146322d6a5a6134284d1b8952203c6f1a449	36	1	MyApp	[]	f	2019-03-20 21:15:13	2019-03-20 21:15:13	2020-03-20 21:15:13
ea7ec4ed15e9f366d3d946cd9789781b2c8402aa642cd7377e96e59e45162851548549909fca3c39	36	1	MyApp	[]	f	2019-03-20 21:18:53	2019-03-20 21:18:53	2020-03-20 21:18:53
fe41b31297a830fd0fa04110a603f1cc93d13212f5998fe7101d2db97cf9be821a9f1db132383d64	36	1	MyApp	[]	f	2019-03-20 21:27:25	2019-03-20 21:27:25	2020-03-20 21:27:25
af814f5fb5b40ff89ce06b465410d2a96cea142e4e29e9b7efd41f42791001b9dde715c1c7006a20	36	1	MyApp	[]	f	2019-03-21 00:11:07	2019-03-21 00:11:07	2020-03-21 00:11:07
6d87265d394ef9ec2eeba257988dd27b1d179521112cd4688c53633cc073766db9ed6674bcfa9fd4	36	1	MyApp	[]	f	2019-03-21 00:13:19	2019-03-21 00:13:19	2020-03-21 00:13:19
6b9184e5c78380ab6b90bc293c1fffbf0c2633fbe0745025baa86eda128c99668dab5e0dda148609	36	1	MyApp	[]	f	2019-03-21 00:34:10	2019-03-21 00:34:10	2020-03-21 00:34:10
7eeb799c97eed0f04c43d8968dd71cf9d29f65c467c742dc801845f9532a75e715fc6bdfa79b08ae	36	1	MyApp	[]	f	2019-03-21 00:38:05	2019-03-21 00:38:05	2020-03-21 00:38:05
ce2ede37125555a57e61925ea0b0057283520a670fd973d84e409f86398650059d3e6869183e4107	36	1	MyApp	[]	f	2019-03-21 00:50:40	2019-03-21 00:50:40	2020-03-21 00:50:40
1e4b12579fcc3a73fea0e98cdc4d8b308f31a1d06d7d107002a4668862bb3267a843806b7f23fb0a	36	1	MyApp	[]	f	2019-03-21 11:06:20	2019-03-21 11:06:20	2020-03-21 11:06:20
8a1c4c63ac32e6e1d1a9a785db99780ef78dbb2d74d74cc62f39b33b024a408815960f07275a085e	36	1	MyApp	[]	f	2019-03-21 14:01:41	2019-03-21 14:01:41	2020-03-21 14:01:41
4e65b42becf61d2dfcdb5691b531972e2761139fdbbe9aaefcd2898f9d1fff00b94eb5be6768ade1	36	1	MyApp	[]	f	2019-03-21 15:40:51	2019-03-21 15:40:51	2020-03-21 15:40:51
9ffb5df42dfd703e3c37f5c8ae705cf539b6bfe5ffb6fc60d53f301848b95e29287cb024e387cc3f	36	1	MyApp	[]	f	2019-03-21 15:41:21	2019-03-21 15:41:21	2020-03-21 15:41:21
eb3ebb3ad30f4937d1ed97b848a08daf94ad17b40c8547294c3d81c13f0500370ef325e28cc62c90	36	1	MyApp	[]	f	2019-03-21 16:33:33	2019-03-21 16:33:33	2020-03-21 16:33:33
c632bbcd8bed7faee90adf5af1351ced83d2135723740622a5cd35b5e846d1cd449e3160ec92f35c	36	1	MyApp	[]	f	2019-03-21 16:39:14	2019-03-21 16:39:14	2020-03-21 16:39:14
b997562453c809f33fcc82c5fbc5928d980fb9ea3a2d1c92a2c5a4e13a808aa9248052c3f3ae47a6	36	1	MyApp	[]	f	2019-03-21 16:40:04	2019-03-21 16:40:04	2020-03-21 16:40:04
7e877b43b46dd5b494b20bc4f751e8218f6dc775db75d78b46135c8897e39f0ccb5a7dab60736ebd	36	1	MyApp	[]	f	2019-03-21 17:18:20	2019-03-21 17:18:20	2020-03-21 17:18:20
51b517938c35c440a06bd484d63222d351d874af660b815e69d53b1ec781b24ec6788fc3a7d8b838	36	1	MyApp	[]	f	2019-03-21 17:46:11	2019-03-21 17:46:11	2020-03-21 17:46:11
10feba1e958978e9d8bc723907ba470fd823b612728aa37a2e0808d1d7d69af189a3b5349ac5bfee	36	1	MyApp	[]	f	2019-03-22 13:45:39	2019-03-22 13:45:39	2020-03-22 13:45:39
58c1332782ebc797c8742ed14e9bc8cbd462f6f90e75aa4034783b1f91fa10a6c025e4a9452ea952	36	1	MyApp	[]	f	2019-03-22 13:49:05	2019-03-22 13:49:05	2020-03-22 13:49:05
82e51cc361f5c0fd9e747858086082e37f7f3c2b0db592917142b0afeb7bbbfcd82a71c42cae62c3	36	3	MyApp	[]	f	2019-06-25 09:29:37	2019-06-25 09:29:37	2020-06-25 09:29:37
c5f2c95e245770bdb9feac31c834dc0f3f674d0aeaff506cc4a07416cf2fe95e0b8bc60da2fee644	36	1	MyApp	[]	f	2019-03-22 13:57:30	2019-03-22 13:57:30	2020-03-22 13:57:30
619eebd16fd3b426b2ccda5c1919b7f0dfcec0425307be11b3fb7fa68dd9d1b4b152ac1f4def3c3f	36	1	MyApp	[]	f	2019-03-22 14:02:01	2019-03-22 14:02:01	2020-03-22 14:02:01
e7d3ea8728806822445ed40ad01237db9730af56fc712f86567c145257a6354befc2e639ef66ac88	36	1	MyApp	[]	f	2019-03-22 14:05:58	2019-03-22 14:05:58	2020-03-22 14:05:58
b1653d8addd4adcb898de63bb9245daf744f0f92c207abcf761341976133951a4eaf94538346c859	36	1	MyApp	[]	f	2019-03-22 15:48:35	2019-03-22 15:48:35	2020-03-22 15:48:35
99225a85d96322e60af110047d28659826c864b1d6c938e24f9e977929d8f0d6ba4a53428bb88dde	36	1	MyApp	[]	f	2019-03-22 15:49:48	2019-03-22 15:49:48	2020-03-22 15:49:48
360bbc52d67dade1a6d81f0d65a7f6bdb4f83e57529a5233a5c1969a197a8b4655a7941015fb494f	36	1	MyApp	[]	f	2019-03-22 16:41:18	2019-03-22 16:41:18	2020-03-22 16:41:18
81c789ec3d98c3c34ea4fbf7b79bf4954870dfe4831dbf79097946a9422683512f6b2192663fc70f	36	1	MyApp	[]	f	2019-03-22 17:04:33	2019-03-22 17:04:33	2020-03-22 17:04:33
ba313772b1cc5024b8dde067e4b710284c223ad9fdf0f1a257ab00280ab79f44a601a46c2ef9c60c	36	1	MyApp	[]	f	2019-03-25 13:49:28	2019-03-25 13:49:28	2020-03-25 13:49:28
5d77363938a2e7a1926c45b552981bc3c2509e35e086be208abee4b3a24f06710fdc74a6d550bcda	36	1	MyApp	[]	f	2019-03-25 14:01:23	2019-03-25 14:01:23	2020-03-25 14:01:23
808c6488c52371c786466a6d939a08cea1547d091e3d4ce52153d80de6ed482d2f077e824a991e4c	36	1	MyApp	[]	f	2019-03-25 14:01:33	2019-03-25 14:01:33	2020-03-25 14:01:33
0619ec02849d81353b8b287317aacdeabd74a4a0b5c76643df729b811252cd980147a695363edf40	36	1	MyApp	[]	f	2019-03-25 17:36:23	2019-03-25 17:36:23	2020-03-25 17:36:23
ef97f4a3ce2e2c526c50f9624e04ed834823e52b2d26cb38d786e98d20f44b10eede1583a76b30ac	36	1	MyApp	[]	f	2019-03-26 10:34:09	2019-03-26 10:34:09	2020-03-26 10:34:09
02cb000bbcdb65f70ba29c4b802a5f5f80e5da12a24e299fdb5b140151954cc69572526615a9f57e	36	1	MyApp	[]	f	2019-03-26 13:52:39	2019-03-26 13:52:39	2020-03-26 13:52:39
4785127fa4f275f0313c038475c9ef181ab7cfc2f8daf2465efa53379e2f3d83dd015010c6796b7a	36	1	MyApp	[]	f	2019-03-26 13:54:22	2019-03-26 13:54:22	2020-03-26 13:54:22
de35aa9302ebcfcc4b520c233645c47dca17483c72ef930e0e8d10ebcca5cbe5e267e2597ed6f2ca	36	1	MyApp	[]	f	2019-03-26 14:05:18	2019-03-26 14:05:18	2020-03-26 14:05:18
c759a67fbce2c21d680ccf86a2af56a8cfa7385111d9f9e68b54b5675b961b522855bde220ce7bd4	36	1	MyApp	[]	f	2019-03-26 14:16:45	2019-03-26 14:16:45	2020-03-26 14:16:45
a3ee1258b0c219d89ba5d1c9f9bb3fac2d6e1ea3734cfaa6e64a97ab6159cb1f87b9bc9566369a02	36	1	MyApp	[]	f	2019-03-26 16:20:57	2019-03-26 16:20:57	2020-03-26 16:20:57
f2a73a46df6f4654a523080d187b96d6603d7e13e74ed9da10108276d0c2079aadb4b31d6d742502	36	1	MyApp	[]	f	2019-03-27 10:42:01	2019-03-27 10:42:01	2020-03-27 10:42:01
7026a84776a7687a1f2f61b361b6ca438e6cfc2a787f2b7945cd828745f9410b641487f356c65632	36	1	MyApp	[]	f	2019-03-27 13:48:24	2019-03-27 13:48:24	2020-03-27 13:48:24
b0421dac4a3286a5d58ce944c17a949b2fc3ed667224204f96af589fd8adc6a0baeba8f0dd2b59ae	36	1	MyApp	[]	f	2019-03-27 13:48:31	2019-03-27 13:48:31	2020-03-27 13:48:31
14a70afb6d8fd0dab643af4ae67069cfe5b700169935202862e3f4886eeb1f41901b172baa84d4fe	36	1	MyApp	[]	f	2019-03-27 15:33:16	2019-03-27 15:33:16	2020-03-27 15:33:16
ece8071b1e9322f7de21a8b15b4b7f794e68c7e303e52b917b2baa809948d40ec3cc17dc2fb06879	36	1	MyApp	[]	f	2019-03-27 15:37:48	2019-03-27 15:37:48	2020-03-27 15:37:48
840b59421b8252e20620a17705e7b4fa448e7c63a9105973f1ee2bc655b760469afb8c4886614d02	36	1	MyApp	[]	f	2019-03-27 15:48:23	2019-03-27 15:48:23	2020-03-27 15:48:23
376e929fbfc1d97f9af1d4596229765fff16bffb3218d64329aec7e382438223e2cb931ef95954fd	36	1	MyApp	[]	f	2019-03-28 13:38:38	2019-03-28 13:38:38	2020-03-28 13:38:38
949c4205407c28558be870bb6218db8b630bb42f3d1a6e006727cd1a6bddd74e65055d0f9319a00b	36	1	MyApp	[]	f	2019-03-28 13:38:45	2019-03-28 13:38:45	2020-03-28 13:38:45
7532986b80297ebc0d33af5b5dcf9746110c81f5b531f6ef35bc35c3865a640714a8ad34860f746a	36	1	MyApp	[]	f	2019-03-29 13:54:08	2019-03-29 13:54:08	2020-03-29 13:54:08
ba0f6fccd425468b5da61ff316b61b9644787c9833ad79469902c8cf860c2bd6eb4c8dd2001e645c	36	1	MyApp	[]	f	2019-03-29 14:12:10	2019-03-29 14:12:10	2020-03-29 14:12:10
32c373e92b7eb45bebd3e811664d8671f4ea99dccf7efdd6ac2a06f9ce31cdda3ea4a1809845bcc1	36	1	MyApp	[]	f	2019-03-29 16:03:49	2019-03-29 16:03:49	2020-03-29 16:03:49
da02b813c6c84f6cf9aa3b6fc86ddd31f31c5fea5d6c75352a79caf97fce9bcb75c0407c08ebcaa3	36	1	MyApp	[]	f	2019-04-01 10:22:42	2019-04-01 10:22:42	2020-04-01 10:22:42
0e7a20d4ee21711f38a43ae6076bbfa0ae218c912a15b4ca309973575bcc304d94895c233ae1cdc9	36	1	MyApp	[]	f	2019-04-01 13:34:49	2019-04-01 13:34:49	2020-04-01 13:34:49
95d6a30c1a1ee412ba21acd9e5674246430c996af14aaa04026659d85ed8c5c224ab64bb7f569844	36	1	MyApp	[]	f	2019-04-01 13:34:57	2019-04-01 13:34:57	2020-04-01 13:34:57
4659de914e932e155d88f0f9ca3a1ea32fa9300f15833398f6d49c572a903f875c689b1339f616bb	36	1	MyApp	[]	f	2019-04-01 14:54:38	2019-04-01 14:54:38	2020-04-01 14:54:38
fcffe880f75d822c41e2300557b7704a12c39d4f8ff8fd74bd33c369ce3b0eda3f1956b3b9dda294	36	1	MyApp	[]	f	2019-04-01 15:02:30	2019-04-01 15:02:30	2020-04-01 15:02:30
e28cab2d1bf06476d2c097620ba26e7aada2e4c5f4cd1467162d2ec1012844dd3d5651a9dd7a5ea2	36	1	MyApp	[]	f	2019-04-01 15:02:34	2019-04-01 15:02:34	2020-04-01 15:02:34
b771f9cefbf10837673d37c64aabb24b9ed05244822377ac44f5f93738ad42d58d1aa022ee449b22	36	1	MyApp	[]	f	2019-04-01 15:32:21	2019-04-01 15:32:21	2020-04-01 15:32:21
31387663b66aa7bb4763019c2285e1a7728d955924dc7d82242690d8d03bbc0da36e2cd6fffd07d3	36	1	MyApp	[]	f	2019-04-02 10:53:26	2019-04-02 10:53:26	2020-04-02 10:53:26
4835c704847bbea7a15c7d85c964159b410e6b093b841daf4e86c95f32cd5e0ee40013080a884d0a	36	1	MyApp	[]	f	2019-04-02 11:26:08	2019-04-02 11:26:08	2020-04-02 11:26:08
a8eff2c8db24621cf4c2435642b61b71f14a43b8fdc898ac57fa2e989324f8c7a5cbe86fff934876	36	1	MyApp	[]	f	2019-04-02 13:34:32	2019-04-02 13:34:32	2020-04-02 13:34:32
a57e47fb6b02e87fd5e9de2f0220b490ba074860eca39db6d5fb2be4a29469df9bd294bc76905ccf	36	1	MyApp	[]	f	2019-04-02 13:58:38	2019-04-02 13:58:38	2020-04-02 13:58:38
b38855b8067e29b9736868655d9527cbb13f4effadcef371aa8841ed733be39538cc53d1eed7039b	53	1	MyApp	[]	f	2019-04-02 14:54:15	2019-04-02 14:54:15	2020-04-02 14:54:15
428c5cd0f5eac694901cbb6db2e470754efa0dd71a22a24720d881cc6d338dc7db4c217346adb5a1	54	1	MyApp	[]	f	2019-04-02 14:55:07	2019-04-02 14:55:07	2020-04-02 14:55:07
f5ca46c62334d4ea9ec45abc5160ddeb4f18a929675126b1ffebcad421efb5c82810643c0af958bc	63	1	MyApp	[]	f	2019-04-02 15:03:36	2019-04-02 15:03:36	2020-04-02 15:03:36
61339efdd5d3b15dd050c13f3d39ac720dcda630498061c8511b5f74e45a87b4242ddb7309d4e551	66	1	MyApp	[]	f	2019-04-02 15:07:59	2019-04-02 15:07:59	2020-04-02 15:07:59
1368be9a3eaccede7f3d9a295aa5599c9437bdb9a3d600cb5dc80541541aabe321db9ad908a47267	67	1	MyApp	[]	f	2019-04-02 15:10:15	2019-04-02 15:10:15	2020-04-02 15:10:15
9c859a0e4d4b7e0113b62b3a1899558acc3b1743a41dea8ae9680200feb529b3112ace5424d80669	70	1	MyApp	[]	f	2019-04-02 15:20:45	2019-04-02 15:20:45	2020-04-02 15:20:45
25011b98e45a2f3fb51237df5c7abd61df6dd32b5d145bd3f6670ef308ee2b2d037df77890605998	71	1	MyApp	[]	f	2019-04-02 15:21:12	2019-04-02 15:21:12	2020-04-02 15:21:12
e56451380b4992cfc060a89575e2d68509682f7103c23930b7ccb7d505912496cee8e1d81e4b34c1	75	1	MyApp	[]	f	2019-04-02 15:21:46	2019-04-02 15:21:46	2020-04-02 15:21:46
d243ad9ee316114080cd8b2734d32859c1788e7a04160f633b0aa00036c62f25e858b4ef11e91d94	77	1	MyApp	[]	f	2019-04-02 15:22:03	2019-04-02 15:22:03	2020-04-02 15:22:03
c0de3fa4209f2bc6b4bcbb3c796c79dbf4ee1aaaca59e8f1bf87b57fc1baae42c5e789c709d06a5d	78	1	MyApp	[]	f	2019-04-02 15:22:30	2019-04-02 15:22:30	2020-04-02 15:22:30
fe490db4db118b9d8daaf6b933a8370181115b7d3bc599e0517aa5b65c8fd3de544b6371af98c2e0	81	1	MyApp	[]	f	2019-04-02 15:24:28	2019-04-02 15:24:28	2020-04-02 15:24:28
1d40f4f147aecb3828168f20c5372a64cdba68072210ce42b135c4ead511942d72508340fad6e952	82	1	MyApp	[]	f	2019-04-02 15:25:00	2019-04-02 15:25:00	2020-04-02 15:25:00
0148258ab69eaf53227867d92f24f4b9c70dedbcf1c67a13944ed0efa03cc353046bbd865e320582	84	1	MyApp	[]	f	2019-04-02 15:25:13	2019-04-02 15:25:13	2020-04-02 15:25:13
6b1de1f87632f77483b4f12046f58aa37685b51e737c79e323aca67f230174401e2d92fd6f995504	90	1	MyApp	[]	f	2019-04-02 15:27:04	2019-04-02 15:27:04	2020-04-02 15:27:04
b1dfbec747ce58d5d9f777e465bfe3f352d8a768cf6a9156f534f835b8a0042a6454efc6d5268d71	93	1	MyApp	[]	f	2019-04-02 15:30:07	2019-04-02 15:30:07	2020-04-02 15:30:07
fcd4559bbbb6fdff25334f8d0778045db078d22dd890846efbe6fa254ab48b5b40fe7d5dce3b198c	94	1	MyApp	[]	f	2019-04-02 15:30:55	2019-04-02 15:30:55	2020-04-02 15:30:55
a3b72c3d82b2d5916423914a31dccdde475685c201b2a7fc49dde1279568cb2b91b4b9dfb30b7725	97	1	MyApp	[]	f	2019-04-02 15:33:40	2019-04-02 15:33:40	2020-04-02 15:33:40
d000532ce6169c1c6bafb8ed2e1fbefe98c997337fb6d9a465c7e68efa467bfd35b454f65cb2640d	101	1	MyApp	[]	f	2019-04-02 15:37:08	2019-04-02 15:37:08	2020-04-02 15:37:08
059e89c03136a5dd292e86f684284d57e18ceafeadb2825ccb561e186505886e3b05a96849b0041b	110	1	MyApp	[]	f	2019-04-02 15:39:37	2019-04-02 15:39:37	2020-04-02 15:39:37
a8cee4b60199fa1899d08752dafc166c4b9c80a03e51247d8a5ee04d4102ec045716ee3cea6cc5c3	111	1	MyApp	[]	f	2019-04-02 15:40:25	2019-04-02 15:40:25	2020-04-02 15:40:25
7a6d370bcae80a8673a728d1f3c182d829227cb7c18a43f8e33c226d58952fbf427e1b607935635f	112	1	MyApp	[]	f	2019-04-02 15:44:59	2019-04-02 15:44:59	2020-04-02 15:44:59
342a92539a9caeec412b43602a17314ec5dfaa07c7a5c808a89abe66a28dd3ab5476bc25c1d06253	113	1	MyApp	[]	f	2019-04-02 15:45:37	2019-04-02 15:45:37	2020-04-02 15:45:37
38136aa8cb4fdc0d7a9631315128ed75b28248ac3d4296b90ddfa8ce0f3d69e6a6bc040cfb5cace0	114	1	MyApp	[]	f	2019-04-02 15:45:57	2019-04-02 15:45:57	2020-04-02 15:45:57
745cde6073df0fd34359d58c5e355fef596f5f2d42a3a57ee30d675b000e548e8bf33bb6e532b142	115	1	MyApp	[]	f	2019-04-02 15:46:41	2019-04-02 15:46:41	2020-04-02 15:46:41
00bbf25fa5ad0b80c20a07e00828dcaea25f9fab24c49b0a29ac4ce980d25ce3b22879f13c94d5fc	115	1	MyApp	[]	f	2019-04-02 15:47:07	2019-04-02 15:47:07	2020-04-02 15:47:07
de574700d0af008c7370a4d18a0622620b4fb84f8abe6e08fbfbb43aa19b34e6512f09579b85af2e	116	1	MyApp	[]	f	2019-04-02 15:47:58	2019-04-02 15:47:58	2020-04-02 15:47:58
4a693eda787852ae7b78a5b5ed9713cff6d99775db26d31487af2f45075ad16b4ae5b09792663969	116	1	MyApp	[]	f	2019-04-02 15:48:06	2019-04-02 15:48:06	2020-04-02 15:48:06
3e39663017b7bc5886016601abc98d262f7d4247e67fc4d836a1306b5f441b0fbd103a43361f8108	116	1	MyApp	[]	f	2019-04-02 15:49:12	2019-04-02 15:49:12	2020-04-02 15:49:12
fa331b86d3a333c4faaead398d341faa3657fdfcb1e2a7de7aa0debcfdc135a73434ff49d5ac512b	36	1	MyApp	[]	f	2019-04-02 15:49:27	2019-04-02 15:49:27	2020-04-02 15:49:27
c11b24e18ab6d23344bf3004459b7bbaab4301e4601429c7493891415a76ec4d811fa82855683370	36	1	MyApp	[]	f	2019-04-02 15:50:12	2019-04-02 15:50:12	2020-04-02 15:50:12
fe41ede1c0ab99b2b0d0c460535047943794dac826597f4b4596a52d9fb40c1914b8321bd66b0298	36	1	MyApp	[]	f	2019-04-02 15:50:25	2019-04-02 15:50:25	2020-04-02 15:50:25
5c20375c927f51890df9acba0d7fc81cd068a4842166abf7cccea77a06caa2df1e79dee609905f3f	117	1	MyApp	[]	f	2019-04-02 17:06:24	2019-04-02 17:06:24	2020-04-02 17:06:24
72638d57d837cd2f9db0ffd03b68d24b34a4f68e02a48b5e80145fe1b5c9c804f739914d127439f7	36	1	MyApp	[]	f	2019-04-03 12:12:18	2019-04-03 12:12:18	2020-04-03 12:12:18
e906d7c2ea2e6653a8436e8d0b719d80696d25a3004c3d3dcac308e9ef2c15556d5688bdb11bf221	36	1	MyApp	[]	f	2019-04-03 13:50:41	2019-04-03 13:50:41	2020-04-03 13:50:41
8f758d7456901b47842674d1c6ccf515481cdbaecabd6e67d9be7ef03e9733b2eba9e4ee15fe88ae	36	1	MyApp	[]	f	2019-04-03 13:50:44	2019-04-03 13:50:44	2020-04-03 13:50:44
7561edf81274354219e9820eb4663b88eed413995368cb75ccdfe0b2f527022e6c4d4ff4b8e01cd7	36	1	MyApp	[]	f	2019-04-03 15:56:46	2019-04-03 15:56:46	2020-04-03 15:56:46
8897154339f3518cb0b7db1854d14ac3498c42070ac7aab179df701e3f73d83bcb5f3ccb0ab387ae	36	1	MyApp	[]	f	2019-04-04 10:27:37	2019-04-04 10:27:37	2020-04-04 10:27:37
5adf1184f2b813fe1e2ea2618cf4c991cae098ca548fd8d0864afb1a6bc1a9bbf1f6913844dd76a9	36	1	MyApp	[]	f	2019-04-04 13:37:29	2019-04-04 13:37:29	2020-04-04 13:37:29
f2f83a041f27e7e37f965fadf0ab3494f1916cb5d574f285c9e25cb1f2fb9090a471dd08179fa094	36	1	MyApp	[]	f	2019-04-04 13:37:52	2019-04-04 13:37:52	2020-04-04 13:37:52
d9938e1691db00c14206f14b683e1001b76ca5c90a3fb838e897ae35b89b31231a44b6494fb83923	36	1	MyApp	[]	f	2019-04-04 13:52:04	2019-04-04 13:52:04	2020-04-04 13:52:04
b1d6b65d9ad5a089c8aaa550ab1b3573f876dfb6812b5b48d17921d745e8a34e05e4d8f7daecbc09	36	1	MyApp	[]	f	2019-04-04 15:17:19	2019-04-04 15:17:19	2020-04-04 15:17:19
412ce37e13082f204ec1470f922759937e2732661cc856170982fa53d26ff8c5897de5b612d4a021	36	1	MyApp	[]	f	2019-04-04 16:34:15	2019-04-04 16:34:15	2020-04-04 16:34:15
cff48166c8efbe9ffa0a6908fd75f5ddd72111857064e038eb8b874b772c93e88b59e66566f4139e	116	1	MyApp	[]	f	2019-04-04 16:47:12	2019-04-04 16:47:12	2020-04-04 16:47:12
2c7a9475f21805322d6308f663fa7b348955e680f89ee2a2bff835dd89a955de1e225a31f96faf44	116	1	MyApp	[]	f	2019-04-04 16:47:28	2019-04-04 16:47:28	2020-04-04 16:47:28
23e8782f082a787e717e3e6357d65ad62558a934592f3ff3a2a41ad669ac96ac107fee3660e1963e	116	1	MyApp	[]	f	2019-04-04 16:49:30	2019-04-04 16:49:30	2020-04-04 16:49:30
6eb09d2568545086e1639d5f42084b544a77c8169b723a2d5a21a0b37ff89939c9d40d3f27db709e	116	1	MyApp	[]	f	2019-04-04 16:52:09	2019-04-04 16:52:09	2020-04-04 16:52:09
c9350c477a0b2b072ace703b0a5f210ade053311ca38d5cdcd1f814a67f4f6de0b63cf05b6c01f29	116	1	MyApp	[]	f	2019-04-04 16:56:35	2019-04-04 16:56:35	2020-04-04 16:56:35
83f841ff9a9c325aa42b47af6033392fb7efac614a265fd58e5b608a1ed64fa2276b5ca31b678f00	116	1	MyApp	[]	f	2019-04-04 17:04:24	2019-04-04 17:04:24	2020-04-04 17:04:24
67224e5cdd9b6e5d640a7b46fdd7d171cd4916386a6faebd5bb823790bffac6b2b2a27931fa1e773	116	1	MyApp	[]	f	2019-04-04 17:07:57	2019-04-04 17:07:57	2020-04-04 17:07:57
1c73d9ee05cb1b51fa3e78ac536a20608bf59ac665384f16398245f4e476b4b9054954388565b20e	116	1	MyApp	[]	f	2019-04-04 17:10:06	2019-04-04 17:10:06	2020-04-04 17:10:06
9cc88d95bbe60a152f00866eaae98625d20f7e6b152d8f1ddea16439ca2db49145d70b6ff987b599	116	1	MyApp	[]	f	2019-04-04 17:10:49	2019-04-04 17:10:49	2020-04-04 17:10:49
6172285edcdb52492cb1991e8a09aad6fc270cd8041b6024fc4ecfc458d2e3dad9323f201fd6bd0e	116	1	MyApp	[]	f	2019-04-04 17:11:06	2019-04-04 17:11:06	2020-04-04 17:11:06
c744d2c4b4fc806bc3ec9fd5f2fe4b6b422e3c09bf24344b42c58e4059af7b24b694bdb044c388f6	119	1	MyApp	[]	f	2019-04-04 17:12:52	2019-04-04 17:12:52	2020-04-04 17:12:52
2f2c862bdafcbeb535e757a28bf7f7748129984c54ba0167ac54b80793c4f66d1aed2a8ec990d13b	119	1	MyApp	[]	f	2019-04-04 17:12:59	2019-04-04 17:12:59	2020-04-04 17:12:59
34653036c0878c511faa09f89ee41702b6d2d7d17186b5dc75aeb3d08e796986ee0b7825ecee1378	119	1	MyApp	[]	f	2019-04-04 17:16:42	2019-04-04 17:16:42	2020-04-04 17:16:42
f04c2c6bc8c1fc50504d76fe1bdfc49552da607a65d1297b1f88c0bcb9c3e1254d3e9ac3afc94a33	119	1	MyApp	[]	f	2019-04-04 17:18:25	2019-04-04 17:18:25	2020-04-04 17:18:25
44e7d732cf837104214e93e8c72fcd1d5df577e2d17c088a5c2e1ec414d7fd0e485b024056bedbeb	119	1	MyApp	[]	f	2019-04-04 17:20:25	2019-04-04 17:20:25	2020-04-04 17:20:25
8bfcb7e297fa7a8519a81f09e7e1f9885436386b038b9b618f5787c847049230f5ab83ec4935790b	119	1	MyApp	[]	f	2019-04-04 17:27:36	2019-04-04 17:27:36	2020-04-04 17:27:36
4fea0295b7b45d47e4bb7840af1d315d6a09b75265c34dac0d96bb1f4e598a02334705a7fccf7198	119	1	MyApp	[]	f	2019-04-04 17:29:21	2019-04-04 17:29:21	2020-04-04 17:29:21
85af2fc0fbc1792a24adb262294e6c2b1bd7f621dff488e78871bb114ae1ed0d8d2748e2e26d9ea9	119	1	MyApp	[]	f	2019-04-04 17:29:39	2019-04-04 17:29:39	2020-04-04 17:29:39
c8d13ee56ece9e9b68029a4a0b1d751ce6bd3b9f6face7cb7d2477290e78b7a2037c372cb5ff273a	119	1	MyApp	[]	f	2019-04-04 17:41:52	2019-04-04 17:41:52	2020-04-04 17:41:52
7e698b7c3c42beffc5c0a0411c4a8f3e0e2e3add0c92722a156a20eebaca479651e2be199c0714ec	36	3	MyApp	[]	f	2019-06-25 09:29:55	2019-06-25 09:29:55	2020-06-25 09:29:55
387af359aa35b6a5f41dc9c2d7e2aa4ffb49fcf6b43998c94e0204c0c5987025a52fbc5844bb0799	119	1	MyApp	[]	f	2019-04-04 17:49:32	2019-04-04 17:49:32	2020-04-04 17:49:32
9f403df20877cc6597797752f0389b5cb92caeb9ec7b68b3692d028d462cac9ce91ea9878eec3e8d	119	1	MyApp	[]	f	2019-04-05 14:02:44	2019-04-05 14:02:44	2020-04-05 14:02:44
8c483d2a68c1a78066aab923c6099bb39527c5e30d738ef3e8eaf074625191991dba6060a3c8f1d2	119	1	MyApp	[]	f	2019-04-05 14:03:04	2019-04-05 14:03:04	2020-04-05 14:03:04
6bd61ed754802946254fb4eeb6e4d35a16367f7489dedec7c401f8989e6e6853c69ba2b7fd18ab1b	120	1	MyApp	[]	f	2019-04-05 14:05:39	2019-04-05 14:05:39	2020-04-05 14:05:39
55f9a0a070fe6e7de68bd9e52ece50f56b6642e9ad81b61b08fc8812e57ccb351fd1f0ab1e8950db	120	1	MyApp	[]	f	2019-04-05 14:05:48	2019-04-05 14:05:48	2020-04-05 14:05:48
1f2043ca4d08e9c736dffa3be2ad0cc3b29208c1a009efe0df3bc4c40bbf4bb78a068bbfd660d1ae	119	1	MyApp	[]	f	2019-04-05 14:08:46	2019-04-05 14:08:46	2020-04-05 14:08:46
aad4ca7b8e0c80b43ef6b7008fd860726cdee77a208893febb7a10ae6e06e605c16a273ec36cc015	122	1	MyApp	[]	f	2019-04-05 14:11:12	2019-04-05 14:11:12	2020-04-05 14:11:12
bcd7b1f90e5fd5911385963e675aab50f3a3da5f863907c7042a45a66045757620f251cb1e8e38f0	122	1	MyApp	[]	f	2019-04-05 14:12:09	2019-04-05 14:12:09	2020-04-05 14:12:09
97da53a2d901fe5226cb793a4bf87b2c9fa410df4f1e44fc5c1d7d6b7853bb0a5d334710d472cdd4	119	1	MyApp	[]	f	2019-04-05 14:14:34	2019-04-05 14:14:34	2020-04-05 14:14:34
51b84d6370366508a400229981c301c9f2af8f5cc985b24c29058d802895f295aa9254e2ffbbbe52	119	1	MyApp	[]	f	2019-04-05 15:40:56	2019-04-05 15:40:56	2020-04-05 15:40:56
109f44a9cade70301a218727e9b3c4f87efb6822926f8e7a1fbed1afb4b67f3bcf3f4a498b7e7ef7	119	1	MyApp	[]	f	2019-04-05 16:17:27	2019-04-05 16:17:27	2020-04-05 16:17:27
dea8f6fb3f33b0244da8496223b1c70fce05de82a746e58e0ed5d830d5424e1e1eb3f0ed0b4e751f	119	1	MyApp	[]	f	2019-04-08 13:53:59	2019-04-08 13:53:59	2020-04-08 13:53:59
427d872569292fe7d6d67d4114293ba7501cccd60332ab5c12702425a91714031bd3f46c8f6285b7	119	1	MyApp	[]	f	2019-04-08 13:54:02	2019-04-08 13:54:02	2020-04-08 13:54:02
c9fc15bfd13e2c8ba430251eaadc298f6ca81a80938ea96fabe9b69cfefc89365da6b08d5ccadf8a	119	1	MyApp	[]	f	2019-04-08 14:09:29	2019-04-08 14:09:29	2020-04-08 14:09:29
8ec170b2f6501c8296c2b979f8b414bad75d954a0d9201968b8c459c65d2d505e36ca8d07c958cde	119	1	MyApp	[]	f	2019-04-08 15:46:38	2019-04-08 15:46:38	2020-04-08 15:46:38
8ee2641b0365d3d57ab401b7adf61150db951e0c1878d5761cc1e6583cae220d24caf8f9c0e61e49	119	1	MyApp	[]	f	2019-04-08 15:46:40	2019-04-08 15:46:40	2020-04-08 15:46:40
94e3e4951dd099b6249b452c5c2fafed2ac27b14391a1be294f7915441f20b7272e5a3efc03637dc	119	1	MyApp	[]	f	2019-04-08 19:20:41	2019-04-08 19:20:41	2020-04-08 19:20:41
6c9f500f9f04e53fb0243d88e93dec94962a4ec04f1b3d54e567de7d6c662496821bc3d4461a19e5	119	1	MyApp	[]	f	2019-04-08 19:21:58	2019-04-08 19:21:58	2020-04-08 19:21:58
786628fea42531eb8b2e3b3635fbf20fcf3a983c33dd6b180f682615b24cb4c1b095c4bcb707046f	119	1	MyApp	[]	f	2019-04-08 19:24:37	2019-04-08 19:24:37	2020-04-08 19:24:37
38f7aee131a76f3f598565d14e8b786bce66bcc8615102ac3345b112d9c1be5cbce99d4e1f8f1943	119	1	MyApp	[]	f	2019-04-09 11:05:25	2019-04-09 11:05:25	2020-04-09 11:05:25
b7f54cbb40c46997734d13153c62669abe773d7981395fcc59bc5d38dbce60a3418140b4e97e5c3e	119	1	MyApp	[]	f	2019-04-09 11:05:51	2019-04-09 11:05:51	2020-04-09 11:05:51
f3f1bd44ad3c3258105cfbf3750eb2e8ada8e992bfbacdd404aaf8f1d0d62f6696ef4bcd98f93110	119	1	MyApp	[]	f	2019-04-09 11:05:58	2019-04-09 11:05:58	2020-04-09 11:05:58
31d048a00101f487fd8f43f39238d3e4050861ba0db4cf1a47b891736e584170fc5e4ac94da91c0a	123	1	MyApp	[]	f	2019-04-09 11:06:56	2019-04-09 11:06:56	2020-04-09 11:06:56
10d55b9c91ea703d8c11aa4ac02481433f4c59ce09067e2825b5eaaad6982403f510e6cf600cb59c	119	1	MyApp	[]	f	2019-04-09 11:22:18	2019-04-09 11:22:18	2020-04-09 11:22:18
477c09a131bc3444fc39e0f3f7c0145bb38fb7ed0a97640cb1bcef1e5cf84251454e84bca74fef23	124	1	MyApp	[]	f	2019-04-09 14:27:33	2019-04-09 14:27:33	2020-04-09 14:27:33
86e7f50b0efd207997a453a1f7fc0ab21e765879efde381cb3657d07bbf0595bdadab404acf2c9d3	124	1	MyApp	[]	f	2019-04-09 14:27:40	2019-04-09 14:27:40	2020-04-09 14:27:40
b9c29a07c15b57eb07fe86a591070b3cd995d8c969d4618a78bff579ecbd8fc534a4549fb559c0a5	125	1	MyApp	[]	f	2019-04-09 15:19:20	2019-04-09 15:19:20	2020-04-09 15:19:20
a18628fb9a6aa5e190e213647420750e34556c17b3e896d81c1c0b80710d991bd7c8d8966891db2a	125	1	MyApp	[]	f	2019-04-09 15:19:26	2019-04-09 15:19:26	2020-04-09 15:19:26
af8990030c922588ef9d0198018d08c09f288abd96a313df1732632bc5f3982bd573da9e779957d5	119	1	MyApp	[]	f	2019-04-09 15:20:16	2019-04-09 15:20:16	2020-04-09 15:20:16
2539d0a0e2a8da02a2c77968d3a31139196507e8466da5505a65e03f702dfacb3bf595742492bd51	119	1	MyApp	[]	f	2019-04-09 15:37:53	2019-04-09 15:37:53	2020-04-09 15:37:53
99a3d0c72dd8826da429d11f20b21dc31a2da9dd6c7674a94cc48bce3e630a671c64c21a7a66a227	130	1	MyApp	[]	f	2019-04-09 15:39:52	2019-04-09 15:39:52	2020-04-09 15:39:52
98ed9eb2b70c21c2d83daee5ee150d43763234e34fed7fb574e13d494f3934a02e40023495b2ffd7	130	1	MyApp	[]	f	2019-04-09 15:40:07	2019-04-09 15:40:07	2020-04-09 15:40:07
1e32c57cdba50ad567046a314534f77b2482c3ad27c1080a6dd7b68995445c795a103f9c7f867f08	119	1	MyApp	[]	f	2019-04-09 15:40:52	2019-04-09 15:40:52	2020-04-09 15:40:52
aab4af6cf5b5ed1024bfd54c0bbf6438f3a1f07faeba0097ea34aa44d566ce3b142e91662d431fe1	119	1	MyApp	[]	f	2019-04-09 15:59:37	2019-04-09 15:59:37	2020-04-09 15:59:37
31290e7e08d0d37e4ba8cf51f2474d48923453d930b43d1220841305e637055b2978a7fe8ace681d	119	1	MyApp	[]	f	2019-04-09 16:06:25	2019-04-09 16:06:25	2020-04-09 16:06:25
6289ed2389919710c7e8b4335c5a6220bb758b38ee2a35fdc416c846f93536dd8b37fcef2384bb72	119	1	MyApp	[]	f	2019-04-10 14:03:18	2019-04-10 14:03:18	2020-04-10 14:03:18
93db40adbcf2da89c565cf55234830657383e2868dbdf82b6ab3cfee9bd73b4dd74123e99b1edc04	119	1	MyApp	[]	f	2019-04-10 14:03:20	2019-04-10 14:03:20	2020-04-10 14:03:20
7b652d29a69d62c363227cebd2241b5eb75958f3024545d14ae77901c3be492ad64261f40f0834d9	119	1	MyApp	[]	f	2019-04-10 16:07:01	2019-04-10 16:07:01	2020-04-10 16:07:01
78dfb076c706f308f035e320e5c9eec682404d5cec78838d678ade4a5abb3a121ea0f77e1d3112ce	119	1	MyApp	[]	f	2019-04-10 16:16:10	2019-04-10 16:16:10	2020-04-10 16:16:10
33a8f4810e8917226dae933a80ad6f3277aa3ec061610495055af5dd028d5c077d49c1350cced16f	119	1	MyApp	[]	f	2019-04-10 17:17:30	2019-04-10 17:17:30	2020-04-10 17:17:30
9bd757fb82a527097c3889a94a8982591afbc8df758f3f6fd1bbd1f6331eefe37df4433f2d2aedee	119	1	MyApp	[]	f	2019-04-10 18:19:14	2019-04-10 18:19:14	2020-04-10 18:19:14
c6bf5283dee74f503baeb0d5510e9a5824a5404491eea0133f01d493f5d3bf1c1782816b86891066	119	1	MyApp	[]	f	2019-04-10 18:22:09	2019-04-10 18:22:09	2020-04-10 18:22:09
5ecc28310babfc51940a783e85fe291e9932c86077fc2c9e307356204712bc7d097b143d5eb0ecc6	119	1	MyApp	[]	f	2019-04-10 18:27:47	2019-04-10 18:27:47	2020-04-10 18:27:47
b2ed693ccac104b526f1a92d039c3a21787e41c2ac39962103fd15ee8c747370eb6707d936d9da42	119	1	MyApp	[]	f	2019-04-10 18:28:58	2019-04-10 18:28:58	2020-04-10 18:28:58
f1d38fde069ee450188f67fb4f59e477553986caf258ae8f9c21d751cfe605abff5ecc8b1b963c78	131	1	MyApp	[]	f	2019-04-10 18:31:34	2019-04-10 18:31:34	2020-04-10 18:31:34
036d3d59909b1cd6006dca1aab2baea44f98d6646d5227315356fe5b36ebfdef88d48ce3c0e6abad	131	1	MyApp	[]	f	2019-04-10 18:31:46	2019-04-10 18:31:46	2020-04-10 18:31:46
1cbe392e2660e575a2ba1399dd67a5a9919207cc8718488261c9a9124360cba4165453050eaef2aa	36	3	MyApp	[]	f	2019-06-25 13:36:45	2019-06-25 13:36:45	2020-06-25 13:36:45
a6e22e824b8779681aefeda1f8179744d192feae0fe19297c5bca84fd14db341457dcbda22f15fe1	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
b00d53e0617ace41fc97db102b9e0be62b3df6a8df74a8d998f564ce8ba46d06f43ab48e4e715562	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
1896fb161c3e6c83b732862bf35c584865fc10ade5c3ec0d65ea33a9089cc85a5387dc14f7bb5831	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
971014e2d8ce76721419bb38c4821b79777c42d00b89253aeaebd7fc08bb8a82beaab59f2529cf5b	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
64dd0db0ce3230ae5e332c7b0312d18c8ff3ebc03e18ec2aa8acaac89d10654cb68582cdda98ada0	36	3	MyApp	[]	f	2019-06-25 13:48:21	2019-06-25 13:48:21	2020-06-25 13:48:21
f847df8a491b4af7340906cdb0f0a3e36d9ae4b692e30023bfd3c63f9de38e3db9a72b9b8484e080	36	3	MyApp	[]	f	2019-07-23 20:53:26	2019-07-23 20:53:26	2020-07-23 20:53:26
4766b6b1491816ce49e320da1bec7bbb8741ca4d4d1b45e531f9009bcbef031deef1588156436633	36	3	MyApp	[]	f	2019-08-02 14:53:37	2019-08-02 14:53:37	2020-08-02 14:53:37
8bf49462c5d180b729aa6405c1ee451662eca2beee93a4506f296290deb80a00cb38e8a7f427dfd9	36	3	MyApp	[]	f	2019-08-07 10:04:23	2019-08-07 10:04:23	2020-08-07 10:04:23
69f1233f93dd23f84231a3f0b24e743d96c27ca8ef7baf5f72f505230878ae541ad4685cd4222227	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
029c0464f0b673eeeee035e0a71741fbfdb36ad87393a9924229368d93178abf7a249b2a3d0100b5	36	1	MyApp	[]	f	2019-04-15 18:03:16	2019-04-15 18:03:16	2020-04-15 18:03:16
2eef2333128073422f1aaeb24a522bdcfbf9fb310abcbf6dcd5efe2f432a4c3516c565ebb332e056	36	1	MyApp	[]	f	2019-04-26 16:09:46	2019-04-26 16:09:46	2020-04-26 16:09:46
aa844c963efa1c4c641d58ab5f2e0ecde2783c5d74536a688a854f2dd9f68f8841dfa80ebd2b7033	36	1	MyApp	[]	f	2019-05-01 14:13:16	2019-05-01 14:13:16	2020-05-01 14:13:16
230abf653c9732d4fcd4a51bd0749a5fa3e5abf134143636aba107742019a910d99cf91a820cfed9	36	1	MyApp	[]	f	2019-05-07 15:15:18	2019-05-07 15:15:18	2020-05-07 15:15:18
be87167eca55180b01e44eb2cebd8442918ffbac41683e61e3d413cd03da15b7e3a607e8dc24c210	36	1	MyApp	[]	f	2019-05-10 15:42:33	2019-05-10 15:42:33	2020-05-10 15:42:33
92da0cc26d0c8bf341d293ef41b88221438e17cf1ac180d1c26f04de0251d93e6e1983877e2d85b3	36	1	MyApp	[]	f	2019-05-10 16:38:52	2019-05-10 16:38:52	2020-05-10 16:38:52
50fc549e889ed04d78114e4554a16184de7cee7f2beef9040fa419872d08337c1d38ee7a6af553b0	36	1	MyApp	[]	f	2019-05-14 14:08:51	2019-05-14 14:08:51	2020-05-14 14:08:51
2bf204ca891beaa6117855dc4a0aeebed93d79ef95e55a2e987bf8b60523c7a909aaef6e4b25d624	135	1	MyApp	[]	f	2019-05-15 18:00:03	2019-05-15 18:00:03	2020-05-15 18:00:03
3f1f1640a3db801bbe458eaea01ba6d2cca0f5c183a84953e2d9613a7c349fcb95fd66a7c462cf94	36	1	MyApp	[]	f	2019-05-21 14:48:57	2019-05-21 14:48:57	2020-05-21 14:48:57
77060d7e0f25257b2b9adb496a61c9a7ad1c60ff8248f329fda181833d503d743a7cdfe2d4d1d85f	36	1	MyApp	[]	f	2019-05-28 15:27:52	2019-05-28 15:27:52	2020-05-28 15:27:52
0547065eb95b5bbc3e077e67d9d956bee7b58894099eefc483812c0efd0e815a9d188c7e1a724bf8	36	1	MyApp	[]	f	2019-06-05 13:59:56	2019-06-05 13:59:56	2020-06-05 13:59:56
2afb2dc11a6e045be7bd1acee7cbceb403c5200991e21c74189e853cb67c08211545d4d3c531ed45	36	1	MyApp	[]	f	2019-06-10 17:03:24	2019-06-10 17:03:24	2020-06-10 17:03:24
3cbd56649d1e41df263a1f55ca7c9a56e17da47333d236c58a8f34b37ed4b350df9850050880c465	36	3	MyApp	[]	f	2019-06-25 16:46:37	2019-06-25 16:46:37	2020-06-25 16:46:37
69cffcd68e284664a20145c09bd6fdcd012d8c47cc59809d3baa7dc11a76bff61e18c8a329ac7e73	36	3	MyApp	[]	f	2019-07-23 20:58:48	2019-07-23 20:58:48	2020-07-23 20:58:48
fd2dac396ba9f4bb7a8cba76ea9fb4c3cf15553591ab28cc9eea66712882de43d77a564c0c95ded4	36	3	MyApp	[]	f	2019-07-30 14:27:27	2019-07-30 14:27:27	2020-07-30 14:27:27
c7fee2a4b0143cee58fb0ff1558c4f6116576f5a5681020de05ef24653a47b70cf7863a9c06ae262	36	3	MyApp	[]	f	2019-08-02 17:49:00	2019-08-02 17:49:00	2020-08-02 17:49:00
f564551b2a6ea7f46f8a0607585814245becff97da9e1c8f10200a43af570ab640f58e951a1b0584	36	3	MyApp	[]	f	2019-08-07 11:50:06	2019-08-07 11:50:06	2020-08-07 11:50:06
92f32e097d6e0e7336f71d07ae7129a896be0b87d05c6f3cd3bffd203a4001f11bf7609a3322c42c	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
8f24b2c639ec576f9d645431893ac9237a3aaa3103f82dde9c8c74f110221a569ccf3ba8c6a81512	36	1	MyApp	[]	f	2019-04-15 18:08:35	2019-04-15 18:08:35	2020-04-15 18:08:35
3edf2be4c6720f610de4350853daf51a5853b4ba175f3400a9439c0dce8672b89bd73aab8ad85880	36	1	MyApp	[]	f	2019-04-26 16:11:52	2019-04-26 16:11:52	2020-04-26 16:11:52
da2f51004582b896a032213e495d9909531b68130e44e12463d108c4dabd70716370d380419bd576	36	1	MyApp	[]	f	2019-05-01 21:29:43	2019-05-01 21:29:43	2020-05-01 21:29:43
d1d808ca800c3de0a11bd2e34580aa6974ba5c8126882309835a4c9c560cc00738478f938e1b4148	36	1	MyApp	[]	f	2019-05-08 14:21:01	2019-05-08 14:21:01	2020-05-08 14:21:01
c1333c570e6806855b518b69849315929983b2d3cb018ceee022d0ec161b2fdda9b51b04654ae8b7	36	1	MyApp	[]	f	2019-05-10 15:44:19	2019-05-10 15:44:19	2020-05-10 15:44:19
ae87ca687b9001be3dd20d35a09701bc7c93a5201e42daf57335fc319651fc3475403ed69130e6dc	36	1	MyApp	[]	f	2019-05-10 16:41:02	2019-05-10 16:41:02	2020-05-10 16:41:02
2ec31120d24146791f28cfc34c624c068bea70395e940780bcd18d673cf7d9181f2b280912f90a5b	36	1	MyApp	[]	f	2019-05-14 14:47:18	2019-05-14 14:47:18	2020-05-14 14:47:18
27851b864c6774475c854d849aab7b5d45e7f94edc3c10117ff43552dc9a9edeb1b55153baabac98	36	1	MyApp	[]	f	2019-05-15 18:02:54	2019-05-15 18:02:54	2020-05-15 18:02:54
e595918baf433016d0240aed50565ad8a49b6157b1f0b25dfd499feca1c391c5807b5126ee0b15b0	36	1	MyApp	[]	f	2019-05-21 15:02:14	2019-05-21 15:02:14	2020-05-21 15:02:14
fb304d377e1cbefae9f2087132053174d9238b401c3a43fd7ac59c906322689d28825b076fd752f7	36	1	MyApp	[]	f	2019-05-28 15:32:49	2019-05-28 15:32:49	2020-05-28 15:32:49
102b7179abfdaaa16150ca6355f31c5a97922829da5731912c9aab64cfac34a0257860eba392ca3c	36	1	MyApp	[]	f	2019-06-05 14:34:29	2019-06-05 14:34:29	2020-06-05 14:34:29
64d8575b7c6a771707e6c26144f7ea97570ad3f13b2736a696a46870c00482b49c66dc9b1999f80c	36	1	MyApp	[]	f	2019-06-11 13:41:00	2019-06-11 13:41:00	2020-06-11 13:41:00
13d190504327e4d4dcb214c71b91346892eeedca4251c96f15546c7de1cc6dbd657ea76b9d78d1fd	36	3	MyApp	[]	f	2019-06-25 16:48:11	2019-06-25 16:48:11	2020-06-25 16:48:11
6050de0fc200ffcbf911537301422b0b35bbcf3fd39533fc8cae78d0dc1b414cb39c9f304ab89653	36	3	MyApp	[]	f	2019-07-23 20:59:27	2019-07-23 20:59:27	2020-07-23 20:59:27
85d955d0e6e28e1f7326cfd914fa03d36677ef8b3828bb8669315943125cc70a82ca60e0bcb8eaa4	36	3	MyApp	[]	f	2019-08-01 11:10:37	2019-08-01 11:10:37	2020-08-01 11:10:37
d043e372a94403321a74fa1b848401ddd5712044523849ba5dcda2f57c0933d0fc4140f61a585498	36	3	MyApp	[]	f	2019-08-05 09:02:54	2019-08-05 09:02:54	2020-08-05 09:02:54
0c67e0434fe859a897d7a9c33edbc06d2825337bbf2fb10d3e94c1b7c2023a1af1120b6efeac8e3b	149	3	MyApp	[]	f	2019-08-07 11:50:41	2019-08-07 11:50:41	2020-08-07 11:50:41
2e85935499afdc3c08fc3402bd500e3f5345fc036721088308b28999efb5dcfe7ff7e002fac80315	132	1	MyApp	[]	f	2019-04-11 16:34:38	2019-04-11 16:34:38	2020-04-11 16:34:38
9e5010a7793d4d3dc273878ffd594e73a3655e4d312a26228da462ade365b915adc54a6c3d1e7465	36	1	MyApp	[]	f	2019-04-23 16:18:36	2019-04-23 16:18:36	2020-04-23 16:18:36
1234d17e71a85334fe8d59a7a61dd0b02a1edebebe814d3d7e3f433e1e7dd42098f40d587fa92f6e	36	1	MyApp	[]	f	2019-04-26 16:20:52	2019-04-26 16:20:52	2020-04-26 16:20:52
7bc6f50fda595d0bafde253a41a082070de72beb7e6ee7a36c0a4fcbe9627882df802caf274bb6a8	36	1	MyApp	[]	f	2019-05-01 21:29:57	2019-05-01 21:29:57	2020-05-01 21:29:57
2350680199dd56cce63c7ee85d29b383adf43fc4fe7b8ff23e7594b542e458ce357249bef983a1d5	36	1	MyApp	[]	f	2019-05-08 14:24:40	2019-05-08 14:24:40	2020-05-08 14:24:40
50ee7989f8efe3c924e1ef636f8ccf28d5e8abed05439afbe8f1a6939e74d8ab788fe090c4ca06c7	36	1	MyApp	[]	f	2019-05-10 15:44:59	2019-05-10 15:44:59	2020-05-10 15:44:59
4419e6ac4b9d187b0caf2526252f1e0f016bed223636f446627234c251c1e04a1d5c3a9015e75af6	36	1	MyApp	[]	f	2019-05-10 16:42:21	2019-05-10 16:42:21	2020-05-10 16:42:21
dd1448bac257ee05f851d8a917898983162c133bde054488a989465248ee726a290d2ae5f0e49cca	36	1	MyApp	[]	f	2019-05-14 15:30:34	2019-05-14 15:30:34	2020-05-14 15:30:34
c316cb6759ca15503b0f150fcfce1c4cadf48b762c400dbf5c8433132dd779ed6e35cd1bdd1360e1	36	1	MyApp	[]	f	2019-05-16 14:16:28	2019-05-16 14:16:28	2020-05-16 14:16:28
5592e24690eed499cebdf738d5b9462ab58ce3951be894546d2fb5f2dfb0e475b3b5b51fe4e50356	36	1	MyApp	[]	f	2019-05-22 14:23:04	2019-05-22 14:23:04	2020-05-22 14:23:04
436a8e54d9a9ac75239d0af30f7d3ef61c0a3b5b771c9ddcb7f3f81712bcbcf611d7827a288da474	36	1	MyApp	[]	f	2019-05-28 16:22:35	2019-05-28 16:22:35	2020-05-28 16:22:35
5b5537351c5f9eec54a5bf97624734fe82c91a2966a6cdd6413c9031523715978caff141cc451e73	36	1	MyApp	[]	f	2019-06-05 16:35:00	2019-06-05 16:35:00	2020-06-05 16:35:00
d2cc37d8d4924d789f86ab89387207927e177c5edecba1d92cad8ada973d5d073aa2b61a66d819bc	36	1	MyApp	[]	f	2019-06-24 15:23:31	2019-06-24 15:23:31	2020-06-24 15:23:31
1efb3d4ec3b250a2361f5a76a798bd15f8047b98bb032bd8a7caefe7b0e40a414cd6e20c0d808290	36	3	MyApp	[]	f	2019-06-25 18:24:10	2019-06-25 18:24:10	2020-06-25 18:24:10
04a766845982383a3d0abb0b711d933dd0d6b8de20368a98d6c057844a7c2791ada1d23ae221f805	36	3	MyApp	[]	f	2019-07-23 21:03:09	2019-07-23 21:03:09	2020-07-23 21:03:09
712630e16f0eea0796da2c74c8be4729b69c3007d7925fc32d7a28378b6e79e37c6afad10b213e3a	36	3	MyApp	[]	f	2019-08-01 11:15:35	2019-08-01 11:15:35	2020-08-01 11:15:35
75287ec7e3a68f6e994e72a5085c8f49c1afdd720b0304ddee57538de6d33fb43d5e003cac99a870	36	3	MyApp	[]	f	2019-08-05 10:23:34	2019-08-05 10:23:34	2020-08-05 10:23:34
7d434929c301b3423c016e3dc8ec2d5ac8d1064f0ecfaf9c0b807659a22c7083d7afa5980aad3ea8	149	3	MyApp	[]	f	2019-08-07 11:51:00	2019-08-07 11:51:00	2020-08-07 11:51:00
39ed100f44aeb66a4dae70193f24e87111c7673441171cf2750065a2d2dc0ee02b501f0fad3a6ae0	130	1	MyApp	[]	f	2019-04-11 17:54:17	2019-04-11 17:54:17	2020-04-11 17:54:17
62411b0a9b82f93611a912d7b92100d3354631fd60bd2cafe47a643b46bcffa6de45a07bc4ebcd67	36	1	MyApp	[]	f	2019-04-24 16:34:50	2019-04-24 16:34:50	2020-04-24 16:34:50
0cd1e4df663967eef85a08f25d012864076d7367c76d2b2f3476fa18652e7909a5fe29017ffa8df7	36	1	MyApp	[]	f	2019-04-29 16:01:33	2019-04-29 16:01:33	2020-04-29 16:01:33
ee3c18a1e524a452e86a82f7fea8e70f15fc9566f80f3c5d439f54771ee80d5539e86ba0b3229119	36	1	MyApp	[]	f	2019-05-02 10:58:46	2019-05-02 10:58:46	2020-05-02 10:58:46
2c98d4cb259e17d7d15f04b53b93c36263802d99315c88937215ac53e7057b6fbda744253a4d5600	36	1	MyApp	[]	f	2019-05-08 15:35:45	2019-05-08 15:35:45	2020-05-08 15:35:45
463dfe30d1682762bd9dd4900484d2902845ff4273b00add77f68917b49fe2bc663b65b381fd46ea	36	1	MyApp	[]	f	2019-05-10 15:45:21	2019-05-10 15:45:21	2020-05-10 15:45:21
8ec34ba173d62f4ba8650e677049ff581b7c43ce3fdc51633fc247944c5ca78ce7bb73a44717fc70	36	1	MyApp	[]	f	2019-05-10 16:44:03	2019-05-10 16:44:03	2020-05-10 16:44:03
708fd94a587251bc2f3925b43ad82b422dd4a54ab9325e67c64e1b12969ab142e651343b0b55f828	36	1	MyApp	[]	f	2019-05-14 15:52:53	2019-05-14 15:52:53	2020-05-14 15:52:53
af02641456729e4eda616db36521526aea9a231c3f2d2c0ca6091038d9c87272eaa43de8cdf5e0ce	36	1	MyApp	[]	f	2019-05-16 14:50:47	2019-05-16 14:50:47	2020-05-16 14:50:47
a6ca31ddaa890c92c6a4940355f7e02a8614ae060170ccd35952bdb29e441376bf007ec7dd10c5ce	36	1	MyApp	[]	f	2019-05-22 14:23:06	2019-05-22 14:23:06	2020-05-22 14:23:06
f5e6b348083d76874b7ece63543d1b1040adafa78091a8dd5e64cd0fcfdafa3af3cb96681992e810	36	1	MyApp	[]	f	2019-05-28 17:55:29	2019-05-28 17:55:29	2020-05-28 17:55:29
9abdccc30bb90eab5b6bd3716fa25e1b3539e338f91b3da9ae718d6e1234cb782280a97da45a0899	36	1	MyApp	[]	f	2019-06-06 14:28:17	2019-06-06 14:28:17	2020-06-06 14:28:17
63321d12dd9c128d53b69621a15a44f942271d3c487c593229f68cdaec74bfd6f7798ee086bf6d76	36	1	MyApp	[]	f	2019-06-24 15:25:33	2019-06-24 15:25:33	2020-06-24 15:25:33
1a41950c24feed10b743abea86c4fc7ebfc1aa5aab8861218b713c17d9e200093b2b6fe8e530f433	36	3	MyApp	[]	f	2019-06-26 14:36:06	2019-06-26 14:36:06	2020-06-26 14:36:06
071297734d0af4f28d39903cb9e3c8bc8fc3f7e42efd9fc63f6f91051919050f914be4a9cc4980b1	36	3	MyApp	[]	f	2019-07-24 06:26:44	2019-07-24 06:26:44	2020-07-24 06:26:44
67ec812baad60d476142ab58cc82a55cbb6c24badc3e4daff43999a11770122c9f07b7078b80c202	36	3	MyApp	[]	f	2019-08-01 11:19:01	2019-08-01 11:19:01	2020-08-01 11:19:01
6ac76acc08e30dc3b424bd92eacfbd97860a0a53004e551a0d699b82cd73d2e81e772aa864f7c28c	36	3	MyApp	[]	f	2019-08-05 11:19:05	2019-08-05 11:19:05	2020-08-05 11:19:05
9965c25e8e970c68b4989b3ebc174d75259cdf7c6e944537f25df5b07bfe77884095f1e18fe869d8	151	3	MyApp	[]	f	2019-08-07 11:54:39	2019-08-07 11:54:39	2020-08-07 11:54:39
a26051410677d88edbb0d0274fca83d8a0fd78045d58fcb991128c525132ba1ba195ab3c5d5bd864	119	1	MyApp	[]	f	2019-04-11 17:54:38	2019-04-11 17:54:38	2020-04-11 17:54:38
732e8ae62145abbb39ba4b8e15b1df708dbfaef89c354217fe0408d0e97c9d108938172b68da6dc8	36	1	MyApp	[]	f	2019-04-24 16:39:28	2019-04-24 16:39:28	2020-04-24 16:39:28
7ffd20c830b45e9bb929478e4199d9ac47185ec8a30e1c97fe2e5e6af2d148fa859aa98b6361634e	36	1	MyApp	[]	f	2019-04-29 16:17:19	2019-04-29 16:17:19	2020-04-29 16:17:19
4450c34f3568450f4e6d6bdaf748b4ee69aeca032dc4ab82fd19d68356c1516b66c75fd2b4603b59	36	1	MyApp	[]	f	2019-05-02 14:04:12	2019-05-02 14:04:12	2020-05-02 14:04:12
78f89cb016a91745aa10e1e059232997b46e145d30b5c4134c378ef333d9df283044cc4014181f35	36	1	MyApp	[]	f	2019-05-09 15:11:52	2019-05-09 15:11:52	2020-05-09 15:11:52
bbd9852540f7b6ab7f3c9d774c337a1cdd677011832c64ff9f35b618825986a2c04a7e1c862915be	36	1	MyApp	[]	f	2019-05-10 15:48:15	2019-05-10 15:48:15	2020-05-10 15:48:15
6d610909581aaa73d35b1d2df5f87396d86b1f81bc80f36a7ee1fcab4f2e740a5ba8a7ffce09c9bb	36	1	MyApp	[]	f	2019-05-10 16:44:16	2019-05-10 16:44:16	2020-05-10 16:44:16
d65c5f4e233c4fcd7eaaaebead1866a751ff0de7b92fa7c033107fbd4c7aff23a8c2c0de2cfe02d1	36	1	MyApp	[]	f	2019-05-14 15:54:47	2019-05-14 15:54:47	2020-05-14 15:54:47
70a91c3b178f12c2fa39322cbe9664211e4425a34fbb4b6b3bd772d038918c01ec3b3f49d2977173	36	1	MyApp	[]	f	2019-05-16 14:53:39	2019-05-16 14:53:39	2020-05-16 14:53:39
55ac67533074192f53b45057236b6e66a9ff5acc0cc4efe23d391fed9945ceaec389cd9eebcc1073	36	1	MyApp	[]	f	2019-05-22 14:51:11	2019-05-22 14:51:11	2020-05-22 14:51:11
4fab4e5a66fa186a4e8454b42b96218041a09bd6a8d413d0f8c961c8e75463197f2c2ae5abb96d6f	36	1	MyApp	[]	f	2019-05-29 14:31:32	2019-05-29 14:31:32	2020-05-29 14:31:32
90ccb79f5b1025fb738b78b9767eeec77951a3b178b40461e33160e8773acf6441fc98ceed43ef12	36	1	MyApp	[]	f	2019-06-06 15:33:11	2019-06-06 15:33:11	2020-06-06 15:33:11
bf021f8a67951d90f46f7640ebed2d8ea671e7450d77b0a93a259039d719d7d5f8f23b27c72191b0	36	1	MyApp	[]	f	2019-06-24 15:46:33	2019-06-24 15:46:33	2020-06-24 15:46:33
555dc5bc9ad0824b844e2794f5cbbfaa89412c2da90f3048b7cdd77353db6f09ab715d55b16de823	36	3	MyApp	[]	f	2019-06-26 16:00:14	2019-06-26 16:00:14	2020-06-26 16:00:14
686fb693e46170c401202fe61a2dc05d4bd58c367b3b939c298e9852a1a8b3a862b71d2d08be250d	36	3	MyApp	[]	f	2019-08-01 11:23:37	2019-08-01 11:23:37	2020-08-01 11:23:37
d3237443c71ebcaa00ba9a55e1abe1885efe31dee8f87516c68fc034b67db7add4ab3d6aa7d2b669	36	3	MyApp	[]	f	2019-08-05 11:19:38	2019-08-05 11:19:38	2020-08-05 11:19:38
b80e8eb2e96c58a6e2b8174599767453a3d421fd026346476b35fb70281c6f8241406279a2070771	151	3	MyApp	[]	f	2019-08-07 11:55:12	2019-08-07 11:55:12	2020-08-07 11:55:12
27fb9dac89ecd0672f91e89a9c4be686e54efaaba0ca7aeed04f04e16fbe6f81e2acdebf55597206	119	1	MyApp	[]	f	2019-04-12 13:46:05	2019-04-12 13:46:05	2020-04-12 13:46:05
be7c264cd32057288688a40029d32dd3d015cb77b33e245b8e31baf0ba2ce64b12aae487a63fd82d	36	1	MyApp	[]	f	2019-04-24 16:52:21	2019-04-24 16:52:21	2020-04-24 16:52:21
685bcdb9153bf39db188292ea8d4bf6cce5c15532fa2755b86f09a8ff5b980c45d568efe67d3467a	36	1	MyApp	[]	f	2019-04-29 16:47:03	2019-04-29 16:47:03	2020-04-29 16:47:03
18dac0b7f5808c45a09881f5f89f3cd8942c135910aedef5604d4909adb54cb365480370a4121863	36	1	MyApp	[]	f	2019-05-02 14:11:01	2019-05-02 14:11:01	2020-05-02 14:11:01
c7da13a0bc76fa5294f93c7ea1e261cc57f740177ce76f2928b4a6f9693c6a76d241ac349eeff0ac	36	1	MyApp	[]	f	2019-05-10 10:25:35	2019-05-10 10:25:35	2020-05-10 10:25:35
18620cb01b6253f3d41096accf270dae6b1d54915d15aaad034f24f228dfa341d449b73ab925bdeb	36	1	MyApp	[]	f	2019-05-10 15:48:39	2019-05-10 15:48:39	2020-05-10 15:48:39
569b01d9ee274a912389a4dec7b1b151a8af55dfc5297e6ba0015647590798c782920c45aa052c53	36	1	MyApp	[]	f	2019-05-10 16:44:43	2019-05-10 16:44:43	2020-05-10 16:44:43
3a9f3a93da1e5db281bd536a6ac9f83717e7b77c9a77193213449b72cea5bfe310584da992e8e7a2	36	1	MyApp	[]	f	2019-05-14 17:33:21	2019-05-14 17:33:21	2020-05-14 17:33:21
3b073703d24c3ae3d983b766ac1b08700c9a1bf7476fc308920c0e1ccd7119bef60d39438a5a5d01	36	1	MyApp	[]	f	2019-05-16 18:43:32	2019-05-16 18:43:32	2020-05-16 18:43:32
4c81948e437e009be94dd1e0ef16f606d0a62e93d08765164d8d3e07c96467b1687730da4292b4c1	36	1	MyApp	[]	f	2019-05-22 14:51:41	2019-05-22 14:51:41	2020-05-22 14:51:41
83fd194b3a5276a55977fd448d0cf6e1da0fdabda1b2cdf3a628f06b0aa2cabcfd748fa18096483d	36	1	MyApp	[]	f	2019-05-29 15:21:00	2019-05-29 15:21:00	2020-05-29 15:21:00
8e2d65783b81d2cd91bedce8a34e63b3d45e3155c6d9e5b6c8fd8f9942e06d7d870d9d91b1830503	36	1	MyApp	[]	f	2019-06-06 15:35:43	2019-06-06 15:35:43	2020-06-06 15:35:43
4d786efb01e5928c7d61470e464c529c967fefbfb358f45b87b566101a0c421357b7ec50a7add517	36	1	MyApp	[]	f	2019-06-24 15:47:31	2019-06-24 15:47:31	2020-06-24 15:47:31
19163a7e035f44503c27c9b3a56bc96acf180ccb996c0ca97747730e6400750a967211cac7a162f3	36	3	MyApp	[]	f	2019-06-26 16:12:07	2019-06-26 16:12:07	2020-06-26 16:12:07
afed644eee858032e2be504b6d3705b04f86a763a889a4e6e38543fb21eeea25c4b9fb1fea8eab4b	36	3	MyApp	[]	f	2019-08-01 15:13:24	2019-08-01 15:13:24	2020-08-01 15:13:24
4e3d91a29a82c9e02aee44c370388f76749178eb328f0a843c4c822b07eec9111acbb46bb70d7868	36	3	MyApp	[]	f	2019-08-05 11:20:11	2019-08-05 11:20:11	2020-08-05 11:20:11
7bc1fb82ed1aa9f5bbd2205efb8a8050c54d808c1f035654681016956a7a06e6827064a24413c46b	119	1	MyApp	[]	f	2019-04-12 13:46:09	2019-04-12 13:46:09	2020-04-12 13:46:09
5f48f9982b34d5bf62513a2616cbcf5a41a296815ac67713bcc9ba0aad6f94ddfad3182f03cc5b2b	36	1	MyApp	[]	f	2019-04-24 17:28:17	2019-04-24 17:28:17	2020-04-24 17:28:17
cdf7e71278064fef610fd19ea4c03b6e31bb6ff8602033274fe7bed006fa3aa4cf8d65ae6aa8ce00	36	1	MyApp	[]	f	2019-04-29 17:18:26	2019-04-29 17:18:26	2020-04-29 17:18:26
598d537f9bbe51387750e37328717b82b980bc0ef8a1aad55269f5a4620710b7df22b7d146e712dd	36	1	MyApp	[]	f	2019-05-02 14:26:07	2019-05-02 14:26:07	2020-05-02 14:26:07
9d332a7d0adeb70879a80b47d7e7bca9c9a2055d21280b15c8a70d88a2a56d58f87cde86cc741910	36	1	MyApp	[]	f	2019-05-10 14:29:02	2019-05-10 14:29:02	2020-05-10 14:29:02
c1fdb270a24a8c7e11a9b57d7a907daa5a3b5baabe1b075989d845381941675a0a59b0fe7e606b1a	36	1	MyApp	[]	f	2019-05-10 15:51:35	2019-05-10 15:51:35	2020-05-10 15:51:35
8855b3d3dba4dc73edf9b38680af08973df24b3da2aeaa3e99d79bcb5f09c0ee55c2da30055cdf54	36	1	MyApp	[]	f	2019-05-10 16:44:58	2019-05-10 16:44:58	2020-05-10 16:44:58
415729cdcc3fc9b360d74ecca3d15488a68f8b097e31d0e39d9db03c277c7cc55940c1e24c69b84c	36	1	MyApp	[]	f	2019-05-14 17:36:28	2019-05-14 17:36:28	2020-05-14 17:36:28
7075a82cb317cfc793e82f0cdc4fab13c3407b3bc604e7ac526c3d7b1321a15ee968af0fc62a1c72	36	1	MyApp	[]	f	2019-05-16 22:06:20	2019-05-16 22:06:20	2020-05-16 22:06:20
e71e9af25b6bf92de66e9b90e92da8ac4fe68a8388366bb22c2ee82545bb950ef4d00a490dc518db	36	1	MyApp	[]	f	2019-05-22 16:08:29	2019-05-22 16:08:29	2020-05-22 16:08:29
d0cc7f23a2828e09689566a9b3b5adc3738f9ff56366a876326606e806d3707fcd6093f315684fe0	36	1	MyApp	[]	f	2019-05-30 13:59:13	2019-05-30 13:59:13	2020-05-30 13:59:13
feb58759e3e7067a93a915014496c83b3d83d94d004d7dc3e20aa6421ff961740f7b061b54a87e24	36	1	MyApp	[]	f	2019-06-06 15:36:24	2019-06-06 15:36:24	2020-06-06 15:36:24
7491144b8bdbe2d2ca084a8b3b7b69a6be166cfba92e0a20980b342247c3c651048353b5c5a430d1	36	1	MyApp	[]	f	2019-06-24 15:47:48	2019-06-24 15:47:48	2020-06-24 15:47:48
c71f2f16181b4a1cd817965e639985335264df1309e3ccf8126a6686ac4e14f32f992dd6599096da	36	3	MyApp	[]	f	2019-06-26 16:13:55	2019-06-26 16:13:55	2020-06-26 16:13:55
889aaa0276ff434e9c5d08b564df39be80fcd74ea212ea5736a79c170beff00413f3979535ff9b45	36	3	MyApp	[]	f	2019-08-02 10:04:15	2019-08-02 10:04:15	2020-08-02 10:04:15
5c9e3e119c7c566599dc4cb71c831a817a7c94277837da0e1e01707c9cfd30e4080a3c781f279be7	36	3	MyApp	[]	f	2019-08-05 11:20:24	2019-08-05 11:20:24	2020-08-05 11:20:24
8d1a969c52523ebe8ceaeeb4cee3f5f94d705b608c69001141df3060b85f9dc9dfb546ed3262aa41	119	1	MyApp	[]	f	2019-04-12 13:47:47	2019-04-12 13:47:47	2020-04-12 13:47:47
399583fb683682e186121bacac8b577fdf5b03855f947ad5c87d133493d13233a1d0c79b965240bd	36	1	MyApp	[]	f	2019-04-24 17:28:18	2019-04-24 17:28:18	2020-04-24 17:28:18
31637b103d287a45d20708be1a7cebdd76c42a0992dea661b0004927b5726ebeeaa4a9a5513a43fa	36	1	MyApp	[]	f	2019-04-29 17:18:37	2019-04-29 17:18:37	2020-04-29 17:18:37
a7eaf1d10acdc995bacf565f48bc8b3fd3ccea814f13fc1eaa1867b20c9ea4172f988a15255ab353	36	1	MyApp	[]	f	2019-05-02 15:39:48	2019-05-02 15:39:48	2020-05-02 15:39:48
0325a81fb88a97c026e5414a05859fd5e3807bd36a27da204085c55f2f3cd238779624a61c8f9958	136	1	MyApp	[]	f	2019-05-10 14:55:48	2019-05-10 14:55:48	2020-05-10 14:55:48
1252c42e6e80dad7c0e0e697666d35c999097dd8bf1ddd3691a85bdc7f59a138450763f8709e828e	36	1	MyApp	[]	f	2019-05-10 15:52:24	2019-05-10 15:52:24	2020-05-10 15:52:24
68e2caf24f56360b31d1af91a5123de93458f76699bd540c75782de5e114da92c9f705019fb8b1b2	36	1	MyApp	[]	f	2019-05-10 16:45:03	2019-05-10 16:45:03	2020-05-10 16:45:03
c3a835a4ecb268ea28ce0fdc94c92377d58c45a6ec008953edcfadc4fbc356444b7b18953a084c09	36	1	MyApp	[]	f	2019-05-14 17:37:19	2019-05-14 17:37:19	2020-05-14 17:37:19
a805ca40ab307dc6ae1f3947d11e813b72c88b257d17a70ae11e3a88c8cc81294457f9b537add35b	36	1	MyApp	[]	f	2019-05-17 14:58:11	2019-05-17 14:58:11	2020-05-17 14:58:11
77e12be9c6acefa258339cf59c995035bd19506a7c867a67ec0691e5d5e9493ad3da76218878a679	36	1	MyApp	[]	f	2019-05-23 13:38:37	2019-05-23 13:38:37	2020-05-23 13:38:37
1d26e821a9cc0068beefbc03b4b01a597d2a27bd26f4d8c48dc574214455a75f6a04567aa608ca6a	36	1	MyApp	[]	f	2019-05-30 14:30:42	2019-05-30 14:30:42	2020-05-30 14:30:42
ed75c924e75ccfb254ef17c33a83a2c501fa3dab4e4bec1dc79aa1480698818dea833829cfa1b73d	36	1	MyApp	[]	f	2019-06-06 15:41:14	2019-06-06 15:41:14	2020-06-06 15:41:14
eee7b13be6757ba828dc8c1b9bc49cbc7f9d28a713c8d01478e0fba7c53b30092fb91df9c6158b77	36	1	MyApp	[]	f	2019-06-24 15:51:30	2019-06-24 15:51:30	2020-06-24 15:51:30
30246dcce81640ca3e0e7551367f2c60f4fc28815c73945ef8a31291eb739f7d066084c2bc2292a4	36	3	MyApp	[]	f	2019-06-27 14:03:16	2019-06-27 14:03:16	2020-06-27 14:03:16
7e3eff980af71372ff833a3d17d677f8bd267b2c3318ea6274b759b50c8bea2898878d6f7522d9e7	36	3	MyApp	[]	f	2019-08-02 11:04:59	2019-08-02 11:04:59	2020-08-02 11:04:59
b79a3b661336c16d7bc6d950f698f92bcc549211f5e59f71ba5e508f48e53bfc75d4704adb26b17a	36	3	MyApp	[]	f	2019-08-05 11:22:26	2019-08-05 11:22:26	2020-08-05 11:22:26
aa24f8d29f9b7c3899e967b5ff7bc4606b36bf486cd77ffba219e8909d4fe4595f37dbfe6f42b1f1	36	1	MyApp	[]	f	2019-04-12 13:49:30	2019-04-12 13:49:30	2020-04-12 13:49:30
53cd1f739a87d40c38f4fd8751a1ec43afb291a642c1129431d7cf8557be68740db461911a3a5d46	36	1	MyApp	[]	f	2019-04-24 17:42:13	2019-04-24 17:42:13	2020-04-24 17:42:13
97950334959724a465a5108aa5719376383b430e3b99461e177a62d19b26ed84d51e616520b53663	36	1	MyApp	[]	f	2019-04-29 18:01:54	2019-04-29 18:01:54	2020-04-29 18:01:54
fd5c5e3aa4e20e520e8aaff34faec8f46d15998967c8f9a619bbd62a6fb7534d5d84d1c4348feb10	135	1	MyApp	[]	f	2019-05-02 16:04:42	2019-05-02 16:04:42	2020-05-02 16:04:42
1a4e0ad68fbcd4f4abff1a32c79b08c7ba0dced4c95793463128f057dba4c6d8411d11b436119e19	137	1	MyApp	[]	f	2019-05-10 14:56:30	2019-05-10 14:56:30	2020-05-10 14:56:30
dccadf503f01edf6bd1a4835fac5a1a4efe422bff1e1692d4f4b07f497cb9dd216165c23d2c1233c	36	1	MyApp	[]	f	2019-05-10 15:53:13	2019-05-10 15:53:13	2020-05-10 15:53:13
03bb5b733d585f943b2ac02571ca78fced6d74f8f00f1134b4a81fba6bb4da1cd0661327415a2f59	36	1	MyApp	[]	f	2019-05-10 16:46:14	2019-05-10 16:46:14	2020-05-10 16:46:14
f71d94048db597f066afb328c1e4c68ca2e4e02f04c7b41a3a07e2810277e9d3f5672490189200fb	135	1	MyApp	[]	f	2019-05-14 18:03:01	2019-05-14 18:03:01	2020-05-14 18:03:01
bd5c07377aecb35f0d26e60318eddfa98b542837bcd4a4291d47f6acedf5b5e4adb0c8a7b1c56a28	36	1	MyApp	[]	f	2019-05-17 15:11:30	2019-05-17 15:11:30	2020-05-17 15:11:30
3efd69bcced7fd9feafce211680e1152bf867cbfdf8c0a2d29e8918a280b54d74e8190ca83d10fe9	36	1	MyApp	[]	f	2019-05-23 14:57:19	2019-05-23 14:57:19	2020-05-23 14:57:19
d518eaf42904e14837ca9335fc5145636a563765e46c1e234c5391cb1649acd41a804114196576eb	36	1	MyApp	[]	f	2019-05-30 14:41:38	2019-05-30 14:41:38	2020-05-30 14:41:38
27ba6b19aa6d72d0682f5b0e4e9d0973f70ff6a378b9cec280a5d79b0f14c0a5d3f02ccdb8501380	149	1	MyApp	[]	f	2019-06-06 15:47:14	2019-06-06 15:47:14	2020-06-06 15:47:14
0c3b9f346627374726bd9454b8ee32220b0dcefc23b98b4cc568f5f6283537084bb869b6b2764a5c	36	1	MyApp	[]	f	2019-06-24 15:54:25	2019-06-24 15:54:25	2020-06-24 15:54:25
28c3516d7e31abea8425cd942c84d5d06db50bab96f3e0b6c9ca9693b5cda12846b2a2d31dc54d68	36	3	MyApp	[]	f	2019-06-27 14:21:28	2019-06-27 14:21:28	2020-06-27 14:21:28
9e6b9670858261ea6adff17191295916e8e1f4c8aa07f1b4a9657d00a67b0690a975d67e6036e068	36	3	MyApp	[]	f	2019-08-02 11:10:27	2019-08-02 11:10:27	2020-08-02 11:10:27
042745aa573701c8b9d6f565e7a975da63d8e894e1d6837ca458ce3e39c75ddb758f8e4b344aef0a	36	3	MyApp	[]	f	2019-08-05 11:27:28	2019-08-05 11:27:28	2020-08-05 11:27:28
c1c9938d9d98f7482717cc11dd0c4c4a0f2549bbdf6441b5486cf5ceca0acf8c2cd210e9e2698cc0	36	1	MyApp	[]	f	2019-04-12 14:18:45	2019-04-12 14:18:45	2020-04-12 14:18:45
57b13b2d5a226c4a325b590670003a0dbbad8f43e7d973c8db0a7f19078bef8f36d8fa038b439213	36	1	MyApp	[]	f	2019-04-24 17:43:28	2019-04-24 17:43:28	2020-04-24 17:43:28
1399c7ac8eefedaec2775d2c491fb639c6a40346568490f2a7b10d8a8ab9ff7ce5bc5103eade61c5	36	1	MyApp	[]	f	2019-04-30 14:05:08	2019-04-30 14:05:08	2020-04-30 14:05:08
16ca6800bbd497a5d75cc4f4cfac7f4b6f9c08c34986c429982718fcf39ff5ca0a05834217a03c52	36	1	MyApp	[]	f	2019-05-02 17:07:19	2019-05-02 17:07:19	2020-05-02 17:07:19
dadfafc8779213393b9fe84d97454ff94f81649c6d51495c623bf473dbb15e18460012078c6058f5	138	1	MyApp	[]	f	2019-05-10 15:05:19	2019-05-10 15:05:19	2020-05-10 15:05:19
cd108766199eaa969261f43cf5d4a88f148e93dfaea03ae0e1477a34cb4f3562fdd3b2085a714466	36	1	MyApp	[]	f	2019-05-10 15:53:51	2019-05-10 15:53:51	2020-05-10 15:53:51
6c348ba670e9526be626af4019638b97c94ae56e05b91d4b8d3b3f5bb69be97d303107bda99ee093	36	1	MyApp	[]	f	2019-05-10 16:46:17	2019-05-10 16:46:17	2020-05-10 16:46:17
8281f5e30b26e957ff5a35fa24566e27611868163a0908fcce70d068c281bd1875188fc87cf4104d	36	1	MyApp	[]	f	2019-05-14 18:03:20	2019-05-14 18:03:20	2020-05-14 18:03:20
02aa8080b404056134fcff6c5fc06389ba4e07ec4feb19577ca8eb08976b7db36e5bdd2241681ddf	36	1	MyApp	[]	f	2019-05-17 15:11:44	2019-05-17 15:11:44	2020-05-17 15:11:44
f96e2419a4fe12fa88e82e833c701386cf4173c6b172a9b54e173bab49bd16a81f9fbd9028f4635b	36	1	MyApp	[]	f	2019-05-23 15:03:26	2019-05-23 15:03:26	2020-05-23 15:03:26
b3cbb9b17b19aeda382a99c6d21c6904ac38d76178800edc3d0f58607befd2daf5b8546c1fc24411	36	1	MyApp	[]	f	2019-05-30 15:53:21	2019-05-30 15:53:21	2020-05-30 15:53:21
1e977302411d329cac0f5c9b3720716e3cf9eb8c9d86774077ff712806312d8baf868536a1621636	149	1	MyApp	[]	f	2019-06-06 15:47:33	2019-06-06 15:47:33	2020-06-06 15:47:33
baef0cd07ec0018d35dad211def0d223279cc3033afd0f646146da448dc7f5b2f0140907e59507d0	36	1	MyApp	[]	f	2019-06-24 17:22:21	2019-06-24 17:22:21	2020-06-24 17:22:21
38c95ec12019133f3145845f0184fffdbde1232315c7ddaca7bc8fd0818449747b838e78b54a0215	36	3	MyApp	[]	f	2019-06-28 14:35:24	2019-06-28 14:35:24	2020-06-28 14:35:24
4dcafb413662df2bb2ddaaa6d15eb6cd35d7c8e02b2e8d1064b137eccc82825c46c2f21d110808fa	36	3	MyApp	[]	f	2019-08-02 11:13:02	2019-08-02 11:13:02	2020-08-02 11:13:02
e2da6943c3f0d0961dfaa1d14164f77153d5c8a74e7154350ddc2f95770850c92f6becb320be8a2f	36	3	MyApp	[]	f	2019-08-05 11:29:35	2019-08-05 11:29:35	2020-08-05 11:29:35
15427c739cc5087c9f96ae25590fe24bd3229df834ada3fa4a79f2ddf7e2aa7a5d5dcd1e99442b28	36	1	MyApp	[]	f	2019-04-12 14:21:42	2019-04-12 14:21:42	2020-04-12 14:21:42
e9b8be88d50e02732c44bb770e93d556c98ea3fc277d4334761ad8b70799dc6225c5464dd5cb1cab	36	1	MyApp	[]	f	2019-04-25 14:12:47	2019-04-25 14:12:47	2020-04-25 14:12:47
03e0fddc15cef2ca84452afc2cfec650ab7aa1e67d11dc70b3a455a83cf58764147f8d2118d75285	36	1	MyApp	[]	f	2019-04-30 14:16:21	2019-04-30 14:16:21	2020-04-30 14:16:21
d0a647b772443d4d60a31e1772f01545da0ac063e2f1043bbc5453a63239093796a0ab5ca8ce9b30	36	1	MyApp	[]	f	2019-05-03 14:33:02	2019-05-03 14:33:02	2020-05-03 14:33:02
aa71cfca1be962752abc63cdf4230a292ca0e29e0189b1b32d31ed331ce9195ebfe9bcd20e413c4d	140	1	MyApp	[]	f	2019-05-10 15:05:51	2019-05-10 15:05:51	2020-05-10 15:05:51
82eaeedaef640872c8d3ce20de125a2bf9a39a34d269e9fcfcc021a86dda3e7c379f87052703ad19	36	1	MyApp	[]	f	2019-05-10 15:54:49	2019-05-10 15:54:49	2020-05-10 15:54:49
c3d99731e5c2837660665e54d78f2cf3019743251be7046966056b3c3eeec01b5c6682bad2d58a47	36	1	MyApp	[]	f	2019-05-10 16:46:24	2019-05-10 16:46:24	2020-05-10 16:46:24
52db0f261a8309e7e195585836bf29d410d2aeb0705dd8723aeda127bfa80b923b8e6485c3e9f644	135	1	MyApp	[]	f	2019-05-14 18:03:41	2019-05-14 18:03:41	2020-05-14 18:03:41
ccab10cb08ccfabf762acaa38c3f3ecccaf67d1b7d2a9331fb1607ab9c07c26b53d3485de0fdeccd	36	1	MyApp	[]	f	2019-05-17 15:19:35	2019-05-17 15:19:35	2020-05-17 15:19:35
dcc642d28d00ed4d431f87ee4d3b0a9d57bcf2c4b13409e19bb5fe1b9ed131b61a156806463ba999	36	1	MyApp	[]	f	2019-05-24 14:35:26	2019-05-24 14:35:26	2020-05-24 14:35:26
6b0ae99aad14104533252f8cbec7c66c33f9ceb4e3898011718c63b1c26cd53c595483ba80db66e4	36	1	MyApp	[]	f	2019-05-30 16:31:35	2019-05-30 16:31:35	2020-05-30 16:31:35
8faac9c8d92b9409c23c837b1c62457c8516e5c9b58e8a7356ac160a21db6e4855aace032d614765	36	1	MyApp	[]	f	2019-06-06 15:49:43	2019-06-06 15:49:43	2020-06-06 15:49:43
2b0ce318422c9d117c3d56fadf96a7fc965fda2ae7f5c44f3179782a4617d60cc25e32a06d5ac55f	36	1	MyApp	[]	f	2019-06-24 17:40:05	2019-06-24 17:40:05	2020-06-24 17:40:05
b3fd7c866f307acd220a7be1f702ad0def1f81ccf6d8cc670adbf2b0c5ea9412bbb946380ea8eaf0	36	3	MyApp	[]	f	2019-06-28 16:52:29	2019-06-28 16:52:29	2020-06-28 16:52:29
b778c32f6ed288faca5a5e1644b2756ed2bade5a73b5290a4fcdd1aa7064ed48b60a0fd414d35289	36	3	MyApp	[]	f	2019-08-02 11:34:16	2019-08-02 11:34:16	2020-08-02 11:34:16
e0f0d35d063156a2dffe2763b398b17cd55bd3abc8f1f9c00a01d428963e95ad32082cd1132cf861	36	3	MyApp	[]	f	2019-08-05 11:41:33	2019-08-05 11:41:33	2020-08-05 11:41:33
d04e4288775c0bd9cac585b35635ae5f59bd78f3818cdd20150d12ec9a6571ed25125e98c52bf941	36	1	MyApp	[]	f	2019-04-12 14:41:53	2019-04-12 14:41:53	2020-04-12 14:41:53
f5b2d676db9c6ed116234a85e1b20f146e927df431431b1c7cca0651bf5195f15253c4882871fc42	36	1	MyApp	[]	f	2019-04-25 14:12:50	2019-04-25 14:12:50	2020-04-25 14:12:50
05f67a05e162e9b6cfe98cb797fd063947261015054dff7ade9a70e4e49ea951c6be2fb6de6b4440	36	1	MyApp	[]	f	2019-04-30 14:20:54	2019-04-30 14:20:54	2020-04-30 14:20:54
4a48958d35ec9b01ed0d9256683527b0c9d66c2df77f518fe300769b5251eb16f36422bb195db750	36	1	MyApp	[]	f	2019-05-03 15:05:01	2019-05-03 15:05:01	2020-05-03 15:05:01
f3aad8959a90671a96e50fef2f2d38e49bc0e634601f2bb0325895861a6fd59e7675446e21e4f76c	141	1	MyApp	[]	f	2019-05-10 15:06:42	2019-05-10 15:06:42	2020-05-10 15:06:42
605a7116155a03d91c897b0a203a971f18f0b1c9bbbb9cb5e159be51c4d9397c8dfb6038cb4a365b	36	1	MyApp	[]	f	2019-05-10 15:55:32	2019-05-10 15:55:32	2020-05-10 15:55:32
e5206be9a7264fb8330c14b4c3a7e125252cf2a9e9517a0492087b07bf8e8cf97c8f1145e52cfa2f	36	1	MyApp	[]	f	2019-05-10 16:47:09	2019-05-10 16:47:09	2020-05-10 16:47:09
0084dc36fd0816578a5df0d8ba51f11a04d108b50f96124978aed205f0a091bdc4c072b7ea42f84a	36	1	MyApp	[]	f	2019-05-14 18:05:18	2019-05-14 18:05:18	2020-05-14 18:05:18
7c1369d0b1751695a65516d5f87b1ac03bb80ac48b9e59adaa0dc12d84975d75c2888f8cd0100a30	36	1	MyApp	[]	f	2019-05-17 15:55:00	2019-05-17 15:55:00	2020-05-17 15:55:00
e5d709d34d0f6916edd4293679db212ab63f1b101b4e48e83e1c11b9c571198887d420cc977bd4fa	36	1	MyApp	[]	f	2019-05-24 14:47:41	2019-05-24 14:47:41	2020-05-24 14:47:41
adadebcc17c3efac94bd352214def12fe170f853c20af34c003f184656b5b230939080fa76348c70	36	1	MyApp	[]	f	2019-05-30 16:57:43	2019-05-30 16:57:43	2020-05-30 16:57:43
f33be3e7f0ee0a2033f76c3a860dbdab7487cd0df8765898b05dc50a42bb32174439178b84983f31	149	1	MyApp	[]	f	2019-06-06 15:50:00	2019-06-06 15:50:00	2020-06-06 15:50:00
f0a31c9b97ff4433c36093748cf379a8e1645869dccc384a3da46d9b899f5cbfac1939dbc7bbd0da	36	3	MyApp	[]	f	2019-06-25 08:26:48	2019-06-25 08:26:48	2020-06-25 08:26:48
c5ca99cb84a6941d442769cf5a18027c16fb62a4f6e9d3ebfe2aaa2e72ae353e9e3bd5ace8b81f2f	36	3	MyApp	[]	f	2019-07-01 13:42:33	2019-07-01 13:42:33	2020-07-01 13:42:33
5e4136335605ee38a8553d135e42242e9cc0de7a2a5367ed9ee78efd3419090ac5d07bf53ed0fd31	36	3	MyApp	[]	f	2019-08-02 11:36:27	2019-08-02 11:36:27	2020-08-02 11:36:27
e1e0a58ee083409673e5dac08593452a083ec5f4455bdbf60c435592183071812ae3b9410851de5c	36	3	MyApp	[]	f	2019-08-05 18:35:58	2019-08-05 18:35:58	2020-08-05 18:35:58
a567679535096e433545eda8a0529042602cb998a9187edc809bb6d22c692e126bc4a329d83b1428	36	1	MyApp	[]	f	2019-04-12 14:43:51	2019-04-12 14:43:51	2020-04-12 14:43:51
0361532429e491cedb7019e5285729532becc0b0f9d8531de1aff558d73751869f388490b01ab72d	36	1	MyApp	[]	f	2019-04-25 15:05:45	2019-04-25 15:05:45	2020-04-25 15:05:45
6e5c6e63cbd25b2307e9229e20e151b788273009ebaf9dbe93d4e62f45c1b16d8d2467210c94b234	36	1	MyApp	[]	f	2019-04-30 14:21:40	2019-04-30 14:21:40	2020-04-30 14:21:40
9aa7a34648def2ce681c64227e97d6117b64e0dcbd59543235e7d8d628f4c44d00f73426d3154844	36	1	MyApp	[]	f	2019-05-03 16:01:57	2019-05-03 16:01:57	2020-05-03 16:01:57
83ac49835ad08c787c163baa12c568a83697ba0140a9021fece14f502e144761a4c44d8682a4ce33	142	1	MyApp	[]	f	2019-05-10 15:07:24	2019-05-10 15:07:24	2020-05-10 15:07:24
ef1431e092574777d2b01dd0e9629556d3917503fa58e1cb0a0d19a0b9d135ce61124438a05f5681	36	1	MyApp	[]	f	2019-05-10 15:56:04	2019-05-10 15:56:04	2020-05-10 15:56:04
43961a01682e3d965d17bae89d2217f34a35ad0a4c64d5febc3dd81c56c765aff7c840f4e295f231	36	1	MyApp	[]	f	2019-05-10 16:58:21	2019-05-10 16:58:21	2020-05-10 16:58:21
0d57f1958302ee57617e928e509398661971076b28cb1bafec2c6027c3f504ae45dd40c86dd3ca21	36	1	MyApp	[]	f	2019-05-15 14:30:35	2019-05-15 14:30:35	2020-05-15 14:30:35
2f1c500cd1404e7762f8e8018067e37ff7ddfc0369ed616808eb49a16c98396e781b09634317b5c3	36	1	MyApp	[]	f	2019-05-18 13:19:33	2019-05-18 13:19:33	2020-05-18 13:19:33
95550d1cf54b485482a59031d9c0521109d3e3c0946108ebce97be9dfcff4209dca68fb685a34cd7	36	1	MyApp	[]	f	2019-05-24 14:53:19	2019-05-24 14:53:19	2020-05-24 14:53:19
a10d198a87ca91b28cc276596706d5def83739b88425d7a562b72c0041d7a182ed87fcb9700949ca	36	1	MyApp	[]	f	2019-05-31 14:00:01	2019-05-31 14:00:01	2020-05-31 14:00:01
98d03d835db70b3417f2983d493751ab9935309d8ec87eb6a270acecf6750b8d8143c01e21b3a852	36	1	MyApp	[]	f	2019-06-06 16:07:13	2019-06-06 16:07:13	2020-06-06 16:07:13
e7a2b07dd984b4ac4c1ebc82f00d2407ea1fc665a61c739740e1f2fa64917ccafa6297238a4ffd52	36	3	MyApp	[]	f	2019-07-01 16:57:53	2019-07-01 16:57:53	2020-07-01 16:57:53
e6b6debf80bd921e167742b15dfe645a0c7ea20115d1164a00b60d4f0129f79cb916636a5a653112	36	3	MyApp	[]	f	2019-08-02 11:38:29	2019-08-02 11:38:29	2020-08-02 11:38:29
adf3d781488d67e253deebca116aff46e3c8b30dfd8f9f0405fc5e9e2faae6ca8672ab327e1d3fd4	36	3	MyApp	[]	f	2019-08-06 09:30:21	2019-08-06 09:30:21	2020-08-06 09:30:21
6340a5c67772722ec17af61b1bcb69261d89cccf2077217a6e4358ff8cd36c03332ae8ed6665ebc3	36	1	MyApp	[]	f	2019-04-12 15:35:49	2019-04-12 15:35:49	2020-04-12 15:35:49
0d7b4400da247b8010a4fe28c2cb2966ccbdbc8a08ff4ad222dcc313de715f513578755899628667	36	1	MyApp	[]	f	2019-04-25 16:49:44	2019-04-25 16:49:44	2020-04-25 16:49:44
2b139ec38edc16af46be8cfa7ecff738440307faac3725b4abbd1d8c1ded693614830c6c2200bfb1	135	1	MyApp	[]	f	2019-04-30 14:55:18	2019-04-30 14:55:18	2020-04-30 14:55:18
3456e4d7283e3a4893d05a0741696d37df5f5116de5ca871c6d2a5f94a0d06cbbcb1916a86643867	36	1	MyApp	[]	f	2019-05-03 16:47:14	2019-05-03 16:47:14	2020-05-03 16:47:14
46d92517a80e2e4c392e479dc052d99f995265905c955d648546e0481fe1705f18a814cc18b413a8	143	1	MyApp	[]	f	2019-05-10 15:17:39	2019-05-10 15:17:39	2020-05-10 15:17:39
8de43df1fe9f081f615c6c7ccbc44e77f2aa396a7918c31e54b8c6ed2097f8feba12cc115dabf90c	36	1	MyApp	[]	f	2019-05-10 15:57:14	2019-05-10 15:57:14	2020-05-10 15:57:14
e4ac9a3c832932ea98c274ab43bf109ce508b174927c52a16e0dc0f857a697108fb79aea9fc78993	36	1	MyApp	[]	f	2019-05-10 17:00:11	2019-05-10 17:00:11	2020-05-10 17:00:11
f4943235d3172a321e6815305d81ccd3b3c753214eb9c7fe0ede0a3cb8c658ed6d34dce5193bdaee	36	1	MyApp	[]	f	2019-05-15 15:24:36	2019-05-15 15:24:36	2020-05-15 15:24:36
5b60b4f1b8ab4e330f8853d6355e11c3d3aa16c3870e0907ddb0c45629e5111bfc251610bc908b5d	36	1	MyApp	[]	f	2019-05-18 13:19:47	2019-05-18 13:19:47	2020-05-18 13:19:47
00f47fd5c5f7156f83754c904a935b51d67f1d3f0a754b29abddc07240a76f644ee165f1719573aa	36	1	MyApp	[]	f	2019-05-24 15:45:35	2019-05-24 15:45:35	2020-05-24 15:45:35
ac993c2347e3bb02ef40eae61f7f5ed4f645d53a978e4e08ea80daca8816bbd6842341805831b1c5	36	1	MyApp	[]	f	2019-05-31 14:01:26	2019-05-31 14:01:26	2020-05-31 14:01:26
e54b5abf58eacd3a47c7e5666f6dc286b21d7b7da621d9266fbabd075168fb5c332645db78857848	36	1	MyApp	[]	f	2019-06-06 22:09:19	2019-06-06 22:09:19	2020-06-06 22:09:19
1fa09ff6001b2ce5db74e26b393094d03b70531a082b77f282807af0a4570e0df6e74be51c0bf881	36	3	MyApp	[]	f	2019-07-02 10:02:40	2019-07-02 10:02:40	2020-07-02 10:02:40
5f0ac1288bc37e7ad971cf1fa7832ede5b47f79fb5483a96bbc50978291eb03b7214b23a90ab870e	36	3	MyApp	[]	f	2019-08-02 11:39:05	2019-08-02 11:39:05	2020-08-02 11:39:05
8fc9133f932016c7dc2c659fbc231b637fdb4370abcba756deb283863eb8f24eb1b5667ff1d3ae41	36	3	MyApp	[]	f	2019-08-06 10:30:58	2019-08-06 10:30:58	2020-08-06 10:30:58
d1f629d773466e125c602214ae477329b72b6ee5a5b7479b8e2ef1e59f70e9dc0093f8ce025f7b91	36	1	MyApp	[]	f	2019-04-12 15:36:14	2019-04-12 15:36:14	2020-04-12 15:36:14
7d5d86fafdc940e501814f5631959cb64fdcd30e1536e31fa4e08ae4e5bbe3507d48866411938bf5	36	1	MyApp	[]	f	2019-04-26 13:54:18	2019-04-26 13:54:18	2020-04-26 13:54:18
1f06a3857cfb2c9781f10e5aaab8be7d0c5daf0c9aaf69792b246fb78befbc6adecc0c65f9befdf8	36	1	MyApp	[]	f	2019-04-30 16:01:44	2019-04-30 16:01:44	2020-04-30 16:01:44
54e64df7af87d7b47bd1ac0cedbb88390ca8269ac5d0397365f835ec53e7c4257c731310d93d86a6	36	1	MyApp	[]	f	2019-05-05 19:33:34	2019-05-05 19:33:34	2020-05-05 19:33:34
9bbf374a996f722d98e6a5a65c3c9101f39993b74b6aed752ec4a20bb6e547011083cb01ddd7dabf	36	1	MyApp	[]	f	2019-05-10 15:20:29	2019-05-10 15:20:29	2020-05-10 15:20:29
a5784034bc13f41afb18e0fb69a3c71a2aaec836a386ed2fcf6953d36a8c2dab63e1699039c574d6	36	1	MyApp	[]	f	2019-05-10 15:57:59	2019-05-10 15:57:59	2020-05-10 15:57:59
e9aba9a4fc61e161b16ab1de0eead955a4ed08c0de92125704cd536ef867bc08e5776dd67f969a32	36	1	MyApp	[]	f	2019-05-10 17:00:34	2019-05-10 17:00:34	2020-05-10 17:00:34
40f8256cea1ad2690df7329e278a9aeec857bc90b5621a99f05623be2b327d21bbb63ebaf24884b2	36	1	MyApp	[]	f	2019-05-15 15:41:34	2019-05-15 15:41:34	2020-05-15 15:41:34
14311854c7363a33a2a062e7b332874558b66355d9822541157baa3bc48fd576a79f1e345ebd154a	36	1	MyApp	[]	f	2019-05-18 13:22:10	2019-05-18 13:22:10	2020-05-18 13:22:10
c169bbd6d8b3df0fe7720d1f282bd0328ea4033b85d7cb10a9e935b697079fd23beb77ed8a325c25	36	1	MyApp	[]	f	2019-05-24 15:52:00	2019-05-24 15:52:00	2020-05-24 15:52:00
b372aef8520c4b1cbca44c1a34ad9da90628bf45ccdd57b94c508a4598753cb89bdf48a7272be986	36	1	MyApp	[]	f	2019-06-03 14:26:21	2019-06-03 14:26:21	2020-06-03 14:26:21
be6eae87c6adb6a275b8a431704ea0512ab90ca7ced2e27fd3d57953d24ed6f803db124d58840139	36	1	MyApp	[]	f	2019-06-07 14:14:31	2019-06-07 14:14:31	2020-06-07 14:14:31
d12a35860665f9116090c6fff58cb445122040b086ce4a344edb3016e483f09b8df9f1ca25a62eb5	36	3	MyApp	[]	f	2019-07-02 10:07:59	2019-07-02 10:07:59	2020-07-02 10:07:59
389dbeff3d5e7d9c63ef07019f83be8c2f93c4319c24ff38fc440438948fa5db516f99c654a3f08e	36	3	MyApp	[]	f	2019-08-02 11:55:47	2019-08-02 11:55:47	2020-08-02 11:55:47
5fb74deb94a934c108ac6929ad4fcbf7ee7363fea9a02072211e730057c07a6163defed2632d39f7	36	3	MyApp	[]	f	2019-08-06 14:24:21	2019-08-06 14:24:21	2020-08-06 14:24:21
82df7e2b92084248a3cb434ce0248e5bf1714bd14e676d62a6c08715b9cf3b64795b90d873465eb1	36	1	MyApp	[]	f	2019-04-12 15:38:01	2019-04-12 15:38:01	2020-04-12 15:38:01
c49b1152648335acde37392f499ed393efe6fe9ecf0e6b8b313fd60c8933710927273c261455d849	36	1	MyApp	[]	f	2019-04-26 13:54:20	2019-04-26 13:54:20	2020-04-26 13:54:20
c1f8d573037d795036f0551e45fc7e50d44738ea226de339ef5cb8336eaa81e743a3e3f656c69423	36	1	MyApp	[]	f	2019-04-30 16:41:26	2019-04-30 16:41:26	2020-04-30 16:41:26
ed9005bc86b15728196c3b85829903620588f357074efcdd2b1eabb3fc3595d41eb966ee9efeb614	36	1	MyApp	[]	f	2019-05-06 14:02:27	2019-05-06 14:02:27	2020-05-06 14:02:27
b67dba30d8c440f35e29375a1008f83cd8317679dd7d20c84dd4ed5d779b54fdf6711a1f5ba5c9ab	36	1	MyApp	[]	f	2019-05-10 15:31:46	2019-05-10 15:31:46	2020-05-10 15:31:46
19d3678a674b8cf9970d5a5ebd19df2b46d97b7e55c2a982f06cbe67d5bba0eea663c95244644f13	36	1	MyApp	[]	f	2019-05-10 16:08:59	2019-05-10 16:08:59	2020-05-10 16:08:59
1908b00dec9d45a47f2659c9fb3e3247b856b945f9bde98dd80b855a277f6ea90d337ea97cb6cc26	36	1	MyApp	[]	f	2019-05-10 17:01:25	2019-05-10 17:01:25	2020-05-10 17:01:25
4a83f2fd5221b3069a010934dc6cb19a184bccaa1a56843992cdcc888ebd4ad92be08a7c3bc18305	36	1	MyApp	[]	f	2019-05-15 15:48:43	2019-05-15 15:48:43	2020-05-15 15:48:43
f8093c11b5236eb1a2b44cdaa80eadb6873441b77f01d723e8bd25f0d3a46cb7b09bc0366b4f8435	36	1	MyApp	[]	f	2019-05-20 13:57:54	2019-05-20 13:57:54	2020-05-20 13:57:54
1c804c2380a597f01b83b680cb48cafff6a8fcfd1d37f13f66e05d2a008e995900355fc3a81944ef	36	1	MyApp	[]	f	2019-05-24 15:58:35	2019-05-24 15:58:35	2020-05-24 15:58:35
03cb2b7631fcc78b1fa22f49551f52105c7994c1f4a0dba8c265f5fa03439457d54ae69807a6a8d2	36	1	MyApp	[]	f	2019-06-03 15:58:54	2019-06-03 15:58:54	2020-06-03 15:58:54
2374962e055ffba1eba1573568e72b777284cbac037aa3594b349757cde332b69889ddcc6d3c181a	36	1	MyApp	[]	f	2019-06-07 14:44:09	2019-06-07 14:44:09	2020-06-07 14:44:09
b447acb2ac7dadc28a9fcf36b1ecec3105630c72b980e0f2a55e4aa65a1532c0f5702cf99df8a6d1	36	3	MyApp	[]	f	2019-07-02 13:50:02	2019-07-02 13:50:02	2020-07-02 13:50:02
45bf2d8a5bb35541bc9f9c33b87602745c70a520c407f5cde9514318fa19f84101b6edc2ab9d7c13	36	3	MyApp	[]	f	2019-08-02 11:56:10	2019-08-02 11:56:10	2020-08-02 11:56:10
0b3b1176667ada6608a2c4d88d6c91dd08413c05285d3e190bab8cfcb261dfef35436b02d0bea822	36	3	MyApp	[]	f	2019-08-06 14:34:19	2019-08-06 14:34:19	2020-08-06 14:34:19
521b1456fb51d1c377edb7d13cff15b4d930c8dd4032baae1e789ab09bd4d56182bbd84d80ac383f	36	1	MyApp	[]	f	2019-04-12 16:07:29	2019-04-12 16:07:29	2020-04-12 16:07:29
2badcc6645e099c3bd1bdadff3fd2af10b039b2294c1a918bcc0f0fc4291b6916b091ac521d55ec8	36	1	MyApp	[]	f	2019-04-26 15:07:26	2019-04-26 15:07:26	2020-04-26 15:07:26
3ddc1ee74a1d2f631a83adf3f697ca12340c63364fde105502f2cc6eab18ee506684b9b8282cbf0d	36	1	MyApp	[]	f	2019-04-30 16:42:45	2019-04-30 16:42:45	2020-04-30 16:42:45
0fcf58f126d3320d38c6ddd35681f67fdbe13c351810b48610e051355b086623a5b9c50ad29f5167	36	1	MyApp	[]	f	2019-05-06 16:28:29	2019-05-06 16:28:29	2020-05-06 16:28:29
799f9e87bfead05a50c48491a20f798670c8f8e40f24c863586a4226d89b896842d07dc9974a69b9	36	1	MyApp	[]	f	2019-05-10 15:32:03	2019-05-10 15:32:03	2020-05-10 15:32:03
4cbd817df003ac571ea2f311d250e97d802669d4fa0f21c559cc3aff4089e2a425b58c5f5480948b	36	1	MyApp	[]	f	2019-05-10 16:09:41	2019-05-10 16:09:41	2020-05-10 16:09:41
85fe9745fb8b569bf00420ce3ec3446f49c1b0cf3b94bd7d168266c55e4bf7e3afa9c933ca016382	36	1	MyApp	[]	f	2019-05-10 17:06:04	2019-05-10 17:06:04	2020-05-10 17:06:04
592656bac4f0421eab21ec1f3e470b130ef8e3b2c72db624064fcd80c510b5ba1e5137bef040055c	36	1	MyApp	[]	f	2019-05-15 16:37:11	2019-05-15 16:37:11	2020-05-15 16:37:11
2e09aa21d7ba9f011569e0c3fb1d069ea5c93a1903b131afdb49bed3dd2743474c518cb40ac75238	147	1	MyApp	[]	f	2019-05-20 14:49:17	2019-05-20 14:49:17	2020-05-20 14:49:17
cb12f5303d5ce4023de6c23849a5f1e8d36080809909280dd185ce18cfa82842f15df2c5aef1118c	36	1	MyApp	[]	f	2019-05-27 13:41:59	2019-05-27 13:41:59	2020-05-27 13:41:59
d4abd019d037df6122f83ae5ed09d6f31e8b61bb068e063ff83e1ab4f63b50b755a32d339873f22c	36	1	MyApp	[]	f	2019-06-03 16:04:28	2019-06-03 16:04:28	2020-06-03 16:04:28
aa37c4d2f663b027b6128fad174fcf11b9be38e4410bdacacd557ff7bada8f5555fad78a255ce223	36	1	MyApp	[]	f	2019-06-07 15:14:17	2019-06-07 15:14:17	2020-06-07 15:14:17
c62c1043bed2e6ed69b008e81984a04755d06f1ee7be381514211226127fa98923379af7303ab65c	36	3	MyApp	[]	f	2019-07-03 14:06:33	2019-07-03 14:06:33	2020-07-03 14:06:33
6eb44eb7e3530c0d53f44ef15cedf684c6b4073487dc7874ff578e4af1d663915d6758b1411eaec3	36	3	MyApp	[]	f	2019-08-02 13:50:28	2019-08-02 13:50:28	2020-08-02 13:50:28
5cc6e5bbb5d8bcdb266bd353d97070a4de7c2f41106a1008e3c837ae2e7c83f6cb3f9a6abae318e9	36	3	MyApp	[]	f	2019-08-06 14:34:47	2019-08-06 14:34:47	2020-08-06 14:34:47
ccccb6a2be16ab13455253f2105382002ec924845765a233bc14cef731642844f9b237230c2fe324	36	1	MyApp	[]	f	2019-04-12 17:26:12	2019-04-12 17:26:12	2020-04-12 17:26:12
6a9ef98aa8586cf0ad35c72f83b36248218d3271edd0a5dc8f355d42b4be7985a03db06f0c3b0e67	36	1	MyApp	[]	f	2019-04-26 15:08:59	2019-04-26 15:08:59	2020-04-26 15:08:59
e6883840c787f1866b81be9f12e7576d4c7547cdc1cc27907f5a416981d3469fabea4c473e96076e	36	1	MyApp	[]	f	2019-04-30 16:53:39	2019-04-30 16:53:39	2020-04-30 16:53:39
9afd32cd683bbd8570b2b2c0bad0586844ec1e3797f7e1bec40062ca04a1ba3679c88ba2b1d70258	36	1	MyApp	[]	f	2019-05-06 17:22:32	2019-05-06 17:22:32	2020-05-06 17:22:32
eb6fcbe2c951277c1cdaa5a79fd4b2a1539fbc15b34291e278f3d21f2fd66df31fce4bc1ac24bd74	36	1	MyApp	[]	f	2019-05-10 15:37:31	2019-05-10 15:37:31	2020-05-10 15:37:31
f320976cd8dca6fdd60bfe43ed1d928a805f4540c5d207e3900d1d504090743609c38eacecd65031	145	1	MyApp	[]	f	2019-05-10 16:14:56	2019-05-10 16:14:56	2020-05-10 16:14:56
1124873e249e2398544629b16a64e7b3c37748afb1cc120addd30252fe21a3c9de4647cb06485a6c	36	1	MyApp	[]	f	2019-05-13 14:39:24	2019-05-13 14:39:24	2020-05-13 14:39:24
09792341a51f9fe62192e7382fdd7179f4ae0a4fa7652d64cdb881b9f0a2b81e2ca99f8bbffd0ddd	36	1	MyApp	[]	f	2019-05-15 16:42:06	2019-05-15 16:42:06	2020-05-15 16:42:06
564ddd801b4bac766d74e8f8589af6e8ca1eb9f531c1a65cb40dfb9375bcf4ae15440e8e131193a2	148	1	MyApp	[]	f	2019-05-20 15:30:19	2019-05-20 15:30:19	2020-05-20 15:30:19
2d35925370e9cec092769c7962c8f79574362392637be538f6f14870944efbd5da13e0d75df0acba	36	1	MyApp	[]	f	2019-05-27 13:43:12	2019-05-27 13:43:12	2020-05-27 13:43:12
a61e973df5697ed4d85b1a176b2d12ed9872dfa62e6d11d5ec8310627460fca5e35c88947e0467cc	36	1	MyApp	[]	f	2019-06-03 18:03:24	2019-06-03 18:03:24	2020-06-03 18:03:24
057e92d99db0bf0db708bd94e9c2bb9699b587871c50912b686a3f61621eede7f36f1f67f02e23e0	36	1	MyApp	[]	f	2019-06-07 15:30:37	2019-06-07 15:30:37	2020-06-07 15:30:37
5a94fa85dbb08dbf3062ab7b4b5a236ee7f6c2107105652cd4c96afd625d918ccfcf4481320afa89	36	3	MyApp	[]	f	2019-07-03 16:03:24	2019-07-03 16:03:24	2020-07-03 16:03:24
4129f1596c68115825fc8b944d920ee7671d44dba2f4768c17dcf157180a4627ba48338cebbd7075	36	3	MyApp	[]	f	2019-08-02 13:55:03	2019-08-02 13:55:03	2020-08-02 13:55:03
57957516714718f0b01ba5a05d8dbfa471a72453a562494981578cd8faf273e01d10723063dc89fa	36	3	MyApp	[]	f	2019-08-06 14:45:51	2019-08-06 14:45:51	2020-08-06 14:45:51
309a8dd37eaf73a030e38a3d12e3725166c2f2e53496796f8465da7281f44b1975a15056b13b6031	36	1	MyApp	[]	f	2019-04-13 21:52:45	2019-04-13 21:52:45	2020-04-13 21:52:45
d08a4fdbb61e824405e852d09219cafb25f330cb5bc081cfe2f0764a126a07a86b7ff2b900961de6	36	1	MyApp	[]	f	2019-04-26 15:11:20	2019-04-26 15:11:20	2020-04-26 15:11:20
448c5c4eeecb471dbf68f6a4c186360f80698dfd964553c1f9b766f01079be24254a890c709a8aa8	36	1	MyApp	[]	f	2019-04-30 17:10:02	2019-04-30 17:10:02	2020-04-30 17:10:02
108ac9566caaedb6fcfffa0b417e173cb1b74840aca48c29ef58d89c8cb1a818d437e82b4b169f84	36	1	MyApp	[]	f	2019-05-06 17:30:33	2019-05-06 17:30:33	2020-05-06 17:30:33
e9f22194b6ec1c33495547f1fc9e0c5002fafba4b6ff943f085307560b587157bc79b5490e1569c8	36	1	MyApp	[]	f	2019-05-10 15:38:54	2019-05-10 15:38:54	2020-05-10 15:38:54
b5078baed11ac87d6493c20c03a5ce1b9e2655315f434bc89a8abbd604693cb0d894cdc7a03c93ff	36	1	MyApp	[]	f	2019-05-10 16:17:26	2019-05-10 16:17:26	2020-05-10 16:17:26
37c027d7037d6ea8d75c6df2d5cc352c2b38486031af61bcdb85a759fa1658afe97e339822443ebe	36	1	MyApp	[]	f	2019-05-13 14:43:53	2019-05-13 14:43:53	2020-05-13 14:43:53
d2a142020c596909d5c33847a73b39f889f2139613360fc1f2706c8f6f463b4991870505841960aa	36	1	MyApp	[]	f	2019-05-15 17:17:11	2019-05-15 17:17:11	2020-05-15 17:17:11
b35530049f6f16059aa8b110943aae82c48efad981f6e0c298fb73c39d42349bd7c1bb577361872e	36	1	MyApp	[]	f	2019-05-20 16:31:59	2019-05-20 16:31:59	2020-05-20 16:31:59
ac98151de0d65a5a0d70d1177983de332e3ddc550fd8dcdc3d137c863e286da0fe201ca69eb3d62e	36	1	MyApp	[]	f	2019-05-27 15:11:55	2019-05-27 15:11:55	2020-05-27 15:11:55
f7fb2f61ac047d616876ad471b9f644cf756a45d317e4699ba766987482ea984a3b52ebae4dc225f	36	1	MyApp	[]	f	2019-06-04 15:12:09	2019-06-04 15:12:09	2020-06-04 15:12:09
93810d8223d7005bd55815806584a6966cc9a52906a37d858189f96ddb2832fb98c971507f19bdf5	36	1	MyApp	[]	f	2019-06-07 16:36:59	2019-06-07 16:36:59	2020-06-07 16:36:59
d540b14fb13c4500d137dfca9e0d38f6c075ab769b26633758903199ba3a165805ddc592f4a4062e	36	3	MyApp	[]	f	2019-07-04 14:33:32	2019-07-04 14:33:32	2020-07-04 14:33:32
6cb333743a1d00adfb4001eaf13a927b9b8891339f8b981e9dea6deb7f8cbc4be6daeeb9695ec613	36	3	MyApp	[]	f	2019-08-02 13:56:04	2019-08-02 13:56:04	2020-08-02 13:56:04
221734ad675702ba837169d6b8896d2cde8996cad7a75081adaa03e94b63aec88fdaba2d5f8894ad	36	3	MyApp	[]	f	2019-08-06 15:02:43	2019-08-06 15:02:43	2020-08-06 15:02:43
c2a9ba3b8ccf07adbde44bb81fe43fbe8ddb30615119cb946fad22d75b6fc8f44f612f6b38487bdd	36	1	MyApp	[]	f	2019-04-15 12:00:58	2019-04-15 12:00:58	2020-04-15 12:00:58
6c23989dfe9f22a55fab85a6f0a06eccc3d2359af83d0529bf9b98dbe316726f35edfd55cc7bf6d2	36	1	MyApp	[]	f	2019-04-26 15:11:42	2019-04-26 15:11:42	2020-04-26 15:11:42
a6708ce1b158a27ca42ebdfbacd06950c6405546edf328cfc823d20a039f589cd3238d60312351d4	36	1	MyApp	[]	f	2019-04-30 17:50:18	2019-04-30 17:50:18	2020-04-30 17:50:18
a20df2d5028cc918c79a3f029df02837b44d296b85e55fa8cebe8b637fb8b5505795266cca29a778	36	1	MyApp	[]	f	2019-05-06 17:47:27	2019-05-06 17:47:27	2020-05-06 17:47:27
f7e88764de18a02783fbd141cf276b322300219cc77a8c39953341a6f23a3638c0f3fbc454f00840	36	1	MyApp	[]	f	2019-05-10 15:39:22	2019-05-10 15:39:22	2020-05-10 15:39:22
37cb37fb6093b593d7334696777b73a3e27385f5343d5356657647c30acb6dd8ffbb66b3bb616e16	146	1	MyApp	[]	f	2019-05-10 16:18:26	2019-05-10 16:18:26	2020-05-10 16:18:26
373a737f6565a88353001736bb9fc79cc5f897dec34ca26f94d18422eb885b389bc0043547b404a8	135	1	MyApp	[]	f	2019-05-13 14:46:42	2019-05-13 14:46:42	2020-05-13 14:46:42
3ecc4dd80c840f455af2025f60985eb8ef09c13e02ed51ba44677b8fb8abaec6d5325e73bb005153	36	1	MyApp	[]	f	2019-05-15 17:32:16	2019-05-15 17:32:16	2020-05-15 17:32:16
233a6bf1ad6a8595f30912012e5aa5b4d7a855f00b98cb354e64366e9a0a8716e40d95553a71bdf6	36	1	MyApp	[]	f	2019-05-20 17:38:47	2019-05-20 17:38:47	2020-05-20 17:38:47
3562bfa06fb2f0d56474b9c50fbf52fad53ab91cf997265b4c4ef98f0e69e929d1b2522d8a90a781	36	1	MyApp	[]	f	2019-05-28 14:48:52	2019-05-28 14:48:52	2020-05-28 14:48:52
0baf5d0dfa46cf6aa22dc56e77439c094c726d31d91bb277b2ebf63e3f0921ef4984f51018627854	36	1	MyApp	[]	f	2019-06-04 15:14:33	2019-06-04 15:14:33	2020-06-04 15:14:33
a7ae32d82da6f349f66b7265417aa3e5846b77e50e2917df7bd4be9bad7729bf628e9c7972f72e18	36	1	MyApp	[]	f	2019-06-10 15:01:23	2019-06-10 15:01:23	2020-06-10 15:01:23
cf5658323c2fcccf35616dfc04f3999c8e64bca61fc757d36a315be72f215ea627ca3339d91be94d	36	3	MyApp	[]	f	2019-07-05 14:21:08	2019-07-05 14:21:08	2020-07-05 14:21:08
8d64edeabf46f89182ccd033f602b3190fcea2a0b97e57232cc7c837b5024cc676ab74cb56afe50b	36	3	MyApp	[]	f	2019-08-02 13:58:25	2019-08-02 13:58:25	2020-08-02 13:58:25
0d89843ce01db50d361809a1d4de3aa160e5daf287d85f5fc7ccce0811a3d5ecc96bffc84f65622e	36	3	MyApp	[]	f	2019-08-06 15:52:13	2019-08-06 15:52:13	2020-08-06 15:52:13
9ea4e98d0cf1ead0ebee8244cad265626de251951341b03d9fa5716e6b150f668810a2404627d9f8	36	1	MyApp	[]	f	2019-04-15 12:00:58	2019-04-15 12:00:58	2020-04-15 12:00:58
3cbf3acc2f3af72915b7a7032daeecc0cbcd476085ae0778b9823f9ad7b1429a29ced756de926c24	36	1	MyApp	[]	f	2019-04-26 15:38:49	2019-04-26 15:38:49	2020-04-26 15:38:49
1c61140d179bbee8fc61f38fb1752baaceeee6b545e2a8e19623b3be11537417821719c68da2ba88	36	1	MyApp	[]	f	2019-05-01 14:09:19	2019-05-01 14:09:19	2020-05-01 14:09:19
5fa8fdaaa21f84097ba0ea813f7151cb106c2c71914fa2d246d00d047e083a944b1f8aabb88b0f22	36	1	MyApp	[]	f	2019-05-07 14:13:03	2019-05-07 14:13:03	2020-05-07 14:13:03
196d0e4d0d1f44dbe82303fb63b33baf16e514daf8a2968899b581be56b1c6041794d62e2518c8d1	36	1	MyApp	[]	f	2019-05-10 15:41:09	2019-05-10 15:41:09	2020-05-10 15:41:09
4981bcfae78a3be4853795f8ddbab7f6684303813c5f682c93300e6331f1970d0ab3170f99f6cdf4	36	1	MyApp	[]	f	2019-05-10 16:36:21	2019-05-10 16:36:21	2020-05-10 16:36:21
90b063885fb4691682df66aeb6826f6f248f9ac658583d3021e306b4b3e3d42e61d50c99197ae447	36	1	MyApp	[]	f	2019-05-13 14:47:13	2019-05-13 14:47:13	2020-05-13 14:47:13
ca3b11a0f19bed3802e388a1479afb07f08d9dc73484acb38d40a4b9a68d5a44db3e373e189696e1	36	1	MyApp	[]	f	2019-05-15 17:34:46	2019-05-15 17:34:46	2020-05-15 17:34:46
1456c9e9c789523ae8aabe52424fe8554fa6b554d1794a83a4a954152ac0a58a5d16a5876398afac	36	1	MyApp	[]	f	2019-05-20 18:07:58	2019-05-20 18:07:58	2020-05-20 18:07:58
9276e48b7e6e4a76516409deea741b56c75d6b57d52ad5c115f4202f09436c784a2b39c268d78975	36	1	MyApp	[]	f	2019-05-28 15:21:38	2019-05-28 15:21:38	2020-05-28 15:21:38
8f24d737ce94b2464052ba8b0da0b9bd653235c9abf20bba40f71ce6c5b82972c841f922e357e177	36	1	MyApp	[]	f	2019-06-04 21:39:32	2019-06-04 21:39:32	2020-06-04 21:39:32
faeeb8d86b25654829813174363ce35637aa84d1a8e7a5f70c76bd1e3db47311ac074b7ca9991ff1	36	1	MyApp	[]	f	2019-06-10 16:23:01	2019-06-10 16:23:01	2020-06-10 16:23:01
da7fcad69813bde44fbddc864c51416fcde688bd30e27749947096f63bb99b1bce1db4e3fad6d2ea	36	3	MyApp	[]	f	2019-07-05 16:18:02	2019-07-05 16:18:02	2020-07-05 16:18:02
8714f1abf0674328c6c19a8bc63055ac18f115126020f2ef2a0cfed69086527ee6d880991af475c7	36	3	MyApp	[]	f	2019-08-02 14:16:04	2019-08-02 14:16:04	2020-08-02 14:16:04
fe23b3cc63f9021b2a52b963711be43b37179d0e30c411ce8ec6cf4a90f68905c1a8e79224bdf3eb	36	3	MyApp	[]	f	2019-08-06 16:40:50	2019-08-06 16:40:50	2020-08-06 16:40:50
2848a611ca414b9afe31219079ba0d5b6568bb478d19d86595029741ad56bb9c322aa3863d3d2c6f	119	1	MyApp	[]	f	2019-04-11 13:38:48	2019-04-11 13:38:48	2020-04-11 13:38:48
86cc13d38364024905f3bf31e63aa2c2211c148a48f8275c06c45236a0b98a4a8dbbafa767d13915	36	3	MyApp	[]	f	2019-07-20 13:18:06	2019-07-20 13:18:06	2020-07-20 13:18:06
41082c3da363cffafbb0e3cb5f5c50f1b460f01d63c095999251879eedcff9ead9d775a287086084	36	3	MyApp	[]	f	2019-08-02 14:39:04	2019-08-02 14:39:04	2020-08-02 14:39:04
843829ea884d3902fcaa526b40fd4741a65753784fd3d7a330dd70bfeb6ada5f8cee489135c900f0	36	3	MyApp	[]	f	2019-08-06 16:46:25	2019-08-06 16:46:25	2020-08-06 16:46:25
\.


--
-- Data for Name: oauth_auth_codes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.oauth_auth_codes (id, user_id, client_id, scopes, revoked, expires_at) FROM stdin;
\.


--
-- Data for Name: oauth_clients; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.oauth_clients (id, user_id, name, secret, redirect, personal_access_client, password_client, revoked, created_at, updated_at) FROM stdin;
1	\N	Laravel Personal Access Client	VaL2TluiO04btxzlP6cFvY7AN4YgYRxTNBUoQJl2	http://localhost	t	f	f	2018-08-27 19:28:46	2018-08-27 19:28:46
2	\N	Laravel Password Grant Client	W91pAJuvWdPXOwLvODjbZHpbG0jObAoOIIEZhbFF	http://localhost	f	t	f	2018-08-27 19:28:47	2018-08-27 19:28:47
3	\N	Laravel Personal Access Client	kVMuqispbVw7Jg74PdjagvVBWXT1pdqtMtyvxRUw	http://localhost	t	f	f	2019-06-25 08:26:19	2019-06-25 08:26:19
4	\N	Laravel Password Grant Client	wXC7ANb04ocGxulsAFSQZELHhdDhI1GPc9JDekrN	http://localhost	f	t	f	2019-06-25 08:26:19	2019-06-25 08:26:19
\.


--
-- Data for Name: oauth_personal_access_clients; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.oauth_personal_access_clients (id, client_id, created_at, updated_at) FROM stdin;
1	1	2018-08-27 19:28:47	2018-08-27 19:28:47
2	3	2019-06-25 08:26:19	2019-06-25 08:26:19
\.


--
-- Data for Name: oauth_refresh_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.oauth_refresh_tokens (id, access_token_id, revoked, expires_at) FROM stdin;
\.


--
-- Data for Name: paises; Type: TABLE DATA; Schema: public; Owner: sysdba
--

COPY public.paises (id, nome, sigla) FROM stdin;
1	Brasil	BR
\.


--
-- Data for Name: papels; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.papels (id, nome, ativo, created_at, updated_at) FROM stdin;
66	ultimo	1	2019-07-02 10:58:55	2019-07-02 10:58:55
67	NOVOUlt	1	2019-07-02 11:01:53	2019-07-02 11:01:53
68	ult	1	2019-07-02 12:11:22	2019-07-02 12:11:22
69	teste	1	2019-07-02 12:11:50	2019-07-02 12:11:50
70	Papel 1	1	2019-07-02 12:14:16	2019-07-02 12:14:16
64	Todos	1	2019-06-06 15:56:47	2019-06-06 15:56:47
65	nenhum	1	2019-06-06 15:56:52	2019-06-06 15:56:52
\.


--
-- Data for Name: papels_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.papels_users (id, id_users, id_papels, created_at, updated_at) FROM stdin;
440	149	64	2019-08-07 11:50:35	2019-08-07 11:50:35
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: permissoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissoes (id, descricao, created_at, updated_at) FROM stdin;
11	inspecionar	2018-09-14 15:08:41	2018-09-14 15:08:41
12	editar	2018-09-14 15:08:41	2018-09-14 15:08:41
13	criar	2018-09-14 15:08:41	2018-09-14 15:08:41
14	ver	2018-09-14 15:08:41	2018-09-14 15:08:41
15	deletar	2018-09-14 15:08:41	2018-09-14 15:08:41
\.


--
-- Data for Name: permissoes_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissoes_users (id, id_users, id_permissoes, created_at, updated_at) FROM stdin;
658	36	11	2019-08-06 10:21:39	2019-08-06 10:21:39
659	36	12	2019-08-06 10:21:39	2019-08-06 10:21:39
660	36	13	2019-08-06 10:21:39	2019-08-06 10:21:39
661	36	14	2019-08-06 10:21:39	2019-08-06 10:21:39
662	36	15	2019-08-06 10:21:39	2019-08-06 10:21:39
663	149	11	2019-08-07 11:50:35	2019-08-07 11:50:35
664	149	12	2019-08-07 11:50:35	2019-08-07 11:50:35
665	149	13	2019-08-07 11:50:35	2019-08-07 11:50:35
666	149	14	2019-08-07 11:50:35	2019-08-07 11:50:35
667	149	15	2019-08-07 11:50:35	2019-08-07 11:50:35
\.


--
-- Data for Name: processos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.processos (id, nome, documento, ativo, created_at, updated_at) FROM stdin;
171	Processo 1	Doc1	1	2019-06-26 16:22:18	2019-06-26 16:22:18
172	Processo 2	Doc2	1	2019-07-02 13:52:57	2019-07-02 13:52:57
\.


--
-- Data for Name: processos_setors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.processos_setors (id, processos_id, setors_id, created_at, updated_at) FROM stdin;
141	171	170	2019-06-26 17:25:08	2019-06-26 17:25:08
142	172	171	2019-07-02 13:53:04	2019-07-02 13:53:04
143	172	172	2019-07-02 13:53:11	2019-07-02 13:53:11
\.


--
-- Data for Name: setors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.setors (id, nome, ativo, created_at, updated_at) FROM stdin;
170	Setor 1	1	2019-06-26 17:25:08	2019-06-26 17:25:08
171	Setor 1	1	2019-07-02 13:53:04	2019-07-02 13:53:04
172	Setor 2	1	2019-07-02 13:53:11	2019-07-02 13:53:11
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, nome, telefone, email, password, remember_token, created_at, updated_at, ultimoacesso, ativo) FROM stdin;
36	Gerente	(49)9 9999-9999	admin	$2y$10$A1Lp5txHDF8uNHAtZmp9ZObpZN5Hk1hcGKqb3LFyOZb8WRzQz9vaO	\N	2018-10-01 14:44:36	2019-08-07 11:50:06	2019-08-07 11:50:06	1
149	Siosi	(49)9 9999-9999	siosi	$2y$10$09Y0MRcluCpxjKM66NmFVuFvHvYiquKbwOjriC/EpKTR78gkqU/4q	\N	2019-06-06 15:47:14	2019-08-07 11:51:00	2019-08-07 11:51:00	1
151	Murilo Silvani	(49)9 9998-5044	murilo.silvani@gmail.com	$2y$10$L1EyhcABdBfOE7BNfgDDyeHqPDmv8hIoJ9tDQK1CQ1LGBI1yq5Gl.	\N	2019-08-07 11:54:39	2019-08-07 11:55:12	2019-08-07 11:55:12	1
147	master	(49)9 9999-9999	teste	$2y$10$lGPJBS8ekHE1VSUbGEcboOX4MD3niMq6eDwTxrDa2nKabNjvMV.VG	\N	2019-05-20 14:49:17	2019-05-20 15:29:48	\N	0
148	masterXX	(49)9 9999-9999XX	ssssssXX	$2y$10$DV2C/OFNdmta08zOgavOuehgQjPaUWl9ekRDYj63gpKDOiSgv8P16	\N	2019-05-20 15:30:19	2019-05-20 15:30:42	\N	0
\.


--
-- Name: acoes_corretivas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acoes_corretivas_id_seq', 173, true);


--
-- Name: acoes_naoconformidades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acoes_naoconformidades_id_seq', 749, true);


--
-- Name: auditoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoria_id_seq', 425, true);


--
-- Name: autorizacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.autorizacao_id_seq', 738, true);


--
-- Name: cidades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sysdba
--

SELECT pg_catalog.setval('public.cidades_id_seq', 1, false);


--
-- Name: empresas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sysdba
--

SELECT pg_catalog.setval('public.empresas_id_seq', 50, true);


--
-- Name: estados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sysdba
--

SELECT pg_catalog.setval('public.estados_id_seq', 1, false);


--
-- Name: funcionarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.funcionarios_id_seq', 39, true);


--
-- Name: itens_auditoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.itens_auditoria_id_seq', 48400, true);


--
-- Name: itens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.itens_id_seq', 134, true);


--
-- Name: itens_temperaturas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sysdba
--

SELECT pg_catalog.setval('public.itens_temperaturas_id_seq', 153, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 58, true);


--
-- Name: naos_conformidades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.naos_conformidades_id_seq', 68, true);


--
-- Name: naos_conformidades_itens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.naos_conformidades_itens_id_seq', 66588, true);


--
-- Name: nc_itens_temps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sysdba
--

SELECT pg_catalog.setval('public.nc_itens_temps_id_seq', 95, true);


--
-- Name: ncitens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ncitens_id_seq', 472, true);


--
-- Name: oauth_clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.oauth_clients_id_seq', 4, true);


--
-- Name: oauth_personal_access_clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.oauth_personal_access_clients_id_seq', 2, true);


--
-- Name: paises_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sysdba
--

SELECT pg_catalog.setval('public.paises_id_seq', 1, false);


--
-- Name: papel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.papel_id_seq', 70, true);


--
-- Name: papels_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.papels_users_id_seq', 440, true);


--
-- Name: permissoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissoes_id_seq', 15, true);


--
-- Name: permissoes_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissoes_users_id_seq', 667, true);


--
-- Name: processos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.processos_id_seq', 172, true);


--
-- Name: processos_setor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.processos_setor_id_seq', 143, true);


--
-- Name: setors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.setors_id_seq', 172, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 151, true);


--
-- Name: acoes_corretivas acoes_corretivas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acoes_corretivas
    ADD CONSTRAINT acoes_corretivas_pkey PRIMARY KEY (id);


--
-- Name: acoes_naoconformidades acoes_naoconformidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acoes_naoconformidades
    ADD CONSTRAINT acoes_naoconformidades_pkey PRIMARY KEY (id);


--
-- Name: auditorias auditoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditorias
    ADD CONSTRAINT auditoria_pkey PRIMARY KEY (id);


--
-- Name: autorizacaos autorizacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.autorizacaos
    ADD CONSTRAINT autorizacao_pkey PRIMARY KEY (id);


--
-- Name: cidades cidades_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.cidades
    ADD CONSTRAINT cidades_pkey PRIMARY KEY (id);


--
-- Name: empresas empresas_cnpj_unique; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT empresas_cnpj_unique UNIQUE (cnpj);


--
-- Name: empresas empresas_db_database_unique; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT empresas_db_database_unique UNIQUE (db_database);


--
-- Name: empresas empresas_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT empresas_pkey PRIMARY KEY (id);


--
-- Name: estados estados_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id);


--
-- Name: fichas_temperaturas fichas_temperatura_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.fichas_temperaturas
    ADD CONSTRAINT fichas_temperatura_pkey PRIMARY KEY (id);


--
-- Name: funcionarios funcionarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionarios
    ADD CONSTRAINT funcionarios_pkey PRIMARY KEY (id);


--
-- Name: fichas itens_auditoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas
    ADD CONSTRAINT itens_auditoria_pkey PRIMARY KEY (id);


--
-- Name: itens itens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens
    ADD CONSTRAINT itens_pkey PRIMARY KEY (id);


--
-- Name: itens_temperaturas itens_temperatura_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.itens_temperaturas
    ADD CONSTRAINT itens_temperatura_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: naosconformidades_itens naos_conformidades_itens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens
    ADD CONSTRAINT naos_conformidades_itens_pkey PRIMARY KEY (id);


--
-- Name: naos_conformidades naos_conformidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naos_conformidades
    ADD CONSTRAINT naos_conformidades_pkey PRIMARY KEY (id);


--
-- Name: nc_itens_temps nc_itens_temp_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.nc_itens_temps
    ADD CONSTRAINT nc_itens_temp_pkey PRIMARY KEY (id);


--
-- Name: nc_itens ncitens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nc_itens
    ADD CONSTRAINT ncitens_pkey PRIMARY KEY (id);


--
-- Name: oauth_access_tokens oauth_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: oauth_auth_codes oauth_auth_codes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_auth_codes
    ADD CONSTRAINT oauth_auth_codes_pkey PRIMARY KEY (id);


--
-- Name: oauth_clients oauth_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_clients
    ADD CONSTRAINT oauth_clients_pkey PRIMARY KEY (id);


--
-- Name: oauth_personal_access_clients oauth_personal_access_clients_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_personal_access_clients
    ADD CONSTRAINT oauth_personal_access_clients_pkey PRIMARY KEY (id);


--
-- Name: oauth_refresh_tokens oauth_refresh_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_pkey PRIMARY KEY (id);


--
-- Name: paises paises_pkey; Type: CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.paises
    ADD CONSTRAINT paises_pkey PRIMARY KEY (id);


--
-- Name: papels papel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.papels
    ADD CONSTRAINT papel_pkey PRIMARY KEY (id);


--
-- Name: papels_users papels_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.papels_users
    ADD CONSTRAINT papels_users_pkey PRIMARY KEY (id);


--
-- Name: permissoes permissoes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissoes
    ADD CONSTRAINT permissoes_pkey PRIMARY KEY (id);


--
-- Name: permissoes_users permissoes_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissoes_users
    ADD CONSTRAINT permissoes_users_pkey PRIMARY KEY (id);


--
-- Name: processos processos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.processos
    ADD CONSTRAINT processos_pkey PRIMARY KEY (id);


--
-- Name: processos_setors processos_setor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.processos_setors
    ADD CONSTRAINT processos_setor_pkey PRIMARY KEY (id);


--
-- Name: setors setors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.setors
    ADD CONSTRAINT setors_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: fki_id_acaocorretivaitem; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_acaocorretivaitem ON public.naosconformidades_itens USING btree (id_acaocorretivaitens);


--
-- Name: fki_id_acoescorretivas; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_acoescorretivas ON public.acoes_naoconformidades USING btree (id_acoescorretivas);


--
-- Name: fki_id_auditorias; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_auditorias ON public.naosconformidades_itens USING btree (id_fichas);


--
-- Name: fki_id_funcionario; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_funcionario ON public.naosconformidades_itens USING btree (id_funcionarios);


--
-- Name: fki_id_itens; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_itens ON public.nc_itens USING btree (id_itens);


--
-- Name: fki_id_naoconformidade; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_naoconformidade ON public.acoes_naoconformidades USING btree (id_naoconformidade);


--
-- Name: fki_id_naoconformidades; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_naoconformidades ON public.naosconformidades_itens USING btree (id_naoconformidades);


--
-- Name: fki_id_ncitens; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_ncitens ON public.nc_itens USING btree (id_ncitens);


--
-- Name: fki_id_papels; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_papels ON public.papels_users USING btree (id_papels);


--
-- Name: fki_id_permissoes; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_permissoes ON public.permissoes_users USING btree (id_permissoes);


--
-- Name: fki_id_user; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_user ON public.papels_users USING btree (id_users);


--
-- Name: fki_id_users; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_id_users ON public.permissoes_users USING btree (id_users);


--
-- Name: oauth_access_tokens_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_access_tokens_user_id_index ON public.oauth_access_tokens USING btree (user_id);


--
-- Name: oauth_clients_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_clients_user_id_index ON public.oauth_clients USING btree (user_id);


--
-- Name: oauth_personal_access_clients_client_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_personal_access_clients_client_id_index ON public.oauth_personal_access_clients USING btree (client_id);


--
-- Name: oauth_refresh_tokens_access_token_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX oauth_refresh_tokens_access_token_id_index ON public.oauth_refresh_tokens USING btree (access_token_id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: cidades cidades_id_estado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.cidades
    ADD CONSTRAINT cidades_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES public.estados(id);


--
-- Name: estados estados_id_pais_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.estados
    ADD CONSTRAINT estados_id_pais_fkey FOREIGN KEY (id_pais) REFERENCES public.paises(id);


--
-- Name: auditorias fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditorias
    ADD CONSTRAINT fk FOREIGN KEY (id_setors) REFERENCES public.setors(id);


--
-- Name: empresas fk_empresa_estado; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT fk_empresa_estado FOREIGN KEY (uf) REFERENCES public.estados(id);


--
-- Name: empresas fk_empresa_municipio; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT fk_empresa_municipio FOREIGN KEY (municipio) REFERENCES public.cidades(id);


--
-- Name: fichas_temperaturas fk_idauditorias; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.fichas_temperaturas
    ADD CONSTRAINT fk_idauditorias FOREIGN KEY (id_auditorias) REFERENCES public.auditorias(id);


--
-- Name: fichas_temperaturas fk_iditens; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.fichas_temperaturas
    ADD CONSTRAINT fk_iditens FOREIGN KEY (id_itens) REFERENCES public.itens_temperaturas(id);


--
-- Name: itens_temperaturas fk_processosetor; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.itens_temperaturas
    ADD CONSTRAINT fk_processosetor FOREIGN KEY (processo_setor_id) REFERENCES public.processos_setors(id);


--
-- Name: naosconformidades_itens id_acaocorretivaitem; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens
    ADD CONSTRAINT id_acaocorretivaitem FOREIGN KEY (id_acaocorretivaitens) REFERENCES public.acoes_corretivas(id);


--
-- Name: acoes_naoconformidades id_acoescorretivas; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acoes_naoconformidades
    ADD CONSTRAINT id_acoescorretivas FOREIGN KEY (id_acoescorretivas) REFERENCES public.acoes_corretivas(id);


--
-- Name: fichas id_auditorias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas
    ADD CONSTRAINT id_auditorias FOREIGN KEY (id_auditorias) REFERENCES public.auditorias(id);


--
-- Name: naosconformidades_itens id_fichas; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens
    ADD CONSTRAINT id_fichas FOREIGN KEY (id_fichas) REFERENCES public.fichas(id);


--
-- Name: naosconformidades_itens id_funcionario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens
    ADD CONSTRAINT id_funcionario FOREIGN KEY (id_funcionarios) REFERENCES public.funcionarios(id);


--
-- Name: fichas id_itens; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas
    ADD CONSTRAINT id_itens FOREIGN KEY (id_itens) REFERENCES public.itens(id);


--
-- Name: nc_itens id_itens; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nc_itens
    ADD CONSTRAINT id_itens FOREIGN KEY (id_itens) REFERENCES public.itens(id);


--
-- Name: acoes_naoconformidades id_naoconformidade; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acoes_naoconformidades
    ADD CONSTRAINT id_naoconformidade FOREIGN KEY (id_naoconformidade) REFERENCES public.naos_conformidades(id);


--
-- Name: naosconformidades_itens id_naoconformidades; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens
    ADD CONSTRAINT id_naoconformidades FOREIGN KEY (id_naoconformidades) REFERENCES public.naos_conformidades(id);


--
-- Name: nc_itens id_ncitens; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nc_itens
    ADD CONSTRAINT id_ncitens FOREIGN KEY (id_ncitens) REFERENCES public.naos_conformidades(id);


--
-- Name: autorizacaos id_papels; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.autorizacaos
    ADD CONSTRAINT id_papels FOREIGN KEY (id_papels) REFERENCES public.papels(id);


--
-- Name: papels_users id_papels; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.papels_users
    ADD CONSTRAINT id_papels FOREIGN KEY (id_papels) REFERENCES public.papels(id);


--
-- Name: permissoes_users id_permissoes; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissoes_users
    ADD CONSTRAINT id_permissoes FOREIGN KEY (id_permissoes) REFERENCES public.permissoes(id);


--
-- Name: auditorias id_processos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditorias
    ADD CONSTRAINT id_processos FOREIGN KEY (id_processos) REFERENCES public.processos(id);


--
-- Name: autorizacaos id_setors; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.autorizacaos
    ADD CONSTRAINT id_setors FOREIGN KEY (id_setors) REFERENCES public.setors(id);


--
-- Name: papels_users id_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.papels_users
    ADD CONSTRAINT id_user FOREIGN KEY (id_users) REFERENCES public.users(id);


--
-- Name: auditorias id_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditorias
    ADD CONSTRAINT id_users FOREIGN KEY (id_users) REFERENCES public.users(id);


--
-- Name: permissoes_users id_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissoes_users
    ADD CONSTRAINT id_users FOREIGN KEY (id_users) REFERENCES public.users(id);


--
-- Name: naosconformidades_itens naosconformidades_itens_id_fichas_temperatura_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.naosconformidades_itens
    ADD CONSTRAINT naosconformidades_itens_id_fichas_temperatura_fkey FOREIGN KEY (id_fichas_temperatura) REFERENCES public.fichas_temperaturas(id);


--
-- Name: nc_itens_temps nc_itens_temp_id_itens_temperatura_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.nc_itens_temps
    ADD CONSTRAINT nc_itens_temp_id_itens_temperatura_fkey FOREIGN KEY (id_itens_temperatura) REFERENCES public.itens_temperaturas(id);


--
-- Name: nc_itens_temps nc_itens_temp_id_ncitens_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sysdba
--

ALTER TABLE ONLY public.nc_itens_temps
    ADD CONSTRAINT nc_itens_temp_id_ncitens_fkey FOREIGN KEY (id_ncitens) REFERENCES public.naos_conformidades(id);


--
-- Name: itens processos_setor_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens
    ADD CONSTRAINT processos_setor_id FOREIGN KEY (processos_setor_id) REFERENCES public.processos_setors(id);


--
-- Name: processos_setors processos_setor_processos_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.processos_setors
    ADD CONSTRAINT processos_setor_processos_id_foreign FOREIGN KEY (processos_id) REFERENCES public.processos(id);


--
-- Name: processos_setors processos_setor_setors_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.processos_setors
    ADD CONSTRAINT processos_setor_setors_id_foreign FOREIGN KEY (setors_id) REFERENCES public.setors(id);


--
-- PostgreSQL database dump complete
--

