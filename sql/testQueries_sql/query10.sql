SELECT M.title, M.year, avg(R.user_rating)
FROM Movies M, Rates R, Good_Users G
WHERE R.mid = M.mid AND R.email_address = G.email_address
GROUP BY M.mid
HAVING COUNT(*) >= 2
ORDER BY avg(R.user_rating) DESC
LIMIT 10; 