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
        public function sum(OldEnglishPound $priceB) {
            $sumD = $this->pennies + $priceB->pennies;
            $restD = 0;
            while( $sumD >= 12){
                $sumD -= 12;
                $restD += 1;
            }
            $sumS = $this->shillings + $priceB->shillings + $restD;
            $restS = 0;
            while($sumS >= 20){
                $sumS -= 20;
                $restS += 1;
            }
            $sumP = $this->pounds + $priceB->pounds + $restS;
            $sum = $sumP."p ".$sumS."s ".$sumD."d";
            return $sum;   
        }
        public function dif(OldEnglishPound $priceB) {
            $loanD = 0;
            if ($priceB->pennies > $this->pennies) {
                if($this->shillings >= 1){
                    $difD = $this->pennies + 12 - $priceB->pennies;
                    $loanD += 1;
                }else{
                    return 0;
                }        
            } else {
                $difD = $this->pennies - $priceB->pennies;
            }
            $loanS = 0;
            if ($priceB->shillings > ($this->shillings - $loanD)) {
                if ($this->pounds >= 1){
                    $difS = $this->shillings - $loanD + 20 - $priceB->shillings;
                    $loanS +=1;
                }else{
                    return 0;
                }
            } else {
                $difS = $this->shillings - $loanD - $priceB->shillings;
            }
            if ($priceB->pounds > $this->pounds - $loanS){
                return 0;
            }else{
                $difP = $this->pounds - $priceB->pounds - $loanS;
            }
            $dif = $difP."p ".$difS."s ".$difD."d";
            return $dif;
        }
        public function mol($int) {
            $molD = $this->pennies * $int;
            $restD = 0;
            while( $molD >= 12){
                $molD -= 12;
                $restD += 1;
            }
            $molS = ($this->shillings * $int) + $restD;
            $restS = 0;
            while( $molS >= 20){
                $molS -= 20;
                $restS += 1;
            }
            $molP = ($this->pounds * $int) + $restS;
            $mol = $molP."p ".$molS."s ".$molD."d";
            return $mol;
        }
        public function div($int) {
            $restP = $this->pounds;
            $divP = 0;
            while ($restP >= $int){
                $restP -= $int;
                $divP += 1;
            }
            $restS = $this->shillings + ($restP * 20);
            $divS = 0;
            while ($restS >= $int){
                $restS -= $int;
                $divS += 1;
            }
            $restD = $this->pennies + ($restS * 12);
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
    echo "Sum: ". $a->sum($b)."\n\n";
    echo "Dif: ". $a->dif($b)."\n\n";
    echo "Mol: ". $a->mol(2)."\n\n";
    echo "Div: ". $a->div(3)."\n\n";
    echo "Div: ". $c->div(15)."\n\n";
?>
