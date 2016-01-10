<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
//        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
//          $errors = array_merge($errors, $this->{$validator}()); //this, if errors are arrays
            if (($this->{$validator}()) != NULL) {
                $errors[] = $this->{$validator}(); //we would use this, if errors weren't arrays, but strings only
            }   
        }

        return $errors;
    }

    public function validateLengthNotNull($string, $field) {
        if ($string == '' || $string == null) {
            $error = $field . ' ei saa olla tyhjä';
            return $error;
        }
    }

    public function validateInteger($number, $field) {
        if (!(ctype_digit($number)) && $number != NULL) {
            $error = $field . ' kentän arvo pitää olla kokonaisluku';
            return $error;
        }
    }
    public function validateLengthNotTooMuch($string, $maxLength, $field) {
        $length = strlen($string);
        
        if ($length > $maxLength) {
            $error = 'Liian pitkä merkkijono (' . $field . ')' ;
            return $error;
        }
    }

}
