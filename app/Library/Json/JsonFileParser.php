<?php

namespace App\Library\Json;

/**
 * Class JsonFileParser
 * @package App\Library\Json
 */
class JsonFileParser
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * JsonFileParser constructor.
     * @param string $fileName
     */
    public function __construct($fileName = '')
    {
        $this->fileName = $fileName;
    }

    /**
     * @return array
     */
    public function load(): array
    {
        $data = file_get_contents($this->fileName);
        return json_decode($data, 'true');
    }

    /**
     * @param $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}
