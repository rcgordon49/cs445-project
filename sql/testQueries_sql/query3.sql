SELECT DISTINCT A.pro_name
FROM Directs D, Acts_in A
WHERE A.mid = D.mid AND D.pro_name = "Spielberg, Steven";