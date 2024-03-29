<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Register</title> 
</head>
    <body>


        <div class="container">
            <header>Registration <button  class="button-28" role="button" onclick="window.location.href = '../home.php';"><span class="text"  >BACK TO SIGNIN</span></button></header>
          <form action="addExamineeExe.php" method="POST">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Personal Details</span>

                        <div class="fields">
                            <div class="input-field">
                                <label>Full Name</label>
                                <input type="text" name="fullname"  class="form-control" id="fullname" autocomplete="off"  placeholder="Enter your name" required="">
                            </div>

                            <div class="input-field">
                                <label>Register Number</label>
                <input type="number" name="regno" id="regno" class="form-control" placeholder="Input regno" autocomplete="off" required="">
                            </div>

                            <div class="input-field">
                                 <label>Birhdate</label>
                <input type="date" name="bdate" id="bdate" class="form-control" placeholder="Input Birhdate" autocomplete="off" >
                            </div>

                            <div class="input-field">
                                <label>Gender</label>
                <select class="form-control" name="gender" id="gender">
                  <option value="0">Select gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
                            </div>

                            <div class="input-field">
                                <label>Course</label>
                <select class="form-control" name="course" id="course">
                  <option value="0">Select course</option>
                  <?php 
                  include 'conn.php';
                    $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id asc");
                    while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $selCourseRow['cou_id']; ?>"><?php echo $selCourseRow['cou_name']; ?></option>
                    <?php }
                   ?>
                </select>
                            </div>

                            <div class="input-field">
                               <label>Year Level</label>
                <select class="form-control" name="year_level" id="year_level">
                  <option value="0">Select year level</option>
                  <option value="first year">First Year</option>
                  <option value="second year">Second Year</option>
                  <option value="third year">Third Year</option>

                </select>
                            </div>
                                                    <div class="input-field">
                                 <label>Section</label>
                <select class="form-control" name="Section" id="Section">
                  <option value="0">Select section</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                </select>
                            </div>
                                                    <div class="input-field">
                                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Input Email" autocomplete="off" required="">
                            </div>

                            <div class="input-field">
                                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Input Password" autocomplete="off" required="">
                            </div>
                               <button>
                            <span class="btnText" type="submit" name="sumbit" value="SUBMIT">SUBMIT</span>

                            <i class="uil uil-navigator"></i>
                        </button>
                        </div>
                    </div>


                </div>

            </form>
        </div>

        <script src="script.js"></script>
    </body>
</html>