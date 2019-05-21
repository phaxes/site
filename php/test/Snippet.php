<?php
if(isset($col_input)){
    foreach($col_input as $input){
      $string_array=explode('"',$input);
      if(strstr($string_array[0],"form")) echo $this->input_form($string_array[1],$string_array[3],$string_array[5])."<br>";
      if(strstr($string_array[0],"button")) echo $this->input_button($string_array[1],$string_array[3],$string_array[5])."<br>";
    }
  }
?>