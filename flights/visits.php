<?php 

if (!isset($_COOKIE['visits'])) {
    setcookie('visits', 1 , time() + 3600 * 24 * 365);
    echo "witaj na stronie!";
 } else {
 	setcookie('visits', $_COOKIE['visits'] + 1, time() + 3600 * 24 * 365);
	if ($_COOKIE['visits'] === 2) {
	    echo "Witaj na stronie po raz kolejny";
    } else {
        echo "witaj, odwiedziłeś stronę " . $_COOKIE['visits'] . " razy";
    }
}
 	
?>






