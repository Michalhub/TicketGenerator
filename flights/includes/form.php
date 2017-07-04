<!Doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Lotnisko</title>
</head>
<body style="background-image: url('includes/sky.jpeg')")>
    <?php
    $airportsFile = 'airports.php';
    include($airportsFile);
    ?>
    <h1 style="text-align: center; padding: 30px;">Airport</h1>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <form action="pdf.php" method="post" role="form" class="cinema_form">
                    <legend>Lotnisko wylotu</legend>
                    <div class="form-group">
                        <select name="start">
                            <?php
                            foreach ($airports as $airport => $name) {
                                echo "<option value='$name[name] $name[code] .$name[timezone]'>$name[name] $name[code] $name[timezone]</option>";
                            }
                            ?>
                        </select>
                        <br/>
                    </div>
                    <legend>Lotnisko przylotu</legend>
                    <div class="form-group">
                        <select name="destination">
                            <?php
                            foreach ($airports as $airport => $name) {
                                echo "<option value='$name[name] $name[code] .$name[timezone]'>$name[name] $name[code] $name[timezone]</option>";
                            }
                            ?>
                        </select>
                        <br/>
                    </div>
                    <legend>Data startu</legend>
                    <div class="form-group">
                        <select name="startTime">
                            <?php
                            echo "<input name='startTime' type='datetime-local'></input>";
                            ?>
                        </select>
                        </br>
                    </div>
                    <div class="form-group">
                        <legend>Długość lotu w godzinach</legend>
                        <label>Długość lotu w godzinach</label>
                        <input type="number" min="0" step="1" name="flightTime">
                        </br>
                    </div>
                    <div class="form-group">
                        <legend>Cena lotu</legend>
                        <input type="number" min="0" step="0.01" name="price">
                        <button type="submit" name="submit" class="btn btn-primary">Prześlij</button>
                        <a href="pdf.php" class="btn btn-primary" target="_blank">Sprawdź pdf</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

<!--