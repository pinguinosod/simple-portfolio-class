<?php

require_once('class-stock.php');
require_once('class-portfolio.php');

$stockAPrices = [
                  "2012-06-15" => 120000,
                  "2013-06-15" => 136000,
                  "2014-06-15" => 169000,
                  "2015-06-15" => 183000,
                  "2016-06-15" => 164000,
                  "2017-06-15" => 145000,
                  "2018-06-15" => 126000
                ];
$stockA = new Stock( $stockAPrices );

$stockBPrices = [
                  "2012-06-15" => 90000,
                  "2013-06-15" => 85000,
                  "2014-06-15" => 88000,
                  "2015-06-15" => 80000,
                  "2016-06-15" => 72000,
                  "2017-06-15" => 60000,
                  "2018-06-15" => 45000
                ];
$stockB = new Stock( $stockBPrices );

$stockCPrices = [
                  "2012-06-15" => 40000,
                  "2013-06-15" => 50000,
                  "2014-06-15" => 65000,
                  "2015-06-15" => 85000,
                  "2016-06-15" => 65000,
                  "2017-06-15" => 50000,
                  "2018-06-15" => 45000
                ];
$stockC = new Stock( $stockCPrices );

$portfolio = new Portfolio( [$stockA, $stockB, $stockC] );

echo "Test: Normal negative profit: ";
var_dump( $portfolio->profit( '2012-06-15', '2018-06-15' ) === -34000 );

echo "Test: Normal positive profit: ";
var_dump( $portfolio->profit( '2012-06-15', '2015-06-15' ) === 98000 );

echo "Test: Starting date = ending date: ";
var_dump( $portfolio->profit( '2015-06-15', '2015-06-15' ) === 0 );

echo "Test: Not registered date: ";
var_dump( $portfolio->profit( '2011-06-15', '2015-06-15' ) === false );

echo "Test: Starting date > ending date: ";
var_dump( $portfolio->profit( '2018-06-15', '2015-06-15' ) === false );

echo "Test: Annualized return: ";
var_dump( $portfolio->profit( '2012-06-15', '2015-06-15', true ) === 11.7 );
