SELECT R.title, R.year
FROM Rates_Test R, Movies M
WHERE R.title = M.title AND R.year = M.year;


SELECT            R.*
FROM              Rates_Test R
NATURAL LEFT JOIN Movies M
WHERE             M.title IS NULL;

SELECT            R.*
FROM              Rates_Test R
NATURAL LEFT JOIN Movies M
WHERE             M.title IS NULL;

CREATE TABLE Edits_Test
(pro_name	CHAR(50) CHARACTER SET latin1 COLLATE latin1_general_cs,
title 		CHAR(250) CHARACTER SET latin1 COLLATE latin1_general_cs,
year 		INT(4),
PRIMARY KEY (pro_name, title, year));

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/edits_formatted.txt' INTO TABLE Edits_Test FIELDS TERMINATED BY '\t';