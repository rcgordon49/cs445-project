SELECT M.mid, M.year, avg(U.age)
FROM Users U, Movies M, Rates R
WHERE M.mid = R.mid
GROUP BY M.mid
HAVING count(*) > 5000;