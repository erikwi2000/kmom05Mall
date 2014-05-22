movieCREATE DATABASE IF NOT EXISTS Movie;
 
USE Movie;
 --
-- Create table for my own movie database
--

CREATE TABLE Movie2
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title VARCHAR(100) NOT NULL,
  director VARCHAR(100),
  LENGTH INT DEFAULT NULL, -- Length in minutes
  year INT NOT NULL DEFAULT 1900,
  plot TEXT, -- Short intro to the movie
  image VARCHAR(100) DEFAULT NULL, -- Link to an image
  subtext CHAR(3) DEFAULT NULL, -- swe, fin, en, etc
  speech CHAR(3) DEFAULT NULL, -- swe, fin, en, etc
  quality CHAR(3) DEFAULT NULL,
  format CHAR(3) DEFAULT NULL -- mp4, divx, etc
) ENGINE INNODB CHARACTER SET utf8;
 
 
SHOW CHARACTER SET;
SHOW COLLATION LIKE 'utf8%';
 
DELETE FROM Movie2;
 
INSERT INTO Movie (title, year, image) VALUES
  ('Pulp fiction', 1994, 'img/movie/pulp-fiction.jpg'),
  ('American Pie', 1999, 'img/movie/american-pie.jpg'),
  ('Pokémon The Movie 2000', 1999, 'img/movie/pokemon.jpg'),  
  ('Kopps', 2003, 'img/movie/kopps.jpg'),
  ('From Dusk Till Dawn', 1996, 'img/movie/from-dusk-till-dawn.jpg'),
    ('Knopp och trolls', 2013, 'img/movie/six.jpg'),
	  ('Kopps', 2003, 'img/movie/kopps.jpg'),
  ('From Husk Till Prawn', 1996, 'img/movie/eight.jpg'),
    ('Knopp och trolls', 2014, 'img/movie/six.jpg'),
	    ('Kopp, kopp en kaffeLatte film', 1957, 'img/movie/seven.jpg')
;
 
SELECT * FROM Movie;
    SELECT 
      M.*,
      G.name AS genre
    FROM Movie AS M
      LEFT OUTER JOIN Movie2Genre AS M2G
        ON M.id = M2G.idMovie
      INNER JOIN Genre AS G
        ON M2G.idGenre = G.id
        WHERE G.name = ?
    ;
  SELECT DISTINCT G.name
  FROM Genre AS G
    INNER JOIN Movie22Genre AS M2G
      ON G.id = M2G.idGenre;

USE Movie2;
--
-- Add tables for genre
--
DROP TABLE IF EXISTS Genre;
CREATE TABLE Genre
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name CHAR(20) NOT NULL -- crime, svenskt, college, drama, etc
) ENGINE INNODB CHARACTER SET utf8;
 
INSERT INTO Genre2 (name) VALUES 
  ('comedy'), ('romance'), ('college'), 
  ('crime'), ('drama'), ('thriller'), 
  ('animation'), ('adventure'), ('family'), 
  ('assimilation'), ('apecatching'), ('furioos'), 
  ('svenskt'), ('action'), ('horror')
;
 
DROP TABLE IF EXISTS Movie2Genre;
CREATE TABLE Movie2Genre
(
  idMovie2 INT NOT NULL,
  idGenre2 INT NOT NULL,
 
  FOREIGN KEY (idMovie2) REFERENCES Movie2 (id),
  FOREIGN KEY (idGenre2) REFERENCES Genre2 (id),
 
  PRIMARY KEY (idMovie2, idGenre2)
) ENGINE INNODB;
 
 
INSERT INTO Movie2Genre (idMovie2, idGenre2) VALUES
  (1, 1),
  (1, 5),
  (1, 6),
  (2, 1),
  (2, 2),
  (2, 3),
  (3, 7), 
  (3, 8), 
  (3, 9), 
  (4, 11),
  (4, 1),
  (4, 10),
  (4, 9),
  (5, 11),
  (5, 4),
  (5, 12),
    (6, 3),
	  (6, 5),
		  (7, 7), 
  (7, 8), 
  (7, 9), 
  (8, 11),
  (8, 1),
  (8, 10),
  (8, 9),
  (9, 11),
  (9, 4),
  (10, 12),
    (6, 15),
	  (6, 14),
	    (6, 7),
		  (7, 13),
		    (7, 11)
