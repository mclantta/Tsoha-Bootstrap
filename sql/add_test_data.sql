-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Reader (name, password) VALUES ('Admin', 'Admin');
INSERT INTO Reader (name, password) VALUES ('Testi', 'Testinen');

INSERT INTO List (reader_id) VALUES ('2');

INSERT INTO Book (name, author, publishyear, pages, description) VALUES ('Ylpeys ja ennakkoluulo', 'Jane Austen', '1813', '205', 'Vanha kirja');
INSERT INTO Book (name, author) VALUES ('Tuulen viemää', 'Margaret Mitchell');
