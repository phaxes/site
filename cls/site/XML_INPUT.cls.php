<?php
/*
* XML.inc.php
*
* Class to convert a XML file into an array
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

/**
 * XML extends SOURCE_TYPE
 * 
 * @package site  
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class XML_INPUT{
	
  private $file;
  private $tag;
  private $type; 
  private $value; 
  private $level;
  private $next;
  private $array_object;
  
  /**
  * XML::__construct()
  * Konstruktor, hier werden die Default-Werte für die Klassenvariablen gesetzt.
  * @param string $file
  */
	public function __construct($file){
    $this->file=$file; //file....
    $this->tag="";
    $this->type="";
    $this->value="";
    $this->level="";
    $this->next="";
    $this->array_object=array();		 
	}
  
  /**
  * XML::xml_object()
  * XML-Parser Funktion, erzeugt ein array aus einer XML-Datei.
  * @param string $xml_file
  * @return array
  */
  public function xml_object($file){ //nochmal file....?
    $xml_string=utf8_encode(file_get_contents($file)); //Datei abrufen
    $parser=xml_parser_create(); 
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
    xml_parse_into_struct($parser,$xml_string,$xml_values); 
    xml_parser_free($parser); 
    $xml_object=array(); 
    $last_object=array(); 
    $now_object=&$xml_object;
    
    foreach($xml_values as $xml_key=>$xml_value){ 
      $index=count($now_object);
      if($xml_value["type"]=="complete"){ 
        $now_object[$index]=new XML_INPUT($file); 
        $now_object[$index]->tag=$xml_value["tag"]; 
        $now_object[$index]->type=$xml_value["type"];
        if(!empty($xml_value["value"])){
          $now_object[$index]->value=$xml_value["value"];
        }else{ 
          $now_object[$index]->value="";
         } 
        $now_object[$index]->level=$xml_value["level"]; 
      }elseif($xml_value["type"]=="open"){ 
        $now_object[$index]=new XML_INPUT($file); 
        $now_object[$index]->tag=$xml_value["tag"]; 
        $now_object[$index]->type=$xml_value["type"];
        if(!empty($xml_value["value"])){
          $now_object[$index]->value=$xml_value["value"];
        }else{ 
          $now_object[$index]->value="";
        } 
        $now_object[$index]->level=$xml_value["level"]; 
        $now_object[$index]->next=array(); 
        $last_object[count($last_object)]=&$now_object; 
        $now_object=&$now_object[$index]->next; 
      }elseif($xml_value["type"]=="close"){ 
        $now_object=&$last_object[count($last_object) - 1]; 
        unset($last_object[count($last_object) - 1]); 
      }
    }
    return $xml_object; 
  } 
  
  /**
  * XML::object_array()
  * Erzeugt ein XML object array.
  * @param integer $tmp_array
  * @return array
  */
  public function object_array($tmp_array){
    if(is_array($tmp_array)){ 
      foreach($tmp_array as $key=>$value){				 
      	if(is_array($value->next)){ 
      		$array_object[$value->tag][]=$this->object_array($value->next); 
      	}else{					 
      		$array_object[$value->tag]=$value->value;					 
      	} 
      }		 
    	return $array_object; 
    }else{ 
      return false; 
    } 
  }	
}
?>