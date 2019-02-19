<?php

namespace App\Library;

use App\Library\Json\JsonFileParser;

/**
 * Class Builder
 * @package App\Library
 */
class Builder
{
    /**
     * Builder constructor.
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->parser = new JsonFileParser($filename);

    }


    /**
     * @return array
     */
    public function load(): array
    {
        return $this->parser->load();
    }
}
