
--
-- Create table for Content
--
USE movie;

DROP TABLE IF EXISTS Content;
CREATE TABLE Content
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  slug CHAR(80) UNIQUE,
  url CHAR(80) UNIQUE,
 
  TYPE CHAR(80),
  title VARCHAR(80),
  DATA TEXT,
  FILTER CHAR(80),
 
  published DATETIME,
  created DATETIME,
  updated DATETIME,
  deleted DATETIME
 
) ENGINE INNODB CHARACTER SET utf8;

INSERT INTO Content (slug, url, TYPE, title, DATA, FILTER, published, created) VALUES
  ('hem', 'hem', 'page', 'Hem', "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", 'bbcode,nl2br', NOW(), NOW()),
  ('om', 'om', 'page', 'Om', "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", 'markdown', NOW(), NOW()),
  ('blogpost-1', NULL, 'post', 'Välkommen till min blogg!', "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", 'link,nl2br', NOW(), NOW()),
  ('blogpost-2', NULL, 'post', 'Nu har sommaren kommit', "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", 'nl2br', NOW(), NOW()),
  ('blogpost-3', NULL, 'post', 'Nu har hösten kommit', "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost", 'nl2br', NOW(), NOW())
;

select * from Content;

SELECT *, (published <= NOW()) AS available
FROM Content;

select * from content;

--
-- Table for user
--
DROP TABLE IF EXISTS User;

CREATE TABLE User
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    acronym CHAR(12) UNIQUE NOT NULL,
    name VARCHAR(80),
    password CHAR(32),
    salt INT NOT NULL
);

INSERT INTO User (acronym, name, salt) VALUES 
    ('doe', 'John/Jane Doe', unix_timestamp()),
    ('admin', 'Administrator', unix_timestamp())
;

UPDATE User SET moviepassword = md5(concat('doe', salt)) WHERE acronym = 'doe';
UPDATE User SET password = md5(concat('admin', salt)) WHERE acronym = 'admin';
select * from movie;
use movie;
select * from Triggers;
use blogg;
select * from content;

select * from user;

SELECT *, (published <= NOW()) AS available
FROM Content;

INSERT INTO Content (slug, url, TYPE, title, DATA, FILTER, published, created) VALUES
 ('blogpost-5', NULL, 'post', 'Nu har hösten kommit', "HuvaHuvaHuvaommaren har kommit, ett budskap som kräver en bloggpost", 'nl2br', NOW(), NOW())
;



use blogg;

select * from content;
show databases;
use blogg;
