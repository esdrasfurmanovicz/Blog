<?php

interface Repository{
    public static function listAll();
    public static function insert($obj);
    public static function get($id);
    public static function delete($id);
    public static function update($obj);

}