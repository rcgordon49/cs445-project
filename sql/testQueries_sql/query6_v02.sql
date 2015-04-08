SELECT DISTINCT M.title, M.year, R.avg_user_age
FROM Movies M, Avg_Ratings R
WHERE M.mid = R.mid AND R.num_rates > 5000
GROUP BY R.mid;