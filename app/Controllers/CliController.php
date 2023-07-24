<?php

namespace App\Controllers;

use App\Models\Ascii;
use App\Models\JsonReader;

class CliController
{
    /**
     * @var \App\Models\JsonReader
     */
    private JsonReader $jsonReader;

    /**
     * Create an object of jsonReader to use
     */
    public function __construct()
    {
        $this->jsonReader = new JsonReader();
    }

    /**
     * Execute a command
     *
     * @return void
     */
    public function exec(): void
    {
        $path = $this->getFile("Enter path to the scv file with data: ");
        $data = $this->getData($path);

        $ascii = new Ascii($data);

        require_once APP_ROOT . "/views/cli/ascii.php";
    }

    /**
     * Ask path to file, until path is not correct
     *
     * @param string $message
     *
     * @return string
     */
    public function getFile(string $message): string
    {
        $path = readline($message);
        readline_add_history($path);

        while (!file_exists($path)) {
            $path = readline("Path to the file is incorrect. Please, try again: ");
            readline_add_history($path);
        }

        return $path;
    }

    /**
     * Ask path to file, until format is not correct
     *
     * @param $path
     *
     * @return array
     */
    public function getData($path): array
    {
        $data = $this->jsonReader->read($path);

        while (json_last_error() > 0) {
            $path = $this->getFile("File has invalid data. Please, try another file: ");
            $data = $this->jsonReader->read($path);
        }

        return $data;
    }
}


