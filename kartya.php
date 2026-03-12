<?php
    class Kartya{
        //adattagok
        private $szin;
        private $forma;
        //tagfüggvények
        public function getSzin(){
            return $this->szin;
        }
        public function getForma(){
            return $this->forma;
        }
        public function setSzin($szin){
            $this->szin = $szin;
        }
        public function setForma($forma){
            $this->forma = $forma;
        }
        public function __toString(){
            return "Kártya szine: ".$this->szin."<br>Kártya formája: ".$this->forma;
        }
    }
?>