<?php
        class OldEnglishPound {
        private $price;
        private $pounds;
        private $shillings;
        private $pennies;

        public function __construct($price){
            $this->price = $price;
            $fetch = explode(" ", $price);
            $this->pounds = (int) $fetch[0];
            $this->shillings = (int) $fetch[1];
            $this->pennies = (int) $fetch[2];
        }
        public function sum($priceA, $priceB) {
            $sumD = $priceA->pennies + $priceB->pennies;
            $restD = 0;
            while( $sumD >= 12){
                $sumD -= 12;
                $restD += 1;
            }
            $sumS = $priceA->shillings + $priceB->shillings + $restD;
            $restS = 0;
            while($sumS >= 20){
                $sumS -= 20;
                $restS += 1;
            }
            $sumP = $priceA->pounds + $priceB->pounds + $restS;
            $sum = $sumP."p ".$sumS."s ".$sumD."d";
            return $sum;   
        }
        public function dif($priceA, $priceB) {
            $loanD = 0;
            if ($priceB->pennies > $priceA->pennies) {
                if($priceA->shillings >= 1){
                    $difD = $priceA->pennies + 12 - $priceB->pennies;
                    $loanD += 1;
                }else{
                    return 0;
                }        
            } else {
                $difD = $priceA->pennies - $priceB->pennies;
            }
            $loanS = 0;
            if ($priceB->shillings > ($priceA->shillings - $loanD)) {
                if ($priceA->pounds >= 1){
                    $difS = $priceA->shillings - $loanD + 20 - $priceB->shillings;
                    $loanS +=1;
                }else{
                    return 0;
                }
            } else {
                $difS = $priceA->shillings - $loanD - $priceB->shillings;
            }
            if ($priceB->pounds > $priceA->pounds - $loanS){
                return 0;
            }else{
                $difP = $priceA->pounds - $priceB->pounds - $loanS;
            }
            $dif = $difP."p ".$difS."s ".$difD."d";
            return $dif;
        }
        public function mol($priceA, $int) {
            $molD = $priceA->pennies * $int;
            $restD = 0;
            while( $molD >= 12){
                $molD -= 12;
                $restD += 1;
            }
            $molS = ($priceA->shillings * $int) + $restD;
            $restS = 0;
            while( $molS >= 20){
                $molS -= 20;
                $restS += 1;
            }
            $molP = ($priceA->pounds * $int) + $restS;
            $mol = $molP."p ".$molS."s ".$molD."d";
            return $mol;
        }
        public function div($priceA, $int) {
            $restP = $priceA->pounds;
            $divP = 0;
            while ($restP >= $int){
                $restP -= $int;
                $divP += 1;
            }
            $restS = $priceA->shillings + ($restP * 20);
            $divS = 0;
            while ($restS >= $int){
                $restS -= $int;
                $divS += 1;
            }
            $restD = $priceA->pennies + ($restS * 12);
            $divD = 0;
            while( $restD >= $int){
                $restD -= $int;
                $divD += 1;
            }
            $restP = 0;
            $restS = 0;
            while($restD >= 20){
                $restD -= 20;
                $restP += 1;  
            }
            while($restD >= 12){
                $restD -= 12;
                $restS += 1;
            }
            $rest = "";
            ($restP) ? $rest .= $restP."p " : "";
            ($restS) ? $rest .= $restS."s " : "";
            ($restD) ? $rest .= $restD."d" : "";
            $div = $divP."p ".$divS."s ".$divD."d"." (".($rest).")";
            return $div;
        }
    }

    $a = new OldEnglishPound("5p 17s 8d");
    $b = new OldEnglishPound("3p 4s 10d");
    $c = new OldEnglishPound("18p 16s 1d");
    echo "Sum: ". $a->sum($a, $b)."<br>";
    echo "Dif: ". $a->dif($b, $a)."<br>";
    echo "Mol: ". $a->mol($a, 2)."<br>";
    echo "Div: ". $a->div($a, 3)."<br>";
    echo "Div: ". $a->div($c, 15)."<br>";
?>
