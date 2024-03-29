<?php
include '../../../conn.php';
$exId = isset($_POST['ex_id']) ? $_POST['ex_id'] : null;
if (isset($_POST["import"])) {
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "pages/uploads/" . $newFileName;

    // Create the directory if it doesn't exist
    if (!file_exists("uploads/")) {
        mkdir("uploads/", 0777, true);
    }

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory)) {
        // File moved successfully

        // Use absolute path for SpreadsheetReader
        $absolutePath = __DIR__ . DIRECTORY_SEPARATOR . $targetDirectory;

        // Require the necessary files
        require 'excelReader/excel_reader2.php';
        require 'excelReader/SpreadsheetReader.php';

        try {
            // Initialize SpreadsheetReader with the absolute path
            $reader = new SpreadsheetReader($absolutePath);

            foreach ($reader as $key => $row) {
               $question = $row[0];
        $choice_A = $row[1];
        $choice_B = $row[2];
        $choice_C = $row[3];
        $choice_D = $row[4];
        $correctAnswer = $row[5];
        $unit = $row[6];

        $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_question = '$question'");
        if ($selQuest->rowCount() > 0) {
            $res = array("res" => "exist", "msg" => $question);
        } else {
            $insQuest = $conn->query("INSERT INTO exam_question_tbl(exam_id,exam_question,exam_ch1,exam_ch2,exam_ch3,exam_ch4,exam_answer,exam_unit) VALUES('$exId','$question','$choice_A','$choice_B','$choice_C','$choice_D','$correctAnswer','$unit') ");

            if ($insQuest) {
                echo "Insert query executed successfully!";
                $res = array("res" => "success", "msg" => $question);
            } else {
                echo "Insert query failed: " . $conn->error;
                $res = array("res" => "failed");
            }
        }
    }

            echo "
                <script>
                alert('Successfully Imported'); 
                document.location.href = '../home.php';
                </script>
            ";
        } catch (Exception $e) {
            // Handle exceptions thrown by SpreadsheetReader
            die("Error reading spreadsheet: " . $e->getMessage());
        }
    } else {
        // Display an error message if move_uploaded_file fails
        die("Error moving uploaded file");
    }
}
?>
