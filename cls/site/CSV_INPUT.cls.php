<?php

/*
* CSV.inc.php
*
* Class to convert an CSV file into an array
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

/**
 * CSV uses SplFileObject
 * 
 * @package site
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */

class CSV_INPUT extends \SplFileObject{
  public $file;
  public $keys;
  public $selected_cols;
  public $data_array;
	
  /**
  * CSV::__construct()
  * Konstruktor, hier werden die Default-Werte für die Klassenvariablen gesetzt.
  * @param string $file
  */
	public function __construct($file){
    parent::__construct($file);
    $this->setFlags(parent::READ_CSV | parent::READ_AHEAD | parent::SKIP_EMPTY); // Config SplFilesObject (http://php.net/manual/de/class.splfileobject.php)
    $this->setCsvControl(';'); // delimiter festlegen
    $this->file=$file;
    $this->selected_cols=array();
    $this->data_array=array();
  }  
  
  public function set_selected_cols($selected_cols){
    $this->selected_cols=$selected_cols;
  }
  
  /**
  * CSV::rewind()
  * Abstrakte SplFileObject Funktion. Holt die Keys aus dem CSV Header.
  * @param stromg $file
  * @param string $delimiter
  */
  public function rewind(){  //zusammenfassen
    parent::rewind(); // SplFileObject Methode: setzt Pointer zurück an die 1. Zeile
    $this->keys=parent::current(); // SplFileObject Methode: gibt aktuelle Zeile der CSV-Datei zurück. Hier die Schlüsselwerte der Dateneinheiten.
    parent::next(); // SplFileObject Methode: nächste Zeile einlesen
  }
  
  /**
  * CSV::current()
  * Abstrakte SplFileObject Funktion. Führt Schlüssel und Werte der Zeilen zusammen.
  * @return array $this
  */
  public function current(){
    return array_combine($this->keys,parent::current()); //Schlüsselwerte und Daten der Zeilen zusammenführen
  }
  
  /**
  * CSV::toArray()
  * Erzeugt Array mit den gewünschten Schlüssel aus der CSV-Datei.
  * @array $data_array
  */
  public function toArray(){ // Array aus CSV-Daten erzeugen
    $this->set_selected_cols(['id','manufacturer','name','additional','price','availability','product_image']);  // array keys festlegen, to do: dynamisch lösen
    foreach($this as $line){
      if(!empty($this->selected_cols)){
        foreach($this->selected_cols as $key=>$selected_col){
          $row[$selected_col]=$line[$selected_col]; 
        }
      }else{
        $row=$line;
      }
      $this->data_array[]=$row;
    }
    return $this->data_array;
  }
}
?>