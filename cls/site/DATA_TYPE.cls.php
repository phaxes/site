<?php

/**
 * abstract class SOURCE_TYPE
 * 
 * @package site  
 * @author Philip Schulz
 * @copyright Philip Schulz
 * @version 2018
 * @access public
 */
abstract class DATA_TYPE implements DATA_SOURCE{
  
  private $id;
  private $title;
  private $description;
  private $image_link;
  private $price;
  private $products_array;
  private $data_array;
  
  public function __construct(){
  }
  
  public function set_id($id){
    $this->id=$id;
    return true;
  }
  
  public function set_title($title){
    $this->title=$title;
    return true;
  }
  
  public function set_description($description){
    $this->description=$description;
    return true;
  }
  
  public function set_image_link($image_link){
    $this->image_link=$image_link;
    return true;
  }
  
  public function set_price($price){
    $this->price=$price;
    return true;
  }
  
  public function get_id(){
    return $this->id;
  }
  
  public function get_title(){
    return $this->title;
  }
  
  public function get_description(){
    return $this->description;
  }
  
  public function get_image_link(){
    return $this->image_link;
  }
  
  public function get_price(){
    return $this->price;
  }
  
  public function set_data_array($data_array){
    $this->data_array=$data_array;
    return true;
  }
  
  public function set_products_array($products_array){
    $this->products_array=$products_array;
    return true;
  }
  
  public function get_data_array(){
    return $this->data_array;
  }
  
  public function get_products_array(){
    return $this->products_array;
  }
}
?>