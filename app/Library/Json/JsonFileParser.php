<?php

namespace App\Library\Json;

use Illuminate\Support\Facades\Storage;

class JsonFileParser {

    private $fileName;

    public function __construct($fileName = '')
    {
        $this->fileName = $fileName;
    }

    public function load(){
        $data = file_get_contents($this->fileName);
        return json_decode($data,'true');
    }

    public function setFileName($fileName){
        $this->fileName = $fileName;
    }
}
