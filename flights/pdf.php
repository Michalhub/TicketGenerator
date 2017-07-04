<?php
require_once('includes/airports.php');
require_once('vendor/autoload.php');
require_once('passenger.php');
require_once('numbertowords.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $destination = $_POST['destination'];
    $startTime = $_POST['startTime'];
    $price = $_POST['price'];
    $flightTime = $_POST['flightTime'];
    $passenger = generatePassenger();

    if (($start !== $destination) && isset($start) && isset($destination) && isset($startTime) && isset($flightTime) && ($price > 0)) {
        echo "Dane wprowadzone"; //warunek równości musiał być na początku
    } else {
        echo "Wprodzono błędne lub niepełne dane!";
        return false;
    }

}
// funkcja wyciągająca strefę czasową ze stringa
function getTimeZone ($data) {
    $position = strpos($data, '.');
    $correctedPosition = substr($data, $position);
    $timeZone = substr($correctedPosition, 1);

    return $timeZone;
}
// ustawiam starowy czas wylotu
$startTimeZone = getTimeZone($start);

$date = new DateTime($startTime, new DateTimeZone("$startTimeZone"));
$startDate = $date->format('Y-m-d H:i:s');

// ustawiam czas dotarcia na miejsce z uwzględnieniem strefy czasowej
$arrivalTimeZone = getTimeZone($destination);

$date2 = new DateTime($startTime, new DateTimeZone("$startTimeZone"));
$date2->setTimezone(new DateTimeZone("$arrivalTimeZone"));
$date2->modify("+ " . $flightTime . "hour");
$arrivalDate = $date2->format('Y-m-d H:i:s');

ob_start();

?>
    <!Doctype html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=UTF-8"/>
        <title>Mikes Airlines</title>
        <link rel="stylesheet" type="text/css" href="includes/style.css">
    </head>
    <body>
    <table>
        <tr>
            <thead>
            <th colspan="2">Mikes Airfield</th>
            </thead>
        </tr>
        <tr class="half">
            <td class="bold">From:</td>
            <td class="bold">To:</td>
        </tr>
        <tr>
            <td class="half">
                <?php
                echo $start;
                ?>
            </td>
            <td class="half">
                <?php
                echo $destination;
                ?>
            </td>
        </tr>
        <tr>
            <td class="halfmini">Departure (local time)</td>
            <td class="halfmini">Arrival (local time)</td>
        </tr>
        <tr>
            <td class="halfmini">
                <?php
                echo $startDate;
                echo "<br />";
                echo $startTimeZone;
                ?>
            </td>
            <td class="halfmini">
                <?php
                echo $arrivalDate;
                echo "<br />";
                echo $arrivalTimeZone;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="bold">Flight time:</td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $flightTime . " h"; ?></td>
        <tr>
            <td colspan="2" class="bold">Name:</td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $passenger; ?></td>
        </tr>
        <tr>
            <td colspan="2" class="bold">Price:</td>
        </tr>
        <tr>
            <td colspan="2">
                <?php
                echo $price . " PLN <br />";
                echo "Słownie: " . changeToWords($price);
                ?>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?php
$variable = ob_get_clean();


$mpdf = new mPDF();

$mpdf->WriteHTML($variable);

$mpdf->Output('ticket.pdf', 'D');




