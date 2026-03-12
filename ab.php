<?php
require_once "kartya.php";
class AB{
    //adattagok
    private $host="localhost";
    private $fNev="root";
    private $jelszo="";
    private $abNev="magyarkartya";
    private $kapcsolat;

    //konstruktor
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->kapcsolat = new mysqli(
                $this->host,
                $this->fNev,
                $this->jelszo,
                $this->abNev
            );
            $this->kapcsolat->set_charset("utf8");
        } catch (mysqli_sql_exception $e) {
            throw new Exception(
                "Adatbázis kapcsolódási hiba történt: ".
                $e->getMessage());
        }
    }

    /*public function kapcsolatLezar(){
        $this->kapcsolat->close();
    }

    //tagfüggvények
    public function oszlopBeolvas($oszlop, $tabla){

    }*/

    public function meret($tabla){
        $sql = "SELECT * FROM $tabla";
        return $this->kapcsolat->query($sql)->num_rows;
    }

    

    public function oszlopLeker2($oszlop,$oszlop2,$tabla){
        $sql = "SELECT $oszlop,$oszlop2 FROM $tabla";
        $matrix2 = $this->kapcsolat->query($sql);
        return $matrix2;
    }
    
    
    
    public function megjelenit2($matrix2){
        echo "<table>";
        while($sor = $matrix2->fetch_row()){
            echo "<tr>";
            echo "<td><p>$sor[0]</p></td>";
            echo "<td><img src='forras/$sor[1]' alt = '$sor[1]'></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }

    public function feltoltes(){
        $formaMeret = $this->meret("forma");
        $szinMeret = $this->meret("szin");
        for ($i=1; $i <= $formaMeret; $i++) { 
           for ($j=1; $j<= $szinMeret; $j++) { 
                try {
                    $stmt = $this->kapcsolat->prepare("INSERT INTO `kartya`(`formaAzon`, `szinAzon`) VALUES (?,?)");
                    $formaAzon = $i;
                    $szinAzon = $j;
                    $stmt->bind_param("ss", $formaAzon, $szinAzon);
                    $stmt->execute();
                } catch (mysqli_sql_exception $e) {
                    throw new Exception(
                    "Hiba történt: ".
                    $e->getMessage());
                }
            }
        }
    }
    public function oszlopLeker3($oszlop1,$oszlop2,$tabla){
        $sql = "SELECT $oszlop1, $oszlop2 FROM $tabla";
        $matrix3 = $this->kapcsolat->query($sql);
        return $matrix3;
    }
    public function kartyakBeolvasasa(){
        $sql= "SELECT szin.kep, forma.nev
                FROM kartya
                inner JOIN forma on forma.formaAzon = kartya.formaAzon
                inner JOIN szin on szin.szinAzon = kartya.szinAzon";
        $matrix = $this->kapcsolat->query($sql);
        return $matrix;
    }
    public function kartyakObjektummal($matrix){
        $objektumLista = [];
        while ($sor = $matrix->fetch_assoc()) {
            $kartya = new Kartya();
            $kartya->setSzin($sor["kep"]);
            $kartya->setForma($sor["nev"]);
            //echo $kartya;
            $objektumLista[] = $kartya;
        }
        shuffle($objektumLista);
        return $objektumLista;
    }
    //fetch_row: 0 1 2
    //fetch_assoc: kep nev
    public function kartyakMegjelenitese($objektumLista){
        //teljes div
        echo "<div>";
        for ($i=0; $i < count($objektumLista); $i++) { 
            if ($i%8==0) {
                //sornyitó div
                echo "<div>";
            }
            $szin = $objektumLista[$i]->getSzin();
            $forma = $objektumLista[$i]->getForma();
            echo "<div><img src='forras/$szin'></div>";
            echo "<div>$forma</div>";
            if ($i%8==7) {
                //sorzáró div
                echo "</div>";
            }
        }
        //teljes lezáró div
        echo "</div>";
    }
    public function megjelenit3($matrix3){
        echo "<table>";
        while($sor = $matrix3->fetch_row()){
            echo "<tr>";
            echo "<td><p>$sor[0]</p></td>";
            echo "<td><p>$sor[1]</p></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }
    public function tombbeAlakit($matrix) {
        return $matrix->fetch_all(MYSQLI_ASSOC);
    }
    


    public function bezaras(){
        $this->kapcsolat->close();
    }



}
?>