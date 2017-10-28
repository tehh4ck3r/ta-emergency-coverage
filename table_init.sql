DROP TABLE IF EXISTS CLASSES;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS STUDENTAVAIL;
DROP TABLE IF EXISTS SUTDENTHOURS;

CREATE TABLE USERS(
	username			VARCHAR(16),
	password			VARCHAR(16),
	email				VARCHAR(32),
	phone				CHAR(10),
	notify_primary		CHAR(2),
	notify_secondary	CHAR(2),
	role				CHAR(4),
	PRIMARY KEY (username)
);

CREATE TABLE CLASSES(
	class_name		VARCHAR (15),
	section_id		INT,
	section_date	DATE,
	start_time		TIME,
	end_time		TIME,
	quarter			CHAR(1),
	year			INT,
	ta				VARCHAR(16),
	ta_secondary	VARCHAR(16),
	professor		VARCHAR(16),
	PRIMARY KEY (section_id, section_date, start_time),
	CONSTRAINT ta_fkey
		FOREIGN KEY (ta)
			REFERENCES USERS (username),
	CONSTRAINT prof_fkey
		FOREIGN KEY (professor)
			REFERENCES USERS (username)
);