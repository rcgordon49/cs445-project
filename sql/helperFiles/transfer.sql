CREATE TABLE Has_Genre_Test
(title 		CHAR(250) CHARACTER SET latin1 COLLATE latin1_general_cs,
year		INT(4),
genre 		CHAR(50),
PRIMARY KEY(title, year, genre));