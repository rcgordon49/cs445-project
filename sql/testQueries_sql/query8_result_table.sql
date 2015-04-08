CREATE TABLE Best_Movies
(mid     int NOT NULL,
title    CHAR(250) CHARACTER SET latin1 COLLATE latin1_general_cs,
year     INT(4) NOT NULL,
avg_rating DOUBLE,
UNIQUE (title, year),
PRIMARY KEY (mid));
 
INSERT INTO Best_Movies(mid, title, year, avg_rating)
SELECT DISTINCT R.mid, R.title, R.year, R.avg_rating
FROM Avg_Ratings R
WHERE num_rates > 1000 
ORDER BY avg_rating DESC
LIMIT 5;
