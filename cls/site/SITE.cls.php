<?php

/*
* SITE.cls.php
*
* Site initializing Class.
*
* Copyright (C) 2018  Philip Schulz <ph.schulz@email.de>
*
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * SITE
 * Initialisiert eine Seite. Controller-Klasse.
 * @package site 
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
class SITE {
  private $content_type;
  private $site_title;
  private $body_title;
  private $body_category;
  private $col_size;
  private $col_title;
  private $element_array;
  private $data_element;
	
   /**
   * SITE::__construct()
   * Konstruktor, hier werden die Default-Werte für die Klassenvariablen gesetzt.
   * @param string $site_title
   * @param string $body_title
   * @param string $body_category
   */
	public function __construct($site_title,$body_title,$body_category){ // to do: default Wert übergeben aus Elternklasse
    $this->content_type="text/html; charset=UTF-8";
    $this->site_title=$site_title;
    $this->body_title=$body_title;
    $this->body_category=$body_category;
    $this->data_element="";
    $this->col_size="";
    $this->col_title="";
    $this->col_array=array();
    $this->col_key="";
    $this->element_array=array();
    //Session starten...
    if(!isset($_SESSION)) session_start();//TODO vorher leeren?
	}
  
  public function get_site_title(){
    return $this->site_title;
  }
  
  public function get_body_title(){
    return $this->body_title;
  }
  
  public function get_body_category(){
    return $this->body_category;
  }
  
  public function get_action_script(){
    return $this->action_script;
  }

  public function get_onclick(){
	  return $this->onclick;
  }
  
  public function get_col_size(){
    return $this->col_size;
  }
  
  public function get_col_title(){
    return $this->col_title;
  }
  
  public function get_col_array(){
    return $this->col_array;
  }
  
  public function get_col_key(){
    return $this->col_key;
  }
  
  public function get_col_input(){
    return $this->col_input;
  }
  
  public function get_element_array(){
    return $this->element_array;
  }
  
  public function set_element_array($element_array){
    $this->element_array=$element_array;
  }
  
  public function add_element($array_element,$element_key=''){
    !empty($element_key) ? $this->element_array[$element_key]=$array_element : $this->element_array[]=$array_element;
  }

  /**
   * SITE::add_element_array()
   * Erstellt ein Element-Array aus dem Daten Array, mit optionalem Schlüssel. Ohne Schlüssel -> einfach INDEXIERUNG (z.B.:$i++)!
   * @param array $element_array
   * @param string $array_element
   * @param string $element_key
   * @return boolean
   */
  public function add_element_array($element_array,$array_element,$element_key=''){
   foreach($element_array as $value){
      !empty($element_key) ? $this->add_element($array_element,$element_key) : $this->add_element($array_element++);
    }
  }
    
  public function render($template){ // puffert die Ausgabe, rendert noch nix
    if(!is_readable($template)){
      throw new Exception('Cant read template: '.$template);
    }
    $content='';
    ob_start(); //alles was jetzt kommt wird gepuffert -->
    
   try{
      require $template; //content in Puffer schreiben
      $content=ob_get_contents();//Puffer in Variable schreiben
    }catch(\Exception $exception){
      throw new Exception($exception->getMessage().'(in template '.$template.')');
    } finally {
      ob_end_clean(); //deaktiviert die Ausgabepufferung
    }
    echo $content; //Puffer ausgeben
  }
  
  public function header(){
    $this->render("../../htm/site/header.html");
  }
  
  public function add_javascript($script=""){ // TODO: dynamisch
    isset($script) ? $this->script=$script : $Script="";
    $this->render("../../htm/site/javascript.html");
  }
  
  public function navbar_start($default_page=""){ // Array mit den gewünschten Form Elements übergeben
    isset($default_page) ? $this->default_page=$default_page : $default_page="";
	  $this->render("../../htm/site/navbar/start.html");
  }

  public function container_start(){
    $this->render("../../htm/site/container/start.html");
  }

  public function jumbotron_start(){
	  $this->render("../../htm/site/jumbotron/start.html");
  }

  public function card_deck_start($topic=""){
	  isset($topic) ? $this->topic=$topic : $this->topic="";
	  $this->render("../../htm/site/card/deck_start.html");
  }

  public function navbar_end(){
    $this->render("../../htm/site/navbar/end.html");
  }

  public function container_end(){
    $this->render("../../htm/site/container/end.html");
  }

  public function jumbotron_end(){
	  $this->render("../../htm/site/jumbotron/end.html");
  }

  public function card_deck_end(){
	  $this->render("../../htm/site/card/deck_end.html");
  }

  public function form_end(){
    $this->render("../../htm/site/form/end.html");
  }

  /**
   * SITE::form()
   * Erstellt ein form-input Element. Methode POST und ACTION.
   * @param string $action_script
   * @return boolean
   */
  public function form($action_script){
    isset($action_script) ? $this->action_script=$action_script : $this->action_script="";
    $this->render("../../htm/site/form/start.html");
  }

  public function form_search($action_script,$name,$id){
    isset($action_script) ? $this->action_script=$action_script : $this->action_script="";
    isset($name) ? $this->name=$name : $this->name="";
    isset($id) ? $this->id=$id : $this->id="";
    $this->render("../../htm/site/form/search.html");
  }
  
  /**
   * SITE::input_form()
   * Erstellt eine input-form mittels <input>-Tag. Types: email,password,checkbox,file,text,checkbox,radio,search.
   * @param string $action_script
   * @return boolean
   */
  public function input_type($type,$name,$placeholder){
    isset($type) ? $this->type=$type : $this->type="";
    isset($name) ? $this->name=$name : $this->name="";
    isset($placeholder) ? $this->placeholder=$placeholder : $this->placeholder="";
    $this->render("../../htm/site/input/type.html");
  }

 /**
   * SITE::input_button()
   * Erstellt ein Button mittels <input>-Tag. Types: button,submit,reset.
   * @param string $type (button,submit,reset)
   * @param string $style (secondary,danger,light,dark,info,link)
   * @param string $id (post_method)
   * @param string $value
   * @return boolean
   */
  public function input_button($type,$style,$id="",$value,$onclick=""){
    isset($type) ? $this->type=$type : $this->type="";
    isset($style) ? $this->style=$style : $this->style="";
    isset($id) ? $this->id=$id : $this->id="";
    isset($value) ? $this->value=$value : $this->value="";
    $this->onclick=$onclick;
    $this->render("../../htm/site/input/button.html");
  }

  /**
   * SITE::link_element()
   * Erstellt Spaltendaten innerhalb der Form mit Hilfe eines optionalen Daten-Arrays, optionale Parametern: $col_title,$col_data,$col_key.
   * @param array $element_array
   * @param string $link_value
   * @param string $link_key
   */
  public function link_element($element_array,$link_value,$link_key=""){
    isset($element_array) ? $this->element_array=$element_array : false;
    isset($link_value) ? $this->link_value=$link_value : $this->link_value="";
    isset($link_key) ? $this->link_key=$link_key : false;
    foreach($this->element_array as $row){
      if(!empty($this->link_key)){
        $this->link_element=$row['image_link'];
        $this->render("../../htm/site/element/link.html");
      }else{
        $this->link_element=$row;
        $this->render("../../htm/site/element/link.html");
      }
    }
  }

  /**
   * SITE::navbar_link()
   * Erzeugt einen Raw-Link im Navbar. Optional PHP-Skript, JavaScript-Snippet.
   * @param string $title
   * @param string $id
   * @param string $action_script
   * @param string $js_snippet
   */
  public function navbar_link($title="",$id="",$action_script="",$js_snippet=""){
    $this->title=$title;
    $this->id=$id;
    $this->action_script=$action_script;
    $this->js_snippet=$js_snippet;
    $this->render("../../htm/site/navbar/link.html");
  }

  public function set_uniqid_array($id){
    $this->uniqid_array[]=$id;
  }

  public function get_uniqid_array(){
    $uniqid_array=$this->uniqid_array;
    $this->uniqid_array=array();
    return $uniqid_array;
  }

  public function table($data_array){ //$data_array muss immer 2D sein!
    isset($data_array) ? $this->data_array=$data_array : $this->data_array=array();
    $this->render("../../htm/site/table/start.html"); //start
    $attributes=array_keys($this->data_array[0]); //Spaltenattribute holen
    foreach($attributes as $row){ //Jedes Attribut als Überschrift der Spalte
      $this->attribute=$row;
      $this->render("../../htm/site/table/th_col.html");
    }
    $this->render("../../htm/site/table/tbody.html"); //continue
    foreach($this->data_array as $key=>$row){ //Jeder Zeile einen Index zuweisen
      $this->index=++$key;
      $this->href="location.href='".$row['image_link']."';"; //absolut undynamisch!!!
      $this->uniqid=uniqid("#");
      $this->set_uniqid_array($this->uniqid); //weitergeben an function, LINK einfügen
      $this->render("../../htm/site/table/th_row.html");
      foreach($row as $data){ //Jedem Attribute des 2D-Arrays den jeweiligen Zeilenwert zuordnen
        $this->data=$data;
        $this->render("../../htm/site/table/td.html");
      }
      $this->render("../../htm/site/table/tr.html");
    }
    $this->render("../../htm/site/table/end.html"); //end
    echo "<pre>"; print_r($this->get_uniqid_array()); echo "</pre>";
  }

  public function card($content_array){
    isset($content_array) ? $this->content_array=$content_array : $this->content_array=array();
    foreach($this->content_array as $row){
      $this->card_header=$row['header'];
      $this->card_image=$row['image'];
      $this->map_address=$row['map_address'];
      $this->card_title=$row['title'];
      $this->cell_1_1=$row['cell_1_1'];
      $this->cell_1_2=$row['cell_1_2'];
      $this->cell_2_1=$row['cell_2_1'];
      $this->cell_2_2=$row['cell_1_2'];
      $this->cell_3_1=$row['cell_3_1'];
      $this->cell_3_2=$row['cell_3_2'];
      $this->cell_4_1=$row['cell_4_1'];
      $this->cell_4_2=$row['cell_4_2'];
      $this->cell_5_1=$row['cell_5_1'];
      $this->cell_5_2=$row['cell_5_2'];
      $this->cell_6_1=$row['cell_6_1'];
      $this->cell_6_2=$row['cell_6_2'];
      $this->cell_7_1=$row['cell_7_1'];
      $this->cell_7_2=$row['cell_7_2'];
      $this->link_element=$row['link_element'];
      $this->render("../../htm/site/card/start.html");
    }
    unset($this->content_array);
  }
  
  public function footer(){
    $this->render("../../htm/site/footer.html");
  } 
}

?>