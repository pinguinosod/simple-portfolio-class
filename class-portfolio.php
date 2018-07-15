<?php

class Portfolio
{
  private $stocks;

  public function __construct( $stocks ) {
    $this->stocks = $stocks;
  }

  public function profit( $startDate, $endDate, $annualized = false ) {
    $profit = 0;

    if ( new Datetime( $startDate ) > new Datetime( $endDate ) ) {
      return false;
    }

    $totalStartPrice = 0;
    $totalEndPrice = 0;

    foreach( $this->stocks as $stock ) {

      $startPrice = $stock->price( $startDate );
      $endPrice = $stock->price( $endDate );

      if ( $startPrice !== false && $endPrice !== false ) { // got the price for both given dates
        $profit += $endPrice - $startPrice;
      }
      else { // couldn't retrieve one or both prices for their given dates
        return false;
      }

      $totalStartPrice += $startPrice;
      $totalEndPrice += $endPrice;

    }

    if ($annualized) {
      $dtStart = new Datetime( $startDate );
      $dtEnd = new Datetime( $endDate );
      $interval = $dtStart->diff( $dtEnd );
      $years = intval( $interval->format( '%y' ) );
      $annualizedReturn = pow( $totalEndPrice / $totalStartPrice, 1 / $years ) - 1;
      return round( $annualizedReturn * 100, 1 );
    }

    return $profit;
  }
}
