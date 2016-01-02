<?php

class ReaderController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handleLogin() {
        $params = filter_input_array(INPUT_POST); //check

        $reader = Reader::authenticate($params['username'], $params['password']);

        if (!$reader) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $reader->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $reader->name . '!'));
        }
    }
    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

}
