CREATE VIEW Avg_Ratings
AS
SELECT DISTINCT M.mid, M.title, M.year, count(R.user_rating) as num_rates, avg(R.user_rating) AS avg_rating
FROM Movies M, Rates R
WHERE R.mid = M.mid
GROUP BY R.mid;