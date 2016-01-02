<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

function check_admin_logged() {
    BaseController::check_admin_logged();
}

$routes->get('/', function() {
    BookController::firstPageBooks();
});
$routes->post('/', function() {
    ReaderController::logout();
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

$routes->get('/signin', function() {
    Controller::signin();
});
$routes->get('/allbooks', function() {
    BookController::listingBooks();
});

$routes->get('/userbook/1', function() {
    Controller::book_user();
});
$routes->post('/allbooks', function() {
    BookController::store();
});
$routes->get('/allbooks/new', 'check_admin_logged', function() {
    BookController::create();
});
$routes->get('/allbooks/:id', function($id) {
    BookController::gettingDetails($id);
});

$routes->get('/allbooks/:id/edit', 'check_admin_logged', function($id) {
    BookController::showEditForm($id);
});
$routes->post('/allbooks/:id/edit', function($id) {
    BookController::updateBook($id);
});
$routes->post('/allbooks/:id/delete', 'check_admin_logged', function($id) {
    BookController::deleteBook($id);
});
$routes->post('/allbooks/:id/add', 'check_logged_in', function($id) {
    ReaderController::addBookToUser($id);
});

$routes->get('/login', function() {
    ReaderController::login();
});
$routes->post('/login', function() {
    ReaderController::handleLogin();
});
$routes->get('/list', 'check_logged_in', function() {
    ReaderController::readersList();
});
