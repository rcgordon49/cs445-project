SELECT M.title, M.year, avg(R.user_rating)
FROM Movies M, Rates R
WHERE R.mid = m.mid
GROUP BY M.mid
ORDER BY avg(R.user_rating)
HAVING count(*) > 1000
LIMIT 5;
