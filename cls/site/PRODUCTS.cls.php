<?php

/*
* PRODUCTS.inc.php
*
* Class of product information returning a normalized product data array
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/



error_reporting(-1);
ini_set('display_errors', TRUE);

/**
 * PRODUCTS
 * Model-Klasse von Site. Verarbeitet normalisierte Daten aus verschiedenen Quellen.
 * @package site
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class PRODUCTS extends DATA{
  private $norm_data_array;
  private $search_string;
  private $result_array;
  private $data_array;
	
   /**
   * PRODUCTS::__construct()
   * Konstruktor, hier werden die Default-Werte f�r die Klassenvariablen gesetzt.
   * @param stromg $file
   * @param string $delimiter
   */
	public function __construct(){ // to do: default Wert �bergeben aus Elternklasse
    parent::__construct();
    $this->norm_data_array=array();
    $this->search_string="";
    $this->result_array=array();
    $this->data_array=array();
	}
  
  public function set_norm_data_array($norm_data_array){ //Standard setter
    $this->norm_data_array=$norm_data_array;
    return true;
  }
  
  public function get_norm_data_array(){ //Standard getter
    return $this->norm_data_array;
  }
  
  /**
  * PRODUCTS::load_norm_data_array()
  * 2D-Array aus Elternklasse ($this->load_normalized_data()).
  * @return array $norm_data_array
  */
  public function load_norm_data_array(){
    return $norm_data_array=parent::load_normalized_data(); // hier passiert die Vererbung
  }
  
  /**
  * PRODUCTS::product_search()
  * Fährt eine allgemein Suche über $norm_data_array aus.
  * @param string $search_string
  * @param array $data_array
  * @return array $result_array
  */
  public function product_search($search_string,$data_array){
    if(!empty($search_string) && !empty($data_array)){ // anders l�sen
      foreach($data_array as $key=>$row){
        if(in_array($search_string,$row) || in_array($search_string,array_map('strtolower',$row)) || in_array(str_replace(" ","",$search_string),str_replace(" ","",$row))){ 
          $this->result_array[]=$row;
        }else{ // Teilstring suchen
          foreach($row as $key=>$value){ // Zusammenfassen
            if(stristr(preg_replace('/\s+/', '', $value), preg_replace('/\s+/', '',$search_string))){
              $this->result_array[]=$row;
            }
          } 
        }
      }  
    return $this->result_array;
    }
    //print_r(test::product_search('205/65', $data_array));  
  }
  
  /**
  * PRODUCTS::product_search_key()
  * F�hrt eine spezielle Suche �ber $norm_data_array aus.
  * @param string $search_string
  * @param array $data_array
  * @param string $serach_key
  * @return array $result_array
  */
  public function product_search_key($search_string,$data_array,$search_key){
    if(!empty($search_string) && !empty($data_array) && !empty($search_key)){
      foreach($data_array as $key=>$row){
        if(in_array($search_string,$row[$search_key]) || in_array($search_string,array_map('strtolower',$row[$search_key])) || in_array(str_replace(" ","",$search_string),str_replace(" ","",$row[$search_key]) && stristr($row[$search_key],$search_string))){
          $this->result_array[]=$row;
        }
      }
    return $this->result_array;
    }
  }
}
?>