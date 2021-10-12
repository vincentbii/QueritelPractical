<?php

/**
 * As stated on instructions page, a user uses the command given
 *
 * valid file locations must be provided
 */
if (!isset($argv[1])) {
    echo "please provide sample input file";
    exit();
}

if (!isset($argv[2])) {
    echo "please provide converted output file";
    exit();
}

$sample_csv_file = trim($argv[1]);

$sql_output_file = trim($argv[2]);

echo $sample_csv_file;
echo $sql_output_file;
$row = 1;

$header = "";
$values = "";
$fAppend = fopen($sql_output_file, "a");
if (($handle = fopen($sample_csv_file, "r")) !== FALSE) {
    while (($datas = fgetcsv($handle, 10, ",")) !== FALSE) {
        if ($row == 1) {
            foreach ($datas as $column) {
                $header .= "'" . addslashes($column) . "',";
            }
            $header = rtrim($header, ", ");
        } else {
            $values = "";
            foreach ($datas as $column) {
                $value = preg_replace('/\s+/S', " ", $column);
                $values .= addslashes($value);
            }
            echo $values . "\n";
        }
        $sqlInsert = "INSERT INTO COUNTRIES($header) VALUES ($values);";
        fwrite($fAppend, $sqlInsert);
        $row++;
    }
    fclose($handle);
}


fclose($fAppend);