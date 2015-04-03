SELECT DISTINCT R.title, R.year, R.avg_rating
FROM Avg_Ratings R
WHERE num_rates > 1000 
ORDER BY avg_rating DESC
LIMIT 5;