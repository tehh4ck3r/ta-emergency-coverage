INSERT INTO USERS VALUES ('kmahajani', '123test', 'kmahajani@scu.edu', '1234567890', 'ph', 'em', 'ta', 'Kush', 'Mahajani');
INSERT INTO USERS VALUES ('mhao', 'asdf', 'mhao@scu.edu', '1234567890', 'em', 'ph', 'ta', 'Mikey', 'Hao');
INSERT INTO USERS VALUES ('orao', 'securepass', 'orao@scu.edu', '1234567890', 'ph', 'em', 'ta', 'Ojus', 'Rao');
INSERT INTO USERS VALUES ('rdanielson', 'lol', 'rdanielson@scu.edu', '1234567890', 'ph', 'em', 'prof', 'Ron', 'Danielson');

INSERT INTO CLASSES VALUES ('COEN 10', 0001, '2017-12-01', '010:00:00', '013:15:00', 'F', 2017, 'kmahajani', NULL, 'rdanielson');
INSERT INTO CLASSES VALUES ('COEN 10', 0001, '2017-12-08', '010:00:00', '013:15:00', 'F', 2017, 'mhao', NULL, 'rdanielson');
INSERT INTO CLASSES VALUES ('COEN 10', 0001, '2017-12-15', '010:00:00', '013:15:00', 'F', 2017, 'kmahajani', NULL, 'rdanielson');
INSERT INTO CLASSES VALUES ('COEN 10', 0001, '2017-12-01', '013:30:00', '016:00:00', 'F', 2017, 'orao', NULL, 'rdanielson');

INSERT INTO STUDENTAVAIL VALUES ('kmahajani', 0001, '2017-12-01', '010:00:00', '010:00:00', '013:00:00');
INSERT INTO STUDENTAVAIL VALUES ('kmahajani', 0001, '2017-12-08', '010:00:00', '010:00:00', '013:15:00');
INSERT INTO STUDENTAVAIL VALUES ('kmahajani', 0001, '2017-12-15', '010:00:00', '011:00:00', '013:15:00');
INSERT INTO STUDENTAVAIL VALUES ('orao', 0001, '2017-12-15', '010:00:00', NULL, NULL);
INSERT INTO STUDENTAVAIL VALUES ('mhao', 0001, '2017-12-15', '010:00:00', '010:00:00', '011:00:00');

INSERT INTO STUDENTHOURS VALUES ('kmahajani', 4, 11);
INSERT INTO STUDENTHOURS VALUES ('mhao', 0, 15);
INSERT INTO STUDENTHOURS VALUES ('orao', 1, 14);