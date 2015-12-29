<?php

class BookController extends BaseController {

    public static function listingBooks() {
        $books = Book::all();
        View::make('book/all_books.html', array('books' => $books));
    }

    public static function firstPageBooks() {
        //now this method searches all the books just like "listingBooks" -method,
        //but later on (when we have more books in the database), this method wants some
        //subset of books (like every books that start with "s", or most favourite books or ...)

        $books = Book::all();
        View::make('book/firstpage.html', array('books' => $books));
    }

    public static function gettingDetails($id) {
        $book = Book::findOne($id);
        View::make('book/book_details.html', array('book' => $book));
    }

    public static function create() {
        View::make('book/add_new.html');
    }

    public static function store() {
        $params = filter_input_array(INPUT_POST);

        $attributes = array(
            'name' => $params['name'],
            'author' => $params['author'],
            'publishyear' => $params['publishyear'],
            'pages' => $params['pages'],
            'description' => $params['description']
        );
        $book = new Book($attributes);
        $errors = $book->errors();

        if (count($errors) == 0) {
            $book->save();
            Redirect::to('/allbooks/' . $book->id, array('message' => 'Kirja on lisätty listalle!'));
        } else {
            View::make('/book/add_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function showEditForm($id) {
        $book = Book::findOne($id);
        View::make('book/edit_book.html', array('attributes' => $book));
    }

    public static function updateBook($id) {
        $params = filter_input_array(INPUT_POST);

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'author' => $params['author'],
            'publishyear' => $params['publishyear'],
            'pages' => $params['pages'],
            'description' => $params['description']
        );

        $book = new Book($attributes);
        $errors = $book->errors();

        if (count($errors) == 0) {
            $book->update();
            Redirect::to('/allbooks/' . $book->id, array('message' => 'Kirjaa on muokattu onnistuneesti!'));
        } else {
            View::make('book/edit_book.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function deleteBook($id) {
        $book = new Book(array('id' => $id));
        
        $book->destroy();
        Redirect::to('/allbooks', array('message' => 'Kirja on poistettu onnistuneesti!'));
    }

}
