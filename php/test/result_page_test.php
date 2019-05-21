<?php

//Klassen einbinden...
require_once("../../inc/products/PRODUCTS.inc.php");

//Objekte instanziieren...
$PRODUCTS=new PRODUCTS();

$products_array=$PRODUCTS->load_norm_data_array();

$String="Id";

$result=array_keys($products_array, $String);

echo "<pre>";
print_r($result);
echo "</pre>";

?>
<html>
<meta charset="UTF-8"/>
	<head>
		<title> Artikel </title>
	</head>
	
	<body>
<input type="search" placeholder="Suche" id="search"/>

	</body>
</html>
