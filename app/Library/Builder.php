<?php

namespace App\Library;

use App\Library\Json\JsonFileParser;

class Builder
{
    public function __construct($filename)
    {
        $this->parser = new JsonFileParser($filename);

    }

    public function load()
    {
        return $this->parser->load();
    }
}
