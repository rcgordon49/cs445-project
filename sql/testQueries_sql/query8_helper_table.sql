CREATE TABLE Avg_Ratings
(mid         int NOT NULL,
 title       CHAR(250) CHARACTER SET latin1 COLLATE latin1_general_cs,
 year        INT(4) NOT NULL,
 num_rates   INT,
 avg_rating  DOUBLE,
 FOREIGN KEY (mid) REFERENCES Movies(mid)
 ON DELETE CASCADE
 ON UPDATE CASCADE,
 FOREIGN KEY (title, year) REFERENCES Movies(title, year)
 ON DELETE CASCADE
 ON UPDATE CASCADE,
 UNIQUE (title, year),
 PRIMARY KEY (mid));
 

INSERT INTO Avg_Ratings(mid, title, year, num_rates, avg_rating)
SELECT DISTINCT M.mid, M.title, M.year, 
    count(R.user_rating) as num_rates, avg(R.user_rating) AS avg_rating
FROM Movies M, Rates R
WHERE R.mid = M.mid
GROUP BY R.mid;