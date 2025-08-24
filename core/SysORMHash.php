<?php

namespace Core;

class SysORMHash {
    public static function make($value) {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    public static function check($value, $hashedValue) {
        return password_verify($value, $hashedValue);
    }
}
