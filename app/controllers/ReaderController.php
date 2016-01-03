<?php

class ReaderController extends BaseController {

    public static function login() {
        View::make('reader/login.html');
    }

    public static function handleLogin() {
        $params = filter_input_array(INPUT_POST); //check

        $reader = Reader::authenticate($params['username'], $params['password']);

        if (!$reader) {
            View::make('reader/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $reader->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $reader->name . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function readersList() {
        $reader = self::get_user_logged_in();
        $books = Reader::findUserBooks($reader->id);
        sort($books);
        
        View::make('reader/own_books.html', array('reader' => $reader, 'books' => $books));
    }
    public static function addBookToUser($id) { 
        $reader = self::get_user_logged_in();
        
        Reader::addBook($id, $reader->id);
        $books = Reader::findUserBooks($reader->id);
        View::make('reader/own_books.html', array('reader' => $reader, 'message' => 'Kirja lisätty listalle onnistuneesti!', 'books' => $books));
    }
    public static function removeBookFromUser($id) {
        $reader = self::get_user_logged_in();
        
        Reader::removeBook($id, $reader->id);
        Redirect::to('/list', array('message' => 'Kirja on poistettu onnistuneesti!'));
    }

    public static function showSignin() {
        View::make('reader/signin.html');
    }
    public static function handleSignin() {
        $params = filter_input_array(INPUT_POST);

        $attributes = array(
            'name' => $params['name'],
            'password' => $params['password'],
        );
        
        $reader = new Reader($attributes);
        $errors = $reader->errors();
        
        //Let's check that user has entered the same password in both fields
        $oneErr = $reader->passwordFieldsAreSame($params['again']);
        if ($oneErr) {
           $errors[] = $oneErr; 
        }

        if (count($errors) == 0) {
            $reader->saveNewReader();
            Redirect::to('/', array('message' => 'Olet luonut käyttäjätunnuksen. Kirjaudu seuraavaksi sisään.'));
        } else {
            View::make('/reader/signin.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
}
