INSERT INTO Acts_in(pro_name, mid, role_name)
SELECT A.pro_name, M.mid, A.role_name
FROM Acts_in_Temp A, Movies M
WHERE A.title = M.title AND A.year = M.year;

INSERT INTO Directs(pro_name, mid)
SELECT D.pro_name, M.mid
FROM Directs_Temp D, Movies M
WHERE D.title = M.title AND D.year = M.year;

INSERT INTO Edits(pro_name, mid)
SELECT E.pro_name, M.mid
FROM Edits_Temp E, Movies M
WHERE E.title = M.title AND E.year = M.year;

INSERT INTO Produces(pro_name, mid)
SELECT P.pro_name, M.mid
FROM Produces_Temp P, Movies M
WHERE P.title = M.title AND P.year = M.year;

INSERT INTO Rates(email_address, mid, user_rating)
SELECT R.email_address, M.mid, R.user_rating
FROM Rates_Temp R, Movies M
WHERE R.title = M.title AND R.year = M.year;

INSERT INTO Has_Key_Word(key_word, mid)
SELECT K.key_word, M.mid
FROM Has_Key_Word_Temp K, Movies M
WHERE K.title = M.title AND K.year = M.year;

INSERT INTO Has_Mpaa_Rating(mid, mpaa_rating)
SELECT M.mid, H.mpaa_rating
FROM Has_Mpaa_Rating_Temp H, Movies M
WHERE H.title = M.title AND H.year = M.year;

INSERT INTO Has_Genre(mid, genre)
SELECT M.mid, H.genre
FROM Has_Genre_Temp H, Movies M
WHERE H.title = M.title AND H.year = M.year;