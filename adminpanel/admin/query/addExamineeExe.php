    <?php
    include("../../../conn.php");

    if (isset($_POST['fullname'], $_POST['regno'], $_POST['course'], $_POST['gender'], $_POST['bdate'], $_POST['year_level'], $_POST['Section'], $_POST['email'], $_POST['password'])) {

      extract($_POST);

      $selExamineeFullname = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_fullname = :fullname");
      $selExamineeFullname->bindParam(':fullname', $fullname);
      $selExamineeFullname->execute();

      $selExamineeEmail = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_email = :email");
      $selExamineeEmail->bindParam(':email', $email);
      $selExamineeEmail->execute();

      $courseId = $_POST['course'];
      $streamKey = 'stream_' . $courseId;
 $stream = isset($_POST['stream']) ? $_POST['stream'] : '';


      if ($gender == "0") {
        $res = array("res" => "noGender");
      } else if ($course == "0") {
        $res = array("res" => "noCourse");
      } else if ($year_level == "0") {
        $res = array("res" => "noLevel");
      } else if ($selExamineeFullname->rowCount() > 0) {
        $res = array("res" => "fullnameExist", "msg" => $fullname);
      } else if ($selExamineeEmail->rowCount() > 0) {
        $res = array("res" => "emailExist", "msg" => $email);
      } else {
        $insData = $conn->prepare("INSERT INTO examinee_tbl(exmne_fullname, exmne_regno, exmne_course, exmne_stream, exmne_gender, exmne_birthdate, exmne_year_level, exmne_section, exmne_email, exmne_password) VALUES (:fullname, :regno, :course, :stream, :gender, :bdate, :year_level, :Section, :email, :password)");

        $insData->bindParam(':fullname', $fullname);
        $insData->bindParam(':regno', $regno);
        $insData->bindParam(':course', $course);
      $insData->bindParam(':stream', $stream);
        $insData->bindParam(':gender', $gender);
        $insData->bindParam(':bdate', $bdate);
        $insData->bindParam(':year_level', $year_level);
        $insData->bindParam(':Section', $Section);
        $insData->bindParam(':email', $email);
        $insData->bindParam(':password', $password);

        if ($insData->execute()) {
          $res = array("res" => "success", "msg" => $email);
        } else {
          $res = array("res" => "failed");
        }
      }

      echo json_encode($res);
    } else {
      // Handle the case when POST variables are not set
      $res = array("res" => "missingData");
      echo json_encode($res);
    }
    ?>
