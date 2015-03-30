SELECT M.title, M.year, avg(R.user_rating)
FROM Movies M, Rates R
WHERE R.mid = m.mid
GROUP BY M.mid
HAVING count(*) > 1000
ORDER BY avg(R.user_rating)
LIMIT 5; 