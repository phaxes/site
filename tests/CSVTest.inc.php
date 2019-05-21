<?php

/*
* CSVTest.inc.php
*
* PHPUnit Test Class.
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require "../inc/CSV.inc.php";

use PHPUnit\Framework\TestCase;

class CSVTest extends TestCase{
  
  public function testExceptionIsRaisedForInvalidConstructorArgument(){
   new CSV(null);
  }
  
  //public function testFailingInclude(){
  //  include "../inc/CSV.inc.php";
  //}
}

?>