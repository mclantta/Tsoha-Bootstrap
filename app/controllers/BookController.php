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
}
