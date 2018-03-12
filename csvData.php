<?php
function getCsvData($filePath) {
  $array = $fields = array(); $i = 0;
  $handle = @fopen($filePath, "r");
  if ($handle) {
    while (($row = fgetcsv($handle, 4096, "|")) !== false) {
        if (empty($fields)) {
            $fields = $row;
            continue;
        }
        foreach ($row as $k=>$value) {
            $array[$i][$fields[$k]] = $value;
        }
        $i++;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
  }

  #$products = sizeof($array);
  array_unshift($array, "0"); // Fügt den Wert 0 an den Anfang des Arrays an
  unset($array[0]); // Entfernt den ersten Wert das Arrays
  return $array;

  }
?>
