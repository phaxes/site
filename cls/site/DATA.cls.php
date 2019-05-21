<?php

/*
* DATA.inc.php
*
* Class to merge one or more normalized data arrays from different sources
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

/**
 * DATA
 * 
 * @package site 
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class DATA extends DATA_TYPE{
  private $class_name_array;
  private $data_array;
	
  /**
  * DATA::__construct()
  * Konstruktor, hier werden die Default-Werte für die Klassenvariablen gesetzt.
  * @return boolean
  */
	public function __construct(){
    $this->class_name_array=array();
    $this->data_array=array();
	}
  
  /**
  * CSV::load_normalized_data()
  * Normalisierte Daten (Arrays) aus den Import Schnittstellen zusammenführen.
  * Eliminiert identische Dateneinheiten.
  * @return array $data_array
  */
  public function load_normalized_data(){
    file_put_contents('../../csv/products/db_tyres.csv', str_replace(["\xEF\xBB\xBF", "\r"],'', file_get_contents('../../csv/products/db_tyres.csv')));
    $inc=scandir(__DIR__); //lokalen Ordner auslesen
    unset($inc[0],$inc[1]); //"." und ".." entfernen
    
    foreach($inc as $file){  //Über die Klassen iterieren
      $class_name=str_replace('.cls.php','',$file);
      $class_instance_name='$'.$class_name;
      $methods=get_class_methods($class_name);
      if(in_array('load_products_array',$methods)){
        $class_instance_name=new $class_name('../../'.strtolower($class_name).'/products/db_tyres.'.strtolower($class_name).''); //Object erzeugen mit $file als Parameter
        $class_name_array=$class_instance_name->load_products_array();  // Aggregationsfunktion aufrufen
      }
      $this->data_array=array_merge($this->data_array,$class_name_array); // Datenimporte zusammenführen
    }
    return array_unique($this->data_array,SORT_REGULAR); //dubplizierte Dateneinheiten eliminieren
  }
}
?>