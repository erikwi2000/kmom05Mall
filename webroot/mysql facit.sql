-- 
-- Övning 01: Skapa en databas 
-- 
-- Detta är en kommentar i SQL 
-- 
-- Skapa tabell Lärare 
-- 
CREATE TABLE Larare 
( 
  akronymLarare CHAR(3) PRIMARY KEY, 
  avdelningLarare CHAR(3), 
  namnLarare CHAR(20), 
  lonLarare INT, 
  foddLarare DATETIME 
); 
-- 
-- Lägg till rader i tabellen Lärare 
-- 
INSERT INTO Larare VALUES ('MOS', 'APS', 'Mikael',   15000, '1968-03-07'); 
INSERT INTO Larare VALUES ('MOL', 'AIS', 'Mats-Ola', 15000, '1978-12-07'); 
INSERT INTO Larare VALUES ('BBE', 'APS', 'Betty',    15000, '1968-07-07'); 
INSERT INTO Larare VALUES ('AJA', 'APS', 'Andreas',  15000, '1988-08-07'); 
INSERT INTO Larare VALUES ('CJH', 'APS', 'Conny',    15000, '1943-01-07'); 
INSERT INTO Larare VALUES ('CSA', 'APS', 'Charlie',  15000, '1969-04-07'); 
INSERT INTO Larare VALUES ('BHR', 'AIS', 'Birgitta', 15000, '1964-02-07'); 
INSERT INTO Larare VALUES ('MAP', 'APS', 'Marie',    15000, '1972-06-07'); 
INSERT INTO Larare VALUES ('LRA', 'APS', 'Linda',    15000, '1975-03-07'); 
INSERT INTO Larare VALUES ('ACA', 'APS', 'Anders',   15000, '1967-09-07'); 

-- 
-- Lägg till rader i tabellen Lärare 
-- 
INSERT INTO Larare(akronymLarare, avdelningLarare, namnLarare, lonLarare, foddLarare) VALUES ('MOS', 'APS', 'Mikael', 15000, '1968-03-07'); 

-- 
-- Radera rader från en tabell 
-- 
DELETE FROM Larare WHERE namnLarare = 'Mikael'; 

-- Ändra befintlig tabell 
ALTER TABLE Larare ADD COLUMN kompetensLarare INT NOT NULL DEFAULT 5; 

-- 
-- Uppdatera ett värde 
-- 
UPDATE Larare SET namnLarare = 'Charles' WHERE akronymLarare = 'CSA'; 

-- Hitta namn som innehåller o 
SELECT * FROM `Larare` WHERE namnLarare LIKE '%o%'; 

-- Hitta lärare som har mer än några nummer 
SELECT * FROM `Larare` WHERE lonLarare > 20000 && kompetensLarare >= 5; 

-- Hitta specifikt ett par akronym 
SELECT * FROM 'Larare' WHERE akronymLarare IN ('MOL','BBE','MOS'); 

-- Hitta namn och lön och sortera efter namn. Lägg till DESC på slutet för att få omvänd ordning. Lägg till LIMIT samt ett nummer för att visa ett visst antal rader. 
SELECT namnLarare, lonLarareFROM `Larare` ORDER BY namnLarare; 

-- Ger kolumnerna/tabell eller whatever ett alias. Snyggare och kortare i detta fall. 
SELECT 
 namnLarare AS 'Lärare', 
 lonLarare AS 'Lön', 
 avdelningLarare AS 'Avdelning' 
FROM Larare; 

--Väljer den högsta lönen. MIN() väljer den lägsta. 

SELECT MAX(lonLarare) FROM Larare; 

--Räkna antalet akronym. Så man gör nästan som en ny kolumn.  
SELECT COUNT(akronymLarare) AS Antal, avdelningLarare AS Avdelning FROM Larare GROUP BY avdelningLarare; 

--Skriver ut hur mycket varje avdelning betalar ut i lön. AVG() funkar på samma sätt. 
SELECT SUM(lonLarare) AS Lön, avdelningLarare AS Avdelning FROM Larare GROUP BY avdelningLarare; 

--Visa endast avdelningar som har en medellön över 18000. HAVING är det viktigare här. Det funkar som WHERE fast med aggregerande funktioner. 

SELECT avdelningLarare, AVG(lonLarare) AS Medellon 
FROM Larare 
GROUP BY avdelningLarare 
HAVING AVG(lonLarare) > 18000; 

--Här utesluter man de löner som bara en lärare har. 

SELECT lonLarare, COUNT(lonLarare) AS Antal 
FROM Larare 
GROUP BY lonLarare 
HAVING COUNT(lonLarare) > 1; 

--Slå ihop de tre strängarna i CONCAT och skriv ut det i en egen tabell.  

