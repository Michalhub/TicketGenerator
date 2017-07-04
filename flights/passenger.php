<?php

require_once ('vendor/autoload.php');

function generatePassenger()
{
    $passenger = null;
    $faker = Faker\Factory::create();
    $passenger = $faker->name;

    return $passenger;
}

?>

