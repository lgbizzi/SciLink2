/*
- As redes sociais possíveis que serem cadastradas serão: Instagram, Facebook, LinkedIn, 
Youtube ou TikTok. 

- Na tabela cientista os atributos cpf_cientista, email_cientista, lattes_cientista e 
snh_cientista são obrigatórios e o cpf_cientista ainda deve ser único. 

- Na tabela titulacao o atributo nom_titulacao é obrigatório. 

- Na tabela area_atuacao o atributo nom_ area_atuacao é obrigatório. 

- Na tabela projeto o atributo pub_projeto é obrigatório e definirá se o projeto poderá 
ser visualizado por outros pesquisadores ou não. 

- Todas as informações dos pesquisadores estarão visíveis, há restrições apenas do(s) 
projeto(s), as informações dessa tabela só estarão visíveis, se autorizado pelo 
pesquisador (atributo pub_projeto). 

*/

CREATE DATABASE IF NOT EXISTS SciLink;

USE SciLink;

CREATE TABLE IF NOT EXISTS cientista(
	id_cientista				INTEGER PRIMARY KEY AUTO_INCREMENT,
	nom_cientista				VARCHAR(50),
	cpf_cientista				VARCHAR(11) NOT NULL,
	dtn_cientista				DATE,
	email_cientista				VARCHAR(50) NOT NULL,
	email_alternativo_cientista	VARCHAR(50),
	lattes_cientista			VARCHAR(50) NOT NULL,
	snh_cientista				VARCHAR(10) NOT NULL,
	CONSTRAINT cpf UNIQUE(cpf_cientista)
);

CREATE TABLE IF NOT EXISTS titulacao(
	id_titulacao				INTEGER PRIMARY KEY AUTO_INCREMENT,
	nom_titulacao				VARCHAR(25) NOT NULL
);

CREATE TABLE IF NOT EXISTS area_atuacao(
	id_area_atuacao				INTEGER PRIMARY KEY AUTO_INCREMENT,
	nom_area_atuacao			VARCHAR(25) NOT NULL
);

CREATE TABLE IF NOT EXISTS projeto(
	id_projeto					INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_cientista				INTEGER,
	tit_projeto					VARCHAR(50),
	res_projeto					VARCHAR(250),
	dti_projeto					DATE,
	dtt_projeto					DATE,
	pub_projeto					BOOLEAN DEFAULT FALSE,
	CONSTRAINT projeto_fkindex1 FOREIGN KEY (id_cientista) REFERENCES cientista (id_cientista)
);

CREATE TABLE IF NOT EXISTS redes_sociais(
	id_rede_social				INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_cientista				INTEGER,
	end_rede_social				VARCHAR(50),
	tip_rede_social				CHAR(1),
	CONSTRAINT redes_sociais_fkindex1 FOREIGN KEY (id_cientista) REFERENCES cientista (id_cientista)
);

CREATE TABLE IF NOT EXISTS area_atuacao_cientista(
	id_cientista				INTEGER,
	id_area_atuacao				INTEGER,
	CONSTRAINT area_atuacao_has_cientista_fkindex1 FOREIGN KEY (id_area_atuacao) REFERENCES area_atuacao (id_area_atuacao),
	CONSTRAINT area_atuacao_has_cientista_fkindex2 FOREIGN KEY (id_cientista) REFERENCES cientista (id_cientista)
);

CREATE TABLE IF NOT EXISTS telefone(
	ddd_telefone				NUMERIC(2),
	id_cientista				INTEGER,
	num_telefone				VARCHAR(10),
	CONSTRAINT telefone_fkindex1 FOREIGN KEY (id_cientista) REFERENCES cientista (id_cientista)
);

CREATE TABLE IF NOT EXISTS formacao(
	id_cientista				INTEGER,
	id_titulacao				INTEGER,
	dti_formacao				DATE,
	dtt_formacao				DATE,
	CONSTRAINT cientista_has_profissao_fkindex1 FOREIGN KEY (id_cientista) REFERENCES cientista (id_cientista),
	CONSTRAINT formacao_fkindex3 FOREIGN KEY (id_titulacao) REFERENCES titulacao (id_titulacao)
);
