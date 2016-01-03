<?php

//require 'app/models/Reader.php';

class Controller extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        $jee = new Book(array(
            'name' => 'Jee',
            'author' => 'Maija',
            'publishyear' => '1999',
            'pages' => '230'
        ));

        $errors = $jee->errors();

        Kint::dump($errors);
        View::make('helloworld.html');
    }

    public static function signin() {
        View::make('suunnitelmat/singin.html');
    }

}
