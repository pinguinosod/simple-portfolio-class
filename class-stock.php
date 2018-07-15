<?php

class Stock
{
  private $prices;

  public function __construct( $prices ) {
    $this->prices = $prices;
  }

  public function price( $date ) {
    if ( array_key_exists( $date, $this->prices ) ) {
      return $this->prices[$date];
    }
    else { // returns false if there is no price for given date
      return false;
    }
  }
}
