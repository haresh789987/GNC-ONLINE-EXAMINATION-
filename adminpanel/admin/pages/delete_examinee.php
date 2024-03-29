<?php
include("../../../conn.php");

if (isset($_POST['id'])) {
    $exmne_id = $_POST['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM exam_attempt WHERE exmne_id = :exmne_id");
    $stmt->bindParam(':exmne_id', $exmne_id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        $res = array("res" => "success");
    } else {
        // Provide more information in case of an error
        $res = array("res" => "failed", "error" => $stmt->errorInfo());
    }
} else {
    // Handle the case where exmne_id is not set in the POST data
    $res = array("res" => "failed", "error" => "exmne_id not provided in POST data");
}

// Encode the result as JSON and output
echo json_encode($res);
?>
