<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
    public static function start_page(){
        View::make('suunnitelmat/etusivu.html');
    }
    
    public static function book_details(){
        View::make('suunnitelmat/book_details.html');
    }
    
    public static function users_own_list(){
        View::make('suunnitelmat/own_list.html');
    }
    
    public static function edit(){
        View::make('suunnitelmat/edit.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    public static function signin(){
        View::make('suunnitelmat/singin.html');
    }
    public static function all_books(){
        View::make('suunnitelmat/all_books.html');
    }
  }
