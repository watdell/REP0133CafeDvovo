<?php
// Include the PhpSpreadsheet Autoloader
require '../../../vendor/autoload.php';  // Include the Composer autoloader for PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

include '../../../serverside/config/dbConnection.php';

$conn = dbConnection();

$repeated == 'NOTNOTNOTNOT';

if (isset($_POST['submit'])) {
    // Check if file is uploaded
    if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == 0) {
        $fileTmpPath = $_FILES['excelFile']['tmp_name'];
        $fileName = $_FILES['excelFile']['name'];
        $fileSize = $_FILES['excelFile']['size'];
        $fileType = $_FILES['excelFile']['type'];

        // Validate file type (Excel)
        $allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];

        if (in_array($fileType, $allowedTypes)) {
            try {
                // Load the Excel file
                $spreadsheet = IOFactory::load($fileTmpPath);

                // Get the active sheet (the one that is visible)
                $sheet = $spreadsheet->getActiveSheet();

                // Convert the sheet into an array of rows
                $rows = $sheet->toArray();

                // Loop through each row in the Excel file
                foreach ($rows as $index => $row) {
                    if ($index == 0) {
                        continue;
                    }
                    // Assuming the Excel file has columns: valor, desc
                    // Modify this based on your actual columns
                    foreach ($row as $deep_index => $deep_row) {
                        if ($deep_row == NULL) {
                        } else { 
                            $full = $deep_index;
                            break;
                        }
                    }

                    $email = $row[$full + 1];
                    $total = $row[$full + 10];
                    $data = $row[$full + 2];

                    if ($email == NULL || $email == $repeated) {
                        continue;
                    };

                    $repeated = $email;

                    // Skip the first row (headers)
                    echo "Valor: $data, Desc: $email\n";

                        // Insert data into database
                    $sql = "INSERT INTO vendas (cliente_id, total, data_venda) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sds", $email, $total, date('Y-m-d',strtotime($data))); // Adjust the data types accordingly
                    $stmt->execute();
                }
                echo "Data successfully inserted into the database.";
            } catch (Exception $e) {
                echo 'Error loading file: ', $e->getMessage();
            }
        } else {
            echo "Please upload a valid Excel file.";
        }
    } else {
        echo "No file uploaded or there was an error with the upload.";
    }
}

$conn->close();

header("Location: completo_excel.php");