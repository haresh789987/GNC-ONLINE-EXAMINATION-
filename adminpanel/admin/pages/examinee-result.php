<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title" style="background-color: lightslategrey; ">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div style='font-weight:bold;color:black;'>STUDENTS RESULT</div>
                    
                </div>
            </div>
        </div>

   <div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-header text-center">Students Result</div>
        <div class="card-body">
            <form method="POST" action="" class="text-center">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <?php
                        $stmt = $conn->query("SELECT cou_id FROM course_tbl");
                        $stmt->execute();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo "<select name='co' class='form-control'>";
                        echo "<option selected>course</option>";
                        foreach ($rows as $row) {
                            echo "<option value='{$row['cou_id']}'>{$row['cou_id']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="yr" class="form-control">
                            <option value="">year</option>
                            <option value="first year">first year</option>
                            <option value="second year">second year</option>
                            <option value="third year">third year</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="sec" class="form-control">
                            <option value="">section</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>

              
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="submit" name="sel" value="Submit" class="btn btn-primary">
                    </div>
                </div>
                    
            </form>
        </div>
    </div>
</div>

            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Exam Name</th>
                            <th>Register Number</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Section</th>
                            <th>stream</th>
                            <th>Scores</th>
                            <th>Ratings</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                                           <?php 
             if(isset($_POST['sel'])){
                            include "../../conn.php";
                      
                            $co = isset($_POST['co']) ? $_POST['co'] : '';
                            $yr = isset($_POST['yr']) ? $_POST['yr'] : '';
                            $sec = isset($_POST['sec']) ? $_POST['sec'] : '';
                            $selExmne = $conn->query("SELECT * FROM examinee_tbl et INNER JOIN exam_attempt ea ON et.exmne_id = ea.exmne_id WHERE exmne_course='$co' AND exmne_year_level='$yr' AND exmne_section='$sec' ORDER BY ea.examat_id DESC");
                            if($selExmne->rowCount() > 0)
                            {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                           <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                                          
                                           <td>
                                             <?php 
                                                $eid = $selExmneRow['exmne_id'];
                                                $selExName = $conn->query("SELECT * FROM exam_tbl et INNER JOIN exam_attempt ea ON et.ex_id=ea.exam_id WHERE  ea.exmne_id='$eid' ")->fetch(PDO::FETCH_ASSOC);
                                                $exam_id = $selExName['ex_id'];
                                                echo $selExName['ex_title'];
                                              ?>
                                           </td>
                                             <td><?php echo $selExmneRow['exmne_regno']; ?></td>
                                             <td>
                                            <?php 
                                                 $exmneCourse = $selExmneRow['exmne_course'];
                                                 $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$exmneCourse' ")->fetch(PDO::FETCH_ASSOC);
                                                 echo $selCourse['cou_name'];
                                             ?>
                                            </td>
                                           <td><?php echo $selExmneRow['exmne_year_level']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_section']; ?></td>
                                           <td> <?php 
        $cou_name = $selCourse['cou_name'];
        $selstream = $conn->query("SELECT * FROM course_tbl WHERE cou_name='$cou_name'")->fetch(PDO::FETCH_ASSOC);
        echo $selstream['stream'];
    ?>
                                           </td>
                                          <td>
  <?php 
    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$eid' AND ea.exam_id='$exam_id' AND ea.exans_status='new' ");
  ?>
  <span>
    <?php echo $selScore->rowCount(); ?>
    <?php 
      $over = $conn->query("SELECT ex_questlimit_display FROM exam_tbl WHERE ex_id='$exam_id' ")->fetchColumn();
//      echo $over;
    ?>
  </span> / <?php echo $over; ?>
</td>
<td>
  <?php 
    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$eid' AND ea.exam_id='$exam_id' AND ea.exans_status='new' ");
  ?>
  <span>
    <?php 
      $score = $selScore->rowCount();
      $ans = $score / $over * 100;
      echo number_format($ans,2);
      echo "%";
    ?>
  </span> 
</td>

                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Course Found</h3>
                                      </td>
                                    </tr>
             <?php }
                               ?>
                                    <?php
             }
             ?>

                    </tbody>
                        </table>
                    </div>
                </div>
            </div>
      
</div>
