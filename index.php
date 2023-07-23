<?php

class Ascii
{
    public array $sortedKeys = [];
    public int $lineLength = 0;
    public string $table = "";

    public function __construct(array $data)
    {
        $this->sortedKeys = $this->getSortedKeys($data);
    }

    public function getSortedKeys(array $data): array
    {
        $keys = [];
        foreach ($data as $value) {
            foreach ($value as $key => $v) {
                if (array_key_exists($key, $keys)) {
                    $keys[$key] = max($keys[$key], strlen($v));
                } else {
                    $keys[$key] = strlen($v);
                }
            }
        }


        //Set Line Length
        foreach ($keys as $value) {
            $this->lineLength += $value;
        }
        $this->lineLength += count($keys) + 1;


        ksort($keys);
        $this->sortedKeys = $keys;
        return $keys;
    }

    public function printTable(array $data): void
    {
        $thead = "";
        $singleLine = str_repeat("-", $this->lineLength);
        $doubleLine = str_repeat("=", $this->lineLength);

        //Table header
        foreach ($this->sortedKeys as $keyTitle => $length) {
            $thead .= "|" . str_repeat(" ", $length - strlen($keyTitle)) . $keyTitle;
        }
        $thead .= "|\n{$singleLine}\n";

        //Table body
        foreach ($data as $tableRow) {
            foreach ($this->sortedKeys as $keyTitle => $length) {
                $value = array_key_exists($keyTitle, $tableRow) ? $tableRow[$keyTitle] : "";

                $this->table .= "|" . str_repeat(" ", $length - strlen($value)) . $value;
            }
            $this->table .= "|\n";
        }

        echo "{$doubleLine}\n{$thead}{$this->table}{$doubleLine}\n";
    }
}

$data = [
    [
        'House' => 'Baratheon',
        'Sigil' => 'A crowned stag',
        'Motto' => 'Ours is the Fury',
    ],
    [
        'Leader' => 'Eddard Stark',
        'House'  => 'Stark',
        'Motto'  => 'Winter is Coming',
        'Sigil'  => 'A gray direwolf',
    ],
    [
        'House'  => 'Lannister',
        'Leader' => 'Tywin Lannister',
        'Sigil'  => 'A golden lion',
    ],
    [
        'Q' => 'Z',
    ],
];

$ascii = new Ascii($data);
$ascii->printTable($data);