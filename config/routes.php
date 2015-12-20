<?php

$routes->get('/', function() {
    Controller::start_page();
});

$routes->get('/hiekkalaatikko', function() {
    Controller::sandbox();
});

$routes->get('/userlist', function() {
    Controller::users_own_list();
});
$routes->get('/edit-user-book/1', function() {
    Controller::edit();
});

$routes->get('/login', function() {
    Controller::login();
});
$routes->get('/signin', function() {
    Controller::signin();
});
$routes->get('/allbooks', function() {
    Controller::all_books();
});
$routes->get('/book/1', function() {
    Controller::book_details();
});
$routes->get('/userbook/1', function() {
    Controller::book_user();
});
