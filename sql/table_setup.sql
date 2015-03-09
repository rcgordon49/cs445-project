SQL Tables

CREATE TABLE Professionals_Temp
(pro_name	CHAR(50),
gender 	CHAR(1));

CREATE TABLE Professionals
(pro_name	CHAR(50),
gender 	CHAR(1),
PRIMARY KEY (pro_name));
 
CREATE TABLE Movies
(mid		int NOT NULL AUTO_INCREMENT,
title 		CHAR(250) NOT NULL,
year 		INT(4) NOT NULL,
running_time	INT(20),
UNIQUE (title, year),
PRIMARY KEY (mid));

CREATE TABLE Mpaa_Rating
(mpaa_rating		CHAR(5),
definition	CHAR(100),
description	TEXT(2000),
PRIMARY KEY (mpaa_rating));

CREATE TABLE Has_Mpaa_Rating_Temp
(title 		CHAR(250),
year 		INT(4),
mpaa_rating	CHAR(5),
FOREIGN KEY (title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (mpaa_rating) REFERENCES Mpaa_Rating(mpaa_rating)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY(title, year));

CREATE TABLE Has_Genre_Temp
(title		CHAR(50),
year		INT(4),
genre 		CHAR(50),
FOREIGN KEY (title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY(title, year, genre));

CREATE TABLE Has_Key_Word_Temp
(title		CHAR(50),
year		INT(4),
key_word	CHAR(50),
FOREIGN KEY (title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (title, year, key_word));

CREATE TABLE Users
(email_address   	CHAR(50),
name    	CHAR(50),
password     	CHAR(50),
age               	INT(3),
gender         	CHAR(25),
location        	CHAR(50),
PRIMARY KEY (email_address));
 
CREATE TABLE Acts_in_Temp
(pro_name  	CHAR(50),
title  		CHAR(250),
year 		INT(4),
role_name    	CHAR(50),
FOREIGN KEY(title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY(pro_name) REFERENCES Professionals(pro_name)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (pro_name, title, year));
 
CREATE TABLE Directs_Temp
(pro_name  	CHAR(50),
title  		CHAR(250),
year 		INT(4),
FOREIGN KEY(title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY(pro_name) REFERENCES Professionals(pro_name)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (pro_name, title, year));
 
CREATE TABLE Produces_Temp
(pro_name  	CHAR(50),
title  		CHAR(250),
year 		INT(4),
FOREIGN KEY(title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY(pro_name) REFERENCES Professionals(pro_name)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (pro_name, title, year));

CREATE TABLE Edits_Temp
(pro_name  	CHAR(50),
title  		CHAR(250),
year 		INT(4),
FOREIGN KEY(title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY(pro_name) REFERENCES Professionals(pro_name)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (pro_name, title, year));

 CREATE TABLE Rates_Temp
(email_address    	CHAR(50),
title  			CHAR(250),
year 			INT(4),
user_rating  		INT(2),
FOREIGN KEY(title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (email_address) REFERENCES Users (email_address)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (email_address, title, year));

CREATE TABLE Watches_Temp
(email_address    	CHAR(50),
title  			CHAR(250),
year 			INT(4),
watch_time  		TIMESTAMP,
FOREIGN KEY(title, year) REFERENCES Movies(title, year)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY (email_address) REFERENCES Users (email_address)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (email_address, title, year, watch_time));

CREATE TABLE Follows
(email1	CHAR(50),
email2		CHAR(50),
follow_time	TIMESTAMP,
FOREIGN KEY (email1) REFERENCES Users (email_address)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
FOREIGN KEY (email2) REFERENCES Users (email_address)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
PRIMARY KEY (email1, email2));
