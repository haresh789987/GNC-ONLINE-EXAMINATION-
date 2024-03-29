<?php

include("../../../conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cou_id'])) {
    $selectedCouId = $_POST['cou_id'];

$stmt = $conn->prepare("SELECT stream FROM course_tbl WHERE cou_id = :cou_id");
$stmt->bindParam(':cou_id', $selectedCouId, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Return the 'steam' value as a response to the AJAX request
    echo $result['stream'];
} else {
    // Handle the case where no matching record is found
    echo "No stream value found for the selected course.";
}


} else {
    // Handle the case where the POST data is not set or invalid
    echo "Invalid request.";
}
?>
