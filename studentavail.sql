DROP TABLE IF EXISTS STUDENTAVAIL;

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