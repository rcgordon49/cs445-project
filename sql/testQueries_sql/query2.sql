SELECT M.mid, M.title, M.year
FROM Acts_in A, Movies M
WHERE A.pro_name = "Pitt, Brad" AND M.mid = A.mid;