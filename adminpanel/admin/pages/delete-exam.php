<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <title>Examinee Attempt list</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title" style="background-color: lightslategrey;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div style='font-weight:bold;color:black;'>DELETE ATTEMPTED EXAMINEE</div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Examinee Attempt list</div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                            <thead>
                                <tr>
                                    <th>Fullname</th>
                                    <th>Register Number</th>
                                    <th>Course</th>
                
                                    <th>Exam Attempt status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selExmne = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id IN (SELECT exmne_id FROM exam_attempt) ORDER BY exmne_id DESC");

                                if ($selExmne->rowCount() > 0) {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) {
                                        $exmne_id = $selExmneRow['exmne_id'];
                                ?>
                                        <tr>
                                            <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                                            <td><?php echo $selExmneRow['exmne_regno']; ?></td>
                                            <td>
                                                <?php
                                                $exmne_course = $selExmneRow['exmne_course'];
                                                $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$exmne_course' ")->fetch(PDO::FETCH_ASSOC);
                                                echo $selCourse['cou_name'];
                                                ?>
                                            </td>


                                            <td>
                                                <?php
                                                $selExamAttempt = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmne_id' ");
                                                if ($selExamAttempt->rowCount() > 0) {
                                                    while ($examAttemptRow = $selExamAttempt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                        <div>
                                                            <input type="hidden" name="examat_id" value="<?php echo $examAttemptRow['examat_id']; ?>">
                                                            <input type="hidden" name="exmne_id" value="<?php echo $examAttemptRow['exmne_id']; ?>">
                                                            <input type="hidden" name="exam_id" value="<?php echo $examAttemptRow['exam_id']; ?>">
                                                            <p> <?php echo $examAttemptRow['examat_status']; ?></p>
                                                        </div>
                                                <?php
                                                    }
                                                } else {
                                                    echo 'No data available in exam_attempt for exmne_id: ' . $exmne_id;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                
                                                 <button type="button" id="delete-Exam" data-id='<?php echo $exmne_id; ?>' class="btn btn-danger btn-sm">Delete</button>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="6">
                                            <h3 class="p-3">No Student available</h3>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script>
$(document).ready(function() {
    $(document).on("click", "#delete-Exam", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type : "POST",
            url : "pages/delete_examinee.php",
            dataType : "json",  
            data : {id: id},
            cache : false,
            success : function(data){
                if(data.res == "success") {
                    Swal.fire(
                        'Success',
                        'Selected Student successfully deleted',
                        'success'
                    )
                    refreshDiv();
                }
            },
            error : function(xhr, ErrorStatus, error){
                console.log(status.error);
            }
        });
        return false;
    });

});
</script>
</body>

</html>
