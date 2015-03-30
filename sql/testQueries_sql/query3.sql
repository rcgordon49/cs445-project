SELECT P.pro_name
FROM Professionals P, Directs D, Acts_in A
WHERE P.pro_name = D.pro_name AND A.mid = D.mid;