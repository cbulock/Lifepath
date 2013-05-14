<?php

 namespace Cbulock\Numerology;
 
 class LifePath {
  
  protected $date;
  
  public function __construct($date) {
   if (!$date instanceof \DateTime) {
    $date = new \DateTime($date);
   }
   $this->date = $date;
  }
  
  public function get() {
   return $this->calculate();
  }
  
  protected function calculate() {
   $pieces = [];
   $total = 0;
   $pieces['y'] = $this->date->format('Y');
   $pieces['m'] = $this->date->format('m');
   $pieces['d'] = $this->date->format('d');
   foreach ($pieces as $piece) {
    $total = $total + $this->sum_piece($piece);
   }
   while (count(str_split($total)) > 1) {
    $total = $this->sum_piece($total);
   }
   return $total;
  }
  
  protected function sum_piece($piece) {
   if ($this->is_master($piece)) return $piece;
   $total = 0;
   $numbers = str_split($piece);
   foreach ($numbers as $number) {
    $total = $total + $number;
   }
   return $total;
  }
  
  protected function is_master($number) {
   $parts = str_split($number);
   if (strlen($number) == 2 AND $parts[0] == $parts[1] AND $parts[0] < 3) {
    return TRUE;
   }
   return FALSE;
  }
  
  
 }
 
