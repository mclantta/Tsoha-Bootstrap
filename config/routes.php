<?php

  $routes->get('/', function() {
    HelloWorldController::start_page();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/book/1', function() {
      HelloWorldController::book_details(); 
  });
  
  $routes->get('/userlist', function() {
      HelloWorldController::users_own_list();
  });
  $routes->get('/edit/1', function() {
      HelloWorldController::edit();
  });
