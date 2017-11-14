DROP TABLE IF EXISTS STUDENTAVAIL;
DROP TABLE IF EXISTS STUDENTHOURS;
DROP TABLE IF EXISTS CLASSES;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS EVENTS;
DROP TRIGGER IF EXISTS calendar_id;

CREATE TABLE USERS(
	username			VARCHAR(16),
	password			VARCHAR(128),
	email				VARCHAR(32),
	phone				CHAR(10),
	notify				ENUM('phone', 'email'),
	role				ENUM('ta', 'prof'),
	first				VARCHAR(16),
	last				VARCHAR(16),
	PRIMARY KEY (username)
);

CREATE TABLE CLASSES(
	class_name		VARCHAR (15),
	section_id		INT,
	section_date	DATE,
	start_time		TIME,
	end_time		TIME,
	quarter			ENUM('F','W','S'),
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
	-- TODO: Ensure prof in this table has role set as prof in users
);

CREATE TABLE STUDENTAVAIL(
	username		VARCHAR(16),
	section_id		INT,
	section_date	DATE,
	start_time		TIME,
	avail_start		TIME,
	avail_end		TIME,
	PRIMARY KEY (username, section_id, section_date, start_time),
	CONSTRAINT avail_username_fkey
		FOREIGN KEY (username)
			REFERENCES USERS (username),
	CONSTRAINT sections
		FOREIGN KEY (section_id, section_date, start_time)
			REFERENCES CLASSES (section_id, section_date, start_time)
);

CREATE TABLE STUDENTHOURS(
	username		VARCHAR(16),
	hours_worked	INT,
	hours_scheduled	INT,
	CONSTRAINT hours_username_fkey
		FOREIGN KEY (username)
			REFERENCES USERS (username)
);

CREATE TABLE EVENTS(
	id		INT NOT NULL AUTO_INCREMENT,
	title	VARCHAR(255),
	start	DATETIME,
	end		DATETIME,
	PRIMARY KEY (id)
);

CREATE TRIGGER calendar_id
AFTER INSERT ON CLASSES
FOR EACH ROW
INSERT INTO EVENTS (title, start, end) VALUES (NEW.class_name, TIMESTAMP(NEW.section_date, NEW.start_time), TIMESTAMP(NEW.section_date, NEW.end_time));