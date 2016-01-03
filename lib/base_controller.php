<?php

require 'app/models/Reader.php';

class BaseController {

    public static function get_user_logged_in() {

        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            if ($user_id != 1) {
                $user = Reader::findOne($user_id);
                return $user;
            }
            return NULL;
        }
        return NULL;
    }

    public static function get_admin_logged_in() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            if ($user_id == 1) {
                $user = Reader::findOne($user_id);
                return $user;
            }
            return NULL;
        }
        return NULL;
    }

    public static function check_user_logged_in() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            if ($user_id == 1) {
                Redirect::to('/', array('message' => 'Sinut uudelleenohjattiin etusivulle!'));
            }
        } else if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

    public static function check_admin_logged() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];

            if ($user_id != 1) {
                Redirect::to('/', array('message' => 'Sinut uudelleenohjattiin etusivulle!'));
            }
        } else if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Sinut uudelleenohjattiin kirjautumissivulle!'));
        }
    }

//    public static function sort_books($books) {
//
//        
//        
//    }

}
