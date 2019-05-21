<?php
/*
* XML.inc.php
*
* Class to convert a XML file into an array
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require_once("XML_INPUT.cls.php");

/**
 * XML extends SOURCE_TYPE
 * 
 * @package site  
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class XML extends DATA_TYPE{
	private $file;
  private $XML_INPUT;
  private $data_array;
  private $xml_object;
  
  /**
  * XML::__construct()
  * Konstruktor, hier werden die Default-Werte f�r die Klassenvariablen gesetzt.
  * @param string $file
  */
	public function __construct($file){ //Array von XML_INPUT als Parameter �bergeben.
    $this->file=$file;
    $this->XML_INPUT=new XML_INPUT($this->file);
    $this->data_array=array();
    $this->xml_object=array();
	}
  
  /**
  * 
  * XML::load_products_array()
  * Erzeugt aus einem (XML-)Array den normalisierten Array des Programms.
  * @return array
  */
  public function load_products_array(){
    $xml_object=$this->XML_INPUT->xml_object($this->file); //Datei verarbeiten
    $data_array=$this->XML_INPUT->object_array($xml_object);  //Inhalt ausgeben
    foreach($data_array as $key=>$root){ //to do: k�rzen, optimieren
      foreach($root as $key=>$row){
        foreach($row as $key=>$index){
          foreach($index as $key=>$items){
            $this->set_id($items["id"]);
            $this->set_title($items["manufacturer"]);
            $this->set_description($items["name"]);
            $this->set_image_link($items["product_image"]);
            $this->set_price($items["price"]);
            //Daten normalisieren
            $products_array[]=array("id"=>$this->get_id(),"title"=>$this->get_title(),"description"=>$this->get_description(),"image_link"=>$this->get_image_link(),"price"=>$this->get_price());
          }
        }
      }
    }
  $this->set_products_array($products_array);
  return $this->get_products_array();
  }
}
?>