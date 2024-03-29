<?php include("../../../conn.php"); ?>

<?php 
    $exId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exId' ");
    $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);
    $courseId = $selExamRow['cou_id'];
    $selCourse = $conn->query("SELECT cou_name as courseName FROM course_tbl WHERE cou_id='$courseId' ")->fetch(PDO::FETCH_ASSOC);
?>

<div style="text-align: center; font-size: 40px;">
    EXAM NAME: <?php echo $selExamRow['ex_title']; ?>
</div>
<br>

<style>
    .text-success {
        color: red;
    }
</style>

<?php 
    $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ");
?>

<div style="text-align: center; font-size: 20px;" >
    Exam Question's     <?php echo $selQuest->rowCount(); ?>
</div>
<br><br>

<?php if ($selQuest->rowCount() > 0) { ?>
    <table>
        <tbody>
            <?php 
                if ($selQuest->rowCount() > 0) {
                    $i = 1;
                    while ($selQuestionRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td>
                                <b class="text-center"><?php echo $i++; ?> .) <?php echo $selQuestionRow['exam_question']; ?> &nbsp;&nbsp;&nbsp;<?php echo "UNIT"; ?> <?php echo $selQuestionRow['exam_unit']; ?></b><br>
                               
                                <?php 
                                    $choices = ['exam_ch1', 'exam_ch2', 'exam_ch3', 'exam_ch4'];
                                    $romanNumerals = ['i', 'ii', 'iii', 'iv'];
                                    foreach ($choices as $index => $choice) {
                                        $isCorrect = ($selQuestionRow[$choice] == $selQuestionRow['exam_answer']) ? 'text-success' : '';
                                        echo "<span class='pl-4 $isCorrect'>" . $romanNumerals[$index] . " - " . $selQuestionRow[$choice];
                                        
                                        // Add text after the correct answer
                                        if ($isCorrect) {
                                            echo " ~ Correct Answer";
                                        }
                                        
                                        echo "</span><br>";
                                    }

                                    // Add space between options and next question
                                    echo "<br>";
                                ?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <!-- Handle no questions found -->
                <?php }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <h4 class="text-primary text-center">No question found...</h4>
<?php } ?>
