<?php
include("../../../conn.php");
extract($_POST);

$newCourseId = $_POST['newCourseId'];
$newCourseName = strtoupper($newCourseName);
$newstream = $_POST['newstream'];
$updCourse = $conn->query("UPDATE course_tbl SET cou_name='$newCourseName', cou_id='$newCourseId', stream ='$newstream' WHERE cou_id='$course_id'");
if($updCourse)
{
    $res = array("res" => "success", "newCourseName" => $newCourseName);
}
else
{
    $res = array("res" => "failed");
}

echo json_encode($res);    
?> 