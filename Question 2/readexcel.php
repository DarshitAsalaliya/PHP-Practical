<html>

<body>
    <center>
        <h2>Read Excel By PHPExcel</h2>
        <?php
        require_once "Classes/PHPExcel.php";
        $path = "student.xlsx";
        $reader = PHPExcel_IOFactory::createReaderForFile($path);
        $excel_Obj = $reader->load($path);

        $worksheet = $excel_Obj->getSheet('0');
        $lastRow = $worksheet->getHighestRow();
        $colomncount = $worksheet->getHighestDataColumn();
        $colomncount_number = PHPExcel_Cell::columnIndexFromString($colomncount);
        echo $lastRow . '     ';
        echo $colomncount;
        echo "<table border='1'>";
        for ($row = 1; $row <= $lastRow; $row++) {
            echo "<tr>";
            for ($col = 0; $col <= $colomncount_number-1; $col++) {
                echo "<td>";
                echo $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue();
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </center>
</body>

</html>