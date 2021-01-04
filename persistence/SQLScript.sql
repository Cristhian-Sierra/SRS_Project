CREATE DATABASE srs;
USE srs;
CREATE TABLE Administrator (
	idAdministrator int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	lastName varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	password varchar(45) NOT NULL,
	picture varchar(45) DEFAULT NULL,
	phone varchar(45) DEFAULT NULL,
	mobile varchar(45) DEFAULT NULL,
	state tinyint DEFAULT NULL,
	PRIMARY KEY (idAdministrator)
);

INSERT INTO Administrator(idAdministrator, name, lastName, email, password, phone, mobile, state) VALUES 
	('1', 'Admin', 'Admin', 'admin@udistrital.edu.co', md5('123'), '123', '123', '1'); 

CREATE TABLE LogAdministrator (
	idLogAdministrator int(11) NOT NULL AUTO_INCREMENT,
	action varchar(45) NOT NULL,
	information text NOT NULL,
	date date NOT NULL,
	time time NOT NULL,
	ip varchar(45) NOT NULL,
	os varchar(45) NOT NULL,
	browser varchar(45) NOT NULL,
	administrator_idAdministrator int(11) NOT NULL,
	PRIMARY KEY (idLogAdministrator)
);

CREATE TABLE Area (
	idArea int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	PRIMARY KEY (idArea)
);

CREATE TABLE Category (
	idCategory int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	area_idArea int(11) NOT NULL,
	PRIMARY KEY (idCategory)
);

CREATE TABLE Journalcategory (
	idJournalcategory int(11) NOT NULL AUTO_INCREMENT,
	category_idCategory int(11) NOT NULL,
	journal_idJournal int(11) NOT NULL,
	PRIMARY KEY (idJournalcategory,category_idCategory,journal_idJournal )
);

CREATE TABLE Journal (
	idJournal int(11) NOT NULL AUTO_INCREMENT,
	title varchar(45) NOT NULL,
	issn int NOT NULL,
	sjr int NOT NULL,
	best_quartile varchar(45) DEFAULT NULL,
	hindex int DEFAULT NULL,
	total_docs int DEFAULT NULL,
	total_references int DEFAULT NULL,
	total_cites int DEFAULT NULL,
	citable_docs int DEFAULT NULL,
	coverage varchar(45) DEFAULT NULL,
	categories varchar(45) DEFAULT NULL,
	country_idCountry int(11) NOT NULL,
	PRIMARY KEY (idJournal)
);

CREATE TABLE Country (
	idCountry int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	region varchar(45) DEFAULT NULL,
	documents int DEFAULT NULL,
	citable_docs int DEFAULT NULL,
	citations int DEFAULT NULL,
	self_citations int DEFAULT NULL,
	citations_per_doc int DEFAULT NULL,
	hindex int DEFAULT NULL,
	PRIMARY KEY (idCountry)
);

CREATE TABLE Filter_search (
	idFilter_search int(11) NOT NULL AUTO_INCREMENT,
	search_date varchar(45) NOT NULL,
	search_time varchar(45) NOT NULL,
	journal_title varchar(45) NOT NULL,
	hindex_filter int NOT NULL,
	references_filter int NOT NULL,
	country_filter varchar(45) NOT NULL,
	category_filter varchar(45) NOT NULL,
	area_filter int NOT NULL,
	quartile_filter int NOT NULL,
	sjr_filter int NOT NULL,
	PRIMARY KEY (idFilter_search)
);

ALTER TABLE LogAdministrator
 	ADD FOREIGN KEY (administrator_idAdministrator) REFERENCES Administrator (idAdministrator); 

ALTER TABLE Category
 	ADD FOREIGN KEY (area_idArea) REFERENCES Area (idArea); 

ALTER TABLE Journalcategory
 	ADD FOREIGN KEY (category_idCategory) REFERENCES Category (idCategory); 

ALTER TABLE Journalcategory
 	ADD FOREIGN KEY (journal_idJournal) REFERENCES Journal (idJournal); 

ALTER TABLE Journal
 	ADD FOREIGN KEY (country_idCountry) REFERENCES Country (idCountry); 

