<?php 
 include("../../../conn.php");


extract($_POST);

$delExam = $conn->query("DELETE  FROM exam_tbl WHERE ex_id='$id'  ");
$delmanage = $conn->query("DELETE FROM exam_question_tbl where exam_id ='$id'");
if($delExam)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>