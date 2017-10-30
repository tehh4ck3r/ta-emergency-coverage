DROP TABLE IF EXISTS STUDENTAVAIL;
DROP TABLE IF EXISTS STUDENTHOURS;
DROP TABLE IF EXISTS CLASSES;
DROP TABLE IF EXISTS USERS;

CREATE TABLE USERS(
	username			VARCHAR(16),
	password			VARCHAR(16),
	email				VARCHAR(32),
	phone				CHAR(10),
	notify_primary		CHAR(2),
	notify_secondary	CHAR(2),
	role				CHAR(4),
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
	-- TODO: Ensure prof has role set as prof
);

CREATE TABLE STUDENTAVAIL(
	username		VARCHAR(16),
	section_id		INT,
	section_date	DATE,
	start_time		TIME,
	avail_start		TIME,
	avial_end		TIME,
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