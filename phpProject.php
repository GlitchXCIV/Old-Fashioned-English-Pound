<?php
        class OldEnglishPound {
        private $price;
        private $pounds;
        private $shillings;
        private $pennies;

        public function __construct($price){
            $this->price = $price;
            
            $fetch = explode(" ", $price);
            // $this->pounds = substr($fetch[0],0,-1);
            // $this->shillings = substr($fetch[1],0,-1);
            // $this->pennies = substr($fetch[2],0,-1);
            $count = count($fetch);
            if($count >=3){
                $this->pounds = (int) $fetch[0];
                $this->shillings = (int) $fetch[1];
                $this->pennies = (int) $fetch[2];
            }elseif($count == 2){
                $this->shillings = (int) $fetch[0];
                $this->pennies = (int) $fetch[1];
            }else{
                $this->pennies = (int) $fetch[0];
            }
        }
        public function sum($priceA, $priceB) {
            $sumD = $priceA->pennies + $priceB->pennies;
            $restD = 0;
            if($sumD > 12){
                $sumD %= 12;
                $restD += 1;
            }
            $sumS = $priceA->shillings + $priceB->shillings + $restD;
            $restS = 0;
            if($sumS > 20){
                $sumS %= 20;
                $restS += 1;
            }
            $sumP = $priceA->pounds + $priceB->pounds + $restD;
            $sum = $sumP."p ".$sumS."s ".$sumD."d";
            return $sum;
           
        }
        public function dif($priceA, $priceB) {
            $loanD = 0;
            if ($priceB->pennies > $priceA->pennies) {
                $difD = $priceA->pennies + 12 - $priceB->pennies;
                $loanD +=1;
            } else {
                $difD = $priceA->pennies - $priceB->pennies;
            }
            $loanS = 0;
            if ($priceB->shillings > ($priceA->shillings - $loanD)) {
                $difS = $priceA->shillings - $loanD + 20 - $priceB->shillings;
                $loanS +=1;
            } else {
                $difS = $priceA->shillings - $priceB->shillings;
            }
                $difP = $priceA->pounds - $priceB->pounds -$loanS;

            $dif = $difP."p ".$difS."s ".$difD."d";
            return $dif;
        }
        public function mol($priceA, $int) {
            $molD = $priceA->pennies * $int;
            $restD = 0;
            while( $molD > 12){
                $molD -= 12;
                $restD += 1;
            }
            $molS = ($priceA->shillings * $int) + $restD;
            $restS = 0;
            while( $molS > 20){
                $molS -= 20;
                $restS += 1;
            }
            $molP = ($priceA->pounds * $int) + $restS;
            $mol = $molP."p ".$molS."s ".$molD."d";
            return $mol;
        }

    }


    $a = new OldEnglishPound("5p 17s 8d");
    $b = new OldEnglishPound("3p 4s 10d");
    $c = new OldEnglishPound("2s 6d");
    $d = new OldEnglishPound("12d");
    echo "Sum: ". $a->sum($a, $b)."<br>";
    echo "-1 Sum: ". $d->sum($c, $d)."<br>";
    echo "Diff: ". $a->dif($c, $a)."<br>";
    echo "Mol: ". $a->mol($a, 2)."<br>";
?>
