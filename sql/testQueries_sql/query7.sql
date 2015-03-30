SELECT DISTINCT U.email_address, U.name, U.age, U.location
FROM Users U, Rates R, Has_Mpaa_Rating H
WHERE U.age <= 17 AND U.email_address = R.email_address
	AND R.mid = H.mid AND H.mpaa_rating = "NC-17";