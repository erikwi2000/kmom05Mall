CREATE DATABASE IF NOT EXISTS movie;

DROP TABLE IF EXISTS movie;

 USE Movie;
CREATE TABLE Movie
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

SELECT * FROM Movie;
  SELECT DISTINCT G.name
  FROM Genre AS G
    INNER JOIN Movie2Genre AS M2G
      ON G.id = M2G.idGenre;

USE bjvi13;
DROP TABLE IF EXISTS Genre;


CREATE TABLE Genre
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name CHAR(20) NOT NULL -- crime, svenskt, college, drama, etc
) ENGINE INNODB CHARACTER SET utf8;

INSERT INTO Genre (name) VALUES 
  ('comedy'), ('romance'), ('college'), 
  ('crime'), ('drama'), ('thriller'), 
  ('animation'), ('adventure'), ('family'), 
  ('assimilation'), ('apecatching'), ('furioos'), 
  ('svenskt'), ('action'), ('horror')
;

DROP TABLE IF EXISTS Movie2Genre;

CREATE TABLE Movie2Genre
(
  idMovie INT NOT NULL,
  idGenre INT NOT NULL,
 
  FOREIGN KEY (idMovie) REFERENCES Movie (id),
  FOREIGN KEY (idGenre) REFERENCES Genre (id),
 
  PRIMARY KEY (idMovie, idGenre)
) ENGINE INNODB;

INSERT INTO Movie2Genre (idMovie, idGenre) VALUES
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
	    (6, 7),
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
		  (7, 13),
		    (7, 11)
;
DROP VIEW IF EXISTS VMovie;

CREATE VIEW VMovie
AS
SELECT 
  M.*,
  GROUP_CONCAT(G.name) AS genre
FROM Movie AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie
  LEFT OUTER JOIN Genre AS G
    ON M2G.idGenre = G.id
GROUP BY M.id
;

SELECT * FROM VMovie;



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




UPDATE USER SET password = md5(concat('doe', salt)) WHERE acronym = 'doe';
UPDATE USER SET password = md5(concat('admin', salt)) WHERE acronym = 'admin';


select * from USER;
select * from Movie;








