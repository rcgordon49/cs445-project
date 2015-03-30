SELECT DISTINCT M.title, M.year, avg(U.age)
FROM Users U, Movies M, Rates R
WHERE M.mid = R.mid AND R.email_address = U.email_address
GROUP BY M.mid
HAVING count(*) > 5000;