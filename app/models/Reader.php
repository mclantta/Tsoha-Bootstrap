<?php

class Reader extends BaseModel {

    public $id, $name, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($name, $password) {
        //does this work, or do we need these: "" ??
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE name=:name AND password=:password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));

        $row = $query->fetch();

        if ($row) {
            $reader = new Reader(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $reader;
        } else {
            return NULL;
        }
        
    }

    public static function findOne($id) {
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE id=:id');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $reader = new Reader(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
        }
        return $reader;
    }

}
