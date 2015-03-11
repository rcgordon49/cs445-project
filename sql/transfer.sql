CREATE TABLE Edits_Test
(pro_name	CHAR(50) CHARACTER SET latin1 COLLATE latin1_general_cs,
title 		CHAR(250) CHARACTER SET latin1 COLLATE latin1_general_cs,
year 		INT(4),
PRIMARY KEY (pro_name, title, year));