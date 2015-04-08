CREATE TABLE Good_Users
(email_address   	CHAR(50),
 PRIMARY KEY (email_address));
 
INSERT INTO Good_Users(email_address)
SELECT DISTINCT R.email_address
FROM Rates R, Best_Movies B
WHERE R.mid = B.mid
GROUP BY R.email_address
HAVING COUNT(*) >= 2 AND MIN(R.user_rating) >= 9;