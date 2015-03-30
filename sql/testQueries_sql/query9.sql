SELECT DISTINCT R.email_address
FROM Rates R, (SELECT * 
               FROM Best_Movies B2 
               ORDER BY B2.avg_rating DESC LIMIT 5) AS B
WHERE R.mid = B.mid
GROUP BY R.email_address
HAVING COUNT(*) >= 2 AND MIN(R.user_rating) >= 9;