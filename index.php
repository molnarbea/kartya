<?php
    require_once "ab.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP</title>
</head>
<body>
    <?php 
        try {
            $adatbazis = new AB();
            echo "Sikerült a kapcsolódás";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        echo "<br>";
        echo $adatbazis->meret("szin");

        $matrix2 = $adatbazis->oszlopLeker2("nev","kep","szin");
        $adatbazis->megjelenit2($matrix2);

        /*$matrix3 = $adatbazis->oszlopLeker3("formaAzon","szinAzon","kartya");
        $adatbazis->megjelenit3($matrix3);*/

        try {
            if($adatbazis->meret("kartya")==0) {
            $adatbazis->feltoltes();
        }} catch(Exception $e){
            echo $e->getMessage();
        }
        
        $matrix = $adatbazis->oszlopLeker2("nev","kep","szin");
        $tomb = $adatbazis->tombbeAlakit($matrix);


        $adatbazis->bezaras();
     ?>
</body>
</html>