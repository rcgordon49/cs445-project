SELECT P.proname
FROM Professionals P, Directs D, Acts_in A
WHERE P.proname = D.proname AND A.mid = D.did;