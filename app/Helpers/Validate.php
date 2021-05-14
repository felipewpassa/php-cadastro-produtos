<?php

class Validate {
    public static function alphaNumeric($text) {
        if(!preg_match('/^([a-zA-Z0-9]+)$/', $text)) {
            return true;
        } else {
            return false;
        }
    }
}