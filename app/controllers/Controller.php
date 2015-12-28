<?php
    
   
  class Controller extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
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
    
    public static function start_page(){
        View::make('suunnitelmat/etusivu.html');
    }
    
    public static function book_user(){
        View::make('suunnitelmat/book_user.html');
    }
    
    public static function users_own_list(){
        View::make('suunnitelmat/own_list.html');
    }
    
    public static function edit(){
        View::make('suunnitelmat/edit_user_book_info.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    public static function signin(){
        View::make('suunnitelmat/singin.html');
    }
    public static function all_books(){
        View::make('suunnitelmat/all_books_kokeilu.html');
    }
    public static function book_details(){
        View::make('suunnitelmat/book_details.html');
    }
    public static function add_new(){
        View::make('book/add_new.html');
    }
  }
