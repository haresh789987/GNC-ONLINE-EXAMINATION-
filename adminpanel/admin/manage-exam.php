<?php 
session_start();

if(!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");


 ?>
<?php include("../../conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php include("includes/header.php"); ?>      

<!-- UI THEME DIRI -->


<div class="app-main">
<!-- sidebar diri  -->
<?php include("includes/sidebar.php"); ?>


<?php 
   $exId = $_GET['id'];

   $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exId' ");
   $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);

   $courseId = $selExamRow['cou_id'];
   $selCourse = $conn->query("SELECT cou_name as courseName FROM course_tbl WHERE cou_id='$courseId' ")->fetch(PDO::FETCH_ASSOC);
 ?>


<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                     <div class="page-title-heading">
                        <div> MANAGE EXAM
                            <div class="page-title-subheading">
                              Add Question for <?php echo $selExamRow['ex_title']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
            <div id="refreshData">

<div class="container">

        <div class="col-md- 06">
    <div class="main-card mb-02 card">
      <div class="card-header">
        <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Exam Information
      </div>
      <div class="card-body">
        <form method="post" id="updateExamFrm">
                               <div class="form-group">
                                <label>Course</label>
                                <select class="form-control" name="courseId" required="">
                                  <option value="<?php echo $selExamRow['cou_id']; ?>"><?php echo $selCourse['courseName']; ?></option>
                                  <?php 
                                    $selAllCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC");
                                    while ($selAllCourseRow = $selAllCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                                      <option value="<?php echo $selAllCourseRow['cou_id']; ?>"><?php echo $selAllCourseRow['cou_name']; ?></option>
                                    <?php }
                                   ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Exam Title</label>
                                <input type="hidden" name="examId" value="<?php echo $selExamRow['ex_id']; ?>">
                                <input type="" name="examTitle" class="form-control" required="" value="<?php echo $selExamRow['ex_title']; ?>">
                              </div>  

                              <div class="form-group">
                                <label>Exam Description</label>
                                <input type="" name="examDesc" class="form-control" required="" value="<?php echo $selExamRow['ex_description']; ?>">
                              </div>  

                              <div class="form-group">
                                <label>Exam Time limit</label>
                                <select class="form-control" name="examLimit" required="">
                                  <option value="<?php echo $selExamRow['ex_time_limit']; ?>"><?php echo $selExamRow['ex_time_limit']; ?> Minutes</option>
                                  <option value="10">10 Minutes</option> 
                                  <option value="20">20 Minutes</option> 
                                  <option value="30">30 Minutes</option> 
                                  <option value="40">40 Minutes</option> 
                                  <option value="50">50 Minutes</option> 
                                  <option value="60">60 Minutes</option> 
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Display limit</label>
                                <input type="number" name="examQuestDipLimit" class="form-control" value="<?php echo $selExamRow['ex_questlimit_display']; ?>"> 
                              </div>

                              <div class="form-group" align="right">
                                <button type="submit" class="btn btn-primary btn-lg">Update</button>
                              </div> 
                           </form>                           
                          </div>
                      </div>
                   
                  </div>
     </div> <br> <br>

                  <div class="col-md-12">
                    <?php 
                        $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ");
                    ?>
                     <div class="main-card mb-3 card">
<div class="card-header">
    <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i> Exam Question's
    <span class="badge badge-pill badge-primary ml-2">
        <?php echo $selQuest->rowCount(); ?>
    </span>
    <div class="btn-actions-pane-right d-flex justify-content-between align-items-center">
      
       <form class="form-inline" action="pages/excel.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="ex_id" value="<?php echo $exId; ?>">
    <div class="form-group">
    
        <input type="file" name="excel" id="excel" required class="form-control-file">
    </div>
    <button type="submit" class="btn btn-sm btn-success ml-2" name="import" style="margin-right: 10px;">Import</button>
</form>

          <form method="POST" class="text-center">
            <a href="pages/print.php?id=<?php echo $exId; ?>" class="btn btn-sm btn-primary" name="sel">Preview</a>
        </form>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalForAddQuestion" style="margin-left: 10px;">Add Question</button>
    </div>
</div>

                      
                          <div class="card-body">
                     
                            <div class="scroll-area-sm" style="min-height: 500px;">
                               <div class="scrollbar-container">
                        
                            <?php 
    if($selQuest->rowCount() > 0) {  ?>
        <div class="table-responsive">
        <div class="table-responsive" style="max-height: 500px; overflow: auto;">
    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                <thead>
                    <tr>
                        <th class="text-left pl-1">Course Name</th>
                        <th class="text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($selQuest->rowCount() > 0) {
                            $i = 1;
                            while ($selQuestionRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td>
                                        <b><?php echo $i++ ; ?> .) <?php echo $selQuestionRow['exam_question']; ?></b><br>
                                        <b><?php echo "UNIT"; ?> <?php echo $selQuestionRow['exam_unit']; ?></b><br>
                                        <?php 
                                            // Choices A, B, C, D
                                            $choices = ['exam_ch1', 'exam_ch2', 'exam_ch3', 'exam_ch4'];
                                            foreach ($choices as $choice) {
                                                $isCorrect = ($selQuestionRow[$choice] == $selQuestionRow['exam_answer']) ? 'text-success' : '';
                                                echo "<span class='pl-4 $isCorrect'>" . strtoupper(substr($choice, -1)) . " - " . $selQuestionRow[$choice] . "</span><br>";
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a rel="facebox" href="facebox_modal/updateQuestion.php?id=<?php echo $selQuestionRow['eqt_id']; ?>" class="btn btn-sm btn-primary">Update</a>
                                        <button type="button" id="deleteQuestion" data-id='<?php echo $selQuestionRow['eqt_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            <?php }
                        }
                        else { ?>
                            <tr>
                                <td colspan="2">
                                    <h3 class="p-3">No Course Found</h3>
                                </td>
                            </tr>
                        <?php }
                    ?>

                </tbody>
            </table>
            </div>
        </div>
    <?php }
    else { ?>
        <h4 class="text-primary">No question found...</h4>
    <?php } ?>
</div>

                          </div>
                        
                      </div>
                  </div>
              </div>  
            </div> 
            </div>
                </div>
</div>
            </div>


<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>
