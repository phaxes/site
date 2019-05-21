<?php

/*
* DATATest.inc.php
*
* PHPUnit Test Class.
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require "../inc/DATA.inc.php";

use PHPUnit\Framework\TestCase;

class DATATest extends TestCase{
  
  public function testExceptionIsRaisedForInvalidConstructorArgument(){
   new DATA(null);
  }
}

?>