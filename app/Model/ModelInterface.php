<?php


namespace App\Model;

/**
 * Interface ModelInterface
 * @package App\Model
 */
interface ModelInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function get($name = '*');

    /**
     * @return mixed
     */
    public function all();

    /**
     * @return mixed
     */
    public function getValid();
}
