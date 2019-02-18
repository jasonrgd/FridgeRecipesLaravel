<?php


namespace App\Model;


interface ModelInterface
{
    public function get($name = '*');

    public function all();

    public function getValid();
}
