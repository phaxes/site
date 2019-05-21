<?php

/*
* XMLTest.inc.php
*
* PHPUnit Test Class.
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require "../inc/XML.inc.php";

use PHPUnit\Framework\TestCase;

class XMLTest extends TestCase{
  
  public function testExceptionIsRaisedForInvalidConstructorArgument(){
   new XML(null);
  }
}

?>