<?php

class Reader extends BaseModel {

    public $id, $name, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($name, $password) {

        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE name=:name AND password=:password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));

        $row = $query->fetch();

        if ($row) {
            $reader = new Reader(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $reader;
        } else {
            return NULL;
        }
    }

    public static function findOne($id) {
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE id=:id');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $reader = new Reader(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
        }
        return $reader;
    }

    public static function findListsId($readerId) {
        $query1 = DB::connection()->prepare('SELECT * FROM List WHERE reader_id=:readerId');
        $query1->execute(array('readerId' => $readerId));
        $row = $query1->fetch();

        if ($row) {
            return $row['id'];
        }
        return NULL;
    }

    public static function addBook($id, $readerId) {
        $listId = self::findListsId($readerId);

        $query2 = DB::connection()->prepare('INSERT INTO Booklist (list_id, book_id) VALUES (:list_id, :book_id)');
        $query2->execute(array('list_id' => $listId, 'book_id' => $id));
    }

    public static function findUserBooks($readerId) {
        $listId = self::findListsId($readerId);

        $query = DB::connection()->prepare('SELECT id, name, author, publishyear, pages, description FROM Book b INNER JOIN Booklist bl ON b.id=bl.book_id WHERE bl.list_id = :list_id');
        $query->execute(array('list_id' => $listId));

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

    public static function isBookUsers($readerId, $bookId) {
        $bool = False;
        $listId = self::findListsId($readerId);

        $query = DB::connection()->prepare('SELECT * FROM Booklist WHERE list_id = :list_id AND book_id = :book_id');
        $query->execute(array('list_id' => $listId, 'book_id' => $bookId));

        $rows = $query->fetchAll();

        if ($rows) {
            $bool = True;
        }

        return $bool;
    }

    public static function removeBook($bookId, $readerId) {
        $listId = self::findListsId($readerId);

        $query = DB::connection()->prepare('DELETE FROM Booklist WHERE list_id=:list_id AND book_id = :book_id');
        $query->execute(array('list_id' => $listId, 'book_id' => $bookId));
    }

}
