<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("conn.php");

// Check if the user is logged in
if (isset($_SESSION['examineeSession']['examineenakalogin']) && isset($_SESSION['examId'])) {
    $exmne_id = $_SESSION['examineeSession']['exmne_id'];
    $examId = $_SESSION['examId'];

    // Check if the exam_attempt record exists
    $selExAttempt = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmne_id' AND exam_id='$examId'");
    
    if ($selExAttempt && $selExAttempt->rowCount() > 0) {
        // If exam_attempt record exists, update its status to 'used'
        $insAttempt = $conn->query("UPDATE exam_attempt SET examat_status = 'used' WHERE exmne_id='$exmne_id' AND exam_id='$examId'");
        
        if ($insAttempt) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        // If exam_attempt record doesn't exist, insert a new record
        $insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id, exam_id, examat_status) VALUES('$exmne_id','$examId','used')");
        
        if ($insAttempt) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>GNC</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="pages/demo.css" />
</head>
<body>

<header class="ScriptHeader">
    <div class="rt-container">
        <div class="col-rt-12">
        </div>
    </div>
</header>

<section>
    <div class="rt-container">
        <div class="col-rt-12">
            <div class="Scriptcontent">
                <div id='card' class="animated fadeIn" style="margin-left:2%;">
                    <div id='upper-side'>
                        <div class="image">
                            <img src="pages/909.png" width="150px" alt="Success Image">
                        </div>
                        <h3 id='status'>
                            Success
                        </h3>
                    </div>
                    <div id='lower-side'>
                        <h1 id='message'>Thanks for completing the examination</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Analytics -->

</body>
</html>
