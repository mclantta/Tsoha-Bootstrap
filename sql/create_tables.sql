-- Lisää CREATE TABLE lauseet tähän tiedostoon


CREATE TABLE Reader(
    id SERIAL PRIMARY KEY,
    name varchar(30) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE List(
    id SERIAL PRIMARY KEY,
    reader_id INTEGER REFERENCES Reader(id) ON DELETE CASCADE
);

CREATE TABLE Book(
    id SERIAL PRIMARY KEY,
    name varchar(120) NOT NULL,
    author varchar(80) NOT NULL,
    publishyear integer,
    pages integer,
    description varchar(250)
);

CREATE TABLE Booklist(
    list_id INTEGER REFERENCES List(id) ON DELETE CASCADE,
    book_id INTEGER REFERENCES Book(id) ON DELETE CASCADE
);