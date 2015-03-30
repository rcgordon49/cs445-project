SELECT R.user_rating, COUNT(*)
FROM Rates R
GROUP BY R.user_rating;