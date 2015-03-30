SELECT R.user_rating, COUNT(*)
FROM Rates
GROUP BY R.user_rating;