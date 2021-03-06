CREATE VIEW Best_Movies
AS
SELECT DISTINCT M.mid, M.title, M.year, avg(R.user_rating) AS avg_rating
FROM Movies M, Rates R
WHERE R.mid = M.mid
GROUP BY M.mid
HAVING count(*) > 1000
ORDER BY avg(R.user_rating) DESC
LIMIT 5;