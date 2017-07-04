<?php
require_once ('vendor/autoload.php');
use NumberToWords\NumberToWords;

$inWords = [];

function changeToWords($amount)
{

    $numberToWords = new NumberToWords();

    $numberTransformer = $numberToWords->getNumberTransformer('pl');

    $inWords = $numberTransformer->toWords($amount, 'PLN');

    return $inWords;
}


