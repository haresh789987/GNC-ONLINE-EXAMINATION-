<?php 
include("../../../conn.php");

extract($_POST);
$core_id = $_POST['core_id'];
$course_name = strtoupper($course_name);
$stream = $_POST['stream']; // Add this line to extract the stream value

$selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_name='$course_name' AND cou_id='$core_id' AND stream='$stream'");

if($selCourse->rowCount() > 0) {
    $res = array("res" => "exist", "course_name" => $course_name);
} else {
    $insCourse = $conn->query("INSERT INTO course_tbl(cou_name, cou_id, stream) VALUES('$course_name','$core_id', '$stream') ");
    if($insCourse) {
        $res = array("res" => "success", "course_name" => $course_name);
    } else {
        $res = array("res" => "failed", "course_name" => $course_name);
    }
}

echo json_encode($res);
?>
