<?php

/** @var \App\Models\Ascii $ascii */
echo "{$ascii->doubleLine}\n{$ascii->getHeader()}{$ascii->singleLine}\n{$ascii->getBody()}{$ascii->doubleLine}\n";