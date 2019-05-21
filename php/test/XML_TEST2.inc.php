<?php

class XML_TEST2{ 
  private $tag;
  private $type;
  private $value; 
  private $level; 
  private $next;
  
  	public function __construct(){
	  $this->tag="";
    $this->type="";
    $this->value="";
    $this->level="";
    $this->next="";
    return 1;
	}

 
function xml_object($xml_string){ 
  $parser=xml_parser_create(); 
  xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
  xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
  xml_parse_into_struct($parser,$xml_string,$xml_values); 
  xml_parser_free($parser); 
  $xml_class=array(); 
  $last_object=array(); 
  $now_object=&$xml_class;
  
  
  foreach($xml_values as $xml_key=>$xml_value){ 
    $index=count($now_object);
    if($xml_value["type"]=="complete"){ 
      $now_object[$index]=new XML; 
      $now_object[$index]->tag=$xml_value["tag"]; 
      $now_object[$index]->type=$xml_value["type"];
      if(!empty($xml_value["value"])){
        $now_object[$index]->value=$xml_value["value"];
      }else{ 
        $now_object[$index]->value="";
       } 
      $now_object[$index]->level=$xml_value["level"]; 
    }elseif($xml_value["type"]=="open"){ 
      $now_object[$index]=new XML; 
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
  return $xml_class; 
} 
 
function object_array($tmparr){		 
  $array_object=array();		 
  if(is_array($tmparr)){ 
    foreach($tmparr as $k=>$v){				 
    	if(is_array($v->next)){ 
    		$array_object[$v->tag][]=object_array($v->next); 
    	}else{					 
    		$array_object[$v->tag]=$v->value;					 
    	} 
    }		 
  	return $array_object; 
  }else{ 
    return false; 
  } 
}	 

function gogo(){
//Datei abrufen 
$xml_string=utf8_encode(file_get_contents('../../xml/products/db_tyres.xml')); 
 
//Datei verarbeiten 
$return=xml_object($xml_string); 
 
//Inhalt ausgeben 
return $return=object_array($return); 

}



} 
?>