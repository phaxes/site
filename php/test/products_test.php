<html>
<meta charset="UTF-8"/>
	<head>
		<title> Artikel </title>
	</head>
	
	<body>
  
<?php
//Klassen einbinden...
require_once("../../inc/products/PRODUCTS.inc.php");

//Objekte instanziieren...
$PRODUCTS=new PRODUCTS();

$products_array=$PRODUCTS->load_norm_data_array();

//echo "<pre>";
//print_r($products_array);
//echo "</pre>";

?>
<table>
  <thead>
  <tr>
    <form action="result_page_test.php" method="post">
      <td>
				<label> Suchfunktion: 
				  <input type="Text" name="String"/>
				  <input type="submit" value="Artikel suchen"/>
				</label> 
      </td>
    </tr>
    <tr>
      <th><?php echo implode('</th><th>', array_keys(current($products_array))); ?></th>
      <th>detail</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach($products_array as $row){
      array_map('htmlentities', $row);
    ?>
    <tr>
      <td>
        <?php 
          echo implode('</td><td>', $row);
        ?>
      </td>
      <td>
        <form>
          <input type="button" value="detail" onclick="window.location.href='<?php echo $row["image_link"][0]; ?>'"/>
        </form>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
	</body>
</html>