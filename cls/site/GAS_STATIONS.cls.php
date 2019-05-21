<?php
/*
* XML.inc.php
*
* Class to convert a XML file into an array
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

require_once("JSON_INPUT.cls.php");

/**
 * GAS_STATIONS extends JSON_INPUT
 *
 * @package site
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class GAS_STATIONS extends JSON_INPUT{
  private $location;
  private $radius;
  private $system_location;
  private $url;
  private $lat;
  private $lon;
  private $data_array;
  private $content_array; //TODO: Variablen sammeln
  private $station_array;
  private $stations_array;

  /**
   * JSON::__construct($url)
   * Konstruktor, hier werden die Default-Werte für die Klassenvariablen gesetzt.
   * @hint $url default: SITE-Location / 10KM
   */
  public function __construct($location,$radius){ //Array von XML_INPUT als Parameter übergeben.
    $this->location=$location;
    $this->radius=$radius;
    $this->system_location="";
    $this->url="";
    $this->data_array=array();
    $this->content_array=array(); //TODO: Variablendefinitionen ergänzen
    $this->lat=""; //TODO: zweimal? Eventuell Methode bauen
    $this->lon=""; //TODO: nach Ablauf Session->keine Daten mehr Seite kann aber geladen werden
    $this->station_array=array();
    $this->stations_array=array();
  }

  public function set_content_array($row=array()){ //TODO: Array Verlauf beobachten....!!!Leeren?
    $row['isOpen']=='1' ? $row['isOpen']='Ja' : $row['isOpen']='Nein';
    $this->content_array[]=array(
      'header'=>$row['brand'],
      'image'=>"",
      'map_address'=>"{$row['street']}+{$row['houseNumber']}+{$row['postCode']}+{$row['place']}",
      'title'=>"",
      'cell_1_1'=>"Diesel",
      'cell_1_2'=>$row['diesel'],
      'cell_2_1'=>"E 5",
      'cell_2_2'=>$row['e5'],
      'cell_3_1'=>"E 10",
      'cell_3_2'=>$row['e10'],
      'cell_4_1'=>"Geöffnet",
      'cell_4_2'=>$row['isOpen'],
      'cell_5_1'=>"Strasse",
      'cell_5_2'=>"{$row['street']} {$row['houseNumber']}",
      'cell_6_1'=>"Ort",
      'cell_6_2'=>"{$row['postCode']} {$row['place']}",
      'cell_7_1'=>"Entfernung",
      'cell_7_2'=>$row['dist']." KM",
      'link_element'=>"http://maps.google.de/maps?saddr={$this->system_location}&daddr={$row['street']}+{$row['houseNumber']}+{$row['postCode']}+{$row['place']}"
    );
  }

  public function get_content_array(){
    $content_array=$this->content_array;
    unset($this->content_array);
    return $content_array;
  }

  public function stations_url(){ //API URL zusammensetzen
    if(!empty($this->location && $this->radius)){ //Client User Coords
      $this->location=str_replace(" ","",$this->location); //TODO: Nummern entfernen!!
      $this->location=preg_replace('/[^A-Za-z]+/', '', $this->location);
      $this->location=strtolower($this->location);
      $this->radius=str_replace(" ","",$this->radius); //TODO: Nummern entfernen!!
      $this->radius=preg_replace('/[^0-9]/', '', $this->radius);
      //JSON Objekt umbauen...cURL...
      $json=file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$this->location}&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc");
      $json_array=json_decode($json,true);
      $coords=array_column($json_array['results'][0], 'location'); //array column does not support 1D Arrays!!!
      $this->lat=$coords[0]['lat'];
      $this->lon=$coords[0]['lng'];
      $this->url="https://maps.googleapis.com/maps/api/geocode/json?latlng={$this->lat},{$this->lon}&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc";
      $json=file_get_contents($this->url);
      $data=json_decode($json);
      echo "<pre>";
      print_r($data);
      echo "</pre>";
      $this->system_location=$data->results[0]->formatted_address; //1. Durchgang ob mit oder ohne Auto-Location
    }else{ //Client System Coords
      $this->lat=$_SESSION["lat"];
      $this->lon=$_SESSION["lon"];
      $this->radius="5";
      $this->url="https://maps.googleapis.com/maps/api/geocode/json?latlng={$this->lat},{$this->lon}&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc";
      $json=file_get_contents($this->url);
      $data=json_decode($json);
      echo "<pre>";
      print_r($data);
      echo "</pre>";
      $this->system_location=$data->results[0]->formatted_address; //1. Durchgang ob mit oder ohne Auto-Location
    }
    return $this->url="https://creativecommons.tankerkoenig.de/json/list.php?lat={$this->lat}&lng={$this->lon}&rad={$this->radius}&sort=dist&type=all&apikey=655a5591-c017-ceb1-93ad-fbae0174af2b";
  }

  public function data_array_api(){ //Tankstellen Array aus API aus location (default+user_input)
    $this->data_array=$this->json_decode_url($this->stations_url());
    $this->stations_array=$this->data_array[4];
    return $this->stations_array;
  }

  public function all_stations(){
    $stations_array=$this->data_array_api();
    foreach($stations_array as $row){
      $this->set_content_array($row);
    }
    return $this->get_content_array();
  }

  public function search_stations($search_tag){
    $this->search_tag=$search_tag;
    $this->stations_array=$this->data_array_api();
    if(!empty($this->stations_array)){
      $search_tag=str_replace(" ","",$search_tag);
      $search_tag=preg_replace('/[^A-Za-z]+/', '', $search_tag);
      $search_tag=strtolower($search_tag);
      $stations_column=array_column($this->stations_array, 'brand');
      $keys=array_keys(array_map('strtolower',$stations_column),$search_tag);
      foreach ($keys as $key){
        $station_array=$this->stations_array[$key];
        $this->set_content_array($station_array);
      }
    }
    $result_array=$this->get_content_array();//TODO: else Zweig?
    if(isset($result_array)){ return $result_array; }else{ echo "Keine Treffer"; }
  }

  public function cheapest_station($search_tag){
    $this->search_tag=$search_tag;
    !empty($this->search_tag) ? $this->content_array=$this->search_stations($this->search_tag) : $this->content_array=$this->all_stations();
    $this->stations_array=array();
    $min=min(array_filter(array_column($this->content_array,'cell_1_2')));
    //key des ersten minimalen Vorkommens von Diesel, E5 oder E10
    $key=array_search($min,array_column($this->content_array,'cell_1_2'));
    $this->station_array=$this->content_array[$key];
    $this->stations_array[]=$this->station_array;
    if(isset($this->stations_array)) { return $this->stations_array; }
  }
}
































