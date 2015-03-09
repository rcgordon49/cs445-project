CREATE TABLE Movies
(mid		int NOT NULL AUTO_INCREMENT,
title 		CHAR(250) CHARACTER SET latin1 COLLATE latin1_general_cs,
year 		INT(4) NOT NULL,
running_time	INT(20),
UNIQUE (title, year),
PRIMARY KEY (mid));