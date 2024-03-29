/* Drop tables and triggers if they already exist */
DROP TABLE IF EXISTS STUDENTAVAIL;
DROP TABLE IF EXISTS STUDENTHOURS;
DROP TABLE IF EXISTS CLASSES;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS EVENTS;
DROP TRIGGER IF EXISTS calendar_id;
DROP TRIGGER IF EXISTS calendar_id_delete;

/* Create users table */
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

/* Create classes table */
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
			REFERENCES USERS (username)
			ON DELETE CASCADE,
	CONSTRAINT prof_fkey
		FOREIGN KEY (professor)
			REFERENCES USERS (username)
			ON DELETE CASCADE
);

/* Create student availability table */
CREATE TABLE STUDENTAVAIL(
	username		VARCHAR(16),
	date			DATE,
	avail_start		TIME,
	avail_end		TIME,
	PRIMARY KEY (username, date, avail_start),
	CONSTRAINT avail_username_fkey
		FOREIGN KEY (username)
			REFERENCES USERS (username)
			ON DELETE CASCADE
);

/* Create student hours table */
CREATE TABLE STUDENTHOURS(
	username		VARCHAR(16),
	hours_worked	INT,
	hours_scheduled	INT,
	CONSTRAINT hours_username_fkey
		FOREIGN KEY (username)
			REFERENCES USERS (username)
			ON DELETE CASCADE
);

/* Create events table */
CREATE TABLE EVENTS(
	id		INT NOT NULL AUTO_INCREMENT,
	title	VARCHAR(255),
	start	DATETIME,
	end		DATETIME,
	PRIMARY KEY (id)
);

/* Create trigger to automatically add classes to events list */
CREATE TRIGGER calendar_id
AFTER INSERT ON CLASSES
FOR EACH ROW
INSERT INTO EVENTS (title, start, end) VALUES (NEW.class_name, TIMESTAMP(NEW.section_date, NEW.start_time), TIMESTAMP(NEW.section_date, NEW.end_time));

/* Create trigger to automatically delete events when classes are deleted */
CREATE TRIGGER calendar_id_delete
AFTER DELETE ON CLASSES
FOR EACH ROW
DELETE FROM EVENTS WHERE title = OLD.class_name AND start = TIMESTAMP(OLD.section_date, OLD.start_time) AND end = TIMESTAMP(OLD.section_date, OLD.end_time);