//public function nearest_station($search_tag=""){
//  !empty($search_tag) ? $this->search_tag=$search_tag : $this->search_tag=$search_tag;
//  if(empty($this->search_tag)) {
//    $this->data_array=$this->json_decode_url($this->url);
//    $stations_array=$this->data_array[4];
//    $min=min(array_column($stations_array, 'dist'));
//    $key=array_search($min, $stations_array);
//    $station_array = $stations_array[$key];
//    $station_array['isOpen'] == '1' ? $station_array['isOpen'] = 'Ja' : $station_array['isOpen'] = 'Nein';
//    $content_array[] = array(
//      'header' => $station_array['brand'],
//      'image' => "",
//      'map_address' => "{$station_array['street']}+{$station_array['houseNumber']}+{$station_array['postCode']}+{$station_array['place']}",
//      'title' => "",
//      'cell_1_1' => "Diesel",
//      'cell_1_2' => $station_array['diesel'],
//      'cell_2_1' => "E 5",
//      'cell_2_2' => $station_array['e5'],
//      'cell_3_1' => "E 10",
//      'cell_3_2' => $station_array['e10'],
//      'cell_4_1' => "Geöffnet",
//      'cell_4_2' => $station_array['isOpen'],
//      'cell_5_1' => "Strasse",
//      'cell_5_2' => "{$station_array['street']} {$station_array['houseNumber']}",
//      'cell_6_1' => "Ort",
//      'cell_6_2' => "{$station_array['postCode']} {$station_array['place']}",
//      'cell_7_1' => "Entfernung",
//      'cell_7_2' => $station_array['dist'] . " KM",
//      'link_element' => "http://maps.google.de/maps?saddr={$this->system_location}&daddr={$station_array['street']}+{$station_array['houseNumber']}+{$station_array['postCode']}+{$station_array['place']}"
//    );
//  }elseif(!empty($this->search_tag)){
//    $stations_array=$this->search_station($this->search_tag);
//    $min=min(array_column($stations_array, 'cell_7_2'));
//    $key=array_search($min, $stations_array);
//    $station_array=$stations_array[$key];
//    $content_array[]=array(
//      'header'=>$station_array['header'],
//      'image'=>"",
//      'map_address'=>"{$station_array['map_address']}",
//      'title'=>"",
//      'cell_1_1'=>"Diesel",
//      'cell_1_2'=>$station_array['cell_1_2'],
//      'cell_2_1'=>"E 5",
//      'cell_2_2'=>$station_array['cell_2_2'],
//      'cell_3_1'=>"E 10",
//      'cell_3_2'=>$station_array['cell_3_2'],
//      'cell_4_1'=>"Geöffnet",
//      'cell_4_2'=>$station_array['cell_4_2'],
//      'cell_5_1'=>"Strasse",
//      'cell_5_2'=>"{$station_array['cell_5_2']}",
//      'cell_6_1'=>"Ort",
//      'cell_6_2'=>"{$station_array['cell_6_2']}",
//      'cell_7_1'=>"Entfernung",
//      'cell_7_2'=>$station_array['cell_7_2'],
//      'link_element'=>"http://maps.google.de/maps?saddr={$this->system_location}&daddr={$station_array['map_address']}"
//    );
//  }
//  return $content_array;
//}
?>