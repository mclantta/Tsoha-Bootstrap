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
        //$books = jokumetodi () joka hakee tietokannasta oikeita kirjoja...
        
        View::make('reader/own_books.html', array('reader' => $reader));
    }
    public static function addBookToUser($id) { 
        $reader = self::get_user_logged_in();
        
        Reader::addBook($id, $reader->id);
        View::make('reader/own_books.html', array('reader' => $reader, 'message' => 'Kirja lisätty listalle onnistuneesti!'));
    }

}
