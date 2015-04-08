CREATE VIEW Good_Users
AS
SELECT DISTINCT R.email_address
FROM Rates R, Best_Movies B
WHERE R.mid = B.mid
GROUP BY R.email_address
HAVING COUNT(*) >= 2 AND MIN(R.user_rating) >= 9;