;
 


DROP VIEW IF EXISTS VMovie;
 
CREATE VIEW VMovie
AS
SELECT 
  M.*,
  GROUP_CONCAT(G.name) AS genre2
FROM Movie2 AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie2
  LEFT OUTER JOIN Genre2 AS G
    ON M2G.idGenre2 = G.id
GROUP BY M.id
;
 
SELECT * FROM VMovie;
use VMovie;
USE Mivoe;
USE Movie;


--
-- Table for user
--
DROP TABLE IF EXISTS USER;
 
CREATE TABLE USER
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  acronym CHAR(12) UNIQUE NOT NULL,
  name VARCHAR(80),
  password CHAR(32),
  salt INT NOT NULL
) ENGINE INNODB CHARACTER SET utf8;
 
INSERT INTO USER (acronym, name, salt) VALUES 
  ('doe', 'John/Jane Doe', unix_timestamp()),
  ('admin', 'Administrator', unix_timestamp())
;
 SELECT acronym, name FROM USER WHERE acronym = ? AND password = md5(concat(?, salt))
UPDATE USER SET password = md5(concat('doe', salt)) WHERE acronym = 'doe';
UPDATE USER SET password = md5(concat('admin', salt)) WHERE acronym = 'admin';
 
SELECT * FROM USER;

SELECT acronym, name FROM USER WHERE acronym = "?"  AND password = md5(concat("?", salt));
SELECT acronym, name FROM USER WHERE acronym = "?"  ;
SELECT acronym, name FROM USER;

SELECT acronym, name FROM USER   ;

SELECT * FROM USER;
SELECT acronym, name FROM USER WHERE acronym = ? ;
SELECT acronym FROM USER   ;
SELECT acronym, name FROM USER WHERE acronym = '?' ;
SELECT acronym, name FROM USER WHERE acronym LIKE '%' AND password LIKE md5(concat('acronym', salt)) ;
SELECT acronym, name, password, salt FROM USER WHERE acronym LIKE '%' AND password LIKE '%';


DROP TABLE IF EXISTS USER;
 
CREATE TABLE USER
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  acronym CHAR(12) UNIQUE NOT NULL,
  name VARCHAR(80),
  password CHAR(32),
  salt INT NOT NULL
) ENGINE INNODB CHARACTER SET utf8;
 
INSERT INTO USER (acronym, name, salt) VALUES 
  ('doe', 'John/Jane Doe', unix_timestamp()),
  ('admin', 'Administrator', unix_timestamp())
;
 
INSERT INTO USER (acronym, name, salt) VALUES 
  ('bjvi13', 'Administrator', unix_timestamp())
;

UPDATE USER SET password = md5(concat('doe', salt)) WHERE acronym = 'doe';
UPDATE USER SET password = md5(concat('admin', salt)) WHERE acronym = 'admin';
 
SELECT * FROM Movie;
use movie;
SELECT acronym, name FROM USER WHERE acronym = '%' AND password = md5(concat('%', salt));
SELECT acronym, name FROM User WHERE acronym = 'doe' AND password = md5(concat('doe', salt));
select * from user;
UPDATE User SET password = md5(concat('doe', salt)) WHERE acronym = 'doe';
SELECT * FROM VMovie;
SELECT * FROM  Movie2Genre;
SELECT * FROM Movie;
INSERT INTO Movie (title, year, image) VALUES
  ('Pulp xxxxx', 1994, 'img/movie/pulp-fiction.jpg'),
  ('PieDie', 1999, 'img/movie/american-pie.jpg'),
  ('Pokévie 2000', 1999, 'img/movie/pokemon.jpg'),  
  ('Kropps', 2003, 'img/movie/kopps.jpg'),
  ('From Disk Till Tvätt', 1996, 'img/movie/from-dusk-till-dawn.jpg')
;

INSERT INTO Movie (title, year, image) VALUES
  ('Pu xxxxx', 1994, 'img/movie/six.jpg')
;

INSERT INTO Movie2Genre (idMovie, idGenre) VALUES

    (6, 3),
	  (6, 5),
	    (6, 7),
		  (7, 4),
		    (7, 6)
;

SELECT * FROM Movie ;