/* INSERT INTO USERS VALUES ('kmahajani', '123test', 'kmahajani@scu.edu', '1234567890', 'phone', 'ta', 'Kush', 'Mahajani');
INSERT INTO USERS VALUES ('mhao', 'asdf', 'mhao@scu.edu', '1234567890', 'email', 'ta', 'Mikey', 'Hao');
INSERT INTO USERS VALUES ('orao', 'securepass', 'orao@scu.edu', '1234567890', 'phone', 'ta', 'Ojus', 'Rao');
INSERT INTO USERS VALUES ('rdanielson', 'lol', 'rdanielson@scu.edu', '1234567890', 'phone', 'prof', 'Ron', 'Danielson'); */

INSERT INTO CLASSES VALUES ('COEN 10', 12345, '2017-12-01', '010:00:00', '013:15:00', 'F', 2017, 'kmahajani', NULL, 'test');
INSERT INTO CLASSES VALUES ('COEN 10', 12345, '2017-12-08', '010:00:00', '013:15:00', 'F', 2017, 'ojus', NULL, 'test');
INSERT INTO CLASSES VALUES ('COEN 10', 12345, '2017-12-15', '010:00:00', '013:15:00', 'F', 2017, 'kmahajani', NULL, 'test');
INSERT INTO CLASSES VALUES ('COEN 10', 12345, '2017-12-01', '013:30:00', '016:00:00', 'F', 2017, 'ojus', NULL, 'test');

INSERT INTO STUDENTAVAIL VALUES ('kmahajani', '2017-12-01', '010:00:00', '013:00:00');
INSERT INTO STUDENTAVAIL VALUES ('kmahajani', '2017-12-08', '010:00:00', '013:15:00');
INSERT INTO STUDENTAVAIL VALUES ('kmahajani', '2017-12-15', '011:00:00', '013:15:00');
INSERT INTO STUDENTAVAIL VALUES ('ojus', '2017-12-15', '010:00:00', '011:00:00');

/* INSERT INTO STUDENTHOURS VALUES ('kmahajani', 4, 11);
INSERT INTO STUDENTHOURS VALUES ('mhao', 0, 15);
INSERT INTO STUDENTHOURS VALUES ('orao', 1, 14); */