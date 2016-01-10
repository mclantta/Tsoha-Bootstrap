<?php

class Book extends BaseModel {

    public $id, $name, $author, $publishyear, $pages, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validateName', 'validateAuthor', 'validatePublishyear', 'validatePages', 'validateDescriptionRightLength');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Book'); //database connection's initialisation
        $query->execute(); //executing query
        $rows = $query->fetchAll();
        $books = array();

        foreach ($rows as $row) {

            $books[] = new Book(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'author' => $row['author'],
                'publishyear' => $row['publishyear'],
                'pages' => $row['pages'],
                'description' => $row['description']
            ));
        }
        return $books;
    }

    public static function findOne($id) {
        $query = DB::connection()->prepare('SELECT * FROM Book WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $book = new Book(array(
                'id' => $id,
                'name' => $row['name'],
                'author' => $row['author'],
                'publishyear' => $row['publishyear'],
                'pages' => $row['pages'],
                'description' => $row['description']
            ));
            return $book;
        }
        return NULL;
    }

    public function save() {

        if ($this->publishyear == NULL && $this->pages == NULL) {
            $query = DB::connection()->prepare('INSERT INTO Book (name, author, description) VALUES (:name, :author, :description) RETURNING id');
            $query->execute(array('name' => $this->name, 'author' => $this->author, 'description' => $this->description));
        } else if ($this->publishyear == NULL) {
            $query = DB::connection()->prepare('INSERT INTO Book (name, author, pages, description) VALUES (:name, :author, :pages, :description) RETURNING id');
            $query->execute(array('name' => $this->name, 'author' => $this->author, 'pages' => $this->pages, 'description' => $this->description));
        } else if ($this->pages == NULL) {
            $query = DB::connection()->prepare('INSERT INTO Book (name, author, publishyear, description) VALUES (:name, :author, :publishyear, :description) RETURNING id');
            $query->execute(array('name' => $this->name, 'author' => $this->author, 'publishyear' => $this->publishyear, 'description' => $this->description));
        } else {
            $query = DB::connection()->prepare('INSERT INTO Book (name, author, publishyear, pages, description) VALUES (:name, :author, :publishyear, :pages, :description) RETURNING id');
            $query->execute(array('name' => $this->name, 'author' => $this->author, 'publishyear' => $this->publishyear, 'pages' => $this->pages, 'description' => $this->description));
        }

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        if ($this->publishyear == NULL && $this->pages == NULL) {
            $query = DB::connection()->prepare('UPDATE Book
        SET name=:name, author=:author, description=:description
        WHERE id=:id');
            $query->execute(array('id' => $this->id, 'name' => $this->name, 'author' => $this->author, 'description' => $this->description));
        } else if ($this->publishyear == NULL) {
            $query = DB::connection()->prepare('UPDATE Book
        SET name=:name, author=:author, pages=:pages, description=:description
        WHERE id=:id');
            $query->execute(array('id' => $this->id, 'name' => $this->name, 'author' => $this->author, 'pages' => $this->pages, 'description' => $this->description));
        } else if ($this->pages == NULL) {
            $query = DB::connection()->prepare('UPDATE Book
        SET name=:name, author=:author, publishyear=:publishyear, description=:description
        WHERE id=:id');
            $query->execute(array('id' => $this->id, 'name' => $this->name, 'author' => $this->author, 'publishyear' => $this->publishyear, 'description' => $this->description));
        } else {
            $query = DB::connection()->prepare('UPDATE Book
        SET name=:name, author=:author, publishyear=:publishyear, pages=:pages, description=:description
        WHERE id=:id');
            $query->execute(array('id' => $this->id, 'name' => $this->name, 'author' => $this->author, 'publishyear' => $this->publishyear, 'pages' => $this->pages, 'description' => $this->description));
        }
    }

    public function validateName() {
        $errors = parent::validateLengthNotNull($this->name, 'Nimi');
        return $errors;
    }

    public function validateAuthor() {
        $errors = parent::validateLengthNotNull($this->author, 'Kirjailija');
        return $errors;
    }

    public function validatePublishyear() {
        $errors = parent::validateInteger($this->publishyear, 'Julkaisuvuosi');
        return $errors;
    }

    public function validatePages() {
        $errors = parent::validateInteger($this->pages, 'Sivumäärä');
        return $errors;
    }

    public function validateDescriptionRightLength() {
        $errors = parent::validateLengthNotTooMuch($this->description, 250, 'esittely, oltava alle 250 sanaa');
        return $errors;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Book WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

}
