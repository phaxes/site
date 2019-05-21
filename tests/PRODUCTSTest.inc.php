<?php

/*
* PRODUCTSTest.inc.php
*
* PHPUnit Test Class.
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require "../inc/PRODUCTS.inc.php";

use PHPUnit\Framework\TestCase;

class PRODUCTSTest extends TestCase{
  
  public function testExceptionIsRaisedForInvalidConstructorArgument(){
   new PRODUCTS(null);
  }
}

?>