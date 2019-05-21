<?php

interface DATA_SOURCE{
  
  public function set_data_array($data_array);
  
  public function set_products_array($products_array);
  
  public function get_data_array();
  
  public function get_products_array();
  
}
?>