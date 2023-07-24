<?php

namespace App\Models;

class Ascii
{
    /**
     * @var string
     */
    public string $singleLine;

    /**
     * @var string
     */
    public string $doubleLine;

    /**
     * @var array
     */
    private array $columns = [];

    /**
     * @var int
     */
    private int $lineLength = 0;

    /**
     * @var array
     */
    private array $data;

    /**
     * Set needle data after creating an object
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->setAndSortColumns();
        $this->setMaxLineLength();

        $this->singleLine = str_repeat("-", $this->lineLength);
        $this->doubleLine = str_repeat("=", $this->lineLength);
    }

    /**
     * Set and sort Columns for the table
     *
     * @return void
     */
    private function setAndSortColumns(): void
    {
        foreach ($this->data as $tableRow) {
            foreach ($tableRow as $column => $value) {
                if (array_key_exists($column, $this->columns)) {
                    $this->columns[$column] = max($this->columns[$column], strlen($value), strlen($column));
                } else {
                    $this->columns[$column] = max(strlen($value), strlen($column));
                }
            }
        }
        ksort($this->columns);
    }

    /**
     * Set max length of the table
     *
     * @return void
     */
    private function setMaxLineLength(): void
    {
        foreach ($this->columns as $columnLength) {
            $this->lineLength += $columnLength;
        }
        $this->lineLength += count($this->columns) + 1;
    }

    /**
     * Get string of header table
     *
     * @return string
     */
    public function getHeader(): string
    {
        $header = "";

        foreach ($this->columns as $title => $length) {
            $header .= "|" . str_repeat(" ", $length - strlen($title)) . $title;
        }

        $header .= "|\n";

        return $header;
    }

    /**
     * Get string of body table
     *
     * @return string
     */
    public function getBody(): string
    {
        $body = "";

        foreach ($this->data as $tableRow) {
            foreach ($this->columns as $columnTitle => $length) {
                $value = array_key_exists($columnTitle, $tableRow) ? $tableRow[$columnTitle] : "";
                $body .= "|" . str_repeat(" ", $length - strlen($value)) . $value;
            }
            $body .= "|\n";
        }

        return $body;
    }
}