
<?php 
  include("../../../conn.php");
  $id = $_GET['id'];
 
  $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id' ")->fetch(PDO::FETCH_ASSOC);

 ?>

<fieldset style="width:543px;" >
	<legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Update Course Name ( <?php echo strtoupper($selCourse['cou_name']); ?> )</i></legend>
  <div class="col-md-12 mt-4">
<form method="post" id="updateCourseFrm">
<div class="form-group">
  <fieldset>
    <legend>Course Id</legend>
    <input type="hidden" name="core_id" value="<?php echo $id; ?>">
    <input type="text" name="newCourseId" class="form-control" required="" value="<?php echo $selCourse['cou_id']; ?>">
  </fieldset>

  <fieldset>
    <legend>Course Name</legend>
    <input type="hidden" name="course_id" value="<?php echo $id; ?>">
    <input type="text" name="newCourseName" class="form-control" required="" value="<?php echo $selCourse['cou_name']; ?>">
  </fieldset>

<fieldset>
    <legend>Status</legend>
    <input type="hidden" name="stream" value="<?php echo $id; ?>">
    <select name="newstream" class="form-control" required="">
        <option value="I" <?php echo ($selCourse['stream'] == 'I') ? 'selected' : ''; ?>>I</option>
        <option value="II" <?php echo ($selCourse['stream'] == 'II') ? 'selected' : ''; ?>>II</option>
    </select>
</fieldset>

</div>
  <div class="form-group" align="right">
    <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
  </div>
</form>
  </div>
</fieldset>







