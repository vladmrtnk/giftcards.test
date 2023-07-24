<?php

namespace App\Models;

class JsonReader
{
    /**
     * Read data from json file and return associative array
     *
     * @param string $path
     *
     * @return array
     */
    public function read(string $path): array
    {
        $data = json_decode(file_get_contents($path), true);

        return (array)$data;
    }
}