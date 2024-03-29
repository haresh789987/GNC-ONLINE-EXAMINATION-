<?php
include "../../../conn.php";
              if(isset($_POST['id']) && isset($_POST['status'])){
                                       $ex_id=$_POST['id'];
                                       $status=$_POST['status'];
                                       $sql = "UPDATE `exam_tbl` set status=? where ex_id=?";
                                       $conn->prepare($sql)->execute([$status, $ex_id]);
}