<?php

class BookController extends BaseController {
    
    public static function listingBooks() {
        $books = Book::all();
        View::make('book/all_books.html', array('books' => $books));
    }
    
    public static function gettingDetails($id) {
        $book = Book::findOne($id);
        View::make('book/book_details.html', array('book' => $book));
    }
}
