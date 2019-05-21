<?php

/*
* CSV.inc.php
*
* Class to convert an CSV file into an array
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require_once("CSV_INPUT.cls.php");

/**
 * CSV extends SOURCE_TYPE
 * 
 * @package site
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class CSV extends DATA_TYPE{
  public $file;
  public $CSV_INPUT;
  
	/**
  * CSV::__construct()
  * Konstruktor, hier werden die Default-Werte f�r die Klassenvariablen gesetzt.
  * @param string $file
  */
	public function __construct($file){
    $this->file=$file;
    $this->CSV_INPUT=new CSV_INPUT($this->file);
  }  
  
  /**
  * 
  * CSV::load_products_array()
  * Erzeugt aus einem (CSV-)Array den normalisierten Array des Programms.
  * @return array
  */
  public function load_products_array(){
    $data_array=$this->CSV_INPUT->toArray();
    foreach($data_array as $key=>$value){
      $this->set_id($value["id"]); 
      $this->set_title($value["manufacturer"]);
      $this->set_description($value["name"]);
      $this->set_image_link($value["product_image"]); 
      $this->set_price($value["price"]);
      $products_array[]=array("id"=>$this->get_id(),
                              "title"=>$this->get_title(),
                              "description"=>$this->get_description(),
                              "image_link"=>$this->get_image_link(),
                              "price"=>$this->get_price());
    }
    $this->set_products_array($products_array);
    return $this->get_products_array();
  }
}

?>