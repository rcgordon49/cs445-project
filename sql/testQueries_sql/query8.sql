SELECT DISTINCT M.title, M.year, avg(R.user_rating) AS avg_rating
FROM Movies M, Rates R
WHERE R.mid = M.mid
GROUP BY R.mid
HAVING count(*) > 1000
ORDER BY avg_rating DESC
LIMIT 5;