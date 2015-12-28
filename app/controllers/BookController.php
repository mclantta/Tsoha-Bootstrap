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
        $params = filter_input_array(INPUT_POST); //katso toimiiko

        $attributes = array(
            'name' => $params['name'],
            'author' => $params['author'],
            'publishyear' => $params['publishyear'],
            'pages'=> $params['pages'],
            'description'=> $params['description']
        );
        $book = new Book($attributes);
        $errors = $book->errors();
        
        $count = 0;
        foreach($errors as $error) {
        if ($error != NULL) {
            $count = 1;
        }
        }
        if ($count == 0) { 
        $book->save();
        Redirect::to('/allbooks/' . $book->id, array('message' => 'Kirja on lisätty listalle!'));
        } else {
        
            View::make('/book/add_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        
    }
}