SELECT CONCAT(avdelningLarare, '/' ,akronymLarare) AS Lärare FROM Larare; 

--Samma sak fast med små bokstäver. Coolt att man kan lägga in en funktion bara sådär. : ) 
SELECT LOWER(CONCAT(avdelningLarare, '/' ,akronymLarare)) AS Lärare FROM Larare; 

--Visar tiden just nu. Finns flera sådana om man vill ha med TIMESTAMP och sånt. Om man vill ha datum också kan man skriva NOW();. 

SELECT CURTIME(); 

--Utökat exempel från ovan fast med lite fler funktioner. 

SELECT NOW(), UTC_DATE(), YEAR(foddLarare) FROM Larare; 

--Här händer det grejer. TIMESTAMPDIFF skriver ut lärarnas faktiska ålder, vilket är coolt. De sorters efter äldst först. 
SELECT 
  namnLarare,  
  TIMESTAMPDIFF(YEAR, foddLarare, CURDATE()) AS Ålder 
FROM Larare 
GROUP BY TIMESTAMPDIFF(YEAR, foddLarare, CURDATE()) DESC; 

--Ännu ballare. Skapar en "vy"(som en ny tabell) i phpmyadmin som baseras på en select sats. Passar bra då tabellerna blir för stora. 
--DROP VIEW tar bort vyn, ALTER VIEW förändrar den. 
CREATE VIEW VLarare 
AS 
SELECT 
  namnLarare,  
  TIMESTAMPDIFF(YEAR, foddLarare, CURDATE()) AS Ålder 
FROM Larare 
GROUP BY TIMESTAMPDIFF(YEAR, foddLarare, CURDATE()) DESC; 

--Längsta SQL-satsen någonsin. 
SELECT  avdelningLarare AS Avdelning, ROUND(AVG(Ålder)) AS Medelålder, ROUND(AVG(lonLarare)) AS Medellön FROM VLarare2 GROUP BY avdelningLarare; 

--Här skapar man ett table som refererar till ett annat table. 
CREATE TABLE Kurstillfalle 
( 
  idKurstillfalle INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
  Kurstillfalle_kodKurs CHAR(6) NOT NULL, 
  Kurstillfalle_akronymLarare CHAR(3) NOT NULL, 
  lasperiodKurstillfalle INT NOT NULL, 
  FOREIGN KEY (Kurstillfalle_kodKurs) REFERENCES Kurs(kodKurs) 
); 

--För att set:a storage engine och teckenkodning då man skapar en tabell. (Man borde alltid skapa detta för att vara säker på att man använder rätt grejor) 
CREATE TABLE t2 (i INT) ENGINE = INNODB CHARACTER SET utf8; 

--Ändrar storage engine i en tabell 
ALTER TABLE Kurstillfalle ENGINE = INNODB; 

--Ser till att klienten och servern pratar i UTF-8. 
SET NAMES 'utf8'; 

-- 
-- Joina två tabeller, använd alias för att korta ned SQL-satsen 
-- Notera att punkten göra att syntaxen blir ganska oo. OBS! WHERE är suboptimalt. 
SELECT * 
FROM Kurs AS K, Kurstillfalle AS Kt 
WHERE K.kodKurs = Kt.Kurstillfalle_kodKurs; 

-- Här joinar vi ännu en tabell men som en vy för att sedan skapa en ny vy.  
CREATE VIEW VKursinfo 
AS 
SELECT * 
FROM VKurstillfallen AS VKt, VLarare2 AS VL 
WHERE Kurstillfalle_akronymLarare = akronymLarare; 

-- Här joinar vi på det optimala sättet, med hjälp av INNER JOIN. 
-- 
-- Inner join av samtliga tabeller. 
-- 
SELECT 
  K.kodKurs AS Kurskod, 
  K.namnKurs AS Kursnamn, 
  Kt.lasperiodKurstillfalle AS Läsperiod, 
  CONCAT(L.namnLarare, ' (', L.akronymLarare, ')') AS Kursansvarig 
FROM Kurstillfalle AS Kt 
  INNER JOIN Kurs AS K 
    ON Kt.Kurstillfalle_kodKurs = K.kodKurs 
  INNER JOIN Larare AS L 
    ON Kt.Kurstillfalle_akronymLarare = L.akronymLarare 
 ORDER BY K.kodKurs 

 -- 
-- Hur många kurstillfällen har lärarna? 
-- 
CREATE VIEW VVAntalKATillfallen 
AS 
SELECT akronymLarare, COUNT(akronymLarare) AS Antal  
FROM VKursinfo 
GROUP BY akronymLarare; 
  
SELECT * FROM VVAntalKATillfallen; 
SELECT MAX(Antal) FROM VVAntalKATillfallen; 