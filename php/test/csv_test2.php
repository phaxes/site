www<?php

// Klassen einbinden...
require_once("../../inc/csv/CSV.inc.php");

// Objekte instanziieren...
$CSV=new CSV();

//$array=$CSV->csv_object("../../csv/products/db_tyres.csv");

$array=$CSV->load_products_array();

echo "<pre>";
print_r($array);
echo "</pre>";


//$row = 1;
//if (($handle = fopen("../../csv/products/db_tyres.csv", "r")) !== FALSE) {
//    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//        $num = count($data);
//        echo "<p> $num Felder in Zeile $row: <br /></p>\n";
//        $row++;
//        for ($c=0; $c < $num; $c++) {
//            echo $data[$c] . "<br />\n";
//        }
//    }
//    fclose($handle);
//}

//$csvFile = file('../../csv/products/db_tyres.csv');
//
//$keys = str_getcsv(array_shift($csvFile), ';');
//foreach ($csvFile as $csvRecord) {
//    $csv[] = array_combine($keys, str_getcsv($csvRecord, ';'));
//}
//echo "<pre>";
//print_r($csv);
//echo "</pre>"; 


//class CSVFile extends \SplFileObject
//{
//    private $keys;
//    private $selectedCols;
//
//    public function __construct($file, $delimiter)
//    {
//        parent::__construct($file);
//        $this->setFlags(SplFileObject::READ_CSV);
//        echo "<pre>"; 
//        print_r($this->setFlags(SplFileObject::READ_CSV)); 
//        echo "</pre>";
//        $this->setCsvControl($delimiter);
//        
//    }
//
//    public function rewind()
//    {
//        parent::rewind();
//        $this->keys = parent::current();
//        echo "<pre>"; 
//        print_r($this->keys); 
//        echo "</pre>";
//        parent::next();
//    }
//
//    public function current()
//    {
//        return array_combine($this->keys, parent::current());
//    }
//
//    public function setSelectedCols($selectedCols)
//    {
//      $this->selectedCols = $selectedCols;
//    }
//
//    public function toArray()
//    {
//        foreach ($this as $line) {
//          if (isset($this->selectedCols)) {
//            foreach($this->selectedCols as $selectedCol) {
//              $row[$selectedCol] = $line[$selectedCol];
//            }  
//          } else {
//            $row = $line; 
//          }
//
//          $return[] = $row;
//        }
//        return $return;
//    }
//}
//
//// Aufruf
//$csv = new CSVFile('../../csv/products/db_tyres.csv', ';');
//$csv->setSelectedCols(['id','manufacturer','name','additional','price','availability','product_image']); // optional
//echo "<pre>";
//print_r($csv->toArray());
//echo "</pre>"; 
//?>