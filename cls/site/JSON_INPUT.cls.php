<?php
/*
* JSON_INPUT.cls.php
*
* Class to convert a JSON Data Source into an normalized SITE-Array.
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

/**
 * JSON_INPUT
 *
 * @package site
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class JSON_INPUT{

  private $data_array;
  private $json;
  private $data;

  /**
   * JSON_INPUT::__construct()
   * Konstruktor, hier werden die Default-Werte für die Klassenvariablen gesetzt.
   * @param string $url
   */
  public function __construct(){
    $this->json="";
    $this->data=array();
    $this->data_array=array();
  }

  public function json_decode_url($url){
    if(!filter_var($url, FILTER_VALIDATE_URL)){
      throw new Exception('Cant read URL: '.$url);
    }

    ob_start(); //alles was jetzt kommt wird gepuffert -->

    try{
      $this->json=file_get_contents($url);   // TODO: Key dynamisch!
      //TODO: JSON Objekt erzeugen
      $this->data=json_decode($this->json,true);
      foreach($this->data as $value){
        $this->data_array[]=$value;
      }
      return $this->data_array;
      $this->data_array=ob_get_contents(); //Puffer in Variable schreiben
    }catch(\Exception $exception){
      throw new Exception($exception->getMessage().' (in Data Array '.$this->data_array.')');
    } finally {
      ob_end_clean(); //deaktiviert die Ausgabepufferung
    }
    return $this->data_array; //Puffer ausgeben
  }
}

?>