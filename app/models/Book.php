<?php

class Book extends BaseModel {

    public $id, $name, $author, $publishyear, $pages, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Book'); //tietokantayhteyden alustus
        $query->execute(); //kyselyn suoritus
        $rows = $query->fetchAll(); //kyselyn tuottamien rivien haku
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
               'name' => $row['name'],
                'author' => $row['author'],
                'publishyear' => $row['publishyear'],
                'pages' => $row['pages'],
                'description' => $row['description']
            ));
        }
        return $book;
    }
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Book (name, author, publishyear, pages, description) VALUES (:name, :author, :publishyear, :pages, :description) RETURNING id');
                
        $query->execute(array('name' => $this->name, 'author' => $this->author, 'publishyear' => $this->publishyear, 'pages' => $this->pages, 'description' => $this->description));   
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
