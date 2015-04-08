SELECT DISTINCT D.pro_name
FROM Movies M, Directs D, Rates R, Users U
WHERE R.email_address = U.email_address AND R.mid = M.mid AND D.mid = M.mid
  AND U.name = "DERRICK MYERS" AND U.age = 36
  AND R.user_rating = 10;

-- CREATE INDEX part_of_name ON customer (name(10));